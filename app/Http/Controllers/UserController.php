<?php

namespace App\Http\Controllers;

use App\Models\Transcribe;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends \App\Http\Controllers\Controller
{
public function index()
{
    $users = User::latest()->get();
    return view('admin.users.index', compact('users'));
}

 public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,staff,user'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

   public function destroy($id)
{
    try {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus.');

    } catch (QueryException $e) {
        return redirect()->back()->with('error', 'User tidak bisa dihapus karena masih memiliki data terkait.');
    }
}

public function edit($id)
{
    $user = User::findOrFail($id);
    return view('admin.users.edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
        'role' => 'required'
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;

    // Update password hanya jika diisi
    if ($request->password) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect()->route('admin.users.index')
        ->with('success', 'User berhasil diupdate.');
}

public function transcribes()
{
    Transcribe::create([
    'user_id' => auth()->id(),
    'file_name' => basename($path),
    'result' => $text
]);

    return $this->hasMany(Transcribe::class);
}

public function history()
{
    $transcripts = \App\Models\Transcript::where('user_id', auth()->id())
                    ->latest()
                    ->get();

    return view('history', compact('transcripts'));
}



}
