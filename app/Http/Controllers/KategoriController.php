<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Kategori;
use \App\Brand;
use PDF;

class KategoriController extends Controller
{
    /**
     *
     * Define Kategori Kontroller Mulai Dengan Struktur CRUD
     * */
    public function kategori() {
    	$kategori = Kategori::all();
    	return view('admin.master.kategori.index', compact('kategori'));
    }

    public function tambah() {
    	return view('admin.master.kategori.tambah');
    }
    public function proses_tambah(Request $r) {
        $kategori = new Kategori;
        $kategori->kategori = $r->kategori;
    
        // Menangani pengunggahan file foto kategori
        if ($r->hasFile('foto_kategori')) {
            $file = $r->file('foto_kategori');
            $originalName = $file->getClientOriginalName();
            $namaKategori = preg_replace('/[^A-Za-z0-9\-]/', '_', $r->kategori); // Mengganti karakter khusus dengan _
            $filename = $namaKategori . '_' . time() . '_' . $originalName;
            $path = $file->move(public_path('foto_kategori'), $filename);
            $kategori->foto_kategori = $filename;
        }
    
        $kategori->save();
        return redirect(route('kategori'))->with('sukses', 'Data Berhasil Ditambah!');
    }
    

    public function proses_edit(Request $r) {
        $kategori = Kategori::findOrFail($r->id);
        $kategori->kategori = $r->kategori;
    
        // Menangani pengunggahan file foto kategori
        if ($r->hasFile('foto_kategori')) {
            // Hapus file lama jika ada
            if ($kategori->foto_kategori) {
                $oldFile = public_path('foto_kategori/') . $kategori->foto_kategori;
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }
    
            // Upload file baru
            $file = $r->file('foto_kategori');
            $originalName = $file->getClientOriginalName();
            $namaKategori = preg_replace('/[^A-Za-z0-9\-]/', '_', $r->kategori); // Mengganti karakter khusus dengan _
            $filename = $namaKategori . '_' . time() . '_' . $originalName;
            $path = $file->move(public_path('foto_kategori'), $filename);
            $kategori->foto_kategori = $filename;
        }
    
        $kategori->save();
        return redirect(route('kategori'))->with('sukses', 'Data Berhasil Diedit!');
    }
    

    public function edit(Request $r, $id) {
        $data['row'] = Kategori::find($id);

    	return view('admin.master.kategori.edit', $data);
    }

    public function hapus($id) {
    	$kategori = Kategori::find($id);
    	$kategori->delete();
    	return redirect(route('kategori'))->with('sukses', 'Data Berhasil Dihapus!');
    }

    public function laporan() {
        $laporan = Kategori::all();
        $brand = Brand::all()->first();
        $pdf = PDF::loadview('admin.master.kategori.laporan', compact('laporan', 'brand'));
        return $pdf->stream();
    }
}
