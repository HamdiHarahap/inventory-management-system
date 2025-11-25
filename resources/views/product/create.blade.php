<x-layout :title="$title">
    <section class="p-6 md:p-10">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Tambah Produk</h1>
            <p class="text-gray-500 mt-1">Isi data berikut untuk menambahkan produk baru.</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
            <form method="POST" enctype="multipart/form-data" class="space-y-8" action="{{ route('product.store') }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Nama Produk</label>
                        <input type="text"
                            name="name"
                            class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm"
                            placeholder="Masukkan nama produk">
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Kategori</label>
                        <select
                            name="category"
                            class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm">
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">SKU</label>
                        <input type="text"
                            name="sku"
                            value="{{ $sku }}"
                            readonly
                            class="px-4 py-3 border rounded-xl bg-gray-100 border-gray-300 shadow-sm" />
                    </div>

                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Barcode</label>
                        <input type="text"
                            name="barcode"
                            value="{{ $barcode }}"
                            readonly
                            class="px-4 py-3 border rounded-xl bg-gray-100 border-gray-300 shadow-sm" />
                    </div>

                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Harga Jual</label>
                        <input type="number"
                            name="price_sell"
                            class="px-4 py-3 border rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 shadow-sm"
                            placeholder="Masukkan harga jual">
                    </div>

                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Harga Beli</label>
                        <input type="number"
                            name="price_buy"
                            class="px-4 py-3 border rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 shadow-sm"
                            placeholder="Masukkan harga beli">
                    </div>

                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Unit</label>
                        <input type="text"
                            name="unit"
                            class="px-4 py-3 border rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 shadow-sm"
                            placeholder="Contoh: pcs, dus, pack">
                    </div>

                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Stok</label>
                        <input type="number"
                            name="stock"
                            class="px-4 py-3 border rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 shadow-sm"
                            placeholder="Jumlah stok">
                    </div>
                </div>

                <div class="flex flex-col">
                    <label class="font-medium text-gray-700 mb-1">Foto Produk</label>
                    <img id="preview"
                         class="w-32 h-32 object-cover rounded-xl mb-3 border shadow hidden"
                         alt="Preview Foto">
                    <div class="border rounded-xl p-4 bg-gray-50 hover:bg-gray-100 transition cursor-pointer">
                        <input type="file"
                               name="image"
                               accept="image/*"
                               onchange="previewImage(event)"
                               class="w-full bg-transparent focus:outline-none">
                    </div>
                </div>
                <div class="flex justify-end gap-4 pt-4">
                    <a href="{{ route('product.index') }}"
                       class="px-5 py-2 rounded-lg border font-medium text-gray-700 hover:bg-gray-100 transition">
                        Batal
                    </a>
                    <button
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg font-medium shadow hover:bg-indigo-700 transition">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </section>

    <script>
        function previewImage(event) {
            const img = document.getElementById('preview');
            img.classList.remove('hidden');
            img.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</x-layout>
