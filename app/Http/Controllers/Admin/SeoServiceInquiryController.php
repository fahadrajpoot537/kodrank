<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoServiceInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SeoServiceInquiryController extends Controller
{
    public function index(Request $request): View
    {
        $query = SeoServiceInquiry::query()->latest();

        if ($request->filled('q')) {
            $query->search($request->string('q')->toString());
        }

        if ($request->filled('page_type') && in_array($request->page_type, ['on_page', 'off_page'], true)) {
            $query->where('page_type', $request->page_type);
        }

        if ($request->filled('status') && in_array($request->status, ['new', 'read', 'replied'], true)) {
            $query->where('status', $request->status);
        }

        $inquiries = $query->paginate(20)->withQueryString();

        return view('admin.seo-inquiries.index', [
            'inquiries' => $inquiries,
            'filters' => [
                'q' => $request->string('q')->toString(),
                'page_type' => $request->string('page_type')->toString(),
                'status' => $request->string('status')->toString(),
            ],
        ]);
    }

    public function show(SeoServiceInquiry $inquiry): View
    {
        $inquiry->markRead();

        return view('admin.seo-inquiries.show', compact('inquiry'));
    }

    public function destroy(SeoServiceInquiry $inquiry): RedirectResponse
    {
        $inquiry->delete();

        return redirect()
            ->route('admin.seo-inquiries.index')
            ->with('success', 'Inquiry deleted.');
    }

    public function markRead(SeoServiceInquiry $inquiry): RedirectResponse
    {
        $inquiry->update(['status' => SeoServiceInquiry::STATUS_READ]);

        return back()->with('success', 'Marked as read.');
    }

    public function markReplied(SeoServiceInquiry $inquiry): RedirectResponse
    {
        $inquiry->update(['status' => SeoServiceInquiry::STATUS_REPLIED]);

        return back()->with('success', 'Marked as replied.');
    }

    public function export(Request $request): StreamedResponse
    {
        $query = SeoServiceInquiry::query()->latest();

        if ($request->filled('q')) {
            $query->search($request->string('q')->toString());
        }
        if ($request->filled('page_type') && in_array($request->page_type, ['on_page', 'off_page'], true)) {
            $query->where('page_type', $request->page_type);
        }
        if ($request->filled('status') && in_array($request->status, ['new', 'read', 'replied'], true)) {
            $query->where('status', $request->status);
        }

        $filename = 'seo-service-inquiries-'.now()->format('Y-m-d-His').'.csv';

        return response()->streamDownload(function () use ($query) {
            $out = fopen('php://output', 'w');
            fputcsv($out, [
                'ID', 'Page Type', 'Service', 'Name', 'Email', 'Phone', 'Country', 'Company', 'Website',
                'Message', 'Status', 'IP', 'Created At',
            ]);

            $query->chunk(200, function ($rows) use ($out) {
                foreach ($rows as $row) {
                    fputcsv($out, [
                        $row->id,
                        $row->page_type,
                        $row->service_name,
                        $row->name,
                        $row->email,
                        $row->phone,
                        $row->country,
                        $row->company,
                        $row->website,
                        $row->message,
                        $row->status,
                        $row->ip,
                        optional($row->created_at)->toDateTimeString(),
                    ]);
                }
            });

            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
