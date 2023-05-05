@extends("welcome")
@section("content")
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="index.html">Home</a></span> / <span>My Wishlist</span></p>
            </div>
        </div>
    </div>
</div>


<div class="colorlib-product" style="padding-top: 0;">
    <div class="container">
        <!-- <div class="row row-pb-lg">
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
				</div> -->
            @if(session("message")) <p class="alert alert-success">{{session("message")}}</p> @endif
                @foreach($order as $row)
        <div class="row d-flex justify-content-between">
        

            <table class="table table-striped table-success" style="flex-basis: 20%;">
                <thead>
                    <tr>
                        <th scope="col-md">ID</th>

                        <th scope="col-2" style="width: 200px;">@if($row->status===1) Đang Duyệt Hàng 
                        @elseif($row->status===2)
                        Đã xác nhận
                        @elseif($row->status===3)
                        Đang vận chuyển
                        @elseif($row->status===4)
                        Đã hoàn thành
                        @elseif($row->status===5)
                        Đã hủy
                        @elseif($row->status===6)
                        Hoàn hàng
                        @endif</th>

                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <th scope="row">{{$row->id}}</th>

                        <td>
                        @if($row->status===1)
                        <form action="/order_status/{{$row->id}}" method="post">
                                @csrf
                                <input type="hidden" name="status" value="5">

                                <button type="submit" class="btn btn-danger w-100"><i class="fa fa-close" aria-hidden="true"></i></button>
                            </form>
                        @elseif($row->status===2)
                        Đã xác nhận
                        @elseif($row->status===3)
                        Đang vận chuyển
                        @elseif($row->status===4)
                        Đã hoàn thành
                        @elseif($row->status===5)
                        <form action="/order_status/{{$row->id}}" method="post">
                                @csrf
                                <input type="hidden" name="status" value="1">
                                <button type="submit" class="btn btn-success w-100">Mua Lại</button>
                            </form>
                        @elseif($row->status===6)
                        Hoàn hàng
                        @endif
                            
                        </td>

                    </tr>
                    <tr>
                    <th scope="col-md">Total</th>
                    <td>{{number_format($row->total_payment)}} VNĐ</td>

                    </tr>
                </tbody>
            </table>
           

            <table class="table table-striped table-success mx-3" style="flex-basis: 75%;">
                <thead>
                    <tr>
                        <th scope="col-md">OrdeDetail_id</th>

                        <th scope="col-2" style="width: 200px;">Order_id</th>
                        <th scope="col-2">Name</th>
                        <th scope="col-2" style="width: 200px;">Discount</th>



                    </tr>
                </thead>
                @foreach($orders as $o) 
                @if($row->id===$o->order_id)
                <tbody>
                    <tr>
                        <th scope="row">{{$o->orderdetail_id}}</th>
                        <td>{{$o->order_id}}</td>
                        <td>{{$o->name}}</td>
                        <td>@if($o->discount_amount>0){{$o->discount_amount}}@else{{0}}@endif</td>
                    </tr>
                @endif

                    @endforeach
                </tbody>
            </table>
           

        </div>
        @endforeach
        <div class="row">
            <div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
                <h2>Shop more</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-lg-3 mb-4 text-center">
                <div class="product-entry border">
                    <a href="#" class="prod-img">
                        <img src="images/item-1.jpg" class="img-fluid" alt="Free html5 bootstrap 4 template">
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
                        <img src="images/item-2.jpg" class="img-fluid" alt="Free html5 bootstrap 4 template">
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
                        <img src="images/item-3.jpg" class="img-fluid" alt="Free html5 bootstrap 4 template">
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
                        <img src="images/item-4.jpg" class="img-fluid" alt="Free html5 bootstrap 4 template">
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