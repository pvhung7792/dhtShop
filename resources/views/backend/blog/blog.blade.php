@extends('backend.main')

@section('title','Quản lý Blog')

@section('content_admin')


<!-- Begin Page Content -->
<div class="container-fluid">

   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">Quản Lý <span class="text-warning">Blog {{$blog_cate->name}}</span></h1>
   <!-- <p class="mb-4">vui lòng chắc chắn rằng không còn bất cứ <span class="text-warning">sản phẩm "S"</span> hoặc <span class="text-warning">ảnh quảng cáo "A"</span> hoặc <span class="text-warning">banner "B"</span> nào liên quan đến <span class="text-warning">Danh Mục</span> trước khi <span class="text-warning">XÓA</span>. Hoặc có thể <span class="text-warning">ẨN</span> danh mục thay vì xóa nó .</p> -->
   @if(session('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{session('success')}}</strong>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>{{session('error')}}</strong>
        </div>
    @endif
   <div class="row">

    <div class="col-md">
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách blog</h6>

        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tiêu đề</th>
                            <th>Ảnh đại diện</th>
                            <th>tóm tắt</th>
                            <th>Trạng thái</th>
                            <th >
                                <a href="{{route('blog.add',$blog_cate->id)}}" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i></a>

                            </th>
                            <!-- <th>liên quan</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($blog as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item->title}}</td>
                                <td><img src="{{url('public')}}/uploads/blogs/{{$item->image}}" style="max-height: 50px;"></td>
                                <td>{{$item->summary}}</td>
                                <td>{{($item->status==1)?'Hiện':'Ẩn'}}</td>
                                <td>
                                    <a href="{{route('blog_view',[$item->blog_cate->slug,$item->slug])}}" class="text-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="{{route('blog.edit',$item->id)}}" class="text-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <form action="{{route('blog.destroy',$item->id)}}" method="POST" class="float-left" >
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn text-danger p-0 del-btn"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </form>
                                </td>
                            </tr>
                         @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
       </div>
       </div>
   </div>
   <!-- /.container-fluid -->

   @stop()

<script>
    $(document).ready(function() {
        $('#table').DataTable({
            columnDefs: [
            { orderable: false, targets: -1 }
            ]
        });
    });
</script>