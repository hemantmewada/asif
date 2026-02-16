@extends('layouts.app')

@section('content')
    <h1>Document Portal</h1>

    @if($user->isUploader())
        <p><a href="{{ route('documents.create') }}">Upload a document</a></p>
    @endif

    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Uploader</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($documents as $document)
            <tr>
                <td>{{ $document->original_name }}</td>
                <td>{{ $document->mime_type }}</td>
                <td>{{ $document->uploader->name }}</td>
                <td>
                    @if($user->isViewer())
                        <a href="{{ route('documents.view', $document) }}" target="_blank" rel="noopener noreferrer">Open preview</a>
                    @else
                        <em>View-only for Viewer role</em>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="4">No documents uploaded yet.</td></tr>
        @endforelse
        </tbody>
    </table>
@endsection
