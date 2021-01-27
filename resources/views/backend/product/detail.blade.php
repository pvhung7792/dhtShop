@extends('backend.main')

@section('title','Chi tiết sản phẩm')

@section('content_admin')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản Lý <span class="text-success">Sản phẩm</span></h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách chi tiết Sản phẩm</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Chi tiết chung
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
                            <img src="{{url('public')}}/uploads/products/{{$product->image}}" style="max-width: 100%;">
                            <hr>
                            <p><b>Tên sản phẩm:</b> {{$product->name}}</p>
                            <p><b>Danh mục:</b> {{$product->brand->category->name}}</p>
                            <p><b>Hãng:</b> {{$product->brand->name}}</p>
                            <p><b>Xuất xứ:</b> {{$product->origin?$product->origin:'N/A'}}</p>
                            <p><b>Năm sản xuất:</b> {{$product->year?$product->year:'N/A'}}</p>
                            <p><b>Pin:</b> {{$product->battery?$product->battery:'N/A'}}</p>
                            <p><b>Sim:</b> {{$product->sim?$product->sim:'N/A'}}</p>
                            <p><b>GPU:</b> {{$product->gpu?$product->gpu:'N/A'}}</p>
                            <p><b>Trọng lượng:</b> {{$product->weight?$product->weight:'N/A'}}</p>
                            <p><b>Hệ điều hành:</b> {{$product->os?$product->os:'N/A'}}</p>
                            <p><b>Kích thước màn hình:</b> {{$product->screen_size?$product->screen_size:'N/A'}}</p>
                            <p><b>Phụ kiện đi kèm:</b> {{$product->in_box?$product->in_box:'N/A'}}</p>
                            <a href="{{route('product.edit',$product->id)}}" class="btn btn-success float-left mr-2" >Sửa thông tin</a>
                        </div>
                    </div>

                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                             Chi tiết riêng
                        </div>
                        <div class="card-body">
                            @if(session('successDetail'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>{{session('successDetail')}}</strong>
                            </div>
                            @endif
                            @if(session('errorDetail'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>{{session('errorDetail')}}</strong>
                            </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>CPU</th>
                                        <th>RAM</th>
                                        <th>Bộ nhớ</th>
                                        <th>Đơn giá (VNĐ)</th>
                                        <th>Khuyến mại (VNĐ)</th>
                                        <th>Trạng thái</th>
                                        <th>
                                            <form action="{{route('product_detail.create')}}" method="GET">
                                                <input type="text" name='name' value="{{$product->name}}" hidden>
                                                <input type="text" name='id' value="{{$product->id}}" hidden>
                                                <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus-square" aria-hidden="true"></i></button>
                                            </form>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pro_detail as $detail)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{($detail->cpu)?$detail->cpu:'N/A'}}</td>
                                        <td>{{($detail->ram)?$detail->ram:'N/A'}}</td>
                                        <td>{{($detail->memory)?$detail->memory:'N/A'}}</td>
                                        <td>{{number_format($detail->price)}}</td>
                                        <td>{{($detail->sale_price)?number_format($detail->sale_price):'N/A'}}</td>
                                        <td>{{($detail->status==1)?'Hiện':'Ẩn'}}</td>
                                        <td>
                                            <a href="{{route('product_detail.edit',$detail->id)}}" class="btn text-warning"><i class="fa fa-pencil-square font-weight-bold" aria-hidden="true"></i></a>
                                            <form action="{{route('product_detail.destroy',$detail->id)}}" method="POST" class="float-left" >
                                                @csrf @method('DELETE')
                                                <input type="text" name='product_id' value="{{$detail->product->id}}" hidden>
                                                <button type="submit" class="btn del-btn"><i class="text-danger fa fa-trash font-weight-bold" aria-hidden="true"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                            </table>
                            </div>

                        </div>

                    </div>
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                             Chi tiết màu sản phẩm
                        </div>
                        <div class="card-body">
                            @if(session('successColor'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>{{session('successColor')}}</strong>
                            </div>
                            @endif
                            @if(session('errorColor'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>{{session('errorColor')}}</strong>
                            </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="table1">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Màu</th>
                                            <th>logo</th>
                                            <th>Ảnh</th>
                                            <th>Trạng thái</th>
                                            <th>
                                                <form action="{{route('product_color.create')}}" method="GET">
                                                    <input type="text" name='id' value="{{$product->id}}" hidden>
                                                    <input type="text" name='name' value="{{$product->name}}" hidden>
                                                    <button type="submit" class="btn btn-primary"  >
                                <i class="fa fa-plus-square" aria-hidden="true"></i></button>
                                                </form>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pro_color as $color)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{($color->name)}}</td>
                                            <td><img src="{{url('public')}}/uploads/product_colors/{{$color->logo}}" alt="" width="50px"></td>
                                            <td>
                                                @for($i=1; $i<6;$i++)
                                                <img {{$a ='image'.$i}} src="{{url('public')}}/uploads/product_colors/{{$color->$a}}." alt="" width="50px">
                                                @endfor
                                            </td>

                                            <td>{{($color->status==1)?'Hiện':'Ẩn'}}</td>
                                            <td>
                                                <a href="{{route('product_color.edit',$color->id)}}" class="btn text-warning"><i class="fa fa-pencil-square font-weight-bold" aria-hidden="true"></i></a>
                                                <form action="{{route('product_color.destroy',$color->id)}}" method="POST" class="float-left" >
                                                    @csrf @method('DELETE')
                                                    <input type="text" name='id' value="{{$color->id}}" hidden>
                                                    <button type="submit" class="btn del-btn"><i class="text-danger fa fa-trash font-weight-bold" aria-hidden="true"></i></button>
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

            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@stop()
@section('script')
<!-- <script>
    $(document).ready(function() {
            $('#table').DataTable({
                columnDefs: [
                    {
                        orderable: false, targets: -1
                    }
                ]
            });
            $('#table1').DataTable({
                columnDefs: [
                    {
                        orderable: false, targets: -1
                    }
                ]
            });
        });
</script> -->
@stop()
