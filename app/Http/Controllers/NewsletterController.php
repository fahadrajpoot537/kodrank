<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use App\Rules\Recaptcha;
use App\Services\LeadNotificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function store(Request $request, LeadNotificationService $notifications): RedirectResponse
    {
        if ($request->filled('kr_hp')) {
            return redirect()
                ->to($this->safeRedirect($request->input('redirect_to'), $request) ?? route('blog.index').'#news')
                ->with('newsletter_success', 'You’re subscribed — thank you.');
        }

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:190'],
            'redirect_to' => ['nullable', 'string', 'max:500'],
            'g-recaptcha-response' => ['required', new Recaptcha],
        ]);
        if ($validator->fails()) {
            return redirect()
                ->to($this->safeRedirect($request->input('redirect_to'), $request) ?? url()->previous().'#news')
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        $email = mb_strtolower(trim($data['email']));
        $subscriber = NewsletterSubscriber::query()->firstOrNew(['email' => $email]);
        $isNew = ! $subscriber->exists;

        $subscriber->fill([
            'source' => 'blog',
            'is_active' => true,
            'subscribed_at' => $subscriber->subscribed_at ?? now(),
        ]);
        $subscriber->save();

        if ($isNew) {
            $notifications->sendNewsletterEmails($subscriber->email);
        }

        return redirect()
            ->to($this->safeRedirect($data['redirect_to'] ?? null, $request) ?? route('blog.index').'#news')
            ->with('newsletter_success', $isNew
                ? 'You’re subscribed — thank you.'
                : 'You’re already subscribed. Thanks for staying with us.');
    }

    private function safeRedirect(?string $redirect, Request $request): ?string
    {
        if ($redirect === null || $redirect === '') {
            return null;
        }

        if (str_starts_with($redirect, '/') && ! str_starts_with($redirect, '//')) {
            return $redirect;
        }

        $allowed = array_filter([
            rtrim((string) config('app.url'), '/'),
            rtrim($request->getSchemeAndHttpHost(), '/'),
        ]);
        foreach ($allowed as $origin) {
            if (str_starts_with($redirect, $origin.'/') || $redirect === $origin || str_starts_with($redirect, $origin.'#')) {
                return $redirect;
            }
        }

        return null;
    }
}
