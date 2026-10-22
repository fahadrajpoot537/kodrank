<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Services\LeadNotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BlogLeadController extends Controller
{
    public function store(Request $request, LeadNotificationService $notifications): JsonResponse
    {
        if ($request->filled('company_fax')) {
            return response()->json(['ok' => true]);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['required', 'string', 'max:40'],
            'service' => ['required', 'string', 'max:200'],
            'message' => ['nullable', 'string', 'max:400'],
            'page' => ['nullable', 'string', 'max:500'],
            'post_title' => ['nullable', 'string', 'max:300'],
        ]);

        $digits = preg_replace('/\D+/', '', $data['phone']) ?? '';
        if (strlen($digits) < 10) {
            throw ValidationException::withMessages([
                'phone' => 'Enter a valid number',
            ]);
        }

        $lines = ['Service: '.$data['service']];
        $title = trim((string) ($data['post_title'] ?? ''));
        $page = trim((string) ($data['page'] ?? ''));
        if ($title !== '') {
            $lines[] = 'Article: '.$title;
        }
        if ($page !== '') {
            $lines[] = 'Page: '.$page;
        }
        $note = trim((string) ($data['message'] ?? ''));
        if ($note !== '') {
            $lines[] = '';
            $lines[] = $note;
        }

        $contact = ContactMessage::query()->create([
            'name' => trim($data['name']),
            'email' => mb_strtolower(trim($data['email'])),
            'phone' => trim($data['phone']),
            'message' => implode("\n", $lines),
        ]);

        $notifications->sendInquiryEmails([
            'source' => 'Blog popup',
            'name' => $contact->name,
            'email' => $contact->email,
            'phone' => $contact->phone,
            'service' => $data['service'],
            'message' => $contact->message,
        ]);

        return response()->json(['ok' => true]);
    }
}
