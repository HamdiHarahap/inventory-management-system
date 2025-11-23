<x-layout :title="$title">
    <div class="p-6 md:p-10">
        <p class="text-gray-600">Selamat datang di Sistem Manajemen Inventory</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                <p class="text-gray-500">Total Produk</p>
                <h3 class="text-3xl font-bold text-indigo-600 mt-2">128</h3>
            </div>
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                <p class="text-gray-500">Kategori</p>
                <h3 class="text-3xl font-bold text-indigo-600 mt-2">128</h3>
            </div>
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                <p class="text-gray-500">Barang Masuk</p>
                <h3 class="text-3xl font-bold text-indigo-600 mt-2">54</h3>
            </div>
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                <p class="text-gray-500">Barang Keluar</p>
                <h3 class="text-3xl font-bold text-indigo-600 mt-2">39</h3>
            </div>
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                <p class="text-gray-500">Users</p>
                <h3 class="text-3xl font-bold text-indigo-600 mt-2">6</h3>
            </div>
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                <p class="text-gray-500">Supplier</p>
                <h3 class="text-3xl font-bold text-indigo-600 mt-2">6</h3>
            </div>
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                <p class="text-gray-500">Customer</p>
                <h3 class="text-3xl font-bold text-indigo-600 mt-2">6</h3>
            </div>
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                <p class="text-gray-500">Aktivitas Terbaru</p>
                <h3 class="text-xl font-bold text-indigo-600 mt-2">Hamdi | Ubah stok</h3>
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
</x-layout>