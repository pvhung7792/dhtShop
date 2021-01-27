@extends('backend.main') 

@section('title','Chi tiết đơn hàng')

@section('content_admin')


<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Thông tin <span class="text-warning">Đơn hàng</span></h1>
    <div class="card-body">
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin đơn hàng</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                Thông tin khách hàng
                            </div>
                            <div class="card-body">
                                <table cellpadding="5">
                                    <tr>
                                        <th>Tên người nhận:</th>
                                        <td>{{$order->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Số điện thoại:</th>
                                        <td>{{$order->phone}}</td>
                                    </tr>
                                    <tr>
                                        <th>Địa chỉ:</th>
                                        <td>{{$order->address}}</td>
                                    </tr>
                                    <tr>
                                        <th>Trạng thái:</th>
                                        <td>
                                            @switch($order->status)
                                        @case(1)
                                            Đã xác nhận
                                            @break
                                        @case(2)
                                            Đang giao hàng
                                            @break
                                        @case(3)
                                            Giao hàng thành công
                                            @break
                                        @case(4)
                                            Đơn đã hủy
                                            @break
                                        @default
                                            Chưa xác nhận
                                    @endswitch
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Ghi chú:</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2">{{$order->note?$order->note:'không có'}}</td>
                                    </tr>
                                </table>
                            </div>
                    </div>

                </div>
                <div class="col-md-7 offset-1">
                    <div class="card">
                      <div class="card-header bg-primary text-white">
                        Chi tiết đơn hàng
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Màu</th>
                                    <th>Đơn giá (VNĐ)</th>
                                    <th>Số lượng</th>
                                    <th>Tổng (VNĐ)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order_detail as $order_detail)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$order_detail->name}}</td>
                                    <td>{{$order_detail->color}}</td>
                                    <td>{{number_format($order_detail->unit_price)}}</td>
                                    <td>{{$order_detail->quantity}}</td>
                                    <td>{{number_format($order_detail->unit_price*$order_detail->quantity)}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="9">
                                        <div class="pull-right">
                                            <p>Tổng tiền: <span class="text-danger pull-right ml-2">{{number_format($order->total_price)}} VNĐ</span></p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        @if($order->status < 4)
                        <a href="{{route('print-order',$order->id)}}"> In đơn hàng</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

@stop()