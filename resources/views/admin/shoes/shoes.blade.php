@extends("admin.index")
@section("contentAdmin")
@if($mess = Session::get("success"))
<p class="alert alert-success">{{$mess}}</p>
@endif
<a href="/admin/shoes/addShoes" class="btn btn-outline-primary">Add</a>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Bordered Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-striped bg-lightblue color-palette">
                            <thead>
                                <tr>
                                    <th style="width: 10px">ID</th>
                                    <th>SHOES Name</th>
                                    <th>Avatar</th>
                                    <th>Discription</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Control</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shoes as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->name}}</td>
                                    <td style="max-width: 100px;"><img src="{{asset('public/image/'.$row->avatar)}}" class="w-100" alt="..."></td>
                                    <td>{{$row->desc_shoes}}</td>
                                    <td>{{number_format($row->price).' VNĐ' }}</td>
                                    <td>{{$row->category_name}}</td>
                                    <td>{{$row->brand_name}}</td>
                                    <td class="d-flex " style="align-items: center;"><a href="/admin/shoes/editShoes/{{$row->id}}" class="btn bg-lime"><i class="fas fa-edit"></i></a>
                                    <a href="/admin/shoes/addshoespic/{{$row->id}}" class="btn bg-primary"><i class="fa fa-image" aria-hidden="true"></i></a>
                                    <form action="/admin/shoes/deleteShoes/{{$row->id}}" method="post" onsubmit="return confirm('Bạn có muốn xóa bản ghi {{$row->id}} này không???')">
                                        @method("delete")
                                        @csrf
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                   
                                </td>

                                </tr>
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