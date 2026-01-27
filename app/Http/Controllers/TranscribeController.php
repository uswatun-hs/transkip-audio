<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TranscribeController extends Controller
{
    // tampilkan halaman upload
    public function index()
    {
        return view('upload');
    }

    // proses upload & kirim ke FastAPI
    public function upload(Request $request)
    {
        $request->validate([
            'audio' => 'required|file|mimes:mp3,wav,webm,mp4'
        ]);

        $path = $request->file('audio')->store('audio');

        $response = Http::timeout(300) // 5 menit
            ->attach(
                'file',
                Storage::get($path),
                basename($path)
            )
            ->post('http://127.0.0.1:8000/transcribe');


        if ($response->failed()) {
            return back()->with('error', 'Gagal melakukan transkripsi');
        }

        $text = $response->json('text');

        return view('result', compact('text'));
    }
}
