<?php

namespace App\Http\Controllers;
use \App\Produk;
use \App\Kategori;
use \App\MataUang;
use \App\Unit;
use \App\PersentaseLaba;
use \App\StokPpn;
use \App\Checkout;
use \App\Brand;
use Illuminate\Http\Request;

class UserProdukController extends Controller
{
    public function allproduk()
    {
        $produk = Produk::all();
        // $products = Product::all(); // Mendapatkan semua produk
        return view('pelanggan.produk', compact('produk'));
    }
    public function detailproduk($id)
    {
        $produk = Produk::find($id);
        return view('pelanggan.detail', compact('produk'));
    }
    
}
