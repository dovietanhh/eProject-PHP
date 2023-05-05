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
                        <h3 class="card-title">{{$brand->brand_id."         ".$brand->brand_name}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="/admin/brands/updateBrand/{{$brand->brand_id}}" enctype="multipart/form-data">
                        @method("PATCH")
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name brand" value="{{$brand->brand_name}}" name="name">
                                <span class="text-danger">{{$errors->first("name")}}</span>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Avatar</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="avatar" value="{{$brand->b_avatar}}">
                                        <label class="custom-file-label" for="exampleInputFile">{{$brand->avatar}}</label>
                                <span class="text-danger">{{$errors->first("avatar")}}</span>

                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Tải ảnh lên</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group w-50">
                                <img src="{{asset('public/image/'.$brand->avatar)}}" alt="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter description" value="{{$brand->description}}" name="description">
                                <span class="text-danger">{{$errors->first("description")}}</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Address</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter address" value="{{$brand->address}}" name="address">
                                <span class="text-danger">{{$errors->first("address")}}</span>
                            </div>
                            
                            
                            
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</session>



    @endsection