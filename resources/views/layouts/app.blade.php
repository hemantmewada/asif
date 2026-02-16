<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure View-Only Portal</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; }
        nav { margin-bottom: 1.5rem; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 0.65rem; text-align: left; }
        .flash { padding: 0.75rem; background: #e8f5e9; margin-bottom: 1rem; }
    </style>
</head>
<body>
<nav>
    <a href="{{ route('documents.index') }}">Documents</a>
    @auth
        | Logged in as {{ auth()->user()->name }} ({{ auth()->user()->role }})
    @endauth
</nav>

@if(session('status'))
    <div class="flash">{{ session('status') }}</div>
@endif

@yield('content')
</body>
</html>
