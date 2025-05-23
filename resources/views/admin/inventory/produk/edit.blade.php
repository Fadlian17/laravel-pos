@extends('layouts.admin')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col p-md-0">
                <h4>Produk</h4>
            </div>
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                    </li>
                    <!-- <li class="breadcrumb-item"><a href="javascript:void()">Forms</a>
                            </li> -->
                    <li class="breadcrumb-item active">Produk
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card forms-card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Edit Produk</h4>
                        <div class="basic-form">
                            <form action="{{route('produk_proses_edit')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="text-label">Nama Produk*</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Produk" value="{{ $row->nama }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="text-label">Kategori Produk*</label>
                                    <select name="kategori_id" class="form-control" required>
                                        <option value="0">Pilih Kategori Produk</option>
                                        @foreach($kategori as $kategoris)
                                        <option value="{{$kategoris->id}}" {{ $row->kategori_id == $kategoris->id ? 'selected' : '' }}>{{$kategoris->kategori}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-label">Stok Produk*</label>
                                    <input type="number" name="stok" class="form-control" placeholder="Masukkan Stok Produk" value="{{ $row->stok }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="text-label">Mata Uang*</label>
                                    <select name="mata_uang_id" class="form-control" required>
                                        <option value="0">Pilih Mata Uang</option>
                                        @foreach($matauang as $matauangs)
                                        <option value="{{$matauangs->id}}" {{ $row->mata_uang_id == $matauangs->id ? 'selected' : '' }}>{{$matauangs->matauang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-label">Unit Produk*</label>
                                    <select name="unit_id" class="form-control" placeholder="Masukkan Unit Produk" required>
                                        <option value="0">Pilih Unit Uang</option>
                                        @foreach($unit as $units)
                                        <option value="{{$units->id}}" {{ $row->unit_id == $units->id ? 'selected' : '' }}>{{$units->unit}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-label">Harga Beli Produk*</label>
                                    <input type="number" name="harga_beli" class="form-control" placeholder="Masukkan Harga Beli" value="{{ $row->harga_beli }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="text-label">Harga Jual Produk*</label>
                                    <select name="laba" class="form-control" required>
                                        <option value="0">Pilih Persentase Laba</option>
                                        @foreach($laba as $labas)
                                        <option value="{{$labas->laba}}">{{$labas->laba}}%</option>
                                        @endforeach
                                    </select>
                                    <select name="ppn" class="form-control" required>
                                        <option value="0">Pilih Stok Minimum</option>
                                        @foreach($stok_minimum as $stok_minimums)
                                        <option value="{{$stok_minimums->ppn}}">Stok Minimum: {{$stok_minimums->stok_minimum}} - PPN: {{$stok_minimums->ppn}}%</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="text-label">Diskon Produk</label>
                                    <input type="number" name="diskon" class="form-control" placeholder="Masukkan Diskon Produk">
                                </div>
                                <div class="form-group">
                                    <label class="text-label">Keterangan Produk*</label>
                                    <textarea name="keterangan" class="form-control" placeholder="Masukkan Keterangan Produk" required>{{ $row->keterangan }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="text-label">Foto Produk*</label>
                                    <input type="file" name="foto_produk" class="form-control">
                                    @if($row->foto_produk)
                                    <img src="{{ asset('storage/' . $row->foto_produk) }}" alt="{{ $row->nama }}" width="100">
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary btn-form mr-2">Submit</button>
                                <a href="{{route('produk')}}" class="btn btn-light text-dark btn-form">Cancel</a>
                                <input type="hidden" name="id" value="{{ $row->id }}">
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- #/ container -->
</div>
@endsection