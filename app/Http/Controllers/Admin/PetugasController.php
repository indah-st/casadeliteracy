<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::latest()->get();
        return view('admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'email' => 'required|email|unique:petugas,email|unique:users,email',
        'password' => 'required|min:6',
        'no_hp' => 'nullable'
    ]);

    // simpan ke tabel petugas
    $petugas = Petugas::create([
    'nama' => $request->nama, // WAJIB TAMBAH INI
    'email' => $request->email,
    'password' => bcrypt($request->password),
    'no_hp' => $request->no_hp,
    'status' => 'aktif'
    ]);


    return redirect()->route('admin.petugas.index')
        ->with('success', 'Petugas berhasil ditambahkan');
}

    public function edit(Petugas $petugas)
    {
        return view('admin.petugas.edit', compact('petugas'));
    }

    public function update(Request $request, Petugas $petugas)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:petugas,email,' . $petugas->id,
            'no_hp' => 'nullable'
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $petugas->update($data);

        $user = User::where('email', $petugas->email)->first();

if ($user) {
    $user->update([
        'name' => $request->nama,
        'email' => $request->email,
    ]);

    if ($request->password) {
        $user->password = Hash::make($request->password);
        $user->save();
    }
}

        return redirect()->route('admin.petugas.index')
            ->with('success', 'Petugas berhasil diupdate');
    }

    public function destroy(Petugas $petugas)
{
    User::where('email', $petugas->email)->delete(); // 🔥 sync
    $petugas->delete();

    return back()->with('success', 'Petugas berhasil dihapus');
}

    public function toggleStatus(Petugas $petugas)
    {
        $petugas->status = $petugas->status === 'aktif' ? 'nonaktif' : 'aktif';
        $petugas->save();

        return back();
    }
}