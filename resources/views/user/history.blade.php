@extends('frontend.main')

@section('content')
<div class="container bg-white mb-2">
	<h3 class="mt-5">Danh sách lịch sử đơn hàng</h3>
	<div class="row mt-5 pb-5">
		<div class="col-md-12">
		@if(!empty($history->all()))
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>STT</th>
					<th>Số lượng</th>
					<th>Giá trị đơn hàng(VNĐ)</th>
					<th>Thời gian đặt hàng</th>
					<th>Thời gian nhận/hủy đơn hàng</th>
					<th>Trạng thái đơn hàng</th>
					<th>Xem</th>
				</tr>
			</thead>
			<tbody>
				@foreach($history as $order)
				<tr>
					<td>{{$loop->index+1}}</td>
					<td>{{$order->total_quantity}}</td>
					<td>{{number_format($order->total_price)}}</td>
					<td>{{date_format($order->created_at, 'd/m/Y H:i:s')}}</td>
					<td>{{date_format($order->updated_at, 'd/m/Y H:i:s')}}</td>
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
                                Đã hủy
                                @break
                            @default
                                Chưa xác nhận
                        @endswitch
                    </td>
					<td class="text-center">
						<form action="{{route('orderDetail')}}" method="POST">
							@csrf
							<input type="hidden" name="order_id" value="{{$order->id}}">
						<button type="submit" class="btn text-primary p-0"><i class="fa fa-folder-open" aria-hidden="true"></i></button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@else
		<h4 class="text-warning">Lịch sử đơn hàng trống</h4>
		@endif
	</div>
	</div>
</div>
@stop()