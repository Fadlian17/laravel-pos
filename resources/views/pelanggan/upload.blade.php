<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from up2client.com/envato/brookwood/main-file/home-page2.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 31 May 2024 07:35:12 GMT -->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pokok Pintar</title>
	<link rel="icon" href="/assets/images/favicon/icon.png">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
	<link rel="stylesheet" href="/assets/css/all.min.css">
	<link rel="stylesheet" href="/assets/css/slick.css">
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/style.css">
	<link rel="stylesheet" href="/assets/css/media-query.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<style>


	.btn-info1 {
		width: 343px;
		height: 46px;
		background: #55ad9b;
		border-radius: 8px;
		display: flex;
		-webkit-box-align: center;
		-ms-flex-align: center;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		align-items: center;
		justify-content: center;
		font-family: 'Poppins';
		font-style: normal;
		font-weight: 500;
		font-size: 18px;
		line-height: 24px;
		margin: auto;
		text-decoration: none;
		color: #FFFFFF
	}
</style>
</head>

<body>
	<div class="site_content">
		<!-- Preloader Start -->

		<div class="loader-mask">
			<div class="loader">
				<div></div>
				<div></div>
			</div>
		</div>
		<!-- Preloader End -->
		<!-- Header Section Start -->
		<header id="top-navbar" class="top-navbar">
			<div class="container">
				<div class="top-navbar_full">
					<div class="back-btn d-flex align-items-center">
						<a href="javascript: history.go(-1)"><img src="assets/images/forget-password-screen/back-btn.svg" alt="back-btn-img"></a>
					</div>
					<div class="top-navbar-title d-flex align-items-center">
						<p>Payment Method</p>
					</div>
				</div>
			</div>
			<div class="navbar-boder"></div>
		</header>

		<!-- Header Section End -->

			<div class="container">
				<div class="notification-page-full mt-24">


					<div class="notification-page-sec">
						{{-- <div class="notification-img">
							<img src="assets/images/homepage2/gulaku.png" width="100vh" alt="">
						</div> --}}
						<div class="notification-content">
							{{-- <p class="noti-title">Nama Produk.</p> --}}
							<p class="noti-subtitle mt-8">Menunggu Pembayaran</p>
							<p class="noti-subtitle mt-8">Total Belanja</p>
						</div>

					</div>
					<div class="check-page-bottom mt-12">


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
		<!--Payment Details Section Start -->
		<form class="payment-form-deatils mt-24" action="/payment" method="post" enctype="multipart/form-data">
			@csrf
			<div id="payment-section">
				<div class="container">
					<div class="payment-section-full">


						<div class="mt-24">
							<p class="selc-pay-txt">Rekening Transfer</p>
						</div>
						<div class="row mt-24">
							<div class="notification-content col-md-5">
								<p class="noti-title">Nomor Rekening</p>
								<p class="noti-subtitle mt-8">Nama Bank</p>
								<p class="noti-subtitle mt-8">Atas Nama</p>
							</div>
							<div class="notification-content col-md-4 ">
								<p class="noti-title">: 0000000000.</p>
								<p class="noti-subtitle mt-8">: BCA</p>
								<p class="noti-subtitle mt-8">: Samsul</p>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="hero-heading">
				<div  class="pay-sec">
					<div class="container">
						<div class="payment-method-bottom-full mt-24">
							<h3 class="pay-txt1">Upload</h3>
							<div class="payment-form mt-16">
								<input type="hidden" value="{{$data['kode_unik']}}" name="kode_unik" />
								<input type="hidden" value="{{$data['alamat']}}" name="alamat" />
								<input type="file" class="custom-payment-input" name='evidence' />
								<input type="hidden" value="TRANSFER" name="metode" />
								@error('bukti_transfer')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="switch-sec mt-24">


							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="Save-button">
				{{-- <a href="payment-success.html">Save</a> --}}
				<input type="submit" class="btn btn-info1" value="Save" />
			</div>
		</form>
		<!--Payment Details Section End -->
	</div>
	<script src="/assets/js/jquery-min-3.6.0.js"></script>
	<script src="/assets/js/slick.min.js"></script>
	<script src="/assets/js/bootstrap.bundle.min.js"></script>
	<script src="/assets/js/custom.js"></script>
</body>

</html>

