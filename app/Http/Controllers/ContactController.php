<?php

namespace App\Http\Controllers;

use App\Models\CmsSection;
use App\Models\ContactMessage;
use App\Services\LeadNotificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        $c = CmsSection::getMap();

        return view('contact.show', [
            'c' => $c,
            'navStuck' => false,
            'bodyClass' => 'page-contact',
            'pageTitle' => 'Contact — KodRank',
            'pageDescription' => 'Tell us what you\'re working on. We\'ll reply within 24 hours with a realistic scope, plain-English plan, and a number you can use.',
        ]);
    }

    public function store(Request $request, LeadNotificationService $notifications): RedirectResponse
    {
        // Honeypot — bots fill this
        if ($request->filled('fax_number')) {
            return redirect()
                ->to($this->safeRedirect($request) ?? route('contact'))
                ->with('contact_success', 'Thanks — we received your message and will get back to you soon.');
        }

        if (! $request->filled('name')) {
            $first = trim((string) $request->input('firstName', $request->input('first_name', '')));
            $last = trim((string) $request->input('lastName', $request->input('last_name', '')));
            if ($first !== '' || $last !== '') {
                $request->merge(['name' => trim($first.' '.$last)]);
            }
        }

        $message = trim((string) $request->input('message', ''));
        $extras = [];
        foreach ([
            'company' => 'Company',
            'service' => 'Service',
            'services' => 'Interested in',
            'timeline' => 'Timeline',
        ] as $key => $label) {
            if ($request->filled($key)) {
                $extras[] = $label.': '.$request->input($key);
            }
        }
        if ($extras !== []) {
            $request->merge([
                'message' => implode("\n", $extras).($message !== '' ? "\n\n".$message : ''),
            ]);
        } elseif ($message === '') {
            $request->merge(['message' => 'Contact form submission']);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['nullable', 'string', 'max:40'],
            'website' => ['nullable', 'string', 'max:190'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        if (($data['website'] ?? '') === '') {
            $data['website'] = null;
        }
        if (($data['phone'] ?? '') === '') {
            $data['phone'] = null;
        }

        $contact = ContactMessage::create($data);

        $notifications->send('New KodRank contact form message', [
            'A new contact form message was saved.',
            'Name: '.$contact->name,
            'Email: '.$contact->email,
            'Phone: '.($contact->phone ?? '—'),
            'Website: '.($contact->website ?? '—'),
            '',
            'Message:',
            $contact->message,
        ]);

        $redirect = $this->safeRedirect($request);

        return redirect()
            ->to($redirect ?? url('/#contact'))
            ->with('contact_success', 'Thanks — we received your message and will get back to you soon.');
    }

    private function safeRedirect(Request $request): ?string
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
