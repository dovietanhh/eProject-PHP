<!DOCTYPE HTML>
<html>
	<head>
	<title>Footwear - Shoe World</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Rokkitt:100,300,400,700" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Animate.css -->
	<link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{ asset('frontend/css/icomoon.css') }}">
	<!-- Ion Icon Fonts-->
	<link rel="stylesheet" href="{{ asset('frontend/css/ionicons.min.css') }}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="{{ asset('frontend/css/flexslider.css') }}">

	<!-- Owl Carousel -->
	<link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
	
	<!-- Date Picker -->
	<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-datepicker.css') }}">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="{{ asset('frontend/css/flaticon.css') }}">

	<!-- Theme style  -->
	<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">


	</head>
	<body>
    <div class="colorlib-loader"></div>
<div id="page">
    <nav class="colorlib-nav" role="navigation">
        <div class="top-menu" style="padding-top: 0 !important;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-7 col-md-9">
                        <div id="colorlib-logo"><a href="/">Footwear</a></div>
                    </div>
                    <div class="col-sm-5 col-md-3">
                    <form action="{{route('search')}}" class="search-wrap" method="get">
                        @csrf
                       <div class="form-group">
                          <input type="search" name="search" class="form-control search" placeholder="Search"
                          @if($tb = session()->get("info"))
                          value="{{$tb}}" @endif>
                          <button class="btn btn-primary submit-search text-center" type="submit"><i class="icon-search"></i></button>
                       </div>
                    </form>
                    <div class="loginava">
                    <div class="col-md-8 text-right">


                        @if(request()->cookie("cusId") == null || request()->cookie("cusId")=="")
                        <a href="/Customer/Login" class="text-link"><p class="loginuser font-weight-bold">Login</p></a>
                        @else
                        <a href="/Customer/Logout" class="text-link"><p class="">Logout</p></a>
                        <h1>{{request()->cookie("namecustomer")}}</h1>
                        @endif
                    </div>
                    <div class="avatar-frame">
                        <img src="path/to/avatar-image" alt="Avatar">
                    </div>
                    </div>
                 </div>
             </div>
                <div class="row">
                    <div class="col-sm-12 text-left menu-1">
                        <ul>
                            <li class="active font-weight-bold"><a href="/">Home</a></li>
                            <li class="has-dropdown">
                                <a class="active font-weight-bold" href="{{ route('men') }}">Men</a>
                                <ul class="dropdown">
                                    <li><a class="active font-weight-bold" href="{{ route('product_detail') }}">Product Detail</a></li>
                                    <li><a class=" font-weight-bold" href="{{ route('cart') }}">Shopping Cart</a></li>
                                    <li><a class=" font-weight-bold" href="{{ route('checkout') }}">Checkout</a></li>
                                    <li><a class=" font-weight-bold" href="{{ route('order_complete') }}">Order Complete</a></li>
                                    <li><a class=" font-weight-bold" href="{{ route('add_to_wishlist') }}">Wishlist ( @if(session('sumOrder')) {{session('sumOrder')}}  @endif )</a></li>
                                </ul>
                            </li>
                            <li><a class=" font-weight-bold" href="{{ route('women') }}">Women</a></li>
                            <li><a class=" font-weight-bold" href="{{ route('about') }}">About</a></li>
                            <li><a class=" font-weight-bold" href="{{ route('contact') }}">Contact</a></li>
                            <li><a class=" font-weight-bold" href="{{ route('My_Order') }}">Wishlist(@if(session('sumOrder')){{session('sumOrder')}}@else{{0}}@endif)</a></li>
                            <li><a class=" font-weight-bold" href="{{ route('profile') }}">Profile</a></li>
                            <li class="cart"><a class="active font-weight-bold" href="{{ route('cart') }}"><i class="icon-shopping-cart"></i> Cart [@if(request()->cookie("cusId")){{session("countCart")}}@else{{0}}@endif]</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="sale">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 offset-sm-2 text-center">
                        <div class="row">
                            <div class="owl-carousel2">
                                <div class="item">
                                    <div class="col">
                                        <h3><a href="#">25% off (Almost) Everything! Use Code: Summer Sale</a></h3>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="col">
                                        <h3><a href="#">Our biggest sale yet 50% off all summer shoes</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
