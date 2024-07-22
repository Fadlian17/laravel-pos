@extends('pelanggan.template')
@section('content')
<style>
	.hidden {
		display: none;
	}

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
<!-- Checkout page Section Start -->
<section id="checkout-page">
	<div class="checkout-page-increment-sec-full mt-24">
		<div class="container">
			<div class="check-page-top-content">
				<h1 class="d-none">Checkout Page</h1>
				<h2 class="d-none">Checkout Details</h2>
				@foreach ($data as $item)
				<div class="checkout-page-top-sec">
					<div class="checkout-page-top-sec-img">
						<img src="/foto_produk/{{$item['foto_produk']}}" width="165vh" height="auto" alt="chair-img" class="img-fluid">
					</div>
					<div class="checkout-quantity-sec">
						<p class="chek-txt1">{{$item['kategori']}}</p>
						<h3 class="chek-txt2 mt-16">{{$item['nama_produk']}}</h3>
						<h4 class="chek-txt3 mt-8">Qty: {{$item['jumlah_cart']}}</h4>
					</div>
					<div class="checkoutpage-increment-full">
						<div class="checkoutpage-increment-full-details">
							<p class="chek-txt4">Rp. {{number_format($item['sub_total_cart'])}}</p>
						</div>
					</div>
				</div>
				<div class="checkoutpage-boder mt-16"></div>
				@endforeach
			</div>
		</div>
	</div>
	<div class="checkoutpage-third-sec mt-24">
		<div class="container">
			<div class="time-addreess-sec">
				<div class="time-addreess-sec-deatils">

					<div class="time-add-main-sec mt-24">
						<h4 class="time-txt1">Delivery Address</h4>
						<form class="checkout-message-des">
							@csrf
							<div class="checkout-message-form">
								<input type="hidden" id="userId" value="{{$userId}}" />
								<textarea class="checkout-message" id="message" placeholder="Masukan Alamat Anda..."></textarea>
							</div>
						</form>
						<button onclick="tambahAlamat(event)" class="btn btn-primary">Tambah Alamat</button>
						<div class="time-add-main-sec-full">
							<div class="time-content-sec">
								<p class="time-txt3" id="messageDisplay">{{$alamat}}</p>
							</div>

						</div>
						<div class="checkoutpage-boder mt-24"></div>
					</div>
					{{-- <div class="checkout-message mt-24">
								<div class="checkout-message-full">
									<h4 class="time-txt1">Special Notes  <span>(Optional)</span></h4>
									<form class="checkout-message-des">
										<div class="checkout-message-form">
											<textarea class="checkout-message" id="message"  placeholder="Pesan anda"></textarea>
										</div>
									</form>
								</div>
								<div class="checkoutpage-boder mt-24"></div>
							</div> --}}
				</div>
			</div>
		</div>
	</div>
	<div class="payment-method-checkoutpage mt-24">
		<div class="container">
			<div class="row">
				<div class="col-8">
					<h4 class="pay-text1">Payment Method</h4>
				</div>

			</div>
		</div>
		<div class="payment-method-checkoutpage-full payment-mode mt-12">
			<div class="checkoutpage-second-sec mt-24">
				<div class="container">
					<div class="row">
						<div class="payment-mode-sec">
							<div class="payment-mode-custom col-md-6 " style="margin-right: 2vh;margin-left: 1vh;">
								<input type="radio" name="payment-type" id="payment-type1" value="Transfer" checked>
								<label class="payment-mode-custom-label" for="payment-type1">
									Transfer
								</label>
							</div>
							<div class="payment-mode-custom col-md-6" style="margin-left: 2vh;">
								<input type="radio" name="payment-type" id="payment-type2" value="COD">
								<label class="payment-mode-custom-label" for="payment-type2">
									COD
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="checkoutpage-boder mt-24"></div>
		</div>
	</div>
	<div class="checkoutpage-fifth-sec mt-24">
		<div class="container">
			<div class="checkoutpage-price-sec">
				<div class="checkoutpage-price-sec-full">
					<div class="check-page-top">
						<h4 class="check-price-txt1">Harga</h4>
						<div class="checkoutpage-boder mt-8"></div>
					</div>
					<div class="check-page-bottom mt-12">
						@foreach ($data as $item)
						<div class="check-page-bottom-deatails">
							<div class="check-price-name">
								<p>{{$item['nama_produk']}}</p>
							</div>
							<div class="check-price-list">
								<p>Rp. {{number_format($item['sub_total_cart'])}}</p>
							</div>
						</div>
						@endforeach
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
	<div class="buy-now-btn mt-24">
		<a href="/confirm" id="button-transfer" class="checkout-1">Buy Now</a>
		<form action="/payment" method="post" id="form-cod">
			@csrf
			<input type="hidden" value="{{$kode_unik['kode_unik']}}" name="kode_unik" />
			<input type="hidden" value="{{$alamat}}" class='inputarea' name="alamat" />
			<input type="hidden" value="COD" name="metode" />
			<input type="submit" class="btn btn-info1" value="Buy Now" >
		</form>
	</div>
</section>
<!-- Checkout page Section End -->
<script>
	function tambahAlamat(event) {
		event.preventDefault();
		var message = document.getElementById('message').value;
		var userId = document.getElementById('userId').value;
		var data = {
			message: message,
			userId: userId
		};
		var csrfToken = $('meta[name="csrf-token"]').attr('content');

		$.ajax({
			url: '/submitAlamat',
			type: 'POST',
			headers: {
				'X-CSRF-TOKEN': csrfToken
			},
			contentType: 'application/json',
			data: JSON.stringify(data),
			success: function(response) {
				if (response.status === 'success') {
					var messageDisplay = document.getElementById('messageDisplay');
					var textarea = document.getElementById('message');
					var inputElem = document.querySelector('.inputarea');

					textarea.value = "";
					messageDisplay.textContent = message;
					inputElem.value = message;
				}
			},
			error: function(xhr, status, error) {
				console.error('Error:', error);
			}
		});
	}

	document.addEventListener('DOMContentLoaded', function() {
		const transferRadio = document.getElementById('payment-type1');
		const codRadio = document.getElementById('payment-type2');
		const transferButton = document.getElementById('button-transfer');
		const codForm = document.getElementById('form-cod');

		function updateButtonVisibility() {
			if (transferRadio.checked) {
				transferButton.classList.remove('hidden');
				codForm.classList.add('hidden');
			} else {
				transferButton.classList.add('hidden');
				codForm.classList.remove('hidden');
			}
		}

		// Initialize visibility on page load
		updateButtonVisibility();

		// Add event listeners
		transferRadio.addEventListener('change', updateButtonVisibility);
		codRadio.addEventListener('change', updateButtonVisibility);
	});
</script>
@endsection
