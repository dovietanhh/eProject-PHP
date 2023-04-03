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
                        <h3 class="card-title">Danh sách nhân viên</h3>
                        <div class="row d-flex justify-content-end" style="align-items: center;">
                            <div class="form-group">

                                <button type="submit" class="btn btn-danger"><i class="fa fa-user " aria-hidden="true"></i></button>
                                <label for="" class="form-label">Đây là Admin Full Role</label>
                            </div>
                            <div class="form-group">

                                <button type="submit" class="btn btn-success"><i class="fa fa-user " aria-hidden="true"></i></button>
                                <label for="" class="form-label">Đây là Nhân Viên</label>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-striped bg-lightblue color-palette">
                            <thead>
                                <tr>
                                    <th style="width: 10px">ID</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <!-- <th>Fullname</th> -->
                                    <!-- <th>Date of birth</th> -->
                                    <th>Gender</th>
                                    <!-- <th>Phone</th> -->
                                    <!-- <th>Email</th> -->
                                    <th>Role</th>
                                    <th>Avatar</th>
                                    <th>Control</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $row)
                                <tr>
                                    <td>{{$row->emp_id}}</td>
                                    <td>{{$row->username}}</td>
                                    <td>{{$row->password}}</td>

                                    <!-- <td>{{$row->fullname}}</td> -->
                                    <!-- <td>@if(Str::length($row->dob)>0) {{ date('d-m-Y', strtotime($row->dob)) }}
                                        @endif
                                    </td> -->
                                    <td>@if($row->gender==true)
                                        <i class="fa fa-male fa-2x text-lime" aria-hidden="true"></i>
                                        @else
                                        <i class="fa fa-female fa-2x text-fuchsia" aria-hidden="true"></i>
                                        @endif
                                    </td>
                                    <!-- <td>{{$row->phone}}</td> -->
                                    <!-- <td>{{$row->email}}</td> -->
                                    <td>
                                        <form action="/admin/employees/update_roles/{{$row->emp_id}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input hidden type="text" name="role" value="{{$row->role_id}}">

                                                @if($row->role_id==true)
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-user " aria-hidden="true"></i></button>
                                                @else
                                                <button type="submit" class="btn btn-success"><i class="fa fa-user  " aria-hidden="true"></i></button> @endif

                                            </div>
                                        </form>



                                    </td>
                                    <td style="max-width: 100px;"><img src="{{asset('public/image/'.$row->avatar)}}" class="w-100" alt="..."></td>
                                    <td class="d-flex " style="align-items: center;"><a href="/admin/employees/editEmployee/{{$row->emp_id}}" class="btn bg-lime"><i class="fas fa-edit"></i></a>
                                        <form action="/admin/employees/deleteEmployee/{{$row->emp_id}}" method="post" onsubmit="return confirm('Bạn có muốn xóa bản ghi {{$row->emp_id}} này không???')">
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