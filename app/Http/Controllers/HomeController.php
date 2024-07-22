<?php

namespace App\Http\Controllers;
use \App\Produk;
use \App\Kategori;
use \App\Brand;
use \App\Cart;
use Illuminate\Http\Request;
use \App\Http\Services\CartService;
use Auth;
use Session;

class HomeController extends Controller
{
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cartLive = $this->cartService->getContent();
        // dd($cart);
        if($cartLive->count() >= '1' && !empty(Auth::user())){
            foreach ($cartLive as $item) {
                $productName = $item->id;
                $cek_kodeunik = Cart::where('user_id', Auth::user()->id)->where('status', '0')->first();
                if (!$cek_kodeunik) {
                    Session::put('kode_unik', rand(1111111111, 9999999999));
                } elseif (!Session::get('kode_unik') || Session::get('kode_unik') !== $cek_kodeunik->kode_unik) {
                    Session::put('kode_unik', $cek_kodeunik->kode_unik);
                }
                $harga = Produk::where('id', $item->id)->first();
                if($item->quantity > $harga->stok){
                    $this->cartService->delContent();
                }
                if($harga->stok <= '0'){
                    $this->cartService->delContent();
                }
                $harga->stok -= $item->quantity;
                $harga->save();
                $produk_cek = Cart::where('produk_id', $item->id)->where('status', '0')->first();
                if($produk_cek == null){
                    $produk = new Cart;
                    $produk->produk_id = $item->id;
                    $produk->jumlah = $item->quantity;
                    $produk->sub_total = $harga->harga_jual * $item->quantity;
                }else{
                    $produk = Cart::where('produk_id', $item->id)->where('status', '0')->first();
                    $produk->produk_id = $item->id;
                    $produk->jumlah += $item->quantity; 
                    $produk->sub_total += $harga->harga_jual * $item->quantity;
                }
                    $produk->user_id = Auth::user()->id;
                    $produk->kode_unik = Session::get('kode_unik');
                    $produk->save();
                    $this->cartService->delContent();
            }  
            // $cart = Cart::where('user_id', Auth::user()->id)->where('status','0')->get();
        }
        
        $produk = Produk::all();
        $kategori = Kategori::all();
        return view('pelanggan.home', compact('produk','kategori'));

    }
}
