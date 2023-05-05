@extends("client.women")
@section('contentone')
<div class="col-lg-9 col-xl-9">
						<div class="row row-pb-md">
                            @foreach($shoes as $row)
							<div class="col-lg-4 mb-4 text-center">
								<div class="product-entry border">
									<a href="/detail-product/{{$row->id}}" class="prod-img">
										<img src="{{asset('public/image/'.$row->avatar)}}" class="img-fluid" alt="Free html5 bootstrap 4 template">
									</a>
									<div class="desc">
										<h2><a href="#">{{$row->name}}</a></h2>
										<span class="price">{{number_format($row->price)}} VND</span>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="block-27">
				               <ul>
					               <li><a href="#"><i class="ion-ios-arrow-back"></i></a></li>
				                  <li class="active"><span>1</span></li>
				                  <li><a href="#">2</a></li>
				                  <li><a href="#">3</a></li>
				                  <li><a href="#">4</a></li>
				                  <li><a href="#">5</a></li>
				                  <li><a href="#"><i class="ion-ios-arrow-forward"></i></a></li>
				               </ul>
				            </div>
							</div>
						</div>
					</div>
@endsection
