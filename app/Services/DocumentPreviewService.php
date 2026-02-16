<?php

namespace App\Services;

use App\Models\Document;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class DocumentPreviewService
{
    public function buildPreview(Document $document): array
    {
        $sourcePath = Storage::disk('private')->path($document->stored_name);

        if ($document->isText()) {
            return [
                'type' => 'text',
                'content' => Storage::disk('private')->get($document->stored_name),
            ];
        }

        if ($document->isPdf()) {
            return [
                'type' => 'pdf',
                'path' => $sourcePath,
            ];
        }

        $previewPath = $this->convertToPdf($document, $sourcePath);

        return [
            'type' => 'pdf',
            'path' => $previewPath,
        ];
    }

    private function convertToPdf(Document $document, string $sourcePath): string
    {
        $targetDir = Storage::disk('previews')->path('');
        $outputBaseName = pathinfo($document->stored_name, PATHINFO_FILENAME);
        $outputPath = $targetDir.DIRECTORY_SEPARATOR.$outputBaseName.'.pdf';

        if (file_exists($outputPath)) {
            return $outputPath;
        }

        $result = Process::run([
            'soffice',
            '--headless',
            '--convert-to',
            'pdf',
            '--outdir',
            $targetDir,
            $sourcePath,
        ]);

        if (! $result->successful() || ! file_exists($outputPath)) {
            throw new RuntimeException('Unable to render document preview. Ensure LibreOffice is installed.');
        }

        return $outputPath;
    }
}
