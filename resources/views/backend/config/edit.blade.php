
@extends('backend.main')

@section('title','Cập nhật cấu hình')

@section('content_admin')


  <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Quản Lý <span class="text-warning">Cấu hình</span></h1>
                    <!-- <p class="mb-4">vui lòng chắc chắn rằng không còn bất cứ <span class="text-warning">sản phẩm "S"</span> hoặc <span class="text-warning">ảnh quảng cáo "A"</span> hoặc <span class="text-warning">banner "B"</span> nào liên quan đến <span class="text-warning">Danh Mục</span> trước khi <span class="text-warning">XÓA</span>. Hoặc có thể <span class="text-warning">ẨN</span> danh mục thay vì xóa nó .</p> -->
                      <div class="card-body">


                    <!-- <div class="collapse" id="collapseExample"> -->
                        <!-- thêm show vào class để trạng thái ban đầu là hiện -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 text-primary"><span class="font-weight-bold">Sửa </span> cấu hình</h6>
                            </div>
                            <div class="row">
                                <div class="col-md-6 ">
                                    <form class="m-4" method="POST" action="{{route('config.update',$config->id) }}" enctype="multipart/form-data">
                                        @csrf @method('PUT')
                                        <input type="text" hidden name="id" value="{{$config->id}}">
                                        <div class=" form-group">
                                            <label class="font-weight-bold text-success" for="name">Logo</label>
                                            <input type="file" class="form-control border border-success" name="fileLogo" value="">
                                            <img src="{{url('public')}}/uploads/logos/{{$config->logo}}" style="max-height: 100px;">
                                            @error('fileLogo')
                                                <small class="help-block text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class=" form-group">
                                            <label class="font-weight-bold text-success" for="name">Số điện thoại</label>
                                            <input type="text" class="@error('phone') is-invalid @enderror form-control border border-success" name="phone" value="{{$config->phone}}">
                                            @error('phone')
                                                <small class="help-block text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class=" form-group">
                                            <label class="font-weight-bold text-success" for="title">Địa chỉ</label>
                                            <input type="text" class=" form-control border border-success" id="title" name="address" value="{{$config->address}}">
                                            @error('address')
                                                <small class="help-block text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class=" form-group">
                                            <label class="font-weight-bold text-success" for="title">Email</label>
                                            <input type="text" class=" form-control border border-success" id="title" name="email" value="{{$config->email}}">
                                            @error('email')
                                                <small class="help-block text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class=" form-group">
                                            <label class="font-weight-bold text-success" for="title">Nội dung</label>
                                            <input type="text" class=" form-control border border-success" id="title" name="bottom_footer" value="{{$config->bottom_footer}}">
                                            @error('bottom_footer')
                                                <small class="help-block text-danger">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class=" form-group">
                                            <label class="font-weight-bold text-success" for="status">Trạng thái </label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1" {{($config->status==1)?"checked":""}}  >
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Hiện
                                                </label>
                                            </div>
                                            @if($config->status == 0)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="0" {{($config->status==0)?"checked":""}}>
                                                <label class="form-check-label" for="exampleRadios2">
                                                    Ẩn
                                                </label>
                                            </div>
                                            @endif
                                        </div>

                                        <button type="submit" class="btn btn-primary">Sửa</button>
                                    </form>
                                </div>

                                <div class="col-md-6">
                                    <div class="m-4">
                                        <h6 class="text-primary font-weight-bold">Hướng dẫn thêm sửa</h6>

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
