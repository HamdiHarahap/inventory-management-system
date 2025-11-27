<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('keyword');

        $data = Customer::when($q, function ($query) use ($q) {
            $query->where('name', 'like', "%$q%")
                ->orWhere('phone', 'like', "%$q%")
                ->orWhere('email', 'like', "%$q%")
                ->orWhere('address', 'like', "%$q%");
        })->get();

        return view('customer.index', [
            'title' => 'Customer',
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('customer.create', [
            'title' => 'Customer',
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

        Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Menambah customer',
            'description' => "Menambahkan customer baru '$request->name'"
        ]);

        return redirect()->route('customer.index')->with('success', 'Customer berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        return view('customer.edit', [
            'title' => 'Customer',
            'data' => Customer::find($id)
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

        $supplier = Customer::findOrFail($id);

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
            ? 'Mengupdate customer: ' . implode(' dan ', $changes)
            : 'Tidak ada perubahan';

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Mengupdate customer',
            'description' => $description
        ]);

        return redirect()->route('customer.index')->with('success', "$request->name berhasil diupdate");
    }

    public function destroy(string $id)
    {
        $data = Customer::find($id);
        $data->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Menghapus customer',
            'description' => "Menghapus customer '$data->name'"
        ]);

        return redirect()->route('customer.index')->with('success', "$data->name berhasil dihapus");
    }
}
