<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsletterSubscriberController extends Controller
{
    public function index(Request $request): View
    {
        $query = NewsletterSubscriber::query()->latest('subscribed_at');
        $term = trim((string) $request->query('q', ''));

        if ($term !== '') {
            $query->where('email', 'like', '%'.$term.'%');
        }

        return view('admin.newsletter.index', [
            'subscribers' => $query->paginate(30)->withQueryString(),
            'q' => $term,
        ]);
    }

    public function toggle(NewsletterSubscriber $subscriber): RedirectResponse
    {
        $subscriber->update(['is_active' => ! $subscriber->is_active]);

        return back()->with('success', 'Subscriber status updated.');
    }

    public function destroy(NewsletterSubscriber $subscriber): RedirectResponse
    {
        $subscriber->delete();

        return back()->with('success', 'Subscriber deleted.');
    }
}
