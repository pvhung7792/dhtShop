@extends('frontend.main')

@section('content')		
		<div>
			<div class="container bg-white p-5 my-3">
				<div class="row">
					<div class="col-lg-6"><h4>GIỎ HÀNG CỦA BẠN <span style="font-size: 16px">({{count($cart_data->items)}} sản phẩm)</span></h4>
					</div>
					 <div class="col-md-8">
					<table class="table">
						<thead>
							<th>Tên sản phẩm</th>
							<th>Ảnh sản phẩm</th>
							<th>Đơn giá</th>
							<th>Số lượng</th>
							<th>Thành tiền</th>
						</thead>
						<tbody>
							@if($cart_data!='')
							@foreach($cart_data->items as $pro_detail_id => $data)
							@foreach($data as $pro_color_id =>$cart)
							<tr class="siglePro">
								<th>
									{{$cart['name']}}
								</th>
								<td>
									<div class="p-2"><img src="{{url('public')}}/Uploads/product_colors/{{$cart['image']}}" alt="" height="70px"></div>
								</td>
								<td>{{number_format($cart['price'])}} VNĐ</td>
								<td>
									{{$cart['quantity']}}
								</td>
								<td>
									{{number_format($cart['price']*$cart['quantity'])}}
								</td>
							</tr>
							@endforeach
							@endforeach
							@else
								<p>Giỏ hàng hiện chưa có mặt hàng nào</p>
							@endif
							<tr>
								<td colspan="3"></td>
								<td colspan="2">Tổng tiền: <span class="text-danger font-weight-bold"> {{number_format($cart_data->total_price)}}</span></td>
								
							</tr>
						</tbody>
					</table>
					</div>
					<div class="col-md-4">
						<div>
							<h5 class="text-danger">Thông tin liên hệ nhận hàng: </h5>
							<form class="form-horizontal" action="{{route('cart.checkout')}}" method="POST">
								@csrf
								<input type="text" name="user_id" value="{{$user->id}}" hidden>
								<div class="form-group">
									<div class="col-sm-10">
									<label class="control-label">Email</label>
										<input type="email" id="email" name="email" value="{{old('email')}}" class="form-control" placeholder="nhập email..."></input>
										@error('email')
			                            <small class="help-block text-danger">{{$message}}</small>
			                            @enderror 
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-10">
									<label for="inputPassword" class="control-label">Người nhận</label>
										<input type="text" class="form-control" value="{{old('name')}}" name="name" id="name" placeholder="nhập tên người nhận...">
										@error('name')
			                            <small class="help-block text-danger">{{$message}}</small>
			                            @enderror
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-10">
									<label for="inputPassword" class="control-label">Địa chỉ</label>
										<input type="text" class="form-control" value="{{old('address')}}" name="address" id="address" placeholder="Địa chỉ nhận hàng...">
										@error('address')
			                            <small class="help-block text-danger">{{$message}}</small>
			                            @enderror
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-10">
									<label for="inputPassword" class="control-label">Số điện thoại</label>
										<input type="text" class="form-control" value="{{old('phone')}}" name="phone" id="phone" placeholder="Số điện thoại...">
										@error('phone')
			                            <small class="help-block text-danger">{{$message}}</small>
			                            @enderror
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-10">
									<label for="phone" class="control-label">Ghi chú</label>
										<textarea name="note" id="input" class="form-control" rows="3">{{old('note')}}</textarea>
									</div>
								</div>
								<div class="form-group">
									<button id="myAddress" class="btn btn-primary float-left" type="button">Sử dụng địa chỉ của bạn</button>
									<button id="myAddress" class="btn btn-warning float-left ml-2" type="reset">Đặt lại</button>
								</div>
								<div class="text-center">
									<button type="submit" class="p-3 border text-white bg-danger mt-3" width="70px">ĐẶT HÀNG</button>
								</div>
							</form>
						</div>
					</div>
					</div>
				</div>
			</div>


			<script type="text/javascript">
				jQuery(document).ready(function() {
					var email = "{{$user->email}}";
					var name = "{{$user->first_name}}"+" "+"{{$user->last_name}}";
					var address = "{{$user->address}}";
					var phone = "{{$user->phone}}";
					$('#myAddress').click(function(){
						// e.preventDefault();
						$('#email').val(email);
						$('#name').val(name);
						$('#address').val(address);
						$('#phone').val(phone);
					});

				});
			</script>


	@stop()		