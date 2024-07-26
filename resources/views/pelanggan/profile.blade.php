@extends('pelanggan.template')
@section('content')
<section id="profile-page-sec">
    <div class="profile-top-sec">
        <div class="profile-top-sec-full">
            <h1 class="d-none">Profile</h1>
            <h2 class="d-none">ProfilePage</h2>
            <div class="profile-img-sec">
                <img src="assets/images/profile-page/prof.jpg" width="100vh" alt="profile-img">
                <div class="gallay-icon">
                    <a href="javascript:void(0)"><img src="assets/images/profile-page/gallary-icon.svg" alt="gallary-icon"></a>
                </div>
            </div>
            <div class="profile-details-sec">
                <h3 class="pro-txt1">{{$data->name}}</h3>
                <a href="">
                    <h4 class="pro-txt2">{{$data->email}}</h4>
                </a>
                <a href="">
                    <h5 class="pro-txt3">{{$data->phone}}</h5>
                </a>
            </div>
        </div>
    </div>
    {{-- <div id="profile-second-sec">
        <div class="container">
            <div class="profile-second-sec mt-24">
                <div class="profile-second-sec-full">
                    <div class="profile2-first">
                        <p>Pesanan anda(2)</p>
                    </div>
                    <div class="profile2-second">
                        <p>Detail</p>
                    </div>
                </div>
                <div class="profile-boder mt-24"></div>
            </div>
        </div>
    </div> --}}
    <div id="profile-third-sec">
        <div class="container">
            <div class="profile-third-sec-full mt-24">
                <h3 class="prile3-txt1">Alamat</h3>
                <div class="profile-address-sec mt-16">
                    <h5 class="prile3-txt3">{{$data->alamat}}</h5>
                </div>
                <!-- <div class="profile-address-sec mt-16">
                    <h4 class="prile3-txt2">Office</h4>
                    <h5 class="prile3-txt3">43 Bourkle Street, Newbridge, NY 36211</h5>
                </div> -->
                <div class="profile-boder mt-24"></div>
                <a href="{{route('userLogout')}}" class="btn btn-primary" style="width: 100%;">Logout</a>
            </div>
        </div>
    </div>
    
</section>
<!-- Profile Details Section End -->
@endsection
@section('nav')
@include('pelanggan.nav')
@endsection