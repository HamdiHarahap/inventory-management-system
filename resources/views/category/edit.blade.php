<x-layout :title="$title">
    <section class="p-6 md:p-10">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Edit Kategori</h1>
            <p class="text-gray-500 mt-1">Perbarui data berikut untuk mengubah kategori.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
            <form method="POST" class="space-y-8" action="{{ route('category.update', ['id' => $data->id]) }}">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6">
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Nama Kategori</label>
                        <input type="text"
                            name="name"
                            class="px-4 py-3 border border-gray-300 rounded-xl 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                                   transition shadow-sm"
                            value="{{$data->name}}"
                            placeholder="Masukkan nama kategori">
                    </div>
                    <div class="flex flex-col">
                        <label class="font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea 
                            name="description"
                            rows="4"
                            class="px-4 py-3 border border-gray-300 rounded-xl 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                                   transition shadow-sm".
                            placeholder="Masukkan deskripsi kategori">{{$data->description}}</textarea>
                    </div>
                </div>
                <div class="flex justify-end gap-4 pt-4">
                    <a href="{{ route('category.index') }}"
                        class="px-5 py-2 rounded-lg border font-medium text-gray-700 
                               hover:bg-gray-100 transition">
                        Batal
                    </a>

                    <button
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg font-medium 
                               shadow hover:bg-indigo-700 transition">
                        Update Kategori
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-layout>
