<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Produk;
use \App\Kategori;
use \App\MataUang;
use \App\Unit;
use \App\PersentaseLaba;
use \App\StokPpn;
use \App\Checkout;
use \App\Brand;
use PDF;

class ProdukController extends Controller
{
    public function produk() {
    	$produk = Produk::all();
    	return view('admin.inventory.produk.index', compact('produk'));
    }

    public function tambah() {
    	$kategori = kategori::all();
    	$matauang = MataUang::all();
    	$unit = Unit::all();
    	$laba = PersentaseLaba::all();
        $stok_minimum = StokPpn::all();
    	return view('admin.inventory.produk.tambah', compact('kategori', 'matauang', 'unit', 'laba', 'stok_minimum'));
    }

    public function proses_tambah(Request $r) {
        $produk = new Produk;
        $barcode = rand(1111111111,9999999999);
        $produk->barcode = $barcode;
        $produk->nama = $r->nama;
        $produk->stok = $r->stok;
        $produk->kategori_id = $r->kategori_id;
        $produk->mata_uang_id = $r->mata_uang_id;
        $produk->unit_id = $r->unit_id;
        $produk->harga_beli = $r->harga_beli;
        $produk->keterangan = $r->keterangan;
        $produk->diskon = $r->diskon;
        $produk->laba = $r->laba;
        $produk->ppn = $r->ppn;
    
        if($r->diskon != null){
            $diskon = $r->harga_beli * $r->diskon / 100;
            $minus = $r->harga_beli - $diskon;
            $persen = $minus * ($r->laba + $r->ppn) / 100;
            $produk->harga_jual = $persen + $minus;
        } else {
            $persen = $r->harga_beli * ($r->laba + $r->ppn) / 100;
            $produk->harga_jual = $r->harga_beli + $persen;
        }
    
        // Menangani pengunggahan file
        if($r->hasFile('foto_produk')) {
            $file = $r->file('foto_produk');
            $namaProduk = preg_replace('/[^A-Za-z0-9\-]/', '_', $r->nama); // Mengganti karakter khusus dengan _
            $filename = $namaProduk . '_' . time() . '_' . $file->getClientOriginalName();
            // Simpan file di folder public/foto_produk
            $file->move(public_path('foto_produk'), $filename);
            // Ubah path agar sesuai dengan yang tersimpan di database
            $produk->foto_produk =  $filename;
        }
        
        
    
        $produk->save();
        return redirect(route('produk'))->with('sukses', 'Data Berhasil Ditambah!');
    }
    
    


    public function edit(Request $r, $id) {
        $row = Produk::find($id);
    	$kategori = kategori::all();
    	$matauang = MataUang::all();
    	$unit = Unit::all();
    	$laba = PersentaseLaba::all();
        $stok_minimum = StokPpn::all();
    	return view('admin.inventory.produk.edit', compact('row','kategori', 'matauang', 'unit', 'laba', 'stok_minimum'));
    }

    public function proses_edit(Request $r) {
        $produk = Produk::find($r->id);
        $barcode = rand(1111111111,9999999999);
        $produk->barcode = $barcode;
        $produk->nama = $r->nama;
        $produk->stok = $r->stok;
        $produk->kategori_id = $r->kategori_id;
        $produk->mata_uang_id = $r->mata_uang_id;
        $produk->unit_id = $r->unit_id;
        $produk->harga_beli = $r->harga_beli;
        $produk->keterangan = $r->keterangan;
        $produk->diskon = $r->diskon;
        $produk->laba = $r->laba;
        $produk->ppn = $r->ppn;
    
        if($r->diskon != null) {
            $diskon = $r->harga_beli * $r->diskon / 100;
            $minus = $r->harga_beli - $diskon;
            $persen = $minus * ($r->laba + $r->ppn) / 100;
            $produk->harga_jual = $persen + $minus;
        } else {
            $persen = $r->harga_beli * ($r->laba + $r->ppn) / 100;
            $produk->harga_jual = $r->harga_beli + $persen;
        }
    
        // Menangani pengunggahan file
        if ($r->hasFile('foto_produk')) {
            // Hapus file foto lama jika ada
            if ($produk->foto_produk) {
                $oldPath = public_path('foto_produk/' . $produk->foto_produk);
                if (file_exists($oldPath)) {
                    // Hapus foto lama
                    if (!unlink($oldPath)) {
                        // Jika gagal menghapus, tampilkan pesan kesalahan
                        return redirect()->back()->withErrors(['error' => 'Gagal menghapus foto lama.']);
                    }
                }
            }
        
            // Simpan foto baru
            $file = $r->file('foto_produk');
            $namaProduk = preg_replace('/[^A-Za-z0-9\-]/', '_', $r->nama); // Mengganti karakter khusus dengan _
            $filename = $namaProduk . '_' . time() . '_' . $file->getClientOriginalName();
            $path = $file->move(public_path('foto_produk'), $filename);
            $produk->foto_produk = $filename;
        }
        
    
        $produk->save();
        return redirect(route('produk'))->with('sukses', 'Data Berhasil Diubah!');
    }
    


    public function hapus($id) {
    	$produk = Produk::find($id);
    	$produk->delete();
    	return redirect(route('produk'))->with('sukses', 'Data Berhasil Dihapus!');
    }

    public function detail($barcode) {
        $kategori = Kategori::all();
        $matauang = MataUang::all();
        $unit = Unit::all();
        $laba = PersentaseLaba::all();
        $stok_minimum = StokPpn::all();
        $produk = Produk::where('barcode', $barcode)->first();
        return view('admin.inventory.produk.detail', compact('produk', 'kategori', 'matauang', 'unit', 'laba', 'stok_minimum'));
    }

    public function proses_detail(Request $r) {
        $produk = Produk::where('barcode', $r->barcode)->first();
        $produk->nama = $r->nama;
        $produk->stok = $r->stok;
        $produk->kategori_id = $r->kategori_id;
        $produk->mata_uang_id = $r->mata_uang_id;
        $produk->unit_id = $r->unit_id;
        $produk->harga_beli = $r->harga_beli;
        $produk->keterangan = $r->keterangan;
        $produk->diskon = $r->diskon;
        $produk->laba = $r->laba;
        $produk->ppn = $r->stok_minimum;

        if($r->diskon != null){
            $diskon = $r->harga_beli * $r->diskon / '100';
            $persen = $diskon * ($r->laba + $r->stok_minimum) / '100';
            $produk->harga_jual = $diskon + $persen;
        }else{
        $persen = $r->harga_beli * ($r->laba + $r->stok_minimum) / '100';
        $produk->harga_jual = $r->harga_beli + $persen;
        }
        $produk->save();
        return redirect()->back()->with('sukses', 'Data Berhasil Diubah!');
    }

    public function laporan_produk() {
        $laporan = Produk::all();
        $brand = Brand::all()->first();
        $pdf = PDF::loadview('admin.inventory.produk.laporan_produk', compact('laporan', 'brand'));
        return $pdf->stream();
    }

    public function laporan_produk_kosong() {
        $laporan = Produk::where('stok', '0')->get();
        $brand = Brand::all()->first();
        $pdf = PDF::loadview('admin.inventory.produk.laporan_produk', compact('laporan', 'brand'));
        return $pdf->stream();
    }

    public function laporan_transaksi() {
        $laporan = Checkout::all();
        $brand = Brand::all()->first();
        $pdf = PDF::loadview('admin.inventory.produk.laporan_transaksi', compact('laporan', 'brand'));
        return $pdf->stream();
    }
}
