<x-layout :title="$title">
    <section class="p-6 md:p-10">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Tambah Supplier</h1>
            <p class="text-gray-500 mt-1">Isi data berikut untuk menambahkan supplier baru.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
            <form method="POST" class="space-y-8" action="{{ route('supplier.store') }}">
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Nama Supplier</label>
                        <input type="text"
                            name="name"
                            class="px-4 py-3 border border-gray-300 rounded-xl 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                                   transition shadow-sm"
                            placeholder="Masukkan nama supplier">
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Nomor HP</label>
                        <input type="number"
                            name="phone"
                            class="px-4 py-3 border border-gray-300 rounded-xl 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                                   transition shadow-sm"
                            placeholder="Masukkan nomor HP">
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Email</label>
                        <input type="email"
                            name="email"
                            class="px-4 py-3 border border-gray-300 rounded-xl 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                                   transition shadow-sm"
                            placeholder="Masukkan email supplier">
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea 
                            name="address"
                            rows="4"
                            class="px-4 py-3 border border-gray-300 rounded-xl 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                                   transition shadow-sm"
                            placeholder="Masukkan alamat lengkap supplier"></textarea>
                    </div>
                </div>
                <div class="flex justify-end gap-4 pt-4">
                    <a href="{{ route('supplier.index') }}"
                        class="px-5 py-2 rounded-lg border font-medium text-gray-700 
                               hover:bg-gray-100 transition">
                        Batal
                    </a>
                    <button
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg font-medium 
                               shadow hover:bg-indigo-700 transition">
                        Simpan Supplier
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-layout>
