@extends('backend.main') 

@section('title','Bình luận')

@section('content_admin')


  <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Quản Lý <span class="text-warning">Danh Mục</span></h1>
                    <!-- <p class="mb-4">vui lòng chắc chắn rằng không còn bất cứ <span class="text-warning">sản phẩm "S"</span> hoặc <span class="text-warning">ảnh quảng cáo "A"</span> hoặc <span class="text-warning">banner "B"</span> nào liên quan đến <span class="text-warning">Danh Mục</span> trước khi <span class="text-warning">XÓA</span>. Hoặc có thể <span class="text-warning">ẨN</span> danh mục thay vì xóa nó .</p> -->
                      <div class="card-body">


                    <!-- <div class="collapse" id="collapseExample"> -->
                       
                    <!-- </div> -->
                </div>


                <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách Bình luận</h6>
                        </div>
                        @if(session('success'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>{{session('success')}}</strong>
                            </div>
                            @endif
                            @if(session('error'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>{{session('error')}}</strong>
                            </div>
                            @endif
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                           <th>STT</th>
                                           <th>
                                                Khách <i class="fa fa-arrows-h" aria-hidden="true"></i> Sản phẩm
                                           </th>
                                           <th>Câu hỏi</th>
                                           <th>Trạng thái</th>
                                           <th>Quản lý</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                        @foreach($notanswer as $notanswer)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $notanswer->user->first_name }} <i class="fa fa-arrows-h" aria-hidden="true"></i> {{ $notanswer->product->name }}
                                            </td>
                                            <td>
                                                {{ (strlen($notanswer->question)>100)?substr($notanswer->question,0,100):$notanswer->question}} 
                                            </td>
                                            <td>{{ ($notanswer->status==1)?"Hiện":"Ẩn" }}</td>
                                            <td>
                                                <a href="{{route('comment.edit',$notanswer->id)}}" class="text-success"><i class="fa fa-comments" aria-hidden="true"></i></a>
                                                <a href="{{route('home.product',[$notanswer->product->brand->category->slug,$notanswer->product->slug])}}" class="text-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                <a href="{{route('comment.delete',$notanswer->id)}}" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                                <!-- <td>
                                                    <p>B: <span class="text-warning">10</span>; 
                                                        A: <span class="text-warning">10</span>; 
                                                        S: <span class="text-warning">20</span></p>
                                                    </td> -->
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                </div>

                <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách Bình luận</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="table1" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                           <th>STT</th>
                                           <th>
                                                Khách <i class="fa fa-arrows-h" aria-hidden="true"></i> Sản phẩm
                                           </th>
                                           <th>Câu hỏi</th>
                                           <th>Trả lời</th>
                                           <th>Trạng thái</th>
                                           <th>Quản lý</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                        @foreach($comment as $comment)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>
                                                {{ $comment->user->first_name }} <i class="fa fa-arrows-h" aria-hidden="true"></i> {{ $comment->product->name }}
                                            </td>
                                            <td>
                                                {{ (strlen($comment->question)>50)?substr($comment->question,0,50):$comment->question}} </td>
                                            <td>
                                                {{(strlen($comment->answer)>50)?substr($comment->answer,0,50):$comment->answer}}
                                            </td>
                                            <td>{{ ($comment->status==1)?"Hiện":"Ẩn" }}</td>
                                            <td>
                                                <a href="{{route('home.product',[$comment->product->brand->category->slug,$comment->product->slug])}}" class="text-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                <a href="{{route('comment.edit',$comment->id)}}" class="text-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                <a href="{{route('comment.delete',$comment->id)}}" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                                <!-- <td>
                                                    <p>B: <span class="text-warning">10</span>; 
                                                        A: <span class="text-warning">10</span>; 
                                                        S: <span class="text-warning">20</span></p>
                                                    </td> -->
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    
                <!-- /.container-fluid -->
                 </div>
                    
                    

                </div>

@stop()
@section('script')

    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                columnDefs: [
                    { orderable: false, targets: -1 }
                ]
            });
            $('#table1').DataTable({
                columnDefs: [
                    { orderable: false, targets: -1 }
                ]
            });
        });
    </script>

    @stop()