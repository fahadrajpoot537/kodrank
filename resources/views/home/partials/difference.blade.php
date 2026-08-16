<section class="sec-ink" id="difference">
  <div class="wrap">
    <div class="head-split rv">
      <div>
        <p class="eyebrow">{{ $c['difference']['eyebrow'] ?? '' }}</p>
        <h2>{{ $c['difference']['title'] ?? '' }}</h2>
      </div>
      <p class="lede">{{ $c['difference']['lede'] ?? '' }}</p>
    </div>

    <div class="chart-split mt-lg">
      <div class="media-art rv">
        <svg viewBox="0 0 620 380" role="img" aria-label="Chart comparing organic visibility from launch day: a site retrofitted with SEO stays flat for months, while a site built with SEO starts elevated and climbs from day one">
          <defs>
            <linearGradient id="gFill" x1="0" y1="0" x2="0" y2="1">
              <stop offset="0" stop-color="#F47A1F" stop-opacity=".26"/>
              <stop offset="1" stop-color="#F47A1F" stop-opacity="0"/>
            </linearGradient>
          </defs>
          <rect x="0" y="0" width="620" height="380" rx="16" fill="rgba(255,255,255,.035)" stroke="rgba(244,122,31,.16)"/>
          <text x="30" y="40" font-family="Poppins, sans-serif" font-size="10" letter-spacing="1.8" fill="#6F8F98">ORGANIC VISIBILITY FROM LAUNCH DAY</text>
          <g stroke="rgba(255,255,255,.07)">
            <line x1="30" y1="80" x2="590" y2="80"/><line x1="30" y1="140" x2="590" y2="140"/>
            <line x1="30" y1="200" x2="590" y2="200"/><line x1="30" y1="260" x2="590" y2="260"/>
            <line x1="30" y1="300" x2="590" y2="300"/>
          </g>
          <line x1="80" y1="66" x2="80" y2="300" stroke="#F6A54E" stroke-width="1.2" stroke-dasharray="4 5" opacity=".7"/>
          <text x="88" y="76" font-family="Poppins, sans-serif" font-size="9.5" letter-spacing="1.2" fill="#F6A54E">LAUNCH</text>
          <path d="M80 214 C160 196 210 178 268 158 C330 137 384 122 444 104 C500 88 546 78 590 70 L590 300 L80 300 Z" fill="url(#gFill)"/>
          <path d="M80 214 C160 196 210 178 268 158 C330 137 384 122 444 104 C500 88 546 78 590 70" stroke="#F47A1F" stroke-width="3" fill="none" stroke-linecap="round"/>
          <circle cx="80" cy="214" r="6" fill="#0A1A22" stroke="#F47A1F" stroke-width="3"/>
          <circle cx="590" cy="70" r="5" fill="#F47A1F"/>
          <path d="M80 296 C150 295 210 293 262 288 C316 283 356 268 404 244 C458 217 512 190 590 162" stroke="#5C7C86" stroke-width="2.4" fill="none" stroke-dasharray="7 7" stroke-linecap="round"/>
          <circle cx="80" cy="296" r="5" fill="#0A1A22" stroke="#5C7C86" stroke-width="2.4"/>
          <g transform="translate(96 168)">
            <rect x="0" y="0" width="176" height="40" rx="10" fill="#0F2A33" stroke="rgba(244,122,31,.35)"/>
            <text x="14" y="17" font-family="Poppins, sans-serif" font-size="8.5" letter-spacing="1.2" fill="#F47A1F">DAY 1</text>
            <text x="14" y="31" font-family="Poppins, sans-serif" font-size="11" fill="#DCEDE2">Indexed, structured, ranking</text>
          </g>
          <g transform="translate(300 252)">
            <rect x="0" y="0" width="212" height="40" rx="10" fill="#0F2A33" stroke="rgba(255,255,255,.12)"/>
            <text x="14" y="17" font-family="Poppins, sans-serif" font-size="8.5" letter-spacing="1.2" fill="#8CA3AB">MONTHS 1–5</text>
            <text x="14" y="31" font-family="Poppins, sans-serif" font-size="11" fill="#A8BEC6">Second agency undoing the build</text>
          </g>
          <line x1="30" y1="300" x2="590" y2="300" stroke="rgba(255,255,255,.16)"/>
          <g font-family="Poppins, sans-serif" font-size="9.5" fill="#6F8F98">
            <text x="70" y="322">Launch</text><text x="230" y="322">+2 mo</text>
            <text x="390" y="322">+4 mo</text><text x="548" y="322">+6 mo</text>
          </g>
          <g transform="translate(30 344)">
            <rect x="0" y="6" width="22" height="3" rx="1.5" fill="#F47A1F"/>
            <text x="32" y="12" font-family="Poppins, sans-serif" font-size="11" fill="#DCEDE2">Built with SEO in the same sprint</text>
            <rect x="278" y="6" width="22" height="3" rx="1.5" fill="#5C7C86"/>
            <text x="310" y="12" font-family="Poppins, sans-serif" font-size="11" fill="#8CA3AB">SEO retrofitted after launch</text>
          </g>
        </svg>
      </div>
      <div class="rv">
        <h3 style="font-size:1.5rem;margin-bottom:16px">{{ $c['difference']['side_title'] ?? 'Search is not a phase. It is a constraint on the build.' }}</h3>
        <p>{{ $c['difference']['side_body'] ?? 'Every decision a developer makes — how the sitemap is shaped, how content renders, what the URLs look like, how fast the first paint arrives — either helps you rank or quietly costs you. Retrofitting those decisions is slow, expensive and often partial.' }}</p>
      </div>
    </div>

    <div class="compare mt-lg">
      <div class="compare-col">
        <div class="compare-hd">{{ $c['difference']['usual_title'] ?? 'The typical route' }}</div>
        <ul>
          @foreach($c['difference']['usual_items'] ?? [] as $item)
            <li>{{ $item }}</li>
          @endforeach
        </ul>
      </div>
      <div class="compare-col win">
        <div class="compare-hd">{{ $c['difference']['kodrank_title'] ?? 'The KodRank way' }}</div>
        <ul>
          @foreach($c['difference']['kodrank_items'] ?? [] as $item)
            <li>{{ $item }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</section>
