	@extends('pelanggan.template')
	@section('content')
	<!-- Favourite Details Section Start -->
	<section id="favourite-page">
		<div class="container">
			<div class="favourite-top-sec mt-24">
				<div class="tranding-item-sec">
					<div class="home-tranding-first">
						<h2 class="home-cate-title">Semua Produk </h2>
					</div>
					<!-- <div class="home-tranding-second">
							<a href="tranding-page.html"><p class="see-all-txt">See all<span><img src="assets/images/homepage/see-all-icon.svg" alt="right-arrow"></span></p></a>
						</div> -->
				</div>
				<div class="fav-second-button">
					<div class="fav-second-button-wrapper">
						<div>
							<a href="javascript:void(0)">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<mask id="mask0_1_4590" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
										<rect width="24" height="24" fill="white" />
									</mask>
									<g mask="url(#mask0_1_4590)">
										<path d="M22 8.52V3.98C22 2.57 21.36 2 19.77 2H15.73C14.14 2 13.5 2.57 13.5 3.98V8.51C13.5 9.93 14.14 10.49 15.73 10.49H19.77C21.36 10.5 22 9.93 22 8.52Z" stroke="#55ad9b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
										<path d="M22 19.77V15.73C22 14.14 21.36 13.5 19.77 13.5H15.73C14.14 13.5 13.5 14.14 13.5 15.73V19.77C13.5 21.36 14.14 22 15.73 22H19.77C21.36 22 22 21.36 22 19.77Z" stroke="#55ad9b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
										<path d="M10.5 8.52V3.98C10.5 2.57 9.86 2 8.27 2H4.23C2.64 2 2 2.57 2 3.98V8.51C2 9.93 2.64 10.49 4.23 10.49H8.27C9.86 10.5 10.5 9.93 10.5 8.52Z" stroke="#55ad9b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
										<path d="M10.5 19.77V15.73C10.5 14.14 9.86 13.5 8.27 13.5H4.23C2.64 13.5 2 14.14 2 15.73V19.77C2 21.36 2.64 22 4.23 22H8.27C9.86 22 10.5 21.36 10.5 19.77Z" stroke="#55ad9b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
									</g>
								</svg>
							</a>
						</div>

					</div>
				</div>
			</div>
			<div class="favourite-bottom-sec mt-24">
				<h1 class="d-none">Favourite Page</h1>
				<h2 class="d-none">Favourtite</h2>
				<div class="favourite-bottom-sec-wrapper">
					@foreach($produk as $produks)
					<div class="related-item mt-14">
						<div class="related-item-img">
							<a href="{{ route('detailproduk', ['id' => $produks->id]) }}">
								<img src="/foto_produk/{{$produks->foto_produk}}" class="img-fluid" alt="chair-img">
							</a>
							<div class="img-bottom-content">
								<div class="img-first-content">
									<p>{{$produks->relasikategori->kategori}}</p>
								</div>
							</div>
						</div>
						<div class="related-item-content">
							<h3 class="rel-txt1">{{$produks->nama}}</h3>
							<div class="related-item-content-rating-sec">
								<div class="related-item-first">
									<p class="rel-txt2">Rp. {{$produks->harga_jual}}</p>
								</div>
								<div class="related-item-second"></div>
							</div>
						</div>
					</div>
					@endforeach



				</div>
			</div>
	</section>
	<!-- Favourite Details Section End -->
	@endsection
	@section('nav')
	@include('pelanggan.nav')
	@endsection
