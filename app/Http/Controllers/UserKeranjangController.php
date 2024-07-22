<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Services\CartService;
use Auth;
use Session;
use \App\Cart;
use \App\Produk;
use \App\User;
use \App\Checkout;

class UserKeranjangController extends Controller
{
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function keranjang(Request $request)
    {
        // $products = Product::all(); // Mendapatkan semua produk
        // return view('pelanggan.cart');
        $cartLive = $this->cartService->getContent();

        if(!empty(Auth::user())){
            $detail = Cart::orderBy('carts.id', 'DESC')
            ->where('carts.user_id', Auth::user()->id)
            ->where('status', '0')
            ->join('produks', 'carts.produk_id', '=', 'produks.id')
            ->join('kategoris', 'produks.kategori_id', '=', 'kategoris.id')
            ->select('carts.kode_unik as kode_unik', 'carts.jumlah as jumlah_cart', 'carts.sub_total as sub_total_cart', 'produks.nama as nama_produk', 'produks.foto_produk as foto_produk', 'kategoris.kategori as kategori')
            ->get();
            // dd($detail);
            $total_harga = 0;
            foreach($detail as $item){
                $total_harga += $item->sub_total_cart;
            }
            return view('pelanggan.cartLogin', ['data' => $detail, 'total_harga' => $total_harga]);
        } else {
            $items = \Cart::getContent();
            return view('pelanggan.cart', ['data' => $items]);
        }
    }

    public function keranjangStore(Request $request)
    {

        if(!empty(Auth::user())){
            $params = $request->except('_token');
            $productName = $params['name'];
            $cek_kodeunik = Cart::where('user_id', Auth::user()->id)->where('status', '0')->first();
            if (!$cek_kodeunik) {
                Session::put('kode_unik', rand(1111111111, 9999999999));
            } elseif (!Session::get('kode_unik') || Session::get('kode_unik') !== $cek_kodeunik->kode_unik) {
                Session::put('kode_unik', $cek_kodeunik->kode_unik);
            }
            $harga = Produk::where('id', $params['id'])->first();
            if($params['quantity'] > $harga->stok){
                $this->cartService->delContent();
                return redirect()->back()->withErrors(['mismatch' => 'Jumlah Melebihi Stok!']);
            }
            if($harga->stok <= '0'){
                $this->cartService->delContent();
                return redirect()->back()->withErrors(['mismatch' => 'Stok Sudah Habis!']);
            }
            $harga->stok -= $params['quantity'];
            $harga->save();
            $produk_cek = Cart::where('produk_id', $params['id'])->where('status', '0')->first();
            if($produk_cek == null){
                $produk = new Cart;
                $produk->produk_id = $params['id'];
                $produk->jumlah = $params['quantity'];
                $produk->sub_total = $harga->harga_jual * $params['quantity'];
            }else{
                $produk = Cart::where('produk_id', $params['id'])->where('status', '0')->first();
                $produk->produk_id = $params['id'];
                $produk->jumlah += $params['quantity']; 
                $produk->sub_total += $params['harga'] * $params['quantity']; 
            }
                $produk->user_id = Auth::user()->id;
                $produk->kode_unik = Session::get('kode_unik');
                $produk->save();
                $this->cartService->delContent();
            \Session::flash('success', 'Product '. $productName .' has been added to cart');
            return redirect()->back();
        } else {
            // dd($cart);
            $params = $request->except('_token');
            // var_dump($params);exit;
            $item = [
                'id' => $params['id'],
                'name' => $params['name'],
                'price' => $params['harga'] *  $params['quantity'],
                'quantity' => $params['quantity'],
                'attributes' => array(
                    'foto' => $params['foto'],
                    'kategori' => $params['kategori'],
                  ) 
            ];
            \Cart::add($item);
            \Session::flash('success', 'Product '. $item['name'] .' has been added to cart');
            return redirect()->back();
        }
    }

