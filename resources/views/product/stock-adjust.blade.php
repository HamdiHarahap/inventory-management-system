<x-layout :title="$title">
    <section class="p-6 md:p-10">
        @if (session('success'))
            <div id="alert-success" 
                class="fixed top-4 z-50 right-4 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg opacity-0 transition-opacity duration-500">
                {{ session('success') }}
            </div>
        @endif
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Ubah Stok</h1>
            <p class="text-gray-500 mt-1">Isi data berikut untuk mengubah stok karena kesalahan.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
            <form method="POST" class="space-y-8" action="{{ route('stock.store') }}">
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Produk</label>
                        <select
                            name="product_id"
                            class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm">
                            @foreach ($product as $item)
                                <option value="{{ $item->id }}" data-price="{{ $item->price_sell }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Tipe</label>
                        <select
                            name="adjustment_type"
                            class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm">
                            <option value="add">Tambah</option>
                            <option value="subtract">Kurangi</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Qty</label>
                        <input type="number"
                            name="qty"
                            value="1"
                            min="1"
                            class="px-4 py-3 border rounded-xl border-gray-300 shadow-sm" />
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Alasan</label>
                        <textarea 
                            name="reason"
                            rows="4"
                            class="px-4 py-3 border border-gray-300 rounded-xl 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                                   transition shadow-sm"
                            placeholder="Masukkan alasan" required></textarea>
                    </div>
                </div>
                <div class="flex justify-end gap-4 pt-4">
                    <a href="{{ route('product.index') }}"
                        class="px-5 py-2 rounded-lg border font-medium text-gray-700 
                               hover:bg-gray-100 transition">
                        Batal
                    </a>
                    <button
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg font-medium 
                               shadow hover:bg-indigo-700 transition">
                        Ubah Stok
                    </button>
                </div>
            </form>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const alertBox = document.getElementById("alert-success");
            if (alertBox) {
                setTimeout(() => alertBox.style.opacity = "1", 50);
                setTimeout(() => alertBox.style.opacity = "0", 3000);
                setTimeout(() => alertBox.remove(), 3500);
            }
        });
    </script>
</x-layout>
