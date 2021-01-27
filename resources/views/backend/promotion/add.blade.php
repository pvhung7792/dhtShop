 @extends('backend.main')

@section('title','Thêm chương trình khuyến mại')

@section('content_admin')


  <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Quản Lý <span class="text-warning">Danh Mục</span></h1>
                    <!-- <p class="mb-4">vui lòng chắc chắn rằng không còn bất cứ <span class="text-warning">sản phẩm "S"</span> hoặc <span class="text-warning">ảnh quảng cáo "A"</span> hoặc <span class="text-warning">banner "B"</span> nào liên quan đến <span class="text-warning">Danh Mục</span> trước khi <span class="text-warning">XÓA</span>. Hoặc có thể <span class="text-warning">ẨN</span> danh mục thay vì xóa nó .</p> -->
                      <div class="card-body">


                    <!-- <div class="collapse" id="collapseExample"> -->
                        <!-- thêm show vào class để trạng thái ban đầu là hiện -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="text-primary font-weight-bold">Thêm chương trình khuyến mại </h6>
                            </div>
                            <div class="row">
                                <div class="col-md-6 ">
                                    <form class="m-4" method="POST" action="{{route('promotion.store') }}">
                                        @csrf
                                        <div class=" form-group">
                                            <label class="font-weight-bold text-success" for="name">Tên chương trìn khuyến mại </label>
                                            <input type="text" class=" form-control border border-success" id="name" name="name">

                                            @error('name')
                                            <small class="help-block text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold text-success" for="name">Nội dung </label>
                                            <textarea name="detail1" id="input" class="form-control" rows="3" ></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold text-success" for="name">Nội dung </label>
                                            <textarea name="detail2" id="input" class="form-control" rows="3" ></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold text-success" for="name">Nội dung </label>
                                            <textarea name="detail3" id="input" class="form-control" rows="3" ></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold text-success" for="name">Nội dung </label>
                                            <textarea name="detail4" id="input" class="form-control" rows="3" ></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold text-success" for="name">Nội dung </label>
                                            <textarea name="detail5" id="input" class="form-control" rows="3" ></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Thêm</button>
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


