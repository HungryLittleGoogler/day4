<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title') · Report Cards</title>
    <link rel="stylesheet" href="{{ asset('css/school.css') }}">
</head>
<body>
    <header>
        <a href="/sections">🏫 Report Cards</a>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>
