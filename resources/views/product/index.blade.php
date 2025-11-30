@php
    $role = auth()->user()->role;
@endphp

<x-layout :title="$title">
    <div class="p-6 md:p-10">
        @if (session('success'))
            <div id="alert-success" 
                class="fixed top-4 z-50 right-4 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg opacity-0 transition-opacity duration-500">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Data Produk</h1>

            <a href="{{ route('product.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition {{$role == 'admin' ? '' : 'hidden' }}">
                + Tambah Produk
            </a>
        </div>
        <div class="mb-4">
            <form method="GET" class="flex items-center gap-2">
                @csrf
                <input type="text" name="keyword" placeholder="Cari produk..."
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
                        <th class="px-6 py-3 text-gray-700 font-medium w-44">Nama</th>
                        <th class="px-6 py-3 text-gray-700 font-medium w-32">Kategori</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Unit</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Harga Beli</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Harga Jual</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Stok</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Gambar</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($data as $item)
                        <tr>
                            <td class="px-6 py-4">{{$item->sku}}</td>
                            <td class="px-6 py-4">{{$item->name}}</td>
                            <td class="px-6 py-4">{{$item->category->name}}</td>
                            <td class="px-6 py-4">{{$item->unit}}</td>
                            <td class="px-6 py-4">Rp {{ number_format($item->price_buy, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($item->price_sell, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if ($item->stock > 10)
                                    <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-700">Ada</span>
                                @elseif ($item->stock > 0)
                                    <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-700">Menipis</span>
                                @else
                                    <span class="px-3 py-1 text-sm rounded-full bg-red-100 text-red-700">Habis</span>
                                @endif
                            </td>
                            @if ($item->image)
                                <td class="px-6 py-4"><img src="{{ asset('storage/' . $item->image) }}" alt="" class="w-20"></td>
                            @else
                                <td class="px-6 py-4">-</td>
                            @endif
                            <td class="px-6 py-4 align-middle">
                                <div class="flex gap-3 items-center {{$role == 'admin' ? '' : 'hidden' }}">
                                    <a href="{{ route('product.edit', ['id'=>$item->id]) }}" class="text-indigo-600 hover:underline">Edit</a>
                                    <form method="POST" action="{{ route('product.destroy', ['id'=>$item->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Anda yakin ingin menghapus ini?')">Hapus</button>
                                    </form>
                                </div>
                                <a href="#" 
                                class="text-indigo-600 hover:underline"
                                onclick="openBarcodeModal('{{ $item->barcode }}', '{{ $item->name }}')">
                                Lihat Barcode
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <div id="barcodeModal" class="fixed inset-0 hidden justify-center items-center z-50 bg-black/45 ">
                    <div class="bg-white p-6 rounded-xl shadow-xl w-[350px]">
                        <h2 class="text-xl font-semibold mb-8">Barcode <span id="barcodeName"></span></h2>
                        <div class="text-center mb-4">
                            <img id="barcodeImage" class="mx-auto" />
                            <p id="barcodeNumber" class="mt-2 font-semibold text-gray-700 text-lg"></p>
                        </div>
                        <button onclick="closeBarcodeModal()"
                            class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                            Tutup
                        </button>
                    </div>
                </div>
            </table>
        </div>
    </div>

    <script>
        function openBarcodeModal(code, name) {
            fetch('/barcode/' + code)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('barcodeImage').src = data.barcode;
                    document.getElementById('barcodeName').innerText = name;
                    document.getElementById('barcodeNumber').innerText = code;

                    document.getElementById('barcodeModal').classList.remove('hidden');
                    document.getElementById('barcodeModal').classList.add('flex');
                });
        }

        function closeBarcodeModal() {
            document.getElementById('barcodeModal').classList.add('hidden');
            document.getElementById('barcodeModal').classList.remove('flex');
        }

        document.addEventListener("DOMContentLoaded", function () {
            const alertBox = document.getElementById("alert-success");
            if (alertBox) {
                setTimeout(() => {
                    alertBox.style.opacity = "1";
                }, 50);

                setTimeout(() => {
                    alertBox.style.opacity = "0";
                }, 3000);

                setTimeout(() => {
                    alertBox.remove();
                }, 3500);
            }
        });
    </script>
</x-layout>
