<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->

    <script src="https://checkout.placetopay.com/lightbox.min.js"></script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="font-sans antialiased bg-gray-200">
    <div class="bg-gray-200 min-h-screen flex justify-center items-center">
        <button id="open"
            class="bg-[#FF2D20] text-white text-center font-bold uppercase cursor-pointer px-4 py-2 rounded">
            Pay PlaceToPay
        </button>
    </div>






</body>

</html>
