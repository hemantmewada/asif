<?php

namespace Tests\Feature;

use App\Models\Document;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DocumentPortalTest extends TestCase
{
    use RefreshDatabase;

    public function test_uploader_can_upload_documents(): void
    {
        Storage::fake('private');
        $user = User::factory()->create(['role' => User::ROLE_UPLOADER]);

        $response = $this->actingAs($user)->post(route('documents.store'), [
            'file' => UploadedFile::fake()->create('notes.txt', 10, 'text/plain'),
        ]);

        $response->assertRedirect(route('documents.index'));
        $this->assertDatabaseCount('documents', 1);
    }

    public function test_viewer_can_only_access_preview_route(): void
    {
        $viewer = User::factory()->create(['role' => User::ROLE_VIEWER]);
        $document = Document::factory()->create();

        $this->actingAs($viewer)->get(route('documents.create'))->assertForbidden();
        $this->actingAs($viewer)->get(route('documents.view', $document))->assertOk();
    }
}
