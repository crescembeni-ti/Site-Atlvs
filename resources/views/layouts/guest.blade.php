<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>ATLVS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-white">

    <x-layout.header />

    <main>
        {{ $slot }}
    </main>

    <x-layout.footer />

</body>
</html>
