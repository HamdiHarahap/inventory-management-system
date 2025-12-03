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
            <h1 class="text-2xl font-bold text-gray-800">Data Transaksi Keluar</h1>

            <a href="{{ route('outgoing.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition {{$role == 'staff' ? '' : 'hidden' }}">
                + Tambah Transaksi Keluar
            </a>
        </div>

        <div class="mb-4">
            <form method="GET" class="flex items-center gap-2">
                @csrf
                <input type="text" name="keyword" placeholder="Cari transaksi..."
                    class="px-4 py-2 border border-gray-300 rounded-lg w-full focus:ring-indigo-500 focus:border-indigo-500">
                <button class="px-4 py-2 bg-gray-200 border border-gray-300 rounded-lg hover:bg-gray-300 transition">
                    Cari
                </button>
            </form>
        </div>

        <a href="{{ route('outgoing.pdf', request()->query()) }}" class="px-4 py-2 bg-indigo-600 border border-indigo-500 rounded-lg hover:bg-indigo-700 transition mt-5 text-white {{$role == 'manager' ? '' : 'hidden' }}">Cetak Laporan</a>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-auto mt-5">
            <table class="w-full text-left min-w-max">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-gray-700 font-medium">No</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Customer</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Produk</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Qty</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Price</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Subtotal</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Tanggal</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Catatan</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @php $no = 1; @endphp
                    @foreach ($data as $item)
                        <tr>
                            <td class="px-6 py-4">{{ $no++ }}</td>
                            <td class="px-6 py-4">{{ $item->outgoing->customer->name}}</td>
                            <td class="px-6 py-4">{{ $item->product->name }}</td>
                            <td class="px-6 py-4">{{ $item->qty }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($item->product->price_buy, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            <td class="px-6 py-4"> {{ \Carbon\Carbon::parse($item->date)->locale('id')->isoFormat('D MMMM YYYY') }}</td>
                            <td class="px-6 py-4">{{ $item->incoming->notes }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

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
