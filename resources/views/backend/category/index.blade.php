@extends('backend.main') 

@section('title','Danh mục')

@section('content_admin')


<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Quản Lý <span class="text-warning">Danh Mục</span></h1>
    <div class="card-body">
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách Danh Mục</h6>
        </div>
        <div class="card-body">
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
            <div class="table-responsive">
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên danh mục</th>
                            <th>Đường dẫn</th>
                            <th>Trạng thái</th>
                            <th>Logo</th>
                            <th ><a href="{{route('category.create')}}" class="btn btn-primary"  >
                                <i class="fa fa-plus-square" aria-hidden="true"></i>
                            </a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category as $cate)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$cate->name}}</td>
                            <td>{{$cate->slug}}</td>
                            <td>{{($cate->status==1)?'Hiển thị':'Ẩn'}}</td>
                            <td><img src="{{url('public')}}/uploads/logos/{{$cate->logo}}" alt="" style="max-height: 50px"></td>
                            <td>
                                <a href="{{route('category.edit',$cate->id)}}" class="text-success float-left mr-2" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <form action="{{route('category.destroy',$cate->id)}}" method="POST" class="float-left" >
                                    @csrf @method('DELETE')
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
@stop()

@section('script')

<script>
    $(document).ready(function() {
        $('#table').DataTable({
            columnDefs: [
            { orderable: false, targets: -1 }
            ]
        });
    });
</script>

@stop()