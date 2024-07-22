@extends('pelanggan.template')
@section('content')
<!-- Homepage2 Details Section Start -->
<section id=homepage2-sec>
	<!-- <div class="container">
				<div class="serachbar-homepage2 mt-24">
					<div class="input-group ">
						<span class="input-group-text search-iconn">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M10.9395 1.9313C5.98074 1.9313 1.94141 5.97063 1.94141 10.9294C1.94141 15.8881 5.98074 19.9353 10.9395 19.9353C13.0575 19.9353 15.0054 19.193 16.5449 17.9606L20.293 21.7067C20.4821 21.888 20.7347 21.988 20.9967 21.9854C21.2587 21.9827 21.5093 21.8775 21.6947 21.6924C21.8801 21.5073 21.9856 21.2569 21.9886 20.9949C21.9917 20.7329 21.892 20.4802 21.7109 20.2908L17.9629 16.5427C19.1963 15.0008 19.9395 13.0498 19.9395 10.9294C19.9395 5.97063 15.8982 1.9313 10.9395 1.9313ZM10.9395 3.93134C14.8173 3.93134 17.9375 7.05153 17.9375 10.9294C17.9375 14.8072 14.8173 17.9352 10.9395 17.9352C7.06162 17.9352 3.94141 14.8072 3.94141 10.9294C3.94141 7.05153 7.06162 3.93134 10.9395 3.93134Z" fill="#7D8FAB"></path>
							</svg>
						</span>
						<input type="text" placeholder="Search Products" class="form-control search-text">
					</div>
				</div>
			</div> -->
	<div class="homepage2-second-sec mt-24">
		<div class="container">
			<div class="product-details">
				@foreach($kategori as $kategoris)
				<a href="#" class="product-sec">
					<div class="product-img-sec">
						<img src="/foto_kategori/{{$kategoris->foto_kategori}}" width="30vh" alt="ktgr">
					</div>
					<h3 class="proct-title-hp-2">{{$kategoris->kategori}}</h3>
				</a>
				@endforeach

			</div>

		</div>
		<div class="homepage2-third-sec mt-24">
			<div class="container">
				<div class="prodcut-sec-slide">
					<div class="prodcut-sec-slide-full">
						<div class="slider-img-sec" style="background-image: url('assets/images/homepage2/images.jpeg'); ">
						</div>
						<div class="slider-content-sec">
							<div class="slider-content-sec-full">
								<p class="slider-pro-title">Diskon Sampai 20% OFF</p>
								<h3 class="slider-pro-subtitle">Jangan sampai ketinggalan!</h3>
							</div>
						</div>
					</div>
					<div class="prodcut-sec-slide-full">
						<div class="slider-img-sec" style="background-image: url('assets/images/homepage2/images.jpeg'); ">
						</div>
						<div class="slider-content-sec">
							<div class="slider-content-sec-full">
								<p class="slider-pro-title">Diskon Sampai 20% OFF</p>
								<h3 class="slider-pro-subtitle">Jangan sampai ketinggalan!</h3>
							</div>
						</div>
					</div>

					<!-- <div class="prodcut-sec-slide-full">
							<div class="slider-img-sec">
							</div>
							<div class="slider-content-sec">
								<div class="slider-content-sec-full">
									<p class="slider-pro-title">UP TO 20% OFF</p>
									<h3 class="slider-pro-subtitle">Table With Hutch Cabinet</h3>
									<div class="slider-btn">
										<a href="javascript:void(0)">Shop Now</a>	
									</div>
								</div>	
							</div>
						</div> -->

				</div>
			</div>
		</div>
		<div class="homepage2-fourth-sec mt-24">
			<div class="container">
				<div class="tranding-item-sec">
					<div class="home-tranding-first">
						<h2 class="home-cate-title">Produk Terbaru</h2>
					</div>
					<!-- <div class="home-tranding-second">
							<a href="tranding-page.html"><p class="see-all-txt">See all<span><img src="assets/images/homepage/see-all-icon.svg" alt="right-arrow"></span></p></a>
						</div> -->
				</div>
			</div>
			<div class="featured-description mt-16">
				@foreach($produk as $index => $produks)
				@if($index < 3) <div class="featured-description-full">
					<div class="featured-img-sec">
						<img src="/foto_produk/{{$produks->foto_produk}}" width="165vh" height="auto" alt="furniture-img" class="img-fluid">
					</div>
					<div class="featured-content">
						<div class="featured-content1">
							<div class="feat-details1">
								<p class="feat-txt1">{{$produks->relasikategori->kategori}}</p>
							</div>
							<div class="feat-details2">
								<p style="font-size: 1vh; color: grey;"> tersedia</p>
							</div>
						</div>
						<h3 class="feat-txt2">{{$produks->nama}} </h3>
						<h4 class="feat-txt3">Rp. {{$produks->harga_jual}}</h4>
					</div>
			</div>
			@endif
			@endforeach



		</div>
	</div>


	<div class="homepage2-seventh-sec mt-24">
		<div class="container">
			<div class="home-tranding-first">
				<h2 class="home-cate-title">Rekomendasi</h2>
			</div>

			<div class="favourite-bottom-sec mt-24">
				<div class="favourite-bottom-sec-wrapper">
					@foreach($produk->shuffle()->take(8) as $produks)
					<div class="related-item">
						<div class="related-item-img related-item-img1 ">
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
							<h5 class="rel-txt1">{{$produks->nama}}</h5>
							<div class="related-item-content-rating-sec">
								<div class="related-item-first">
									<h6 class="rel-txt2">Rp. {{$produks->harga_jual}}</h6>
								</div>
							</div>
						</div>
					</div>
					@endforeach

					
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Homepage2 Details Section End -->
@endsection
@section('nav')
@include('pelanggan.nav')
@endsection