@extends('layouts.admin')
@section('content')
<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col p-md-0">
                        <h4>Kategori</h4>
                    </div>
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <!-- <li class="breadcrumb-item"><a href="javascript:void()">Forms</a>
                            </li> -->
                            <li class="breadcrumb-item active">Kategori
                            </li>
                        </ol>
                    </div>
                </div>

                @if($message = Session::get('sukses'))
                <div class="alert alert-primary alert-dismissible fade show">
                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button> <strong>{{$message}}</strong></div>
                @endif

                <div class="row">
                    <div class="col-xl-12">
                        <div class="col-lg-12">
                            <div class="card button-card">
                                <div class="card-body">
                                    {{-- <h4 class="card-title card-intro-title">Button with icons</h4> --}}
                                    <center>
                                    <div class="button-icon">
                                        <a href="{{route('kategori_tambah')}}" class="btn btn-rounded btn-info"><span class="btn-icon-left text-info"><i class="fa fa-plus color-info"></i> </span>Tambah Kategori</a>
                                        <a href="{{route('kategori_laporan')}}" class="btn btn-rounded btn-warning" target="_blank"><span class="btn-icon-left text-warning"><i
                                                class="fa fa-download color-warning"></i> </span>Cetak</a>
                                    </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Kategori</th>
                                            <th>Foto Kategori</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kategori as $kategoris)
                                        <tr>
                                            <td>{{$kategoris->id}}</td>
                                            <td>{{$kategoris->kategori}}</td>
                                            <td>{{$kategoris->foto_kategori}}</td>
                                            <td><a href="{{route('kategori_edit', $kategoris->id)}}"><i class="fa fa-edit" aria-hidden="true" title="Edit"></i></a></td>
                                            <td><a href="{{route('kategori_hapus', $kategoris->id)}}" class="confirmation"><i class="fa fa-trash-o" aria-hidden="true" title="Hapus"></i></a></td>
                                        </tr>
                                        <script type="text/javascript">
                                                var elems = document.getElementsByClassName('confirmation');
                                                var confirmIt = function (e) {
                                                    if (!confirm('Are you sure?')) e.preventDefault();
                                                };
                                                for (var i = 0, l = elems.length; i < l; i++) {
                                                    elems[i].addEventListener('click', confirmIt, false);
                                                }
                                            </script>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Kategori</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
@section('js')

<script src="/gleek/gleek/assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="/gleek/gleek/main/js/plugins-init/datatables.init.js"></script>
@endsection
@endsection
