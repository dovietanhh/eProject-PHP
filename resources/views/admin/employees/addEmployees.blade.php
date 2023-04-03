@extends("admin.index")
@section("contentAdmin")
@if(count($errors) > 0)
@foreach($errors->all() as $error)
<div class="alert alert-danger">{{ $error }}</div>
@endforeach
@endif

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thêm mới</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="/admin/employees/saveEmployee" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter username Employee" name="username" value="{{old('username')}}">
                                <span class="text-danger">{{$errors->first("username")}}</span>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fullname</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter fullname Employee" name="fullname" value="{{old('fullname')}}">
                                <span class="text-danger">{{$errors->first("fullname")}}</span>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter email" name="email">
                                <span class="text-danger">{{$errors->first("email")}}</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date Of Birth</label>
                                <div class="input-group date" >
                                    <input type="text" class="form-control" id="myID" placeholder="Ngày sinh của bạn" name="dob" value="{{old('dob')}}">
                                    <span class="input-group-append">
                                        <span class="input-group-text bg-white">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>    
                                    </span>
                                </div>
                                <span class="text-danger">{{$errors->first("dob")}}</span>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Gender</label>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="gen" value="1" 
                                    {{old('gen')== "1" ? "checked" : "" }}
                                    id="Nam"><label for="" class="form-check-label">Nam</label>
                                </div>

                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="gen" value="0" {{old('gen')== "0" ? "checked" : "" }}  id="Nữ"><label for="" class="form-check-label">Nữ</label>
                                </div>
                                <span class="text-danger">{{$errors->first("gen")}}</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Phone</label>
                                <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Enter phone" name="phone" value="{{old('phone')}}">
                                <span class="text-danger">{{$errors->first("phone")}}</span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter password" name="password">
                                <span class="text-danger">{{$errors->first("password")}}</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Confirmed password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter repassword" name="repassword">
                                <span class="text-danger">{{$errors->first("repassword")}}</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Avatar</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="avatar" value="{{old('avatar')}}">
                                        <label class="custom-file-label" for="exampleInputFile">Chọn ảnh cá nhân</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Tải ảnh lên</span>
                                    </div>
                                </div>
                            </div>




                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </session>


    

    @endsection