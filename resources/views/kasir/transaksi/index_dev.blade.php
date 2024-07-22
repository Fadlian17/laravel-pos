@extends('layouts.kasir')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col p-md-0">
                <h4>Transaksi</h4>
            </div>
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                    </li>
                    <!-- <li class="breadcrumb-item"><a href="javascript:void()">Forms</a> 
                    </li> -->
                    <li class="breadcrumb-item active">Transaksi
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="example" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pembeli</th>
                                    <th>Total Bayar</th>
                                    <th>Detail Belanja</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th>Metode</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <style>
                                    .actionButton{
                                        display: flex;
                                        justify-content: space-between;
                                        border: solid 20px;
                                    }
                                    .pembayaran{
                                        pointer-events: 
                                    }
                                </style>
                                @php
                                $no = 1
                                @endphp
                                @foreach($transaksi as $item)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$item->nama_user}}</td>
                                    <td>{{$item->total}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="detailBelanjaModal(event, '{{$item->kode_unik}}')">
                                            Detail Belanja
                                        </button>
                                    </td>
                                    <td>
                                        @if ($item->status !== 'MENUNGGU PEMBAYARAN' && $item->metode !== 'COD')
                                            <span class="pembayaran" style="cursor:pointer" onclick="(detailPembayaran('{{$item->bukti_pembayaran}}'))">{{$item->status}}</span>    
                                        @else
                                            {{$item->status}} 
                                        @endif
                                    </td>
                                    <td>{{$item->metode}}</td>
                                    <td class="actionButton">
                                        <a href="{{route('cancel_order', $item->kode_unik)}}" class="confirmation"><i class="fa fa-ban" aria-hidden="true" title="Batalkan Pesanan"></i></a>
                                        <a href="{{route('confirmation', $item->kode_unik)}}" class="confirmation"><i class="fa fa-check-square-o" aria-hidden="true" title="Konfirmasi Pembayaran"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pembeli</th>
                                    <th>Total Bayar</th>
                                    <th>Detail Belanja</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th>Metode</th>
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
    <!-- Modal Detail Belanja -->
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            max-width: 600px;
            border-radius: 10px;
        }

        .tableDetail {
          border-collapse: collapse;
          width: 100%;
          color: #000000;
        }
        
        .tdDetail, .thDetail {
          border: 1px solid #000000;
          text-align: center;
          padding: 8px;
        }

        .detailPembayaran{
            width: 100%;
        }
        
    </style>
    <div id="detailBelanja" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closedetailBelanjaModal()">&times;</span>
            <h2 style="text-align: center;">Detail Belanja</h2>
            <div id="showDetail" style="text-align: center;">
                <img src="<?php echo asset('gleek/gleek/assets/images/load.gif')?>" alt="" />
            </div>
        </div>
    </div>
    <div id="detailPembayaran" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closedetailPembayaranModal()">&times;</span>
            <h2 style="text-align: center;">Bukti Pembayaran</h2>
            <div id="showDetailPembayaran" style="text-align: center;">
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
@section('js')
<script>
    
    function detailBelanjaModal(event, detailId) {
        var modal = document.getElementById("detailBelanja");
        modal.style.display = "block"; 
        $.ajax({
                url:'?detailId=' + detailId,
                type: 'get'       
            })
            .done(function(data){
                var htmlContent = '';
                var total_pembayaran = 0;
                console.log(data);                
                htmlContent += `
                <table class="tableDetail">
                  <tr>
                    <th class="thDetail">Nama Produk</th>
                    <th class="thDetail">Jumlah Pembelian</th>
                    <th class="thDetail">Harga</th>
                  </tr>`;
                  data.forEach(function(item) {
                  htmlContent += `
                  <tr>
                    <td class="tdDetail">${item.nama_produk}</td>
                    <td class="tdDetail">${item.jumlah_cart}</td>
                    <td class="tdDetail">${item.sub_total_cart}</td>
                  </tr>`;
                  total_pembayaran += item.sub_total_cart;
                  });
                  htmlContent += `
                  <tr>
                        <td colspan="2" class="tdDetail">Total Pembayaran</td>
                        <td class="tdDetail">${total_pembayaran}</td>
                  <tr>
                  </table>
                `;
                $('#showDetail').html(htmlContent);
            })
            .fail(function(jqXHR,ajaxOptions,thrownError){
                alert('Server not responding..');
            })
    }

    function closedetailBelanjaModal(){
        var modal = document.getElementById("detailBelanja");
        modal.style.display = "none";
        $('#showDetail').html('<img src="<?php echo asset('gleek/gleek/assets/images/load.gif')?>" alt="" />');
    }

    function detailPembayaran(fileName){
        const path = "<?php echo asset('gleek/gleek/assets/images/pembayaran/"+fileName+"')?>";
        var modal = document.getElementById("detailPembayaran");
        modal.style.display = "block"; 
        $('#showDetailPembayaran').html('<img class="detailPembayaran" src="' + path + '" alt="" />');
    }

    function closedetailPembayaranModal(){
        var modal = document.getElementById("detailPembayaran");
        modal.style.display = "none";
    }

    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>
<script src="/gleek/gleek/assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="/gleek/gleek/main/js/plugins-init/datatables.init.js"></script>
@endsection
@endsection