@php
    $role = auth()->user()->role;
@endphp
<x-layout :title="$title">
    <div class="p-6 md:p-10">
        <p class="text-gray-600">Selamat datang di Sistem Manajemen Inventory</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                <p class="text-gray-500">Total Produk</p>
                <h3 class="text-3xl font-bold text-indigo-600 mt-2">{{$countProduct}}</h3>
            </div>
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                <p class="text-gray-500">Kategori</p>
                <h3 class="text-3xl font-bold text-indigo-600 mt-2">{{$countCategory}}</h3>
            </div>
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                <p class="text-gray-500">Barang Masuk</p>
                <h3 class="text-3xl font-bold text-indigo-600 mt-2">{{$countIncoming}}</h3>
            </div>
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                <p class="text-gray-500">Barang Keluar</p>
                <h3 class="text-3xl font-bold text-indigo-600 mt-2">{{$countOutgoing}}</h3>
            </div>
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6 {{($role == 'admin' || $role == 'manager') ? '' : 'hidden' }}">
                <p class="text-gray-500">Users</p>
                <h3 class="text-3xl font-bold text-indigo-600 mt-2">{{$countUser}}</h3>
            </div>
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                <p class="text-gray-500">Supplier</p>
                <h3 class="text-3xl font-bold text-indigo-600 mt-2">{{$countSupplier}}</h3>
            </div>
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6">
                <p class="text-gray-500">Customer</p>
                <h3 class="text-3xl font-bold text-indigo-600 mt-2">{{$countCustomer}}</h3>
            </div>
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl p-6 {{$role == 'manager' ? '' : 'hidden' }}">
                <p class="text-gray-500">Aktivitas Terbaru</p>
                <h3 class="text-xl font-bold text-indigo-600 mt-2">{{$activity}}</h3>
            </div>
        </div>

    </div>
</x-layout>