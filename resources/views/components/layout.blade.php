@props(['title'])

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="min-h-screen bg-gray-50 flex">
        <aside class="w-64 bg-white border-r border-gray-200 px-6 py-8 hidden md:block">
            <h1 class="text-2xl font-bold text-indigo-600">Inventory Management</h1>
            <nav class="mt-10 flex flex-col gap-2 text-gray-700 font-medium">
                <a href="{{ route('dashboard') }}"
                    class="transition block px-4 py-2 rounded-lg
                    {{ $title == 'Dashboard' ? 'bg-gray-100 text-indigo-600' : 'hover:text-indigo-600' }}">
                    Dashboard
                </a>
                <details class="group">
                    <summary
                        class="flex justify-between items-center cursor-pointer px-4 py-2 rounded-lg hover:text-indigo-600 transition">
                        <span>Master Data</span>
                        <span class="group-open:rotate-180 transition"><img src="assets/images/arrow_down.svg" alt="" class="w-6"></span>
                    </summary>
                    <div class="ml-4 mt-2 flex flex-col gap-2">
                        <a href="{{ route('product.index') }}"
                            class="block px-4 py-2 rounded-lg transition
                            {{ $title == 'Produk' ? 'bg-gray-100 text-indigo-600' : 'hover:text-indigo-600' }}">
                            Produk
                        </a>
                        <a href="#"
                            class="block px-4 py-2 rounded-lg transition
                            {{ $title == 'Kategori' ? 'bg-gray-100 text-indigo-600' : 'hover:text-indigo-600' }}">
                            Kategori
                        </a>
                        <a href="#"
                            class="block px-4 py-2 rounded-lg transition
                            {{ $title == 'Users' ? 'bg-gray-100 text-indigo-600' : 'hover:text-indigo-600' }}">
                            Users
                        </a>
                        <a href="#"
                            class="block px-4 py-2 rounded-lg transition
                            {{ $title == 'Supplier' ? 'bg-gray-100 text-indigo-600' : 'hover:text-indigo-600' }}">
                            Supplier
                        </a>
                    </div>
                </details>
                <details class="group">
                    <summary
                        class="flex justify-between items-center cursor-pointer px-4 py-2 rounded-lg hover:text-indigo-600 transition">
                        <span>Transaksi</span>
                        <span class="group-open:rotate-180 transition"><img src="assets/images/arrow_down.svg" alt="" class="w-6"></span>
                    </summary>
                    <div class="ml-4 mt-2 flex flex-col gap-2">
                        <a href="#"
                            class="block px-4 py-2 rounded-lg transition
                            {{ $title == 'Transaksi' ? 'bg-gray-100 text-indigo-600' : 'hover:text-indigo-600' }}">
                            Transaksi
                        </a>
                        <a href="#"
                            class="block px-4 py-2 rounded-lg transition
                            {{ $title == 'Transaksi Masuk' ? 'bg-gray-100 text-indigo-600' : 'hover:text-indigo-600' }}">
                            Transaksi Masuk
                        </a>
                        <a href="#"
                            class="block px-4 py-2 rounded-lg transition
                            {{ $title == 'Transaksi Keluar' ? 'bg-gray-100 text-indigo-600' : 'hover:text-indigo-600' }}">
                            Transaksi Keluar
                        </a>
                        <a href="#"
                            class="block px-4 py-2 rounded-lg transition
                            {{ $title == 'Transaksi Item' ? 'bg-gray-100 text-indigo-600' : 'hover:text-indigo-600' }}">
                            Transaksi Item
                        </a>
                        <a href="#"
                            class="block px-4 py-2 rounded-lg transition
                            {{ $title == 'Ubah Stok' ? 'bg-gray-100 text-indigo-600' : 'hover:text-indigo-600' }}">
                            Ubah Stok
                        </a>
                    </div>
                </details>
                <a href="#"
                    class="transition block px-4 py-2 rounded-lg
                    {{ $title == 'Aktivitas' ? 'bg-gray-100 text-indigo-600' : 'hover:text-indigo-600' }}">
                    Aktivitas
                </a>
            </nav>
        </aside>
        <main class="flex-1">
            <header class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center sticky top-0 z-10">    

                <h2 class="text-xl font-bold text-gray-800 hidden md:block">{{$title}}</h2>

                <div class="relative" x-data="{ open: false }">
                    <button 
                        @click="open = !open"
                        class="flex items-center gap-3 bg-gray-100 hover:bg-gray-200 transition px-3 py-2 rounded-full"
                    >
                        @auth
                            <div class="w-9 h-9 bg-indigo-600 text-white flex items-center justify-center rounded-full font-semibold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="font-semibold text-gray-700 hidden sm:block">
                                {{ auth()->user()->name }}
                            </span>
                        @endauth

                        @guest
                            <span class="text-gray-600 text-sm">Guest</span>
                        @endguest

                    </button>

                    <div 
                        x-show="open"
                        @click.away="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 shadow-lg rounded-md py-2 z-20"
                    >
                        <a href="/profile" class="block px-4 py-2 hover:bg-gray-100 text-gray-700">Profile</a>
                        <a href="/change-password" class="block px-4 py-2 hover:bg-gray-100 text-gray-700">Change Password</a>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>
            {{$slot}}
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>