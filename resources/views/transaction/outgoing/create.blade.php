<x-layout :title="$title">
    <section class="p-6 md:p-10">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Tambah Transaksi Keluar</h1>
            <p class="text-gray-500 mt-1">Isi data berikut untuk menambahkan transaksi baru.</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
            <form method="POST" enctype="multipart/form-data" class="space-y-8" action="{{ route('outgoing.store') }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Customer</label>
                        <select
                            name="customer_id"
                            class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm">
                            @foreach ($data['customer'] as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Produk</label>
                        <select
                            name="product_id"
                            class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm">
                            @foreach ($data['product'] as $item)
                                <option value="{{ $item->id }}" data-price="{{ $item->price_sell }}">{{ $item->name }}</option>
                            @endforeach
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
                        <label class="font-medium text-gray-700 mb-1">Harga</label>
                        <input type="text"
                            name="price"
                            readonly
                            class="px-4 py-3 border rounded-xl bg-gray-100 border-gray-300 shadow-sm" />
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Total</label>
                        <input type="text"
                            name="total"
                            readonly
                            class="px-4 py-3 border rounded-xl bg-gray-100 border-gray-300 shadow-sm" />
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date"
                            name="date"
                            value="{{ date('Y-m-d') }}"
                            readonly
                            class="px-4 py-3 border rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 shadow-sm" />
                    </div>

                </div>
                <div class="flex flex-col mt-4">
                    <label class="font-medium text-gray-700 mb-1">Catatan</label>
                    <textarea
                        name="notes"
                        rows="4"
                        class="px-4 py-3 border rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 shadow-sm"
                        placeholder="Tambahkan catatan jika diperlukan">-</textarea>
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
        const productSelect = document.querySelector('select[name="product_id"]');
        const qtyInput = document.querySelector('input[name="qty"]');
        const priceInput = document.querySelector('input[name="price"]');
        const totalInput = document.querySelector('input[name="total"]');

        function updateTotal() {
            const price = parseFloat(priceInput.value) || 0;
            const qty = parseInt(qtyInput.value) || 0;
            totalInput.value = price * qty;
        }

        productSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.getAttribute('data-price') || 0;

            priceInput.value = price;
            updateTotal();
        });

        qtyInput.addEventListener('input', updateTotal);
    </script>

</x-layout>
