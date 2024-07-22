@extends('pelanggan.template')
@section('content')
		<section id="sign-in-screen">
			<div class="container">
				<div class="sign-in-screen_full">
					<div class="sign-in-screen-top">
						<h1>Welcome Back!</h1>
						<p class="sign-in-cont">Sign in to continue</p>
						@error('mismatch')
							<span class="text-danger">{{ $message }}</span>
						@enderror
						<form class="sign-in-form mt-32" method="POST" action="/pelanggan/process_login">
							@csrf
							<div class="form-sec">
								<label  class="txt-lbl">Email</label><br>
								<input type="email" id="email" name="email" placeholder="yourname@mail.com" class="txt-input">
								<div class="form_bottom_boder"></div>
								@error('email')
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
							<div class="row remember-sec">
								<div class="col-12 d-flex justify-content-end align-items-center">
									<a href="forget-password-screen.html" class="forget-btn">Forgot password?</a>	
								</div>
							</div>
							<div class="sign-in mt-32">
								<input type="submit" class="btn btn-primary" value="Sign In"/>
							</div>
						</form>
					
						<div class="block-footer">
							<p>Don’t have an account? <a href="/pelanggan/register">Sign Up</a></p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- SignUp Details  End -->
@endsection

