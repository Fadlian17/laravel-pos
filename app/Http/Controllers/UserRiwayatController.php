<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use \App\Cart;
use \App\Produk;
use \App\User;
use \App\Checkout;
use Illuminate\Http\Request;

class UserRiwayatController extends Controller
{
    public function riwayatpemesanan()
    {
        $detail = Cart::orderBy('carts.id', 'DESC')
        ->where('carts.user_id', Auth::user()->id)
        ->where('carts.status', '1')
        ->join('produks', 'carts.produk_id', '=', 'produks.id')
        ->join('kategoris', 'produks.kategori_id', '=', 'kategoris.id')
        ->join('checkouts', 'carts.kode_unik', '=', 'checkouts.kode_unik')
        ->select('carts.kode_unik as kode_unik', 'checkouts.status as status', 'carts.jumlah as jumlah_cart', 'carts.sub_total as sub_total_cart', 'produks.nama as nama_produk', 'produks.foto_produk as foto_produk', 'kategoris.kategori as kategori')
        ->get();

        // dd($detail);
        return view('pelanggan.riwayat', ['data' => $detail,]);
    }
}
