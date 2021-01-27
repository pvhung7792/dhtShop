@extends('backend.main') 


@section('content_admin')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản Lý <span class="text-warning">Bình luận</span></h1>
    <!-- <p class="mb-4">vui lòng chắc chắn rằng không còn bất cứ <span class="text-warning">sản phẩm "S"</span> hoặc <span class="text-warning">ảnh quảng cáo "A"</span> hoặc <span class="text-warning">banner "B"</span> nào liên quan đến <span class="text-warning">Danh Mục</span> trước khi <span class="text-warning">XÓA</span>. Hoặc có thể <span class="text-warning">ẨN</span> danh mục thay vì xóa nó .</p> -->
    <div class="card-body">


        <!-- <div class="collapse" id="collapseExample"> -->
            <!-- thêm show vào class để trạng thái ban đầu là hiện -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 text-primary"><span class="font-weight-bold">Trả lời câu hỏi của khách</h6>
                </div>
                <div class="row">
                    <div class="col-md-6 ">

                       
                            <div class="m-2">
                                <label for="">Câu hỏi</label>
                                <textarea class="form-control" rows="3" disabled>{{ $comment->question }}</textarea>
                            </div>
                             <form class="m-2" method="POST" action="{{ route('addAnswer',$comment->id)}}">
                                @csrf 
                                
                                <div class="form-group">
                                     <label for="answer">Trả lời</label>
                                    <textarea name="answer" id="input" class="form-control" rows="3" required="required" placeholder="Viết bình luận (Vui lòng nhập tiếng việt có dấu)" value="{{ $comment->answer }}">{{ $comment->answer }}</textarea>
                                </div>
                                 <div class="form-group">
                                     <label for="status">Trạng thái</label>
                                    <input type="radio" name="status" value=1 {{ ($comment->status==1)?"checked":"" }}> Hiện
                                    <input type="radio" name="status" value=0 {{ ($comment->status==0)?"checked":"" }}> Ẩn
                                </div>

                                <button type="submit" class="btn btn-primary mt-5">Cập nhật</button>
                        </form>
                    </div>

                    <div class="col-lg-6 px-4">
                        <h5 class="text-primary font-weight-bold my-3">Thông tin</h5>
                        <h6 class="">Người dùng: <a href="">{{ $comment->user->last_name }} {{ $comment->user->first_name }}</a></h6>
                        <h6 class="">Sản phẩm đề cập: <span class="text-warning">{{ $comment->product->name }}</span></h6>
                    </div>
                </div>

            </div>

            <!-- </div> -->
        </div>
        <!-- DataTales Example -->


    </div>
    <!-- /.container-fluid -->

    @stop()