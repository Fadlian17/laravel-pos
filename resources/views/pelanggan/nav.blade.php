<div id="bottom-navigation">
			<div class="container">
				<div class="home-navigation-menu">
					<div class="row">
						<div class="col-12">
							<div class="bottom-panel nagivation-menu-wrap">
								<ul class="sc-bottom-bar furniture-bottom-nav" id="furniture_navbar">
									<li class="nav-menu-icon {{ request()->routeIs('home') ? 'active' : '' }}">
										<a href="{{ route('home') }}" class="home-icon navigation-icons">
											<i class="bi bi-house" style="font-size: 24px;"></i>
										</a>
									</li>
									<li class="nav-menu-icon {{ request()->routeIs('allproduk') ? 'active' : '' }}">
										<a href="{{ route('allproduk') }}" class="event-icon navigation-icons">
											<i class="bi bi-basket" style="font-size: 24px;"></i>
										</a>
									</li>



									<li class="nav-menu-icon nav-account-icon {{ request()->routeIs('riwayatpemesanan') ? 'active' : '' }}">
										<a href="{{ route('riwayatpemesanan') }}" class="notification-icon navigation-icons left-icon">
											<i class="bi bi-clipboard2-minus" style="font-size: 24px; "></i>
										</a>
									</li>
									<li class="nav-menu-icon nav-notifi-icon {{ request()->routeIs('userprofile') ? 'active' : '' }}">
										<a href="{{ route('userprofile') }}" class="account-icon navigation-icons">
											<i class="bi bi-person-circle" style="font-size: 24px; "></i>
										</a>
									</li>
								</ul>
								<a class="sc-nav-indicator" href="{{ route('keranjang') }}">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<mask id="mask0_1_786" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
											<rect width="24" height="24" fill="white" />
										</mask>
										<g mask="url(#mask0_1_786)">
											<path d="M2 2H3.74001C4.82001 2 5.67 2.93 5.58 4L4.75 13.96C4.61 15.59 5.89999 16.99 7.53999 16.99H18.19C19.63 16.99 20.89 15.81 21 14.38L21.54 6.88C21.66 5.22 20.4 3.87 18.73 3.87H5.82001" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
											<path d="M16.25 22C16.9404 22 17.5 21.4404 17.5 20.75C17.5 20.0596 16.9404 19.5 16.25 19.5C15.5596 19.5 15 20.0596 15 20.75C15 21.4404 15.5596 22 16.25 22Z" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
											<path d="M8.25 22C8.94036 22 9.5 21.4404 9.5 20.75C9.5 20.0596 8.94036 19.5 8.25 19.5C7.55964 19.5 7 20.0596 7 20.75C7 21.4404 7.55964 22 8.25 22Z" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
											<path d="M9 8H21" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
										</g>
									</svg>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Bottom Navigation Section End -->