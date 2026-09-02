<?php

namespace App\Http\Controllers;

use App\Models\CmsSection;
use App\Models\ContactMessage;
use App\Rules\Recaptcha;
use App\Services\LeadNotificationService;
use App\Support\CmsPageDefaults;
use App\Support\Countries;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        $c = CmsSection::getMap();
        $p = array_merge(CmsPageDefaults::contactPage(), is_array($c['contact_page'] ?? null) ? $c['contact_page'] : []);

        return view('contact.show', [
            'c' => $c,
            'p' => $p,
            'navStuck' => false,
            'bodyClass' => 'page-contact',
            'pageTitle' => $p['seo_title'] ?? 'Contact — KodRank',
            'pageDescription' => $p['seo_description'] ?? '',
        ]);
    }

    public function store(Request $request, LeadNotificationService $notifications): RedirectResponse
    {
        // Honeypot — bots fill this
        $success = trim((string) ((CmsSection::getMap()['contact_page']['success_message'] ?? '') ?: 'Thanks — we received your message. Our team will contact you within 24 hours.'));

        if ($request->filled('fax_number')) {
            return redirect()
                ->to($this->safeRedirect($request) ?? route('contact'))
                ->with('contact_success', $success);
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
            'country' => ['required', 'string', Rule::in(Countries::names())],
            'website' => ['nullable', 'string', 'max:190'],
            'message' => ['required', 'string', 'max:5000'],
            'g-recaptcha-response' => ['required', new Recaptcha],
        ]);
        unset($data['g-recaptcha-response']);

        if (($data['website'] ?? '') === '') {
            $data['website'] = null;
        }
        if (($data['phone'] ?? '') === '') {
            $data['phone'] = null;
        }

        $contact = ContactMessage::create($data);

        $notifications->sendInquiryEmails([
            'source' => 'Contact form',
            'name' => $contact->name,
            'email' => $contact->email,
            'phone' => $contact->phone,
            'country' => $contact->country,
            'website' => $contact->website,
            'service' => $request->input('service') ?: $request->input('services'),
            'message' => $contact->message,
        ]);

        $redirect = $this->safeRedirect($request);

        return redirect()
            ->to($redirect ?? url('/#contact'))
            ->with('contact_success', $success);
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
