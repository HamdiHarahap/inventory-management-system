<x-layout>
    <div class="min-h-screen bg-gray-50 flex">

        {{-- Sidebar --}}
        <aside class="w-64 bg-white border-r border-gray-200 px-6 py-8 hidden md:block">
            <h1 class="text-2xl font-bold text-indigo-600">Inventory</h1>

            <nav class="mt-10 flex flex-col gap-4 text-gray-700 font-medium">
                <a href="#" class="hover:text-indigo-600 transition">Dashboard</a>
                <a href="#" class="hover:text-indigo-600 transition">Products</a>
                <a href="#" class="hover:text-indigo-600 transition">Categories</a>
                <a href="#" class="hover:text-indigo-600 transition">Transactions</a>
                <a href="#" class="hover:text-indigo-600 transition">Users</a>
            </nav>
        </aside>

        {{-- Content Area --}}
        <main class="flex-1">

            {{-- Top Navbar --}}
            <header class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center sticky top-0 z-10">

                {{-- Title --}}
                <h2 class="text-xl font-bold text-gray-800 hidden md:block">Dashboard</h2>

                {{-- User Info + Dropdown --}}
                <div class="relative" x-data="{ open: false }">
                    <button 
                        @click="open = !open"
                        class="flex items-center gap-3 bg-gray-100 hover:bg-gray-200 transition px-3 py-2 rounded-full"
                    >
                        <div class="w-9 h-9 bg-indigo-600 text-white flex items-center justify-center rounded-full font-semibold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span class="font-semibold text-gray-700 hidden sm:block">
                            {{ auth()->user()->name }}
                        </span>
                    </button>

                    {{-- Dropdown --}}
                    <div 
                        x-show="open"
                        @click.away="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 shadow-lg rounded-md py-2 z-20"
                    >
                        <a href="/profile" class="block px-4 py-2 hover:bg-gray-100 text-gray-700">Profile</a>
                        <a href="/change-password" class="block px-4 py-2 hover:bg-gray-100 text-gray-700">Change Password</a>

                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

            </header>

            <div class="p-6 md:p-10">

                <p class="text-gray-600">Welcome back! Here’s your system overview.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
                    <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                        <p class="text-gray-500">Total Products</p>
                        <h3 class="text-3xl font-bold text-indigo-600 mt-2">128</h3>
                    </div>

                    <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                        <p class="text-gray-500">Incoming Items</p>
                        <h3 class="text-3xl font-bold text-indigo-600 mt-2">54</h3>
                    </div>

                    <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                        <p class="text-gray-500">Outgoing Items</p>
                        <h3 class="text-3xl font-bold text-indigo-600 mt-2">39</h3>
                    </div>

                    <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                        <p class="text-gray-500">Users</p>
                        <h3 class="text-3xl font-bold text-indigo-600 mt-2">6</h3>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl shadow-sm mt-10">
                    <div class="px-6 py-4 border-b">
                        <h3 class="font-semibold text-gray-700">Recent Transactions</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-gray-700">
                            <thead class="bg-gray-100 border-b">
                                <tr>
                                    <th class="px-6 py-3">Date</th>
                                    <th class="px-6 py-3">Type</th>
                                    <th class="px-6 py-3">Item</th>
                                    <th class="px-6 py-3">Qty</th>
                                    <th class="px-6 py-3">User</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">2025-11-22</td>
                                    <td class="px-6 py-4 text-indigo-600 font-semibold">Incoming</td>
                                    <td class="px-6 py-4">Laptop ASUS</td>
                                    <td class="px-6 py-4">5</td>
                                    <td class="px-6 py-4">Admin</td>
                                </tr>

                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">2025-11-22</td>
                                    <td class="px-6 py-4 text-red-600 font-semibold">Outgoing</td>
                                    <td class="px-6 py-4">Mouse Logitech</td>
                                    <td class="px-6 py-4">2</td>
                                    <td class="px-6 py-4">Staff</td>
                                </tr>

                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">2025-11-21</td>
                                    <td class="px-6 py-4 text-indigo-600 font-semibold">Incoming</td>
                                    <td class="px-6 py-4">Keyboard</td>
                                    <td class="px-6 py-4">10</td>
                                    <td class="px-6 py-4">Admin</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</x-layout>
