@extends("welcome")
@section("content")
<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="index.html">Home</a></span> / <span>Checkout</span></p>
					</div>
				</div>
			</div>
		</div>


		<div class="colorlib-product">
			<div class="container">
				<div class="row row-pb-lg">
					<div class="col-sm-10 offset-md-1">
						<div class="process-wrap">
							<div class="process text-center active">
								<p><span>01</span></p>
								<h3>Shopping Cart</h3>
							</div>
							<div class="process text-center active">
								<p><span>02</span></p>
								<h3>Checkout</h3>
							</div>
							<div class="process text-center">
								<p><span>03</span></p>
								<h3>Order Complete</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<form method="post" class="colorlib-form" action="/checkout/orderdetail/{{request()->cookie('cusId')}}">
							@csrf
							<h2>Billing Details</h2>
		              	<div class="row">
			               <!-- <div class="col-md-12">
			                  <div class="form-group">
			                  	<label for="country">Select Country</label>
			                     <div class="form-field">
			                     	<i class="icon icon-arrow-down3"></i>
			                        <select name="people" id="people" class="form-control">
				                      	<option value="#">Select country</option>
				                        <option value="#">Alaska</option>
				                        <option value="#">China</option>
				                        <option value="#">Japan</option>
				                        <option value="#">Korea</option>
				                        <option value="#">Philippines</option>
			                        </select>
			                     </div>
			                  </div>
			               </div> -->

								<div class="col-md-12">
									<div class="form-group">
										<label for="fname">Full Name</label>
										<input type="text" name="fname" class="form-control" placeholder="Your fullname" value="{{$infoCus->fullname}}">
									</div>
								</div>
								
<!-- 
								<div class="col-md-12">
									<div class="form-group">
										<label for="companyname">Company Name</label>
			                    	<input type="text" id="companyname" class="form-control" placeholder="Company Name">
			                  </div>
			               </div> -->

			               <div class="col-md-12">
									<div class="form-group">
										<label for="fname">Address</label>
			                    	<input type="text" name="address" class="form-control" placeholder="Enter Your Address" value="{{$infoCus->address}}">
			                  </div>
			                  <!-- <div class="form-group">
			                    	<input type="text" id="address2" class="form-control" placeholder="Second Address">
			                  </div> -->
			               </div>
			            
			               <div class="col-md-12">
									<div class="form-group">
										<label for="companyname">Town/City</label>
			                    	<input type="text" id="towncity" class="form-control" placeholder="Town or City" value="{{$infoCus->city}}">
			                  </div>
			               </div>
			            
								<!-- <div class="col-md-6">
									<div class="form-group">
										<label for="stateprovince">State/Province</label>
										<input type="text" id="fname" class="form-control" placeholder="State Province">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="lname">Zip/Postal Code</label>
										<input type="text" id="zippostalcode" class="form-control" placeholder="Zip / Postal">
									</div>
								</div> -->
							
								<div class="col-md-6">
									<div class="form-group">
										<label for="email">E-mail Address</label>
										<input type="text" id="email" class="form-control" placeholder="State Province" value="{{$infoCus->email}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="Phone">Phone Number</label>
										<input type="text" name="phone" class="form-control" placeholder="" value="{{$infoCus->phone}}">
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<div class="radio">
										  <label><input type="radio" name="optradio" value="0"> Really I have account !!!</label>
										  <label><input type="radio" name="optradio" value="1"> Ship to different address</label>
										</div>
									</div>
								</div>
		               </div>
					</div>

					<div class="col-lg-4">
						<div class="row">
							<div class="col-md-12">
								<div class="cart-detail">
									<h2>Cart Total</h2>
									<ul>
										<li>
											<span>Subtotal</span> <span>{{Session::get("subtotal")}} VNĐ</span>
											<ul>
												@foreach($cart as $c)
												<li><span>{{$c->quantity_cart}} x {{$c->name}}</span> <span>{{number_format($c->quantity_cart*$c->price)}} VNĐ</span></li>
												@endforeach
											</ul>
										</li>
									
										<li><span>Shipping</span> <span>{{session('shipping')}} VNĐ</span></li>
										<li><span>Order Total</span> <span>{{number_format(session('total'))}} VNĐ</span></li>
									</ul>
								</div>
						   </div>

						   <div class="w-100"></div>

						   <div class="col-md-12">
								<div class="cart-detail">
									<h2>Payment Method</h2>
									<!-- <div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio"> Direct Bank Tranfer</label>
											</div>
										</div>
									</div> -->
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradios"> Check Payment</label>
											</div>
										</div>
									</div>
									@if($errors->has('optradios'))
					<div class="alert alert-danger">{{ $errors->first('optradios') }} <i class="fa fa-warning" aria-hidden="true"></i></div>
					@endif
									<!-- <div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio"> Paypal</label>
											</div>
										</div>
									</div> -->
									<div class="form-group">
										<div class="col-md-12">
											<div class="checkbox">
											   <label><input type="checkbox" value="1" name="accept"> I have read and accept the terms and conditions</label>
											</div>
										</div>
									</div>
									@if($errors->has('accept'))
					<div class="alert alert-danger">{{ $errors->first('accept') }} <i class="fa fa-warning" aria-hidden="true"></i></div>
					@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								<p><button type="submit" class="w-100 btn btn-success">Đặt Hàng</button></p>
								<!-- <p><a href="{{route('order_complete')}}" class="btn btn-success">Đặt Hàng</a></p> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</form>
		@endsection