 @extends('backend.main') 
 
@section('title','Chi tiết chương trình khuyến mại')

 @section('content_admin')


 <!-- Begin Page Content -->
 <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản Lý <span class="text-warning">Promotion</span></h1>
    <!-- <p class="mb-4">vui lòng chắc chắn rằng không còn bất cứ <span class="text-warning">sản phẩm "S"</span> hoặc <span class="text-warning">ảnh quảng cáo "A"</span> hoặc <span class="text-warning">banner "B"</span> nào liên quan đến <span class="text-warning">Danh Mục</span> trước khi <span class="text-warning">XÓA</span>. Hoặc có thể <span class="text-warning">ẨN</span> danh mục thay vì xóa nó .</p> -->
    <div class="card-body">


        <!-- <div class="collapse" id="collapseExample"> -->
            <!-- thêm show vào class để trạng thái ban đầu là hiện -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="text-primary font-weight-bold">Chi tiết chương trình khuyến mại </h6>
                </div>
                <div class="row">
                    <div class="col-md-4 p-5">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                Tiêu đề:
                            </div>
                            <div class="card-body">
                                <p>Nội dung:</p>
                            </div>
                        </div>
                        </div>

                        <div class="col-md-6 offset-1">
                            <h6 class="text-primary font-weight-bold m-4">Danh sách sản phẩm sử dụng chương trình</h6>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Danh mục</th>
                                        <th>Nhãn hiệu</th>
                                        <th>Thời gian bắt đầu</th>
                                        <th><a href="{{route('promotion.add_detail',['id'=>1])}}" class="btn btn-primary">Thêm</a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="" class="btn btn-danger">Xóa</a></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><a href="" class="btn btn-secondary">Xóa hết</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <!-- </div> -->
            </div>
            <!-- DataTales Example -->


        </div>
        <!-- /.container-fluid -->

        @stop()