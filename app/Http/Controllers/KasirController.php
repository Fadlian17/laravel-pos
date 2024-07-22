<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Produk;
use \App\Cart;
use \App\Checkout;
use Auth;
use Session;
use \PDF;
use \App\User;
use \App\Brand;

class KasirController extends Controller
{
    public function dashboard() {
        $transaksi = Checkout::orderBy('id', 'DESC')->get();
        $count_order = Checkout::all()->count();
        $count_produk = Produk::all()->count();
        $count_user = User::all()->count();
    	return view('kasir.dashboard', compact('transaksi', 'count_order', 'count_produk', 'count_user'));
    }

    public function profile() {
        $profile = User::find(Auth::user()->id);
        return view('kasir.profile.index', compact('profile'));
    }

    public function proses_profile(Request $r) {
        $profile = User::find(Auth::user()->id);
        $profile->name = $r->name;
        $profile->email = $r->email;
        if($r->password != null){
        $profile->password = bcrypt($r->password);
        }
        $profile->save();
        return redirect(route('kasir_profile'))->with('sukses', 'Profile Berhasil Diubah!');
    }

    public function transaksi() {
    	$produk = Produk::all();
    	$cart = Cart::where('user_id', Auth::user()->id)->where('status','0')->get();
        $cart2 = Cart::where('user_id', Auth::user()->id)->where('status','0')->first();
        // dd($cart2);
    	return view('kasir.transaksi.index', compact('produk', 'cart', 'cart2'));
    }

    public function prosestransaksi(Request $request){
        $transaksi = Checkout::orderBy('id', 'DESC')
                            ->join('users', 'checkouts.user_id', '=', 'users.id')
                            ->select('checkouts.*', 'users.name as nama_user', 'users.phone as phone')
                            ->whereIn('checkouts.status', ['MENUNGGU PEMBAYARAN', 'PEMBAYARAN SUDAH DILAKUKAN', 'PEMBAYARAN TELAH DIKONFIRMASI'])
                            ->get();
        if ($request->ajax()) {  
            $detail = Cart::orderBy('id', 'DESC')
                            ->where('carts.kode_unik', $request->query('detailId'))
                            ->join('checkouts', 'carts.kode_unik', '=', 'checkouts.kode_unik')
                            ->join('produks', 'carts.produk_id', '=', 'produks.id')
                            ->select('checkouts.*', 'carts.produk_id as produk_id', 'carts.jumlah as jumlah_cart', 'carts.sub_total as sub_total_cart', 'produks.nama as nama_produk')
                            ->get();
            return response()->json($detail);
        }
        // dd($transaksi);
    	return view('kasir.transaksi.index_dev', compact('transaksi'));
    }

    public function aturjadwalkirim(Request $request){
        $transaksi = Checkout::orderBy('id', 'DESC')
                            ->join('users', 'checkouts.user_id', '=', 'users.id')
                            ->select('checkouts.*', 'users.name as nama_user')
                            ->whereNotIn('checkouts.status', ['MENUNGGU PEMBAYARAN', 'PEMBAYARAN SUDAH DILAKUKAN'])
                            ->get();
        if ($request->ajax()) {  
            $detail = Cart::orderBy('id', 'DESC')
                            ->where('carts.kode_unik', $request->query('detailId'))
                            ->join('checkouts', 'carts.kode_unik', '=', 'checkouts.kode_unik')
                            ->join('produks', 'carts.produk_id', '=', 'produks.id')
                            ->select('checkouts.*', 'carts.produk_id as produk_id', 'carts.jumlah as jumlah_cart', 'carts.sub_total as sub_total_cart', 'produks.nama as nama_produk')
                            ->get();
            return response()->json($detail);
        }
        // dd($detail);
    	return view('kasir.transaksi.aturjadwalkirim', compact('transaksi'));
    }

    public function aturtanggal(Request $request){
        // dd($request->jadwal);
        $checkout = Checkout::where('id', $request->transaksiId)->first();
        $checkout->tgl_pengiriman = $request->jadwal;
        $checkout->status = 'BARANG DALAM PROSES PENGIRIMAN';
        $checkout->save();
    	return back()->with('sukses', 'Tanggal Telah Dipudate');
    }

