<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSeoServiceInquiryRequest;
use App\Models\SeoServiceInquiry;
use App\Services\LeadNotificationService;
use Illuminate\Http\RedirectResponse;

class SeoServiceInquiryController extends Controller
{
    public function store(StoreSeoServiceInquiryRequest $request, LeadNotificationService $notifications): RedirectResponse
    {
        // Honeypot — bots fill this
        if ($request->filled('fax_number')) {
            return redirect()
                ->to($this->safeRedirect($request) ?? url()->previous())
                ->with('contact_success', 'Thanks — we received your message and will get back to you soon.');
        }

        $data = $request->validated();
        unset($data['fax_number'], $data['redirect_to']);

        $inquiry = SeoServiceInquiry::query()->create([
            ...$data,
            'service_name' => $data['service_name'] ?? $request->input('service'),
            'ip' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 1000),
            'status' => SeoServiceInquiry::STATUS_NEW,
        ]);

        $notifications->send('New KodRank service inquiry', [
            'A new service inquiry was saved.',
            'Service: '.($inquiry->service_name ?? '—'),
            'Page type: '.($inquiry->page_type ?? '—'),
            'Name: '.$inquiry->name,
            'Email: '.$inquiry->email,
            'Phone: '.($inquiry->phone ?? '—'),
            'Company: '.($inquiry->company ?? '—'),
            'Website: '.($inquiry->website ?? '—'),
            '',
            'Message:',
            $inquiry->message,
        ]);

        return redirect()
            ->to($this->safeRedirect($request) ?? url()->previous())
            ->with('contact_success', 'Thanks — we received your message and will get back to you soon.');
    }

    private function safeRedirect(StoreSeoServiceInquiryRequest $request): ?string
    {
        $redirect = $request->input('redirect_to');
        if (! is_string($redirect) || $redirect === '') {
            return null;
        }

        if (str_starts_with($redirect, '/') && ! str_starts_with($redirect, '//')) {
            return $redirect;
        }

        $appUrl = rtrim((string) config('app.url'), '/');
        if ($appUrl !== '' && str_starts_with($redirect, $appUrl)) {
            return $redirect;
        }

        return null;
    }
}
