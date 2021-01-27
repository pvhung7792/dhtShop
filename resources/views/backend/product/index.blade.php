@extends('backend.main')

@section('title','Sản phẩm')

@section('content_admin')


<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Quản Lý <span class="text-warning">sản phẩm</span></h1>
    <div class="card-body">
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
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
                <div class="table-responsive">
                    <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Hãng</th>
                            <th>Màu sản phẩm</th>
                            <th>Trạng thái</th>
                            <th>Ảnh</th>
                            <th>
                                <a href="{{ route('product.create') }}" class="btn btn-primary"  >
                                <i class="fa fa-plus-square" aria-hidden="true"></i></a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $pro)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$pro->name}}</td>
                            <td>{{$pro->brand->category->name}}</td>
                            <td>{{$pro->brand->name}}</td>
                            <td>
                            @foreach ($pro->product_color as $key => $color)
                                @if($key==count($pro->product_color)-1)
                                {{$color->name}}
                                @else
                                {{$color->name}},
                                @endif
                            @endforeach
                            </td>
                            <td>{{($pro->status==1)?'Hiện':'Ẩn'}}</td>
                            <td><img src="{{url('public')}}/uploads/products/{{$pro->image}}" alt="" width="50px"></td>
                            <td>
                                <a href="{{route('product.show',$pro->id)}}" class="text-primary float-left mr-2 mt-1"><i class="fa fa-external-link font-weight-bold" aria-hidden="true"></i></a>
                               <a href="{{route('product.edit',$pro->id)}}" class="text-warning float-left mr-2 mt-1"><i class="fa fa-pencil-square font-weight-bold" aria-hidden="true"></i></a>
                                <form action="{{route('product.del_pro',$pro->id)}}" method="POST" class="float-left">
                                    @csrf @method('DELETE')
                                    <input type="text" name='logo' value="{{$pro->logo}}" hidden>
                                    <button type="submit" class="btn text-danger p-0 del-btn"><i class="fa fa-trash font-weight-bold" aria-hidden="true"></i></button>
                                </form>
                                <!-- Button trigger modal -->
                                <!-- <a type="button" class="text-danger del-btn" productId="{{$pro->id}}" data-toggle="modal" data-target="#exampleModal">
                                  <i class="fa fa-trash font-weight-bold" aria-hidden="true"></i>
                                </a> -->


                                <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Chú ý</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                    <p>Việc xóa sản phẩm sẽ bao gồm xóa tất cả những sản phẩm con và các ảnh sản phẩm liên quan đến nó</p>
                                    <h5 class="text-danger">bạn có chắc chắn muốn xóa?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                    <form action="{{route('product.del_pro',1)}}">
                                        <input type="text" name="product_id" id="productId" value="" hidden>
                                        <button type="submit" class="btn btn-danger">Tiếp tục xóa</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> -->
                            </td>
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

    // $('.del-btn').click(function(){
    //     let proId = $(this).attr('productId');
    //     console.log(proId);
    //     $('#productId').val(proId);
    // })
</script>
@stop()
