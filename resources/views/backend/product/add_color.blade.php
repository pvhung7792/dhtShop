@extends('backend.main')

@section('title','Thêm mới ảnh theo màu')

@section('content_admin')


  <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Quản Lý <span class="text-danger">Sản phẩm</span></h1>
                    <!-- <p class="mb-4">vui lòng chắc chắn rằng không còn bất cứ <span class="text-warning">sản phẩm "S"</span> hoặc <span class="text-warning">ảnh quảng cáo "A"</span> hoặc <span class="text-warning">banner "B"</span> nào liên quan đến <span class="text-warning">Danh Mục</span> trước khi <span class="text-warning">XÓA</span>. Hoặc có thể <span class="text-warning">ẨN</span> danh mục thay vì xóa nó .</p> -->
                      <div class="card-body">


                    <!-- <div class="collapse" id="collapseExample"> -->
                        <!-- thêm show vào class để trạng thái ban đầu là hiện -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 text-primary"><span class="font-weight-bold">Thêm </span> ảnh sản phẩm <span class="font-weight-bold">{{$product->name}} </span> theo màu</h6>

                            </div>
                            <div class="row">
                                <div class="col-md-6 ">
                                    <form class="m-4" method="POST" action="{{route('product_color.store')}}" enctype='multipart/form-data'>
                                        @csrf
                                        <input type="text" name='product_id' value="{{$product->id}}" hidden>
                                        <div class=" form-group">
                                            <label class="font-weight-bold text-success" for="name">Tên màu </label>
                                            <input type="text" class=" form-control border border-success" id="name" name="name">

                                            @error('name')
                                            <small class="help-block text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold text-primary" for="name">Logo</label>
                                            <input type="file" class=" form-control border border-primary" id="fileLogo" name="fileLogo">
                                            @error('fileLogo')
                                             <small class="help-block text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold text-primary" for="name">Ảnh</label>
                                            <input type="file" class=" form-control border border-primary" id="fileImage" name="fileImage[]" multiple>
                                            
                                            @error('fileImage')
                                             <small class="help-block text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class=" form-group">
                                            <label class="font-weight-bold text-success" for="status">Trạng thái </label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1" checked>
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Hiện
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="0">
                                                <label class="form-check-label" for="exampleRadios2">
                                                    Ẩn
                                                </label>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Thêm</button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <div class="m-4">
                                        <h6 class="text-primary font-weight-bold">Preview</h6>

                                    </div>

                                </div>
                            </div>

                        </div>

                    <!-- </div> -->
                </div>
                    <!-- DataTales Example -->


                </div>
                <!-- /.container-fluid -->

@stop()