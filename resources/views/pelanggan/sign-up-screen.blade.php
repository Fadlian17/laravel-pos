@extends('pelanggan.template')
@section('content')
		<!-- SignUp Details Start -->
		<section id="sign-up-screen">
			<div class="container">
				<div class="sign-in-screen_full">
					<div class="sign-in-screen-top">
						<h1>Create an Account</h1>
						<p class="sign-in-cont">Sign up to join</p>
						<form class="sign-in-form mt-32" action="/pelanggan/process_register" method="POST">
							@csrf
							<div class="form-sec">
								<label class="txt-lbl">Full Name</label><br>
								<input type="text" id="fname" name="name"  placeholder="Aelisha Sm" class="txt-input">
								<div class="form_bottom_boder"></div>
								@error('name')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-sec mt-16">
								<label class="txt-lbl">Email</label><br>
								<input type="email" id="email"  name="email" placeholder="yourname@mail.com" class="txt-input">
								<div class="form_bottom_boder"></div>
								@error('email')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-sec mt-16">
								<label class="txt-lbl">Mobile Number</label><br>
								<input type="number" id="mobile-no" placeholder="085484658466" name="phone" class="txt-input">
								<div class="form_bottom_boder"></div>
								@error('phone')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-sec mt-16">
								<label  class="txt-lbl">Password</label><br>
								<input type="password" id="password" name="password" placeholder="********" class="txt-input">
								<div class="form_bottom_boder"></div>
								@error('password')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-sec mt-16">
								<label  class="txt-lbl">Confirm Password</label><br>
								<input type="password" id="password" name="confpassword" placeholder="********" class="txt-input">
								<div class="form_bottom_boder"></div>
								@error('confpassword')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
							
							<div class="sign-up mt-32">
								<input type="submit" value="Sign Up"/>	
							</div>
						</form>
						<div class="block-footer">
							<p>Have an account? <a href="sign-in-screen.html">Sign In</a></p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- SignUp Details  End -->
@endsection

