<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Support\BlogAuthors;
use App\Support\BlogMedia;
use App\Support\UrlRedirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function index(): View
    {
        $posts = BlogPost::query()
            ->with('category')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.blog.posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('admin.blog.posts.form', [
            'post' => new BlogPost([
                'is_published' => true,
                'show_in_latest' => true,
                'read_minutes' => 8,
                'author_name' => BlogAuthors::all()['hidayatul-haq']['name'],
                'author_role' => BlogAuthors::all()['hidayatul-haq']['role'],
                'author_linkedin' => BlogAuthors::all()['hidayatul-haq']['linkedin'],
                'author_image' => BlogAuthors::all()['hidayatul-haq']['image'],
                'author_bio' => BlogAuthors::all()['hidayatul-haq']['bio'],
            ]),
            'categories' => BlogCategory::query()->orderBy('sort_order')->get(),
            'authors' => BlogAuthors::all(),
            'authorKey' => 'hidayatul-haq',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: Str::slug($data['title']));
        $data = $this->applyUploads($request, $data);

        BlogPost::query()->create($data);

        return redirect()
            ->route('admin.blog.posts.index')
            ->with('success', 'Blog post created.');
    }

    public function edit(BlogPost $post): View
    {
        return view('admin.blog.posts.form', [
            'post' => $post,
            'categories' => BlogCategory::query()->orderBy('sort_order')->get(),
            'authors' => BlogAuthors::all(),
            'authorKey' => BlogAuthors::keyForName($post->author_name) ?: 'hidayatul-haq',
        ]);
    }

    public function update(Request $request, BlogPost $post): RedirectResponse
    {
        $data = $this->validated($request, $post);
        $oldSlug = $post->slug;
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: Str::slug($data['title']), $post->id);
        $data = $this->applyUploads($request, $data, $post);

        $post->update($data);

        if ($oldSlug !== $post->slug) {
            UrlRedirector::remember('/blogs/'.$oldSlug, '/blogs/'.$post->slug);
        }

        return redirect()
            ->route('admin.blog.posts.index')
            ->with('success', $oldSlug !== $post->slug
                ? 'Blog post updated. /blogs/'.$oldSlug.' now redirects to the new slug.'
                : 'Blog post updated.');
    }

    public function destroy(BlogPost $post): RedirectResponse
    {
        $post->delete();

        return redirect()
            ->route('admin.blog.posts.index')
            ->with('success', 'Blog post deleted.');
    }

    public function uploadEditorImage(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:5120'],
        ]);

        return response()->json([
            'url' => asset(BlogMedia::storeUpload($request->file('image'), 'content')),
        ]);
    }

    private function validated(Request $request, ?BlogPost $post = null): array
    {
        $data = $request->validate([
            'category_id' => ['nullable', 'exists:blog_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'body' => ['nullable', 'string'],
            'content_html' => ['nullable', 'string'],
            'table_of_contents' => ['nullable', 'array'],
            'tag_label' => ['nullable', 'string', 'max:100'],
            'post_tags' => ['nullable', 'string', 'max:500'],
            'inline_cta_title' => ['nullable', 'string', 'max:255'],
            'inline_cta_body' => ['nullable', 'string', 'max:1000'],
            'inline_cta_text' => ['nullable', 'string', 'max:120'],
            'inline_cta_url' => ['nullable', 'string', 'max:255'],
            'author_key' => ['nullable', 'string', 'max:80'],
            'author_name' => ['nullable', 'string', 'max:120'],
            'author_role' => ['nullable', 'string', 'max:255'],
            'author_bio' => ['nullable', 'string', 'max:20000'],
            'author_linkedin' => ['nullable', 'string', 'max:255'],
            'author_image' => ['nullable', 'string', 'max:255'],
            'featured_image' => ['nullable', 'string', 'max:255'],
            'featured_image_alt' => ['nullable', 'string', 'max:255'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'seo_keywords' => ['nullable', 'string', 'max:500'],
            'canonical_url' => ['nullable', 'string', 'max:255'],
            'robots' => ['nullable', 'string', 'max:100'],
            'og_title' => ['nullable', 'string', 'max:255'],
            'og_description' => ['nullable', 'string', 'max:500'],
            'og_image' => ['nullable', 'string', 'max:255'],
            'og_image_alt' => ['nullable', 'string', 'max:255'],
            'read_minutes' => ['nullable', 'integer', 'min:1', 'max:120'],
            'published_at' => ['nullable', 'date'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'is_editors_pick' => ['nullable', 'boolean'],
            'show_in_latest' => ['nullable', 'boolean'],
            'featured_image_file' => ['nullable', 'image', 'max:5120'],
            'author_image_file' => ['nullable', 'image', 'max:5120'],
        ]);

        $data['is_published'] = $request->boolean('is_published');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_editors_pick'] = $request->boolean('is_editors_pick');
        $data['show_in_latest'] = $request->boolean('show_in_latest');
        $data['read_minutes'] = (int) ($data['read_minutes'] ?? 5);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['category_id'] = $data['category_id'] ?: null;
        $data['robots'] = trim((string) ($data['robots'] ?? '')) ?: 'index, follow';

        $author = BlogAuthors::findByKey($data['author_key'] ?? null);
        unset($data['author_key'], $data['featured_image_file'], $data['author_image_file']);

        if ($author) {
            $data['author_name'] = $author['name'];
            $data['author_role'] = trim((string) ($data['author_role'] ?? '')) ?: $author['role'];
            $data['author_linkedin'] = trim((string) ($data['author_linkedin'] ?? '')) ?: $author['linkedin'];
            $data['author_image'] = trim((string) ($data['author_image'] ?? '')) ?: $author['image'];
            if (trim(strip_tags((string) ($data['author_bio'] ?? ''))) === '') {
                $data['author_bio'] = $author['bio'];
            }
        } else {
            $data['author_name'] = trim((string) ($data['author_name'] ?? '')) ?: 'KodRank';
        }

        return $data;
    }

    private function applyUploads(Request $request, array $data, ?BlogPost $post = null): array
    {
        if ($request->hasFile('featured_image_file')) {
            $data['featured_image'] = BlogMedia::storeUpload($request->file('featured_image_file'));
        } elseif ($post && empty($data['featured_image'])) {
            $data['featured_image'] = $post->featured_image;
        }

        if ($request->hasFile('author_image_file')) {
            $data['author_image'] = BlogMedia::storeUpload($request->file('author_image_file'));
        } elseif ($post && empty($data['author_image'])) {
            $data['author_image'] = $post->author_image;
        }

        return $data;
    }

    private function uniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $base = Str::slug($slug) ?: 'post';
        $candidate = $base;
        $i = 2;

        while (
            BlogPost::query()
                ->where('slug', $candidate)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $candidate = $base.'-'.$i;
            $i++;
        }

        return $candidate;
    }
}
