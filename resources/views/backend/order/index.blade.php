 @extends('backend.main') 
 
 @section('title','Danh sách đơn hàng')

 @section('content_admin')


 <!-- Begin Page Content -->
 <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản Lý <span class="text-warning">Danh Mục</span></h1>
    <div class="card-body">
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách Đơn hàng</h6>
            <select name="" id="selectStatus" class="form-control w-25 mt-2" required="required">
                <option value="all" {{$status==5?'selected':''}}>Tất cả</option>
                <option value="0" {{$status==0?'selected':''}}>Đơn hàng chưa xác nhận</option>
                <option value="1" {{$status==1?'selected':''}}>Đơn hàng đã xác nhận</option>
                <option value="2" {{$status==2?'selected':''}}>Đơn hàng đang giao</option>
                <option value="3" {{$status==3?'selected':''}}>Đơn hàng hoàn thành</option>
                <option value="4" {{$status==4?'selected':''}}>Đơn hàng đã hủy</option>
            </select>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if(session('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{session('success')}}</strong> 
            </div>
            @endif
                <table class="table table-bordered" width="100%" cellspacing="0" id="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Người dùng</th>
                            <th>Người nhận</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Tổng tiền (VNĐ)</th>
                            <th>Tổng SL hàng</th>
                            <th>Thời gian cập nhật</th>
                            <th>Thời gian tạo</th>
                            <th style="min-width: 200px;">Trạng thái</th>
                            <th>Xem chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order as $order)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$order->user->first_name}} {{$order->user->last_name}}</td>
                            <td>{{$order->name}}</td>
                            <td>{{$order->address}}</td>
                            <td>{{$order->phone}}</td>
                            <td>{{number_format($order->total_price)}}</td>
                            <td>{{$order->total_quantity}}</td>
                            <td>{{date_format($order->updated_at, 'd/m/Y H:i:s')}}</td>
                            <td>{{date_format($order->created_at, 'd/m/Y H:i:s')}}</td>
                            <td>
                                <select orderId="{{$order->id}}" class="form-control updateStatus" {{($order->status==3||$order->status==4)?'disabled':''}}>
                                    <option value="0" {{$order->status==0?'selected':''}} {{$order->status > 0?'hidden':''}}>Chưa xác nhận</option>
                                    <option value="1" {{$order->status==1?'selected':''}} {{$order->status > 1?'hidden':''}}>Đã xác nhận</option>
                                    <option value="2" {{$order->status==2?'selected':''}} {{$order->status > 2?'hidden':''}}>Đang giao hàng</option>
                                    <option value="3" {{$order->status==3?'selected':''}}>Đã giao hàng</option>
                                    <option value="4" {{$order->status==4?'selected':''}}>Đã hủy</option>
                                </select>
                            </td>
                            <td>
                                <a href="{{route('order.show',$order->id)}}" class="pl-3 text-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
            { orderable: false, targets: -1 }
        ]
    });
//Đổi trạng thái đơn hàng
    $("#table").on("change", ".updateStatus", function(){
        let orderId = $(this).attr('orderId');
        let status = $(this).val();
        // alert(orderId + status);
        window.location.href = "update-status-order/"+orderId+"/"+status;
        
    });
    
    // $('.updateStatus').change(function(){
    //     let orderId = $(this).attr('orderId');
    //     let status = $(this).val();
    //     alert(orderId + status);
    //     window.location.href = "update-status-order/"+orderId+"/"+status;
    // })  

    $('#selectStatus').change(function(){
        let status = $(this).val();
        console.log(status);
        if (status == 'all') {
            window.location.href = "order";
        }else{
            window.location.href = "order?status="+status;
        }
    })    
});


</script>
@stop()