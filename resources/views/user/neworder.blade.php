@extends('frontend.main')

@section('content')
<div class="container bg-white mb-2">
	<h3 class="mt-5">Danh sách đơn hàng đang thực hiện</h3>
	<div class="row mt-5 pb-5">
		<div class="col-md-12">
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
                @if(!empty($new_order->all()))
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>STT</th>
					<th>Số lượng</th>
					<th>Giá trị đơn hàng(VNĐ)</th>
					<th>Thời gian đặt hàng</th>
					<th>Thời gian cập nhật</th>
					<th>Trạng thái đơn hàng</th>
					<th>Xem</th>
					<th>Hủy</th>
				</tr>
			</thead>
			<tbody>
				@foreach($new_order as $order)
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
					<td class="text-center">
						<form action="{{route('orderCancel')}}" method="POST">
							@csrf
							<input type="hidden" name="order_id" value="{{$order->id}}">
							<button type="submit" class="btn text-danger p-0 del-btn"><i class="fa fa-remove" aria-hidden="true"></i></button>
						<!-- <a href="{{route('orderCancel',$order->id)}}"><i class="fa fa-remove text-danger"></i></a> -->
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@else
		<div class="text-center">
			<h4 class="text-warning">Bạn hiện chưa có đơn hàng nào</h4>
			<a href="{{route('home')}}">Ấn vào đây để về trang chủ</a>
		</div>
		@endif
	</div>
	</div>
</div>
<script>
	$('.del-btn').click(function(e){
		e.preventDefault();
		let form = $(this).parent('form');
		Swal.fire({
			title: "Bạn có chắc chắn muốn hủy đơn hàng?",
            type: 'warning',
           	confirmButtonText: 'Có',
           	showCancelButton: true,
           	cancelButtonText: 'Không',
           	cancelButtonColor: 'red',
           	preConfirm: function() {
           		form.submit();
			}
		})
	})
</script>
@stop()