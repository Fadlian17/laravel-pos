@extends('pelanggan.template')
@section('content')
<section id="shopping-page">
    <div class="checkout-page-increment-sec-full mt-24">
        <div class="container">
            <h6 class="">Keranjang Belanja</h6>
            @foreach ($data as $item)
            <div class="check-page-top-content">
                <div class="checkout-page-top-sec">
                    <div class="checkout-page-top-sec-img">
                        <img src="/foto_produk/{{$item['foto_produk']}}" alt="chair-img" class="img-fluid">
                    </div>
                    <div class="checkout-quantity-sec">
                        <p class="chek-txt1">{{$item['kategori']}}</p>
                        <h4 class="chek-txt2 mt-16">{{$item['nama_produk']}}</h4>
                        <h5 class="chek-txt3 mt-8">Qty: {{$item['jumlah_cart']}} x Rp. {{$item['sub_total_cart'] / $item['jumlah_cart']}}</h5>
                    </div>
                    <div class="checkoutpage-increment-full">
                        <div class="checkoutpage-increment-full-details">
                            <p class="chek-txt4">Rp. {{number_format($item['sub_total_cart'])}}</p>
                            <div class="quantity">
                                <a href="{{url('/keranjang/hapus/'. $item['kode_unik'])}}">
                                    Hapus
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="checkoutpage-boder mt-16"></div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- <div class="coupon-sec mt-24">
        <div class="container">
            <div class="coupon-sec-deatils">
                <div class="input-group ">
                    <span class="input-group-text coupon-iconn">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_1_2590" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                                <rect width="24" height="24" fill="white" />
                            </mask>
                            <g mask="url(#mask0_1_2590)">
                                <path d="M19.5 12.9083C19.5 11.462 20.62 10.2882 22 10.2882V9.24015C22 5.04803 21 4 17 4H7C3 4 2 5.04803 2 9.24015V9.76416C3.38 9.76416 4.5 10.938 4.5 12.3842C4.5 13.8305 3.38 15.0043 2 15.0043V15.5283C2 19.7204 3 20.7685 7 20.7685H17C21 20.7685 22 19.7204 22 15.5283C20.62 15.5283 19.5 14.3545 19.5 12.9083Z" stroke="#55ad9b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M9 15.2663L15 8.97815" stroke="#55ad9b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M14.9945 15.2663H15.0035" stroke="#55ad9b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M8.99451 9.50216H9.00349" stroke="#55ad9b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                        </svg>
                    </span>
                    <input type="number" placeholder="Enter Your Coupon Code" class="form-control search-text">
                </div>
            </div>
        </div>
    </div> -->
    <div class="checkoutpage-fifth-sec mt-24">
        <div class="container">
            <div class="checkoutpage-price-sec">
                <div class="checkoutpage-price-sec-full">
                    <div class="check-page-top">
                        <h4 class="check-price-txt1">Rincian Harga</h4>
                        <div class="checkoutpage-boder mt-8"></div>
                    </div>
                    <div class="check-page-bottom mt-12">
                        {{-- <div class="check-page-bottom-deatails">
                            <div class="check-price-name">
                                <p>3 items</p>
                            </div>
                            <div class="check-price-list">
                                <p>Rp. {{number_format(\Cart::getSubTotal())}}</p>
                            </div>
                        </div>
                        <div class="check-page-bottom-deatails mt-12">
                            <div class="check-price-name">
                                <p>Diskon</p>
                            </div>
                            <div>
                                <p class="col-green">- </p>
                            </div>
                        </div> --}}

                        <div class="checkoutpage-boder mt-12"></div>
                        <div class="check-page-bottom-deatails mt-12">
                            <div>
                                <p class="col-black">Total Harga</p>
                            </div>
                            <div>
                                <p class="col-black">Rp. {{number_format($total_harga)}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="checkout-buy-now-btn mt-24">
        <a href="/checkout">Chekout</a>
    </div>
</section>
@endsection
