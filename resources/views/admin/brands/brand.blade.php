@extends("admin.index")
@section("contentAdmin")
@if($mess = Session::get("success"))

<p class="alert alert-success">{{$mess}}</p>
@endif
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
                        <table class="table table-striped">
                            <thead class=" bg-maroon">
                                <tr>
                                    <th style="width: 10px">ID</th>
                                    <th>Brand Name</th>
                                    <th>Avatar</th>
                                    <th>Discription</th>
                                    <th>Address</th>
                                    <th>Control</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($brand as $row)
                                <tr>
                                    <td>{{$row->brand_id}}</td>
                                    <td>{{$row->brand_name}}</td>
                                    <td style="max-width: 100px;"><img src="{{asset('public/image/'.$row->b_avatar)}}" class="w-100" alt="..."></td>
                                    <td>{{$row->description}}</td>
                                    <td>{{$row->address}}</td>

                                    <td class="d-flex"><a href="/admin/brands/editBrand/{{$row->brand_id}}" class="btn bg-lime"><i class="fas fa-edit"></i></a>
                                        <form action="/admin/brands/deleteBrand/{{$row->brand_id}}" method="post" onsubmit="return confirm('Bạn có muốn xóa bản ghi {{$row->brand_id}} này không???')">
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