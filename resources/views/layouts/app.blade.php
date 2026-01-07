<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ATLVS')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-white antialiased">

    {{-- Header do site --}}
    <x-site.header />

    {{-- Conteúdo das páginas --}}
    <main class="pt-24">
        @yield('content')
    </main>

    {{-- Footer do site --}}
    <x-site.footer />

</body>
</html>
