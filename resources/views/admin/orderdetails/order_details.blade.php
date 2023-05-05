@extends("admin.index")
@section("contentAdmin")
@if($mess = Session::get("success"))
<p class="alert alert-success">{{$mess}}</p>
@endif
<a href="/admin/categories/addcategory" class="btn btn-outline-primary mb-3">Add Employee</a>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Danh sách Order: {{$order_status->description}}</h3>
                        <a class="btn btn-success" href="{{route('Order')}}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
                         
                        @if($order_status->status===2) 
                        <form action="/order_status/{{$order_status->id}}" method="post">
                            @csrf
                            <input type="hidden" name="status" value="3">
                            <button class="btn btn-info" type="submit"><i class="fa-solid fa-truck"></i></button>
                            </form>
              @endif
              @if($order_status->status===3) 

                            <form action="/order_status/{{$order_status->id}}" method="post">
                                @csrf
                                <input type="hidden" name="status" value="4">
                                <button class="btn btn-info" type="submit"><i class="fa-solid fa-check-double"></i></button>
                       
                      
                            @endif
                            @if($order_status->status===4) 

                            <button class="btn btn-success"><i class="fa-solid fa-check-double"></i></button>
                       
                      
                            @endif
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-striped bg-lightblue color-palette">
                            <thead>
                                <tr>
                                    <th style="width: 10px">Orderdeatil_id</th>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Size</th>

                                    <th>Quantity</th>
                                    <th>Discount</th>




                                </tr>
                            </thead>
                            <tbody>

                                @foreach($order as $row)
                                <tr>
                                    <td> {{$row->orderdetail_id}}</td>
                                    <td>{{$row->name}}</td>

                                    <td>{{number_format($row->price)}} VNĐ</td>

                                    <td>{{$row->size}}</td>
                                    <td>{{$row->quantity}}</td>

                                    <td>@if($row->discount_amount>0)
                                        {{$row->discount_amount}}
                                        @else
                                        {{0}}
                                        @endif
                                    </td>

                                    <!-- <td style="max-width: 100px;"><img src="{{asset('public/image/'.$row->avatar)}}" class="w-100" alt="..."></td> -->

                                    @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </session>


    @endsection