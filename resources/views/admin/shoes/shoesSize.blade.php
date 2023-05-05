@extends("admin.index")
@section("contentAdmin")
@if($mess = Session::get("success"))
<p class="alert alert-success">{{$mess}}</p>
@endif
<a href="{{route('addsize')}}" class="btn btn-outline-primary">Add</a>

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
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Control</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($size as $row)
                                <tr>
                                    <td>{{$row->size_id}}</td>
                                    <td>{{$row->name}}</td>
                                 
                                    <td>{{$row->size}}</td>
                                    <td>{{$row->quantity}}</td>
                                    <td class="d-flex " style="align-items: center;"><a href="/admin/shoes/editShoesSize/{{$row->size_id}}" class="btn bg-lime"><i class="fas fa-edit"></i></a>
                                    
                                    <form action="/admin/shoes/deleteShoesSize/{{$row->size_id}}" method="post" onsubmit="return confirm('Bạn có muốn xóa bản ghi {{$row->size_id}} này không???')">
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