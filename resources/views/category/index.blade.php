<x-layout :title="$title">
    <div class="p-6 md:p-10">
        @if (session('success'))
            <div id="alert-success" 
                class="fixed top-4 z-50 right-4 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg opacity-0 transition-opacity duration-500">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Data Kategori</h1>

            <a href="{{ route('category.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                + Tambah Kategori
            </a>
        </div>
        <div class="mb-4">
            <form method="GET" class="flex items-center gap-2">
                @csrf
                <input type="text" name="keyword" placeholder="Cari kategori..."
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
                        <th class="px-6 py-3 text-gray-700 font-medium">No</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Nama</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Deskripsi</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $item)
                       <tr>
                            <td class="px-6 py-4">{{$no++}}</td>
                            <td class="px-6 py-4">{{$item->name}}</td>
                            <td class="px-6 py-4">{{$item->description}}</td>
                            <td class="px-6 py-4 flex gap-3">
                                <a href="{{ route('category.edit', ['id'=>$item->id]) }}" class="text-indigo-600 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('category.destroy', ['id'=>$item->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Anda yakin ingin menghapus ini?')">Hapus</button>
                                </form>
                            </td>
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
                // tampilkan
                setTimeout(() => {
                    alertBox.style.opacity = "1";
                }, 50);

                // hilangkan setelah 3 detik
                setTimeout(() => {
                    alertBox.style.opacity = "0";
                }, 3000);

                // hapus dari DOM setelah animasi hilang (500ms)
                setTimeout(() => {
                    alertBox.remove();
                }, 3500);
            }
        });
    </script>
</x-layout>

