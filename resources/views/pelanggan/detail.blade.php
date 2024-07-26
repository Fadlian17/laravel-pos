@extends('pelanggan.template')
@section('content')
<!-- Single Product Page2 Details Start -->
<section id="product-page2-sec">
<div class="product-page2-first-sec">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="product-page2-slider">
                    <div class="productpage2-overlay"></div>
                    <img src="/foto_produk/{{ $produk->foto_produk }}" alt="product-img" class="img-fluid w-100">
                    <div class="product-page2-top">
                        <div class="prod-page2-sofas">
                            <p>{{ $produk->relasikategori->kategori }}</p>
                        </div>
                        <div class="prod-page2-favour">
                            <a href="javascript:void(0);" class="item-bookmark">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="20" height="20">
                                        <rect width="20" height="20" fill="white"></rect>
                                    </mask>
                                    <g mask="url(#mask0_1_2980)">
                                        <path d="M13.4259 2.5C16.3611 2.5 18.3333 5.29375 18.3333 7.9C18.3333 13.1781 10.1481 17.5 9.99996 17.5C9.85181 17.5 1.66663 13.1781 1.66663 7.9C1.66663 5.29375 3.63885 2.5 6.57403 2.5C8.25922 2.5 9.36107 3.35312 9.99996 4.10312C10.6388 3.35312 11.7407 2.5 13.4259 2.5Z" fill="#666666"></path>
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="product-page2-bottom">
                        <div class="product-page2-bottom-wrapper">
                            <h1 class="prod-page2-title">{{ $produk->nama }}</h1>
                            <p class="prod-page2-subtitle">Rp. {{ $produk->harga_jual }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="product-page2-second-sec mt-16">
        <div class="product-page2-second-sec-wrapper">
            <h2 class="d-none">Product Detail</h2>

            <p class="read-more-text read-desc">{{ $produk->keterangan }}</p>

            <div class="read-more-btn-text">
                <a href="javascript:void(0);" class="product2-readmore">
                    <img src="/assets/images/single-product-page2/read-more-arrow.svg" alt="right-arrow">
                    <p class="read-more">Read More</p>
                </a>
            </div>
        </div>
    </div>
    <form action="/keranjangStore" method="post">
        @csrf
        <div class="product-page2-fourth-sec">
            <div class="product-page2-fourth-sec-wrap">
                <div class="product-incre">
                    <a href="javascript:void(0)" class="product__minus sub">
                        <span>
                            <svg width="8" height="8" viewBox="0 0 8 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1H7" stroke="#666666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </a>
                    <input type="hidden" name="id" value="{{ $produk->id }}">
                    <input type="hidden" name="name" value="{{ $produk->nama }}">
                    <input type="hidden" name="harga" value="{{ $produk->harga_jual }}">
                    <input type="hidden" name="foto" value="{{ $produk->foto_produk }}">
                    <input type="hidden" name="kategori" value="{{ $produk->relasikategori->kategori }}">
                    <input name="quantity" type="text" class="product__input" value="1">
                    <a href="javascript:void(0)" class="product__plus add">
                        <span>
                            <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 4H7" stroke="#55ad9b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M4 7V1" stroke="#55ad9b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </a>
                </div>
                <div class="product-page2-buy-btn">
                    {{-- <a href="shopping-cart.html">Add To Cart</a> --}}
                    <input type="submit" class="btn btn-primary"  value="Add To Cart"/>
                </div>
            </div>
        </div>
    </form>
    @error('mismatch')
        <script>
            alert("{{$message}}");
        </script>
    @enderror
</section>
<!-- Single Product Page2 Details End -->
@endsection
