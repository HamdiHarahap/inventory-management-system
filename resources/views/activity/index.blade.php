<x-layout :title="$title">
    <div class="p-6 md:p-10">
        <div class="mb-4">
            <form method="GET" class="flex items-center gap-2">
                <input
                    type="date"
                    name="date"
                    class="px-4 py-2 border border-gray-300 rounded-lg w-full focus:ring-indigo-500 focus:border-indigo-500"
                />
                <select
                    name="user"
                    class="px-4 py-3 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm">
                    <option value="">Semua Pengguna</option>
                    @foreach ($users as $item)
                        <option value="{{ $item->id }}"
                            {{ request('user') == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
                <button class="px-4 py-2 bg-gray-200 border border-gray-300 rounded-lg hover:bg-gray-300 transition">
                    Cari
                </button>
            </form>
        </div>
        
        <a href="{{ route('activity.pdf', request()->query()) }}" class="px-4 py-2 bg-indigo-600 border border-indigo-500 rounded-lg hover:bg-indigo-700 transition mt-5 text-white">Cetak Laporan</a>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-auto mt-5">
            <table class="w-full text-left min-w-max">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-gray-700 font-medium">No</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Nama Pengguna</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Aksi</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Deskripsi</th>
                        <th class="px-6 py-3 text-gray-700 font-medium">Tanggal</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach ($data as $item)
                        <tr>
                            <td class="px-6 py-4">
                                {{ ++$loop->index }}
                            </td>
                            <td class="px-6 py-4">{{ $item->user->name }}</td>
                            <td class="px-6 py-4">{{ $item->action }}</td>
                            <td class="px-6 py-4 max-w-xs whitespace-normal">
                                {{ $item->description }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $data->appends(request()->query())->links() }}
        </div>
    </div>
</x-layout>
