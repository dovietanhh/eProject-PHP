@extends("welcome")
@section("content")
<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col">
				<p class="bread"><span><a href="/">Home</a></span> / <span>Shopping Cart</span></p>
			</div>
		</div>
	</div>
</div>
@if(Session::get("success")!=null||Session::get("success")!="")
<p class="alert alert-success">{{Session::get("success")}}</p>
@endif
@if(Session::get("err")!=null||Session::get("err")!="")
<p class="alert alert-danger">{{Session::get("err")}} <i class="fa fa-warning" aria-hidden="true"></i></p>
@endif
<div class="colorlib-product">
	<div class="container">
		<div class="row row-pb-lg">
			<div class="col-md-10 offset-md-1">
				<div class="process-wrap">
					<div class="process text-center active">
						<p><span>01</span></p>
						<h3>Shopping Cart</h3>
					</div>
					<div class="process text-center">
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
		<div class="row row-pb-lg">
			<div class="col-md-12">
				<div class="product-name d-flex">
					<div class="one-forth text-left px-4">
						<span>Product Details</span>
					</div>
					<div class="one-eight text-center">
						<span>Size</span>
					</div>
					<div class="one-eight text-center">
						<span>Price</span>
					</div>
					<div class="one-eight text-center">
						<span>Quantity</span>
					</div>
					<div class="one-eight text-center">
						<span>Total</span>
					</div>
					<div class="one-eight text-center px-4">
						<span>Control</span>
					</div>
				</div>


				@foreach($cart as $row)

				<div class="product-cart d-flex">
					<div class="one-forth">
						<div class="product-img" style="background-image: url('public/image/{{$row->avatar}}')">
						</div>
						<div class="display-tc">
							<h3><a href="/detail-product/{{$row->id}}" class="d-block">{{$row->name}}</a></h3>
						</div>
					</div>
					<div class="one-eight text-center">
						<div class="display-tc">
							<span class="price">{{$row->size}}</span>
						</div>
					</div>
					<div class="one-eight text-center">
						<div class="display-tc">
							<span class="price">{{number_format($row->price) }} VND</span>
						</div>
					</div>
					<div class="one-eight text-center">
						<div class="display-tc">
							<form action="/Cart/UpdateCart/{{$row->cart_id}}" method="post">
								@method("PATCH")
								@csrf
								<input type="number" id="quantity" name="quantity" class="form-control input-number text-center" value="{{$row->quantity_cart}}" min="1" max="100">
						</div>
					</div>
					<div class="one-eight text-center">
						<div class="display-tc">
							<span class="price">{{number_format($row->quantity_cart*$row->price) }} VND</span>
						</div>
					</div>
					<div class="one-eight text-center">
						<div class="display-tc">
							<form action="/Cart/UpdateCart/{{$row->cart_id}}" method="post">
								@method("PATCH")
								@csrf

								<button type="submit" class="btn btn-info"><i class="fa fa-edit" aria-hidden="true"></i></button>
							</form>
							<form action="/Cart/DeleteCart/{{$row->cart_id}}" method="post">
								@csrf
								@method("DELETE")
								<button type="submit" class="btn btn-danger" onclick="return confirm('You really want to remove?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
							</form>


						</div>
					</div>
				</div>
				@endforeach



			</div>
		</div>
		<div class="row row-pb-lg">
			<div class="col-md-12">
				<div class="total-wrap">
					<div class="row">
						<div class="col-sm-8">
							<form action="/discount_rate" method="post">
								@csrf
								<div class="row form-group">
									<div class="col-sm-9">
										<input type="text" name="discount" class="form-control input-number" placeholder="Your Coupon Number..." value="@if(session('IdSale')) {{session('IdSale')}} @endif">
									</div>
									<div class="col-sm-3">
										<input type="submit" value="Apply Coupon" class="btn btn-primary">
									</div>
								</div>
							</form>
							@if(Session::get("messageSuccess")!==null&&Session::get("messageSuccess")!=="")
							<p class="alert alert-success">{{Session::get("messageSuccess")}}</p>
							@endif
							@if(Session::get("messageErr")!==null&&Session::get("messageErr")!=="")
							<p class="alert alert-danger">{{Session::get("messageErr")}}</p>
							@endif

						</div>
						<div class="col-sm-4 text-center">
							<form method="post" action="/checkout/order">
								@csrf
								<div class="total">
									<div class="sub">
										<p><span>Subtotal:</span> <span>{{number_format($subtotal)}} VND</span></p>
										<input type="hidden" name="subtotal" value="<?= number_format($subtotal) ?>">
										<p><span>Delivery:</span> <span>{{number_format(30000)}} VND</span></p>
										<input type="hidden" name="shipping" value="<?= number_format(30000) ?>">
										<p><span>Discount:</span> <span>@if(Session::get("data")!==null||session("data")!=="")<input type="hidden" name="discount_save" value="<?= session("data") ?>"> {{Session::get("data")}}@endif%</span></p>
									</div>
									<div class="grand-total">
										<p><span><strong>Total:</strong></span> <span>@if(Session::get("data")!==null||session("data")!=="")
												{{number_format($subtotal-$subtotal*session("data")/100+30000)}}
												<input type="hidden" name="total" value="<?= $subtotal - $subtotal * session("data") / 100 + 30000 ?>">
												@else
												<input type="hidden" name="total" value="{{$subtotal+30000}}">
												{{number_format($subtotal+30000)}}
												@endif VND</span></p>
									</div>
									<div class="grand-total w-100">
										<button type="submit" class="btn btn-primary">Checkout</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
				<h2>Related Products</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-lg-3 mb-4 text-center">
				<div class="product-entry border">
					<a href="#" class="prod-img">
						<img src="{{asset('frontend/images/item-1.jpg')}}" class="img-fluid" alt="Free html5 bootstrap 4 template">
					</a>
					<div class="desc">
						<h2><a href="#">Women's Boots Shoes Maca</a></h2>
						<span class="price">$139.00</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-lg-3 mb-4 text-center">
				<div class="product-entry border">
					<a href="#" class="prod-img">
						<img src="{{asset('frontend/images/item-2.jpg')}}" class="img-fluid" alt="Free html5 bootstrap 4 template">
					</a>
					<div class="desc">
						<h2><a href="#">Women's Minam Meaghan</a></h2>
						<span class="price">$139.00</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-lg-3 mb-4 text-center">
				<div class="product-entry border">
					<a href="#" class="prod-img">
						<img src="{{asset('frontend/images/item-3.jpg')}}" class="img-fluid" alt="Free html5 bootstrap 4 template">
					</a>
					<div class="desc">
						<h2><a href="#">Men's Taja Commissioner</a></h2>
						<span class="price">$139.00</span>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-lg-3 mb-4 text-center">
				<div class="product-entry border">
					<a href="#" class="prod-img">
						<img src="{{asset('frontend/images/item-4.jpg')}}" class="img-fluid" alt="Free html5 bootstrap 4 template">
					</a>
					<div class="desc">
						<h2><a href="#">Russ Men's Sneakers</a></h2>
						<span class="price">$139.00</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection