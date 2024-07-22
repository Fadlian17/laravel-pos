@extends('pelanggan.template')
@section('content')
<!-- Riwayat Section Start -->

<section id="notification-page">
    <div class="container">
        <div class="notification-page-full mt-24">
            <div class="home-tranding-first">
                <h2 class="home-cate-title">Riwayat Belanja</h2>

            </div>
            @foreach ($data as $item)
                <a href="#" >
                    <div class="notification-page-sec">
                        <div class="notification-img">
                            <img src="/foto_produk/{{$item['foto_produk']}}" width="100vh" alt="">
                        </div>
                        <div class="notification-content">
                            <p class="noti-title">{{$item['nama_produk']}}</p>
                            <p class="noti-subtitle mt-8">{{$item['status'] == 'PEMBAYARAN SUDAH DILAKUKAN' ? 'MENUNGGU KONFIRMASI PEMBAYARAN' : $item['status']}}
                            
                            </p>
                            <p class="noti-subtitle mt-8">Rp. {{number_format($item['sub_total_cart'])}}</p>
                        </div>
                    </div>                
                </a> 
            @endforeach
        </div>
    </div>
</section>
<!-- Riwayat Section End -->
@endsection
@section('nav')
    @include('pelanggan.nav')
@endsection
