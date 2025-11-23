<x-layout :title="$title">
    <div class="p-6 md:p-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Data Produk</h1>

            <a href="{{ route('product.add') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                + Tambah Produk
            </a>
        </div>
        <div class="mb-4">
            <form method="GET" class="flex items-center gap-2">
                <input type="text" name="search" placeholder="Cari produk..."
                    class="px-4 py-2 border border-gray-300 rounded-lg w-full focus:ring-indigo-500 focus:border-indigo-500">
                <button class="px-4 py-2 bg-gray-200 border border-gray-300 rounded-lg hover:bg-gray-300 transition">
                    Cari
                </button>
            </form>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-auto">

            <table class="w-full text-left min-w-max">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-gray-700 font-medium">SKU</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Barcode</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Nama</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Kategori</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Unit</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Harga Beli</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Harga Jual</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Stok</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4">PRD-001</td>
                        <td class="px-6 py-4">8998888000111</td>
                        <td class="px-6 py-4">Indomie Goreng</td>
                        <td class="px-6 py-4">Makanan</td>
                        <td class="px-6 py-4">Pcs</td>
                        <td class="px-6 py-4">Rp 2.500</td>
                        <td class="px-6 py-4">Rp 3.500</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-700">Ada</span>
                        </td>
                        <td class="px-6 py-4 flex gap-3">
                            <a href="#" class="text-indigo-600 hover:underline">Edit</a>
                            <a href="#" class="text-red-600 hover:underline">Hapus</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4">PRD-002</td>
                        <td class="px-6 py-4">8998888000222</td>
                        <td class="px-6 py-4">Kopi Kapal Api</td>
                        <td class="px-6 py-4">Minuman</td>
                        <td class="px-6 py-4">Pcs</td>
                        <td class="px-6 py-4">Rp 1.500</td>
                        <td class="px-6 py-4">Rp 2.000</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-700">Hampir Habis</span>
                        </td>
                        <td class="px-6 py-4 flex gap-3">
                            <a href="#" class="text-indigo-600 hover:underline">Edit</a>
                            <a href="#" class="text-red-600 hover:underline">Hapus</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4">PRD-003</td>
                        <td class="px-6 py-4">8998888000333</td>
                        <td class="px-6 py-4">Beras Premium</td>
                        <td class="px-6 py-4">Sembako</td>
                        <td class="px-6 py-4">Kg</td>
                        <td class="px-6 py-4">Rp 10.000</td>
                        <td class="px-6 py-4">Rp 12.000</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-sm rounded-full bg-red-100 text-red-700">Habis</span>
                        </td>
                        <td class="px-6 py-4 flex gap-3">
                            <a href="#" class="text-indigo-600 hover:underline">Edit</a>
                            <a href="#" class="text-red-600 hover:underline">Hapus</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
