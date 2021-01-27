@extends('backend.main') 

@section('title','Nhãn hiệu')

@section('content_admin')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản Lý <span class="text-warning">Hãng sản phẩm</span></h1>
    <div class="card-body">
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách Nhãn Hiệu</h6>
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
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>{{session('error')}}</strong> 
                </div>
                @endif
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên thương hiệu</th>
                            <th>Danh Mục</th>
                            <th>Đường dẫn</th>
                            <th>Trạng thái</th>
                            <th width="50px">Số sản phẩm</th>
                            <th>Logo</th>
                            <th ><a href="{{ route('brand.create') }}" class="btn btn-primary"  >
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            </a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brand as $brd)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$brd->name}}</td>
                            <td>{{$brd->category->name}}</td>
                            <td>{{$brd->slug}}</td>
                            <td>{{(($brd->status)==1)?'Hiển thị':'Ẩn'}}</td>
                            <td>{{$brd->product->count()}}</td>
                            <td><img src="{{url('public')}}/uploads/brands/{{$brd->logo}}" alt="" style="max-height: 50px"></td>
                            <td>
                               <a href="{{route('brand.edit',$brd->id)}}" class="text-success float-left mr-2" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <form action="{{route('brand.destroy',$brd->id)}}" method="POST" class="float-left" >
                                    @csrf @method('DELETE')
                                    <input type="text" name='logo' value="{{$brd->logo}}" hidden>
                                    <button type="submit" class="btn text-danger p-0 del-btn"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                           </td>
                        @endforeach
                       </tr>
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