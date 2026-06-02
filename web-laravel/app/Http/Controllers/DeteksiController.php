<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DeteksiController extends Controller
{
    public function index()
    {
        return view('deteksi');
    }

    public function predict(Request $request)
    {
        $request->validate([
            'image' => 'required|image'
        ]);

        // ambil file
        $imageFile = $request->file('image');

        // simpan gambar dulu
        $path = $imageFile->store('uploads', 'public');
        $imagePath = 'storage/' . $path;

        // kirim ke API YOLO
        $response = Http::attach(
            'file',
            file_get_contents($imageFile->getRealPath()),
            $imageFile->getClientOriginalName()
        )->post('http://127.0.0.1:8001/predict');

        $result = $response->json();

        return view('hasil', [
            'result' => $result,
            'imagePath' => $imagePath
        ]);
    }
}