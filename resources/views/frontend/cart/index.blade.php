@extends('frontend.main')

@section('style')
<style>
	input[type=number] { 
		-moz-appearance: textfield;
		appearance: textfield;
		margin: 0; 
	}

	input[type=number]::-webkit-inner-spin-button, 
	input[type=number]::-webkit-outer-spin-button { 
		-webkit-appearance: none; 
		margin: 0; 
	}

	.quantity{
		display: flex;
	}

	.quantity button{
		background-color: #fff;
		border: solid 1px grey;
		width:27px;
	}
</style>
@stop

@section('content')		
<div>
	<div class="container bg-white p-5 my-3">
		@if(session('message'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>{{session('message')}}</strong> 
		</div>
		@endif
		<div class="row">
			<div class="col-lg-6"><h4>GIỎ HÀNG CỦA BẠN <span style="font-size: 16px">({{$cart_data->total_quantity}} sản phẩm)</span></h4>
			</div>
			<div class="col-lg-6 ">
				@if($cart_data->items !=[])
				<a href="" class="float-right">Mua thêm sản phẩm khác</a>
				@endif
			</div>
		</div>
		@if($cart_data->items != [])
		<table class="table">
			<tbody>
				@foreach($cart_data->items as $pro_detai_id => $data)
				@foreach($data as $color_id =>$cart)
				<tr class="siglePro">
					<th>
						<div class="p-2"><img src="{{url('public')}}/Uploads/product_colors/{{$cart['image']}}" height="170px" ></div>
					</th>
					<td>
						<h4>{{$cart['name']}}</h4>
						<form action="" style="padding-top: 10px;">
							@foreach($cart['color_list'] as $color_list)
							<div class="float-left mr-2 text-center">
								<input 
								id="radio{{$cart['id']}}{{$color_id}}{{$color_list['color_name']}}" 
								type="radio" name="pro_color_id" value="{{$color_list['pro_color_id']}}" 
								{{$color_id == $color_list['pro_color_id']?'checked':''}}
								class="proColor" 
								proDetailId="{{$cart['id']}}" 
								proOldColorId="{{$color_id}}" 
								><br>
								<label for="radio{{$cart['id']}}{{$color_id}}{{$color_list['color_name']}}">
									<img src="{{url('public')}}/uploads/product_colors/{{$color_list['color_image']}}" height="50px"><br>
									{{$color_list['color_name']}}
								</label>
							</div>
							@endforeach
						</form>
					</td>
					<!-- <td>Số lượng: {{$cart['quantity']}}</td> -->
					<td>{{number_format($cart['price'])}} VNĐ</td>
					<td>
						<div class="quantity">
							<button style="border-right: none" class="down-btn">-</button>
							<input type="number" class="text-center proQty" value="{{$cart['quantity']}}" style="width: 30px;" proDetailId="{{$cart['id']}}" proColorId="{{$color_id}}" min="0" max="10">
							<button style="border-left: none" class="up-btn">+</button>
						</div>
					</td>
					<td>
						{{number_format($cart['price']*$cart['quantity'])}}
					</td>
					<td>
						<a type="button" class="btn ml-3 font-weight-bold text-danger" href="{{route('cart.delete',[$cart['id'],$color_id])}}">x</a>
					</td>
				</tr>
				@endforeach
				@endforeach
				<tr>
					<td colspan="2"></td>
					<td colspan="2" ><span class="float-right">Tổng tiền:  <span class="text-danger font-weight-bold mx-3"> {{number_format($cart_data->total_price)}}</span></td></span>
				</tr>
			</tbody>
		</table>
		<div class="text-center">
			<a class="p-3 border text-white bg-danger btn" width="70px" href="{{route('cart.purchase')}}">ĐẶT HÀNG LUÔN</a>
		</div>
		@else
		<div class="text-center">
			<h4>Giỏ hàng hiện chưa có mặt hàng nào</h4>
			<a href="{{route('home')}}">Ấn vào đây để về trang chủ</a>
		</div>
		@endif
	</div>
</div>
</div>


<script type="text/javascript">
	jQuery(document).ready(function() {
		$('.new_address').click(function(){
			$('.new_addre').show();
			$('.old_addre').hide();
		});
		$('.old_address').click(function(){
			$('.old_addre').show();
			$('.new_addre').hide();
		});
	});

	$(".proQty").each(function(){
		$(this).change(function(){
			let qty = $(this).val();
			let proDetailId = $(this).attr('proDetailId');
			let proColorId = $(this).attr('proColorId');
			// console.log(proDetailId+proColor);
			window.location.href = "update-cart-qty/"+proDetailId+"/"+proColorId+"/"+qty;
			// console.log('ok');
		})
	})

	$(".proColor").each(function(){
		$(this).change(function(){
			let proNewColorID = $(this).val();
			let proDetailId = $(this).attr('proDetailId');
			let proOldColorId = $(this).attr('proOldColorId');
						// let proColorId = $(this).attr('proColorId');
						// console.log(proDetailId+proColor+proColorId);
			window.location.href = "update-cart-color/"+proDetailId+"/"+proOldColorId+"/"+proNewColorID;
		})
	})

	function updateQty(selector){
		let qty = $(selector).val();
		let proDetailId = $(selector).attr('proDetailId');
					// let proColor = $(selector).attr('proColor');
					let proColorId = $(selector).attr('proColorId');
					// console.log(proDetailId+proColor+proColorId);
					window.location.href = "update-cart-qty/"+proDetailId+"/"+proColorId+"/"+qty;
					// console.log('ok');
				}


	$(".down-btn").click(function(e){
		let qty = $(this).next().val();
			   // qty += 1;
		$(this).next().val(qty-1);

		let selector = $(this).next();
		updateQty(selector);
	})

	$(".up-btn").click(function(e){
		let qty = $(this).prev().val();
		// if (qty<10) {
			qty = Number(qty) + 1 ;
			$(this).prev().val(qty);
			let selector = $(this).prev();
			updateQty(selector);
		// }else{
		// 	alert('Bạn chỉ được mua tối đa 10 sản phẩm');
		// }
	})
</script>


@stop()		