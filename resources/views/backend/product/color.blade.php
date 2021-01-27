@extends('backend.main')

@section('title','Sản phẩm')

@section('content_admin')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản Lý <span class="text-success">Màu sản phẩm</span></h1>
    <!-- <p class="mb-4">vui lòng chắc chắn rằng không còn bất cứ <span class="text-warning">sản phẩm "S"</span> hoặc <span class="text-warning">ảnh quảng cáo "A"</span> hoặc <span class="text-warning">banner "B"</span> nào liên quan đến <span class="text-warning">Danh Mục</span> trước khi <span class="text-warning">XÓA</span>. Hoặc có thể <span class="text-warning">ẨN</span> danh mục thay vì xóa nó .</p> -->
    <!-- DataTales Example -->
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
                        <div class="card-body">
                            {{-- {{dd($product)}} --}}
                            <p><b>Tên sản phẩm:</b> {{$product->name}}</p>
                            <p><b>Danh mục:</b> {{$product->brand->category->name}}</p>
                            <p><b>Hãng:</b> {{$product->brand->name}}</p>
                            <p><b>Xuất xứ:</b> {{$product->origin}}</p>
                            <p><b>Năm sản xuất:</b> {{$product->year}}</p>
                            <p><b>Dung lượng pin:</b> {{$product->battery}}</p>
                            <p><b>Sim:</b> {{$product->sim}}</p>
                            <p><b>GPU:</b> {{$product->gpu}}</p>
                            <p><b>Trọng lượng:</b> {{$product->weight}}</p>
                            <p><b>Hệ điều hành:</b> {{$product->os}}</p>
                            <p><b>Kích thước màn hình:</b> {{$product->screen_size}}</p>
                            <p><b>Phụ kiện đi kèm:</b> {{$product->in_box}}</p>
                        </div>
                    </div>

                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                             Chi tiết riêng
                        </div>
                        <div class="card-body">


                            <table class="table table-bordered table-hover">
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
                                                <button type="submit" class="btn btn-primary">Thêm</button>
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
                                            <a href="{{route('product_color.edit',$color->id)}}" class="btn btn-success float-left mr-2">Sửa</a>
                                            <form action="{{route('product_color.destroy',$color->id)}}" method="POST" class="float-left" >
                                                @csrf @method('DELETE')
                                                <input type="text" name='id' value="{{$color->id}}" hidden>
                                                <button type="submit" class="btn btn-danger">Xóa</button>
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
<!-- /.container-fluid -->
@stop()
