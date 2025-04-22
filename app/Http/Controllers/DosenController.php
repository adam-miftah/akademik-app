<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function dashboard(Request $request)
    {
        return response()->json([
            'message' => 'Selamat datang di dashboard dosen!',
            'user' => $request->user()
        ]);
    }
}
