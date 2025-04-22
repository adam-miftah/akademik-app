<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        return response()->json([
            'message' => 'Selamat datang di dashboard admin!',
            'user' => $request->user()
        ]);
    }
}
