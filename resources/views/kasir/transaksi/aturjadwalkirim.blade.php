@extends('layouts.kasir')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col p-md-0">
                <h4>Atur Jadwal Kirim</h4>
            </div>
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                    </li>
                    <!-- <li class="breadcrumb-item"><a href="javascript:void()">Forms</a> 
                    </li> -->
                    <li class="breadcrumb-item active">Atur Jadwal Kirim
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
                                    <th>Alamat</th>
                                    <th>Status Pengiriman</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <style>
                                    .actionButton{
                                        display: flex;
                                        justify-content: center;
                                        gap: 2rem;
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
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="detailBelanjaModal(event, '{{$item->kode_unik}}')">
                                            Detail Belanja
                                        </button>
                                    </td>
                                    <td>{{$item->alamat}}</td>
                                    <td>{{$item->status == 'PEMBAYARAN TELAH DIKONFIRMASI' ? 'BARANG BELUM DIKIRIM' : $item->status}}</td>
                                    <td class="actionButton">
                                        @if ($item->tgl_pengiriman)
                                            <a href="#" onclick="jadwalButton('{{$item->tgl_pengiriman}}')" class="confirmation"><i class="fa fa-calendar" aria-hidden="true" title="Atur Jadwal Pengiriman"></i></a>   
                                        @else
                                            <a href="#" onclick="aturjadwalButton('{{$item->id}}')" class="confirmation"><i class="fa fa-calendar" aria-hidden="true" title="Atur Jadwal Pengiriman"></i></a>
                                        @endif
                                        <a href="{{route('delivery-confirmation', $item->kode_unik)}}" class="confirmation"><i class="fa fa-check-square-o" aria-hidden="true" title="Konfirmasi Barang Sampai"></i></a>
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
                                    <th>Alamat</th>
                                    <th>Status Pengiriman</th>
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
    <div id="aturjadwal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeaturjadwalModal()">&times;</span>
            <h2 style="text-align: center;">Atur Jadwal Pengiriman</h2>
            <div id="showDetail" style="text-align: center; margin-top:2rem;">
                <form action="aturtanggal" method="POST">
                    @csrf
                    <input type="text" id="transaksiId" name="transaksiId" hidden required/>
                    <input type="date" name="jadwal" required /> <br><br>
                    <button type="submit" class="btn btn-primary">
                       Submit Tanggal
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div id="jadwal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closejadwalModal()">&times;</span>
            <h2 style="text-align: center;">Atur Jadwal Pengiriman</h2>
            <div id="showTanggal" style="text-align: center; margin-top:2rem;">
                
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

    function aturjadwalButton(transaksiId) {
        var modal = document.getElementById("aturjadwal");
        modal.style.display = "block"; 
        var inputElement = document.getElementById('transaksiId');
        inputElement.value = transaksiId;
    }

    function closeaturjadwalModal(){
        var modal = document.getElementById("aturjadwal");
        modal.style.display = "none";
    }

    function jadwalButton(jadwal) {
        var modal = document.getElementById("jadwal");
        modal.style.display = "block"; 
        var parts = jadwal.split('-');
        var year = parts[0];
        var month = parts[1];
        var day = parts[2];
        var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                          "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                        ];
        $('#showTanggal').html('Pengiriman sudah di atur pada tanggal ' + day + ' ' + monthNames[parseInt(month) - 1] + ' ' + year);
    }

    function closejadwalModal(){
        var modal = document.getElementById("jadwal");
        modal.style.display = "none";
    }
</script>
<script src="/gleek/gleek/assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="/gleek/gleek/main/js/plugins-init/datatables.init.js"></script>
@endsection
@endsection