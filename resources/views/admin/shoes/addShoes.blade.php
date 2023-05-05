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
                    <form method="post" action="/admin/shoes/saveShoes" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name shoes" name="name" value="{{old('name')}}">
                                <span class="text-danger">{{$errors->first("name")}}</span>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Avatar</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="avatar" value="{{old('avatar')}}">
                                        <label class="custom-file-label" for="exampleInputFile">Chọn ảnh</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Tải ảnh lên</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Thể Loại</label>
                                <select class="form-control" name="category">
                                    <option selected disabled>------Chọn category------</option>

                                    @foreach($cate as $row)
                                    <option value="{{$row->category_id}}" {{ (collect(old('category'))->contains($row->category_id)) ? 'selected':'' }}>{{$row->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Thương hiệu</label>
                                <select class="form-control" name="brand">
                                    <option selected disabled>------Chọn brand------</option>

                                    @foreach($brand as $row)
                                    <option value="{{$row->brand_id}}" {{ (collect(old('brand'))->contains($row->brand_id)) ? 'selected':'' }}>{{$row->brand_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter description" name="description" value="{{old('description')}}">
                                <span class="text-danger">{{$errors->first("description")}}</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Price</label>
                                <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Enter price" name="price" value="{{old('price')}}">
                                <span class="text-danger">{{$errors->first("price")}}</span>
                            </div>
                            <div class="form-group">
                                <label>Thương hiệu</label>
                                <select class="form-control" name="gender"> 
                                    <option selected="" disabled="">------Dành cho nam hay nữ------</option>

                                    <option value="0">Women</option>
                                    <option value="1">Men</option>
                                    <option value="null">For All</option>

                                </select>
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