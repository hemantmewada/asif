@extends('layouts.app')

@section('content')
    <h1>Upload a document</h1>

    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
        @csrf
        <label for="file">File</label>
        <input id="file" name="file" type="file" accept=".pdf,.docx,.pptx,.txt,.xlsx" required>
        <button type="submit">Upload</button>
    </form>
@endsection
