@extends('backend.main')

@section('title','Danh sách chương trình khuyến mại')

@section('content_admin')


  <!-- Begin Page Content -->
            <div class="container-fluid">

                    <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Quản Lý <span class="text-warning">Promotion</span></h1>
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

                    <!-- <div class="collapse" id="collapseExample"> -->

                    <!-- </div> -->
                </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách chương trình khuyến mãi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">


                                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên chương trình KM</th>
                                            <th>Khuyến mại 1</th>
                                            <th>Khuyến mại 2</th>
                                            <th>Khuyến mại 3</th>
                                            <th>Khuyến mại 4</th>
                                            <th>Khuyến mại 5</th>
                                            <th ><a href="{{route('promotion.create')}}" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i></a></th>
                                            <!-- <th>liên quan</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($promo as $pro)
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$pro->name}}</td>
                                                <td>{{$pro->detail1}}</td>
                                                <td>{{$pro->detail2}}</td>
                                                <td>{{$pro->detail3}}</td>
                                                <td>{{$pro->detail4}}</td>
                                                <td>{{$pro->detail5}}</td>

                                                <td>
                                                    <!-- <a href="{{route('promotion.show',['promotion'=>1])}}" class="text-success"><i class="fa fa-eye" aria-hidden="true"></i></a> -->
                                                    <a href="{{route('promotion.edit',$pro->id)}}" class="text-primary" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>


                                                    <form action="{{route('promotion.destroy',$pro->id)}}" method="POST">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn text-danger p-0 del-btn"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </form>
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