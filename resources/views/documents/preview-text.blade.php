@extends('layouts.app')

@section('content')
    <h1>Preview: {{ $document->original_name }}</h1>
    <pre style="white-space: pre-wrap; border: 1px solid #ddd; padding: 1rem;">{{ $content }}</pre>
@endsection