    public function keranjangHapus($productId){
        if(!empty(Auth::user())){
            $produk = Produk::where('id', $transaksi->produk_id)->first();
            $cart = Cart::where('kode_unik', $productId)->where('status', '0');
            $produk->stok += $cart->jumlah;
            $produk->save();
            $cart->delete();
        }else{
            \Cart::remove($productId);
        }
        return redirect()->back();
    }

    public function checkout(){
        $detail = Cart::orderBy('carts.id', 'DESC')
        ->where('carts.user_id', Auth::user()->id)
        ->where('status', '0')
        ->join('produks', 'carts.produk_id', '=', 'produks.id')
        ->join('kategoris', 'produks.kategori_id', '=', 'kategoris.id')
        ->select('carts.kode_unik as kode_unik', 'carts.jumlah as jumlah_cart', 'carts.sub_total as sub_total_cart', 'produks.nama as nama_produk', 'produks.foto_produk as foto_produk', 'kategoris.kategori as kategori')
        ->get();
        $userId = Auth::user()->id;
        $alamat = User::find(Auth::user()->id);
        $total_harga = 0;
        foreach($detail as $item){
            $total_harga += $item->sub_total_cart;
        }
        return view('pelanggan.checkout-page', ['data' => $detail, 'total_harga' => $total_harga, 'userId' => $userId, 'alamat' => $alamat->alamat, 'kode_unik' => $detail->first()]);
    }

    public function submitAlamat(Request $request){
        $userId = $request->input('userId');
        $alamat = $request->input('message');
        $user = User::find($userId);
        $user->alamat = $alamat;
        $user->save();
        if (!$user) {
            return response()->json(['status' => 'Error']);
        }else{
            return response()->json(['status' => 'success']);
        }
    }

    public function confirm(){
        $detail = Cart::orderBy('carts.id', 'DESC')
        ->where('carts.user_id', Auth::user()->id)
        ->where('status', '0')
        ->join('produks', 'carts.produk_id', '=', 'produks.id')
        ->join('kategoris', 'produks.kategori_id', '=', 'kategoris.id')
        ->join('users', 'carts.user_id', '=', 'users.id')
        ->select('carts.kode_unik as kode_unik', 'users.alamat as alamat', 'carts.jumlah as jumlah_cart', 'carts.sub_total as sub_total_cart', 'produks.nama as nama_produk', 'produks.foto_produk as foto_produk', 'kategoris.kategori as kategori')
        ->get();
        $total_harga = 0;
        foreach($detail as $item){
            $total_harga += $item->sub_total_cart;
        }
        return view('pelanggan.upload', ['data' => $detail->first(), 'total_harga' => $total_harga]);
    }

    public function payment(Request $request){
        // dd($request->request->all());
        if($request->hasFile('file')){
            $request->validate([
                'evidence' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            ]);
            $file = $request->file('evidence');
            $imageName = $request->kode_unik."_".$file->getClientOriginalName();
            $file->move('gleek/gleek/assets/images/pembayaran/', $imageName);
        }

        $cart = Cart::where('user_id', Auth::user()->id)->where('status', '0')->get();      
        $cart2 = Cart::where('kode_unik', Session::get('kode_unik'))->update(array('status' => '1'));
        $checkout = new Checkout;
        $checkout->total = $cart->sum('sub_total');
        $checkout->user_id = Auth::user()->id;
        $checkout->metode = $request->metode;
        $checkout->kode_unik = $request->kode_unik;
        $checkout->status = 'PEMBAYARAN SUDAH DILAKUKAN';
        if($request->hasFile('file')){
            $checkout->bukti_pembayaran = $file->getClientOriginalName();
        }
        $checkout->alamat = $request->alamat;
        $checkout->save();
        Session::forget('kode_unik');
        return redirect('/payment-success');
    }

    public function success(){
        return view('pelanggan.payment-success');
    }
}