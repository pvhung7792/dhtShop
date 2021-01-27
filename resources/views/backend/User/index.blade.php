@extends('backend.main') 
 
@section('title','Người dùng')

@section('content_admin')


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản Lý <span class="text-warning">Người dùng</span></h1>
    <!-- <p class="mb-4">vui lòng chắc chắn rằng không còn bất cứ <span class="text-warning">sản phẩm "S"</span> hoặc <span class="text-warning">ảnh quảng cáo "A"</span> hoặc <span class="text-warning">banner "B"</span> nào liên quan đến <span class="text-warning">Danh Mục</span> trước khi <span class="text-warning">XÓA</span>. Hoặc có thể <span class="text-warning">ẨN</span> danh mục thay vì xóa nó .</p> -->
    <div class="card-body">


        <!-- <div class="collapse" id="collapseExample"> -->

            <!-- </div> -->
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách người dùng</h6>
            </div>
            <div class="card-body">
                @if(session('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>{{session('message')}}</strong> 
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>{{session('error')}}</strong> 
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="table" width="100%" cellspacing="0">
                        <thead>
                            <tr >
                                <th>STT</th>
                                <th >Họ</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>địa chỉ</th>
                                <th>Sđt</th>
                                <th>Trạng thái</th>
                                <th>Phân quyền</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $user)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$user->last_name}}</td>
                                <td>{{$user->first_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->address}}</td>
                                <td>{{$user->phone}}</td>

                                    <!-- nếu là quản trị được phép xóa và thay đổi mọi thông tin người dùng -->
                                    @if(Auth::guard('user')->user()->role ==2)
                                    <form class="m-4" method="POST" action="{{ route('user.update',$user->id)}}"  >
                                    @csrf @method('PUT')
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <td>
                                        <div class=" form-group">
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" {{ ($user->status==1)?"checked":"" }}>
                                              <label class="form-check-label" for="inlineRadio1">Hoạt động</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0" {{ ($user->status==0)?"checked":"" }}>
                                              <label class="form-check-label text-warning" for="inlineRadio2">Khóa</label>
                                            </div>
                                           
                                      </div>
                                    </td>
                                    <td>
                                        <div class=" form-group">
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="role" id="inlineRadio1" value="0" {{ ($user->role==0)?"checked":"" }}>
                                              <label class="form-check-label" for="inlineRadio1">người dùng</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="role" id="inlineRadio2" value="1" {{ ($user->role==1)?"checked":"" }}>
                                              <label class="form-check-label text-success" for="inlineRadio2">Admin</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="role" id="inlineRadio3" value="2" {{ ($user->role==2)?"checked":"" }}>
                                              <label class="form-check-label text-danger" for="inlineRadio3">Quản trị</label>
                                            </div>
                                      </div>
                                  </td>
                                <td>
                                         <button type="submit" class="text-success btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                        </form>
                                    <form action="{{ route('user.destroy',$user->id) }}" method="POST" class="float-left" >
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-danger btn"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </form>
                                    </td>
                                    <!-- nếu là admin chỉ có thể thay đổi trạng thái của người dùng -->

                                    @elseif($user->role==0)
                                    <form class="m-4" method="POST" action="{{ route('user.update',$user->id)}}"  >
                                    @csrf @method('PUT')
                                    <input type="text" name="id" id="id" hidden value="{{$user->id}}">
                                    <td>
                                      <div class=" form-group">
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1" {{ ($user->status==1)?"checked":"" }}>
                                              <label class="form-check-label" for="inlineRadio1">Hoạt động</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0" {{ ($user->status==0)?"checked":"" }}>
                                              <label class="form-check-label" for="inlineRadio2">Khóa</label>
                                            </div>
                                           
                                      </div>
                                    </td>
                                    
                                    <td>
                                        @if($user->role==2)
                                        <span class="text-danger">Quản Trị</span>
                                        @elseif($user->role==1)
                                        <span class="text-success">Admin</span>
                                        @else
                                        <span >người dùng</span>
                                        @endif
                                    </td>
                                    <td>
                                         <button type="submit"  class="btn btn-primary">Sửa</button>
                                        
                                    </td></form>
                                    <!-- nếu là admin chỉ có thể xem các thông tin của admin và Quản trị -->
                                    @else

                                    <td>
                                        <span >{{ ($user->status==1)?"Hoạt động":"Khóa" }}</span>
                                    </td>
                                    <td>
                                        @if($user->role==2)
                                        <span class="text-danger">Quản Trị</span>
                                        @elseif($user->role==1)
                                        <span class="text-success">Admin</span>
                                        @else
                                        <span >người dùng</span>
                                        @endif
                                    </td>

                                    <td> 
                                        <span class="text-warning">{{ '*.*' }}</span>
                                    </td>
                                    @endif
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

