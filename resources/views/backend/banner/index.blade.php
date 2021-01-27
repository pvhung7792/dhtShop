@extends('backend.main') 

@section('title','Banner')

@section('content_admin')


<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Quản Lý <span class="text-warning">banner</span></h1>
    <div class="card-body">
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách banner</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Nơi đặt</th>
                            <th>Vị trí</th>
                            <th>Tiêu đề</th>
                            <th>Liên kết</th>
                            <th>Trạng thái</th>
                            <th>Ảnh</th>
                            <th ><a href="{{ route('banner.create') }}" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banner as $bnn)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$bnn->name}}</td>
                            <td>{{($bnn->cate_id=='')?'Trang chủ':$bnn->category->name}}</td>
                            <td>
                            @switch($bnn->home_pos)
                                @case(1)
                                    Trang chính
                                    @break
                                @case(2)
                                    Banner phụ
                                    @break
                                @default
                                    N/A
                            @endswitch
                            </td>
                            <td>{{$bnn->title}}</td>
                            <td>{{$bnn->link}}</td>
                            <td>{{($bnn->status==1)?'Hiện':'Ẩn'}}</td>
                            <td><img src="{{url('public')}}/uploads/banners/{{$bnn->image}}" style="max-height: 70px;"></td>
                            <td>
                                <a href="{{route('banner.edit',$bnn->id)}}" class="text-success float-left mr-2" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <form action="{{route('banner.destroy',$bnn->id)}}" method="POST" class="float-left" >
                                    @csrf @method('DELETE')
                                    <input type="text" name='image' value="{{$bnn->image}}" hidden>
                                    <button type="submit" class="btn text-danger p-0 del-btn"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->


@stop()

@section('script')
<script>
    $(document).ready(function() {
            $('#table').DataTable({
                columnDefs: [
                    { 
                        orderable: false, targets: -1
                    }
                ]
            });
        });
</script>
@stop()