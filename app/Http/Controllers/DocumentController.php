<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Services\DocumentPreviewService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DocumentController extends Controller
{
    public function index(Request $request): View
    {
        return view('documents.index', [
            'documents' => Document::query()->latest()->get(),
            'user' => $request->user(),
        ]);
    }

    public function create(): View
    {
        return view('documents.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'file' => ['required', 'file', 'mimetypes:'.implode(',', Document::ALLOWED_MIME_TYPES), 'max:20480'],
        ]);

        $file = $validated['file'];
        $storedName = Str::uuid()->toString().'.'.$file->getClientOriginalExtension();

        Storage::disk('private')->putFileAs('', $file, $storedName);

        Document::query()->create([
            'uploader_id' => $request->user()->id,
            'original_name' => $file->getClientOriginalName(),
            'stored_name' => $storedName,
            'mime_type' => $file->getMimeType(),
            'size_bytes' => $file->getSize(),
        ]);

        return redirect()->route('documents.index')->with('status', 'Document uploaded successfully.');
    }

    public function view(Document $document, DocumentPreviewService $previewService): StreamedResponse|View
    {
        $preview = $previewService->buildPreview($document);

        if ($preview['type'] === 'text') {
            return view('documents.preview-text', [
                'document' => $document,
                'content' => $preview['content'],
            ]);
        }

        return response()->stream(function () use ($preview): void {
            $stream = fopen($preview['path'], 'rb');
            fpassthru($stream);
            fclose($stream);
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="preview.pdf"',
            'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => 'no-store, private',
        ]);
    }
}
