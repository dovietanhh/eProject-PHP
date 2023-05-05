@extends("admin.index")
@section("contentAdmin")
@if(count($errors) > 0)
@foreach($errors->all() as $error)
<div class="alert alert-danger">{{ $error }}</div>
@endforeach
@endif
@if($mess = Session::get("success"))
<p class="alert alert-success">{{$mess}}</p>
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
                    <form method="post" action="/admin/shoes/updateShoesSize/{{$size->size_id}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                        <div class="form-group">
                                <label>Tên giày</label>
                                <select class="form-control" name="id">
                                    <option selected disabled="">------Chọn Giầy cần thêm ảnh------</option>
                                    @foreach($shoes as $row)
                                    
                                    <option @if($row->id=== $size->shoes_id) selected @endif value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Size giày</label>
                                <select class="form-control col-md-2" name="size">
                                    <option selected disabled="" class="text-center">------Chọn size------</option>
                                    @for($i=1;$i<=43;$i++)
                                    <option @if($size->size===$i) selected @endif value="{{$i}}" >{{$i}}</option>
                                    @endfor

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Số lượng</label>
                                <input type="number" name="quantity" id="" value="{{$size->quantity}}" class="form-control col-md-3" min="0">
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