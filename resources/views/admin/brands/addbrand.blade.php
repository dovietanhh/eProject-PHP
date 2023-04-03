@extends("admin.index")
@section("contentAdmin")
@if($mess = Session::get("success"))

<p class="alert alert-success">{{$mess}}</p>
@endif
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
                        <h3 class="card-title">{{$pageTitle}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="/admin/brands/saveBrand" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name brand" name="name">
                                <span class="text-danger">{{$errors->first("name")}}</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Avatar</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="avatar" class="custom-file-input">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        <span class="text-danger">{{$errors->first("avatar")}}</span>

                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Tải ảnh lên</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter description" name="description">
                                <span class="text-danger">{{$errors->first("description")}}</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Address</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter description" name="address">
                                <span class="text-danger">{{$errors->first("address")}}</span>
                            </div>


                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Thêm brand</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </session>



    @endsection