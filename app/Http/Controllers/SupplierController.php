<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('keyword');

        $data = Supplier::when($q, function ($query) use ($q) {
            $query->where('name', 'like', "%$q%")
                ->orWhere('phone', 'like', "%$q%")
                ->orWhere('email', 'like', "%$q%")
                ->orWhere('address', 'like', "%$q%");
        })->get();

        return view('supplier.index', [
            'title' => 'Supplier',
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('supplier.create', [
            'title' => 'Supplier',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required'
        ]);

        Supplier::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Menambah supplier',
            'description' => "Menambahkan supplier baru '$request->name'"
        ]);

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        return view('supplier.edit', [
            'title' => 'Supplier',
            'data' => Supplier::find($id)
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required'
        ]);

        $supplier = Supplier::findOrFail($id);

        $oldName = $supplier->name;
        $oldPhone = $supplier->phone;
        $oldEmail = $supplier->email;
        $oldAddress = $supplier->address;

        $supplier->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address
        ]);

        $changes = [];

        if ($oldName !== $request->name) {
            $changes[] = "nama dari '$oldName' menjadi '{$request->name}'";
        }

        if ($oldPhone !== $request->phone) {
            $changes[] = "nomor HP dari '$oldPhone' menjadi '{$request->phone}'";
        }

        if ($oldEmail !== $request->email) {
            $changes[] = "email dari '$oldEmail' menjadi '{$request->email}'";
        }

        if ($oldAddress !== $request->address) {
            $changes[] = "alamat dari '$oldAddress' menjadi '{$request->address}'";
        }

        $description = count($changes) > 0
            ? 'Mengupdate supplier: ' . implode(' dan ', $changes)
            : 'Tidak ada perubahan';

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Mengupdate supplier',
            'description' => $description
        ]);

        return redirect()->route('supplier.index')->with('success', "$request->name berhasil diupdate");
    }

    public function destroy(string $id)
    {
        $data = Supplier::find($id);
        $data->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Menghapus supplier',
            'description' => "Menghapus supplier '$data->name'"
        ]);

        return redirect()->route('supplier.index')->with('success', "$data->name berhasil dihapus");
    }

}
