<?php

namespace App\Http\Controllers;
use Auth;
use \App\User;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function userprofile(Request $request)
    {
        // $products = Product::all(); // Mendapatkan semua produk
        $user = User::find(Auth::user()->id);
        return view('pelanggan.profile', ['data' => $user]);
    }
}
