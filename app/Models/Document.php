<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    public const ALLOWED_MIME_TYPES = [
        'application/pdf',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'text/plain',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    ];

    protected $fillable = [
        'uploader_id',
        'original_name',
        'stored_name',
        'mime_type',
        'size_bytes',
    ];

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }

    public function isText(): bool
    {
        return $this->mime_type === 'text/plain';
    }

    public function isPdf(): bool
    {
        return $this->mime_type === 'application/pdf';
    }

    public function needsConversion(): bool
    {
        return ! $this->isText() && ! $this->isPdf();
    }
}
