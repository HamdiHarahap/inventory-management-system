<x-layout :title="$title">
    <section class="p-6 md:p-10">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Tambah Pengguna</h1>
            <p class="text-gray-500 mt-1">Isi data berikut untuk menambahkan pengguna baru.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
            <form method="POST" action="{{ route('user.update', ['id'=>$data->id]) }}" class="space-y-8">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text"
                               name="name"
                               value="{{$data->name}}"
                               class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                               placeholder="Masukkan nama pengguna">
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Email</label>
                        <input type="email"
                               name="email"
                               value="{{$data->email}}"
                               class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 shadow-sm"
                               placeholder="Masukkan email pengguna">
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Password</label>
                        <input type="password"
                               name="password"
                               class="px-4 py-3 border rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 shadow-sm"
                               placeholder="Masukkan password">
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Role</label>
                        <select name="role" class="px-4 py-3 border border-gray-300 rounded-xl">
                            <option value="staff" {{ $data->role == 'staff' ? 'selected' : '' }}>Staff</option>
                            <option value="manager" {{ $data->role == 'manager' ? 'selected' : '' }}>Manager</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end gap-4 pt-4">
                    <a href="{{ route('user.index') }}"
                       class="px-5 py-2 rounded-lg border font-medium text-gray-700 hover:bg-gray-100 transition">
                        Batal
                    </a>
                    <button
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg font-medium shadow hover:bg-indigo-700 transition">
                        Simpan Pengguna
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-layout>
