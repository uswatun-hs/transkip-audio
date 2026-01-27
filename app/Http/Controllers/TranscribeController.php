<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;

class TranscribeController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'audio' => 'required|file|mimes:mp3,wav,webm,mp4'
        ]);

        // simpan audio
        $path = $request->file('audio')->store('audio');

        try {
            $response = Http::timeout(300)
                ->attach(
                    'file',
                    Storage::get($path),
                    basename($path)
                )
                ->post('http://127.0.0.1:8000/transcribe');

            if ($response->failed()) {
                throw new \Exception('FastAPI error');
            }

            $data = $response->json();

            if (!isset($data['text'])) {
                throw new \Exception('Text tidak ditemukan');
            }

            $text = $data['text'];

        } catch (\Exception $e) {
            Storage::delete($path);
            return back()->with('error', 'Gagal melakukan transkripsi');
        }

        // hapus audio setelah dipakai
        Storage::delete($path);

        return view('result', compact('text'));
    }

    public function exportWord(Request $request)
    {
        $text = $request->input('text');

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addText($text);

        $filename = 'transkrip.docx';
        $path = storage_path("app/$filename");

        IOFactory::createWriter($phpWord, 'Word2007')->save($path);

        return response()->download($path)->deleteFileAfterSend(true);
    }

    public function exportPdf(Request $request)
    {
        $text = $request->input('text');

        $pdf = Pdf::loadView('pdf.transcript', compact('text'));

        return $pdf->download('transkrip.pdf');
    }
}