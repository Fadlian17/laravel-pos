@extends('pelanggan.template')
@section('content')
		<!-- Payment Success Section Start -->
		<section id="payment-success-first">
			<div class="payment-success-first-wrap">
				<img src="assets/images/payment-success/bg-img.png" class="img-fluid" alt="bg-img">
			
			</div>
			<div class="payment-success-second-wrapper">
				<div class="container">
					<div class="payment-success-second">
						<div class="container">
							<div class="payment-success-second-wrap">
								<h1 class="success-title">Berhasil!</h1>
								<div class="success-img mt-24">
									<img src="assets/images/success/success.png" alt="success-img">
								</div>
								<h2 class="success-subtitle mt-24">Terimakasih Sudah Berbelanja</h2>
								<p class="success-para">Your items has been placed and is on it’s way to being processed</p>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<div class="Backtohome">
				<a href="/riwayatpemesanan">Lihat Pesanan</a>	
			</div>
		</section>
		<!-- Payment Success Section End -->
@endsection

