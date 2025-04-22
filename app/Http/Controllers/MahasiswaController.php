<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function dashboard(Request $request)
    {
        return response()->json([
            'message' => 'Selamat datang di dashboard mahasiswa!',
            'user' => $request->user()
        ]);
    }
}
