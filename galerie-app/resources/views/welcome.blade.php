<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galerie</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            background-color: #000;
            color: #fff;
        }

        a {
            color: #ff0000;
        }

        a:hover {
            color: #ff5555;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-gray-900 p-4 text-white">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Galerie</h1>
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-white">Panel</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white">Odhlásit se</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-white">Přihlásit se</a>
                    <a href="{{ route('register') }}" class="text-white">Zaregistrovat se</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Gallery Section with Lightbox -->
    <div x-data="{ open: false, image: '' }" class="max-w-7xl mx-auto py-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($images as $image) <!-- Tento cyklus prochází všechny obrázky -->
            <div class="bg-gray-900 rounded-lg overflow-hidden shadow-md cursor-pointer"
                 @click="open = true; image = '{{ asset('images/' . basename($image)) }}'">
                <img src="{{ asset('images/' . basename($image)) }}" alt="Obrazek" class="w-full h-48 object-cover">
            </div>
        @endforeach
    </div>
</div>


    <!-- Lightbox Modal -->
    <div x-show="open" x-cloak class="fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center z-50"
         @click.away="open = false">
        <div class="relative max-w-4xl w-full">
            <button class="absolute top-4 right-4 text-white text-3xl" @click="open = false">&times;</button>
            <img :src="image" class="w-full max-h-screen object-contain">
        </div>
    </div>

    <!-- Tlačítko pro výběr souboru -->
<div class="max-w-7xl mx-auto py-8">
    <form action="{{ route('gallery.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" accept="image/*" class="bg-gray-700 text-white px-4 py-2 rounded-md cursor-pointer">
        <button type="submit" class="ml-4 px-6 py-2 bg-blue-600 text-white rounded-md">Nahraj obrázek</button>
    </form>
</div>


    <style>
        [x-cloak] { display: none !important; }
    </style>

</body>
</html>
