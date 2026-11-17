/**
 * Write a sibling *.min.css for every stylesheet in public/css.
 * Original files are read-only. Re-run after editing a source stylesheet:
 *   npm run css:minify
 */
import { readdir, readFile, writeFile, stat } from 'node:fs/promises';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import { transform } from 'lightningcss';

// Keep syntax the originals already use. These targets understand clamp(), :has(),
// and custom properties, and they do not rewrite @media into range syntax or
// collapse overflow longhands into two-value shorthands older Safari drops.
const targets = {
    chrome: 80 << 16,
    edge: 80 << 16,
    firefox: 80 << 16,
    safari: (13 << 16) | (1 << 8),
    ios_saf: (13 << 16) | (1 << 8),
};

const root = path.resolve(path.dirname(fileURLToPath(import.meta.url)), '..');
const cssDir = path.join(root, 'public', 'css');

function extractUrls(css) {
    const urls = [];
    const re = /url\(\s*(?:"([^"]*)"|'([^']*)'|([^)\s]+))\s*\)/gi;
    let match;
    while ((match = re.exec(css))) {
        urls.push((match[1] ?? match[2] ?? match[3]).trim());
    }
    return urls;
}

function uniqueSorted(values) {
    return [...new Set(values)].sort();
}

function extractNames(css, atRule) {
    const names = [];
    const re = new RegExp(`@${atRule}\\s+([^{\\s]+)`, 'gi');
    let match;
    while ((match = re.exec(css))) {
        names.push(match[1]);
    }
    return names;
}

function customProperties(css) {
    const names = [];
    const re = /(--[A-Za-z0-9_-]+)\s*:/g;
    let match;
    while ((match = re.exec(css))) {
        names.push(match[1]);
    }
    return names;
}

function sameSet(left, right) {
    const a = uniqueSorted(left);
    const b = uniqueSorted(right);
    if (a.length !== b.length) {
        return false;
    }
    return a.every((value, index) => value === b[index]);
}

function stripComments(css) {
    return css.replace(/\/\*[\s\S]*?\*\//g, '');
}

function verify(source, minified) {
    const original = stripComments(source);
    const compact = stripComments(minified);
    const problems = [];
    if (!sameSet(extractUrls(original), extractUrls(compact))) {
        problems.push('url() values changed');
    }
    if (!sameSet(extractNames(original, 'keyframes'), extractNames(compact, 'keyframes'))) {
        problems.push('@keyframes names changed');
    }
    if ((original.match(/@font-face\b/gi) || []).length !== (compact.match(/@font-face\b/gi) || []).length) {
        problems.push('@font-face count changed');
    }
    if (/@media\s*\(\s*width\s*<=/i.test(compact) || /overflow:\s*clip\s+visible/i.test(compact)) {
        problems.push('minifier rewrote media or overflow syntax');
    }
    if (!sameSet(customProperties(original), customProperties(compact))) {
        problems.push('custom properties changed');
    }
    const sourceMedia = original.match(/@media\b/gi) || [];
    const minMedia = compact.match(/@media\b/gi) || [];
    if (minMedia.length > sourceMedia.length) {
        problems.push('@media count increased');
    }
    return problems;
}

const entries = (await readdir(cssDir)).filter((name) => name.endsWith('.css') && !name.endsWith('.min.css')).sort();
function withoutDataUrls(css) {
    return css
        .replace(/url\(\s*'(data:[^']*)'\s*\)/gi, 'url("")')
        .replace(/url\(\s*"(data:[^"]*)"\s*\)/gi, 'url("")')
        .replace(/url\(\s*data:[^)]*\)/gi, 'url("")');
}

const report = [];
const failures = [];
let originalBytes = 0;
let minifiedBytes = 0;
let originalRulesBytes = 0;
let minifiedRulesBytes = 0;

for (const name of entries) {
    const sourcePath = path.join(cssDir, name);
    const source = await readFile(sourcePath);
    const outputName = name.replace(/\.css$/i, '.min.css');
    const outputPath = path.join(cssDir, outputName);

    let code;
    let engine = 'lightningcss';
    try {
        const result = transform({
            filename: sourcePath,
            code: source,
            minify: true,
            sourceMap: false,
            errorRecovery: false,
            targets,
        });
        code = Buffer.from(result.code);
    } catch (error) {
        throw new Error(`${name}: Lightning CSS failed: ${error.message}`);
    }

    const problems = verify(source.toString('utf8'), code.toString('utf8'));
    if (problems.length > 0) {
        failures.push(`${name}: ${problems.join('; ')}`);
        continue;
    }

    await writeFile(outputPath, code);
    const before = (await stat(sourcePath)).size;
    const after = (await stat(outputPath)).size;
    const beforeRules = Buffer.byteLength(withoutDataUrls(source.toString('utf8')));
    const afterRules = Buffer.byteLength(withoutDataUrls(code.toString('utf8')));
    originalBytes += before;
    minifiedBytes += after;
    originalRulesBytes += beforeRules;
    minifiedRulesBytes += afterRules;
    report.push({
        file: name,
        minified: outputName,
        originalBytes: before,
        minifiedBytes: after,
        engine,
    });
}

if (failures.length > 0) {
    console.error(failures.join('\n'));
    process.exitCode = 1;
}

const reduction = originalBytes === 0 ? 0 : ((originalBytes - minifiedBytes) / originalBytes) * 100;
const rulesReduction = originalRulesBytes === 0 ? 0 : ((originalRulesBytes - minifiedRulesBytes) / originalRulesBytes) * 100;
console.log(JSON.stringify({
    files: report.length,
    originalBytes,
    minifiedBytes,
    reductionPercent: Math.round(reduction * 100) / 100,
    originalRulesBytes,
    minifiedRulesBytes,
    rulesReductionPercent: Math.round(rulesReduction * 100) / 100,
    report,
}, null, 2));
