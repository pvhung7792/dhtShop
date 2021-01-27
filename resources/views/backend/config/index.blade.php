@extends('backend.main')

@section('title','Cấu hình')

@section('content_admin')


  <!-- Begin Page Content -->
            <div class="container-fluid">
                                        <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Quản Lý <span class="text-warning">Cấu hình</span></h1>
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
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách cấu hình</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">


                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <input type="hidden" name="" id="">
                                            <th>STT</th>
                                            <th>Logo</th>
                                            <th>Số điện thoại</th>
                                            <th>Địa chỉ</th>
                                            <th>Email</th>
                                            <th>Nội dung</th>
                                            <th>Trạng thái</th>
                                            {{-- <th>Ngày cập nhật</th>
                                            <th>Ngày tạo</th> --}}
                                            <th ><a href="{{route('config.create')}}" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i></a></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($config as $fig)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td><img src="{{url('public')}}/uploads/logos/{{$fig->logo}}" style="max-height: 50px;"></td>

                                            <td>{{$fig->phone}}</td>
                                            <td>{{$fig->address}}</td>
                                            <td>{{$fig->email}}</td>
                                            <td>{{$fig->bottom_footer}}</td>
                                            <td>{{($fig->status==1)?'Hiện':'Ẩn'}}</td>
                                            <td>
                                                <a href="{{ route('config.edit',$fig->id) }}" class="text-success float-left mr-2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                                <form action="{{route('config.destroy',$fig->id)}}" method="POST">
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
