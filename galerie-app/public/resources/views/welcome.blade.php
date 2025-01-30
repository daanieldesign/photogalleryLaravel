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
            @foreach (['image1.jpg', 'image2.jpg', 'image3.jpg', 'image4.jpg', 'image5.png', 'image6.png', 'image7.jpg',
            'image8.jpg', 'image9.jpg', 'image10.jpg', 'image11.jpg', 'image12.jpg', 'image13.jpg', 'image14.jpg',
            'image15.jpg', 'image16.jpg', 'image17.jpg', 'image18.jpg', 'image19.jpg', 'image20.jpg', 'image21.jpg',
            'image22.png', 'image23.png', 'image24.jpg', 'image25.png', 'image26.png', 'image27.png', 'image28.png',
            'image29.png', 'image30.jpg', 'image31.jpg', 'image32.png', 'image33.png',] as $image)
                <div class="bg-gray-900 rounded-lg overflow-hidden shadow-md cursor-pointer"
                     @click="open = true; image = '{{ asset('images/'.$image) }}'">
                    <img src="{{ asset('images/'.$image) }}" alt="Obrazek_cislo" class="w-full h-48 object-cover">
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

    <style>
        [x-cloak] { display: none !important; }
    </style>

</body>
</html>
