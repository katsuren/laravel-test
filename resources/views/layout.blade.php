<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>laravel-test</title>
</head>
<body>
    {{-- フラッシュ・メッセージ --}}
    @if (session('flash_message'))
        <div class="flash">
            {{ session('flash_message') }}
        </div>
    @endif
    @yield('content')
</body>
</html>
