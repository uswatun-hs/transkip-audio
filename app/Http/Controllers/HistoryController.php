<?php

namespace App\Http\Controllers;

use App\Models\Transcribe;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    // ==========================
    // INDEX (List History)
    // ==========================
    public function index(Request $request)
{
    $role = auth()->user()->role;

    $query = Transcribe::with('user')->latest();

    // 🔥 FILTER ROLE (admin only)
    if ($request->role && $role == 'admin') {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('role', $request->role);
        });
    }

    // User hanya lihat miliknya
    if ($role == 'user') {
        $query->where('user_id', auth()->id());
    }

    $transcripts = $query->paginate(10);

    return view('history.index', compact('transcripts'));
}

    // ==========================
    // SHOW
    // ==========================
    public function show($id)
    {
        $data = Transcribe::with('user')->findOrFail($id);

        if (auth()->user()->role == 'user' && $data->user_id != auth()->id()) {
            abort(403);
        }

        return view('history.show', compact('data'));
    }

    // ==========================
    // EDIT (Admin Only)
    // ==========================
    public function edit($id)
    {
        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        $data = Transcribe::findOrFail($id);

        return view('history.edit', compact('data'));
    }

    // ==========================
    // UPDATE (Admin Only)
    // ==========================
    public function update(Request $request, $id)
    {
        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        $request->validate([
            'result' => 'required'
        ]);

        $data = Transcribe::findOrFail($id);
        $data->update([
            'result' => $request->result
        ]);

        return redirect()->route('history.index')
            ->with('success', 'History berhasil diupdate');
    }

    // ==========================
    // DESTROY (Admin Only)
    // ==========================
    public function destroy($id)
    {
        if (auth()->user()->role != 'admin') {
            abort(403);
        }

        $data = Transcribe::findOrFail($id);
        $data->delete();

        return back()->with('success', 'History berhasil dihapus');
    }
}
