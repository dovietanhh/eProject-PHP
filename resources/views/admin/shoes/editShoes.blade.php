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
                        <h3 class="card-title">{{$shoes->id."         ".$shoes->name}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="/admin/shoes/updateShoes/{{$shoes->id}}" enctype="multipart/form-data">
                        @method("PATCH")
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name shoes" value="{{$shoes->name}}" name="name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Avatar</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="avatar" value="{{$shoes->avatar}}">
                                        <label class="custom-file-label" for="exampleInputFile">Chọn ảnh</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Tải ảnh lên</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <img class="w-100" src="{{asset('public/image/'.$shoes->avatar)}}" alt="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Description</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter description" value="{{$shoes->desc_shoes}}" name="description">
                                <span class="text-danger">{{$errors->first("description")}}</span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Price</label>
                                <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Enter price" value="{{$shoes->price}}" name="price">
                                <span class="text-danger">{{$errors->first("price")}}</span>
                            </div>
                           
                            <div class="form-group">
                        <label>Thể Loại</label>
                        <select class="form-control" name="category">
                          <option selected disabled>------Chọn category------</option>

                            @foreach($cate as $row)
                          <option value="{{$row->category_id}}" 
                          @if($row->category_id==$shoes->category_id)
                          selected
                          @endif
                          >{{$row->category_name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Thương hiệu</label>
                        <select class="form-control" name="brand">
                          <option selected disabled>------Chọn brand------</option>

                            @foreach($brand as $row)
                          <option value="{{$row->brand_id}}" 
                          @if($row->brand_id==$shoes->brand_id)
                          selected
                          @endif
                          >{{$row->brand_name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                                <label>Thương hiệu</label>
                                <select class="form-control" name="gender"> 
                                    <option @if($shoes->gender===null) selected @endif disabled="">------Dành cho nam hay nữ------</option>

                                    <option @if($shoes->gender===0) selected @endif value="0">Women</option>
                                    <option @if($shoes->gender===1) selected @endif value="1">Men</option>
                                    <option @if($shoes->gender===2) selected @endif value="2">For All</option>

                                </select>
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