    public function proses_transaksi(Request $r) {

        if(!Session::get('kode_unik')){
            Session::put('kode_unik', rand(1111111111,9999999999));
        }
        if($r->produk_id == '0'){
            return redirect(route('transaksi'))->with('sukses', 'Anda Belum Memilih Produk!');
        }
        if($r->jumlah <= '0'){
            return redirect(route('transaksi'))->with('sukses', 'Minimal Jumlah Pembelian 1!');
        }
        $harga = Produk::where('id', $r->produk_id)->first();
        if($r->jumlah > $harga->stok){
            return redirect(route('transaksi'))->with('sukses', 'Jumlah Melebihi Stok!');
        }
        if($harga->stok <= '0'){
            return redirect(route('transaksi'))->with('sukses', 'Stok Sudah Habis!');
        }
        $harga->stok -= $r->jumlah;
        $harga->save();
    	$produk_cek = Cart::where('produk_id', $r->produk_id)->where('status', '0')->first();
        if($produk_cek == null){
        $produk = new Cart;
    	$produk->produk_id = $r->produk_id;
    	$produk->jumlah = $r->jumlah;
        }else{
        $produk = Cart::where('produk_id', $r->produk_id)->where('status', '0')->first();
        $produk->produk_id = $r->produk_id;
        $produk->jumlah += $r->jumlah; 
        }
    	$produk->sub_total = $harga->harga_jual * $r->jumlah;
    	$produk->user_id = Auth::user()->id;
        $produk->kode_unik = Session::get('kode_unik');
    	$produk->save();
    	return redirect()->back()->with('sukses', 'Barang Berhasil Ditambah!');
    }

    public function proses_hapus($id) {
        $transaksi = Cart::find($id);
        $produk = Produk::where('id', $transaksi->produk_id)->first();
        $produk->stok += $transaksi->jumlah;
        $produk->save();
        $transaksi->delete();
        return redirect()->back()->with('sukses', 'Barang Berhasil Dihapus!');
    }

    public function cancel_order($kode_unik) {
        $checkout = Checkout::where('kode_unik', $kode_unik);
        $carts = Cart::where('kode_unik', $kode_unik)->get();
        foreach ($carts as $cart) {
            $produk = Produk::where('id', $cart->produk_id)->first();
            $produk->stok += $cart->jumlah;
            $produk->save();
            $cart->delete();
        }
        $checkout->delete();
        return redirect()->back()->with('sukses', 'Transaksi Berhasil Dihapus');
    }

    public function confirmation($kode_unik) {
        $checkout = Checkout::where('kode_unik', $kode_unik)->first();
        $saldo = $checkout->total;
        $checkout->saldo += $saldo;
        $checkout->kembalian += $checkout->saldo - $saldo;
        $checkout->status = 'PEMBAYARAN TELAH DIKONFIRMASI';
        $checkout->save();
        return redirect()->back()->with('sukses', 'Pembayaran Telah Dikonfirmasi');
    }

    public function delivery_confirmation($kode_unik) {
        $checkout = Checkout::where('kode_unik', $kode_unik)->first();
        $checkout->status = 'BARANG TELAH SAMPAI';
        $checkout->save();
        return redirect()->back()->with('sukses', 'Pengiriman Telah Dikonfirmasi');
    }

    public function proses_hapus_all($id) {
        $transaksi = Cart::find($id);
        $produk = Produk::where('id', $transaksi->produk_id)->first();
        $produk->stok += $transaksi->jumlah;
        $produk->save();
        $transaksi = Cart::where('user_id', Auth::user()->id)->delete();
        return redirect()->back()->with('sukses', 'Barang Berhasil Dihapus!');
    }

    public function checkout() {
        $produk = Produk::all();
        $cart = Cart::where('user_id', Auth::user()->id)->where('status','0')->get();
        return view('kasir.transaksi.checkout', compact('produk', 'cart'));
    }

    public function proses_checkout(Request $r) {
        if($r->saldo < $r->total){
            return redirect()->back();
        }
        $cart = Cart::where('user_id', Auth::user()->id)->where('status', '0')->get();
        if($r->saldo < $cart->sum('sub_total')){
            return redirect(route('transaksi_checkout'))->with('sukses', 'Saldo Yang Anda Masukkan Kurang!');
        }
      
        $cart2 = Cart::where('kode_unik', Session::get('kode_unik'))->update(array('status' => '1'));
        $checkout = new Checkout;
        $checkout->total = $cart->sum('sub_total');
        $checkout->user_id = Auth::user()->id;
        $checkout->metode = $r->metode;
        $checkout->saldo = $r->saldo;
        $checkout->kode_unik = Session::get('kode_unik');
        if($r->saldo < $cart->sum('sub_total')){
            return redirect(route('transaksi_checkout'));
        }
        $checkout->kembalian = $r->saldo - $cart->sum('sub_total');
        $checkout->save();
        Session::forget('kode_unik');
        return redirect(route('transaksi'))->with('sukses', 'Transaksi Berhasil!');
    }

    public function kode_unik() {
        $checkout = Checkout::all();
        return view('kasir.transaksi.kode_unik', compact('checkout'));
    }

    public function invoice(Request $r) {
        $brand = Brand::all()->first();
        $kode_unik = Cart::where('kode_unik', $r->kode_unik)->get();
        $pdf = PDF::loadview('kasir.transaksi.bukti', compact('kode_unik', 'brand'));
        return $pdf->stream();
    }
}
