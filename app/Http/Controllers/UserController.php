<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->keyword;

        if(Auth::user()->role == 'admin') {
            $data = User::where('role', '!=', 'admin')
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%$q%")
                    ->orWhere('role', 'like', "%$q%");
                });
            })
            ->get();
        }

        if(Auth::user()->role == 'manager') {
            $data = User::where('role', '!=', 'manager')
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%$q%")
                    ->orWhere('role', 'like', "%$q%");
                });
            })
            ->get();
        }
            
        return view('user.index', [
            'title' => 'Pengguna',
            'data'  => $data,
        ]);
    }


    public function create()
    {
        return view('user.create', [
            'title' => 'Pengguna',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Manambahkan pengguna',
            'description' => "Menambahkan pengguna baru '$request->name'"
        ]);

        return redirect()->route('user.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        return view('user.edit', [
            'title' => 'Pengguna',
            'data' => User::find($id)
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'role' => 'required'
        ]);

        $user = User::findOrFail($id);

        $oldData = $user->only(['name', 'email', 'role']);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ]);

        $passwordChanged = false;
        if($request->password) {
            $user->password = Hash::make($request->password);
            $passwordChanged = true;
        }

        $user->save();

        $changes = [];

        if ($oldData['name'] !== $request->name) {
            $changes[] = "nama dari '{$oldData['name']}' menjadi '{$request->name}'";
        }
        if ($oldData['email'] !== $request->email) {
            $changes[] = "email dari '{$oldData['email']}' menjadi '{$request->email}'";
        }
        if ($oldData['role'] !== $request->role) {
            $changes[] = "role dari '{$oldData['role']}' menjadi '{$request->role}'";
        }
        if ($passwordChanged) {
            $changes[] = "password diubah";
        }

        $description = count($changes) > 0
            ? 'Mengupdate pengguna: ' . implode(' dan ', $changes)
            : 'Tidak ada perubahan';

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Mengupdate pengguna',
            'description' => $description
        ]);

        return redirect()->route('user.index')->with('success', "$user->name berhasil diperbarui!");
    }


    public function destroy(string $id)
    {
        $data = User::find($id);
        $data->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Menghapus pengguna',
            'description' => "Menghapus pengguna '$data->name'"
        ]);

        return redirect()->route('user.index')->with('success', "$data->name berhasil dihapus");
    }
}
