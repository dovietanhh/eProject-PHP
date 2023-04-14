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
                    <div class="card-header">
                        <h3 class="card-title">Danh sách khách hàng</h3>
                    

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-striped bg-lightblue color-palette">
                            <thead>
                                <tr>
                                    <th style="width: 10px">ID</th>
                                    <th>Username</th>
                                    <th>Fullname</th>
                                    <th>Date of birth</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Identity Number</th>

                                    <th>Email</th>
                                    <th>Avatar</th>
                                    <th>Control</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->username}}</td>

                                    <td>{{$row->fullname}}</td>
                                    <td>@if(Str::length($row->dob)>0) {{ date('d-m-Y', strtotime($row->dob)) }}
                                        @endif
                                    </td>
                                    <td>@if($row->gender==true)
                                        <i class="fa fa-male fa-2x text-lime" aria-hidden="true"></i>
                                        @else
                                        <i class="fa fa-female fa-2x text-fuchsia" aria-hidden="true"></i>
                                        @endif
                                    </td>
                                    <td>{{$row->phone}}</td>
                                    <td>{{$row->identiy_number}}</td>

                                    <td>{{$row->email}}</td>
                                    
                                    <td style="max-width: 100px;"><img src="{{asset('public/image/'.$row->avatar)}}" class="w-100" alt="..."></td>
                                    <td class="d-flex " style="align-items: center;">
                                    <!-- <a href="/admin/customers/editCustomer/{{$row->id}}" class="btn bg-lime"><i class="fas fa-edit"></i></a> -->
                                        <form action="/admin/customers/deleteCustomer/{{$row->id}}" method="post" onsubmit="return confirm('Bạn có muốn xóa bản ghi {{$row->id}} này không???')">
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