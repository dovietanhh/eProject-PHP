@extends("admin.index")
@section("contentAdmin")

<a href="{{route('addPicture')}}" class="btn btn-outline-primary">Add</a>

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
                                    <th>SHOES ID</th>
                                    <th>SHOES NAME</th>
                                    <th>Image Main</th>
                                    <th>Image</th>
                                    <th>Control</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shoespic as $row)
                                <tr>
                                    <td>{{$row->spic_id}}</td>
                                    <td>{{$row->shoes_id}}</td>

                                    <td>{{$row->name}}</td>
                                    <td style="max-width: 100px;"><img src="{{asset('public/image/'.$row->avatar)}}" class="w-100" alt="..."></td>

                                    <td style="max-width: 100px;"><img src="{{asset('public/image/'.$row->picture)}}" class="w-100" alt="..."></td>
                                    
                                    <td class="d-flex " style="align-items: center;"><a href="/admin/shoes/editShoespic/{{$row->spic_id}}" class="btn bg-lime"><i class="fas fa-edit"></i></a>
                                    <form action="/admin/shoes/deleteShoespic/{{$row->spic_id}}" method="post" onsubmit="return confirm('Bạn có muốn xóa bản ghi {{$row->id}} này không???')">
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