@extends('backend.main') 

@section('title','Thêm mới chi tiết')

@section('content_admin')


<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Quản Lý <span class="text-danger">Sản phẩm</span></h1>
    <div class="card-body">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 text-primary"><span class="font-weight-bold">Thêm </span> chi tiết sản phẩm</h6>
            </div>
            <div class="row">
                <div class="col-md-6 ">
                    <form class="m-4" method="POST" action="{{ route('product_detail.store') }}">
                        @csrf
                        <input type="text" name="product_id" value="{{$pro->id}}" hidden>
                        <div class=" form-group">
                            <label class="font-weight-bold text-success">Sản phẩm </label>
                            <input type="text" class=" form-control border border-success" value="{{$pro->name}}" disabled>
                        </div>
                        <div class=" form-group">
                            <label class="font-weight-bold text-success">Trạng thái </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="radio1" name="status" value="1"  {{(old('status')==1||old('status')=='')?'checked':''}}>
                                <label class="form-check-label" for="radio1">
                                    Hiện
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="radio2" name="status" value="0" {{(old('status')==0&&old('status')!='')?'checked':''}}>
                                <label class="form-check-label" for="radio2">
                                    Ẩn
                                </label>
                            </div>
                        </div>
                        <div class="row">
                        <div class=" form-group col-md-6">
                            <label class="font-weight-bold text-success">Giá</label>
                            <input type="text" class=" form-control border border-success" id="price" name="price" value="{{old('price')}}">

                            @error('price')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class=" form-group col-md-6">
                            <label class="font-weight-bold text-success" for="name">Giá khuyến mại </label>
                            <input type="text" class=" form-control border border-success" id="sale_price" name="sale_price" value="{{old('sale_price')}}">

                            @error('sale_price')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class=" form-group col-md-6">
                            <label class="font-weight-bold text-success" for="name">Bộ nhớ RAM</label>
                            <input type="text" class=" form-control border border-success" id="ram" name="ram" value="{{old('ram')}}">

                            @error('ram')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class=" form-group col-md-6">
                            <label class="font-weight-bold text-success" for="name">Chip</label>
                            <input type="text" class=" form-control border border-success" id="cpu" name="cpu" value="{{old('cpu')}}">

                            @error('cpu')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class=" form-group col-md-6">
                            <label class="font-weight-bold text-success" for="name">Dung lượng bộ nhớ</label>
                            <input type="text" class=" form-control border border-success" id="memory" name="memory" value="{{old('memory')}}">

                            @error('memory')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="m-4 text-secondary">
                        <h6 class="text-primary font-weight-bold">Hướng dẫn thêm sửa</h6>
                        <strong>Trạng thái:</strong><p>Lựa chọn trạng thái ẩn hiện của sản phẩm, nếu chọn "ẩn" thì sản phẩm sẽ không hiển thị ở trang người dùng.</p>
                        <strong>Giá:</strong><p>Giá sản phẩm phải nhập bằng số lớn hơn 0</p>
                        <strong>Giá khuyến mại:</strong><p>Giá khuyến mại phải nhập bằng số lớn hơn 0</p>
                        <p class="text-danger">Lưu ý: Giá khuyến mại là số tiền được giảm đi so với giá gốc, không phải là giá sản phẩm sau khi áp dụng khuyến mại.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@stop()