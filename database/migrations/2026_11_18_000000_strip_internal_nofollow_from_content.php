<?php

use App\Models\CmsSection;
use App\Models\ServicePage;
use App\Support\HtmlNofollow;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $hosts = HtmlNofollow::defaultHosts();

        if (Schema::hasTable('blog_posts')) {
            DB::table('blog_posts')
                ->where(function ($query): void {
                    $query->where('content_html', 'like', '%nofollow%')
                        ->orWhere('body', 'like', '%nofollow%')
                        ->orWhere('author_bio', 'like', '%nofollow%');
                })
                ->orderBy('id')
                ->chunkById(20, function ($rows) use ($hosts): void {
                    foreach ($rows as $row) {
                        $update = [];
                        foreach (['content_html', 'body', 'author_bio'] as $column) {
                            $original = (string) ($row->{$column} ?? '');
                            $clean = HtmlNofollow::stripInternal($original, $hosts);
                            if ($clean !== $original) {
                                $update[$column] = $clean;
                            }
                        }
                        if ($update !== []) {
                            DB::table('blog_posts')->where('id', $row->id)->update($update);
                        }
                    }
                });
        }

        $this->cleanJsonTable('cms_sections', $hosts, function (): void {
            CmsSection::forgetCache();
        });

        $this->cleanJsonTable('service_page_sections', $hosts, function (): void {
            if (Schema::hasTable('service_pages')) {
                DB::table('service_pages')->orderBy('id')->pluck('slug')->each(function ($slug): void {
                    if (is_string($slug) && $slug !== '') {
                        ServicePage::forgetCache($slug);
                    }
                });
            }
        });
    }

    public function down(): void
    {
        // The removed nofollow tokens are not restored.
    }

    private function cleanJsonTable(string $table, array $hosts, callable $after): void
    {
        if (! Schema::hasTable($table) || ! Schema::hasColumn($table, 'data')) {
            return;
        }

        $changedAny = false;

        DB::table($table)
            ->where('data', 'like', '%nofollow%')
            ->orderBy('id')
            ->chunkById(20, function ($rows) use ($table, $hosts, &$changedAny): void {
                foreach ($rows as $row) {
                    $decoded = json_decode((string) $row->data, true);
                    if (! is_array($decoded)) {
                        continue;
                    }

                    $changed = false;
                    $clean = HtmlNofollow::stripInternalDeep($decoded, $hosts, $changed);
                    if (! $changed) {
                        continue;
                    }

                    DB::table($table)->where('id', $row->id)->update([
                        'data' => json_encode($clean, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    ]);
                    $changedAny = true;
                }
            });

        if ($changedAny) {
            $after();
        }
    }
};
