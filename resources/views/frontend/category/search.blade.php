@extends('frontend.main')

@section('content')


<div class="px-5">
	<div class="container-fluid">
		Trang chủ / Search
		
	</div>
	<div class="container-fluid">
		<div class="row">
			
			
					<div class="container-fluid border rounded p-4 bg-white my-3">
						<div class="row">
							<div class="col-lg-8">
								<legend><h2 class="">Tìm thấy <span class="form-control-sm text-black-50">{{ $count }} sản phẩm</span>
								</h2></legend>
							</div>
							<!-- <div class="col-lg-4">
								<div class="row">
									<div class="col-lg-5">Ưu tiên xem: </div>
									<select class="custom-select custom-select-lg|custom-select-sm col-lg-7">
										<option selected></option>
										<option value="1">giá cao</option>
										<option value="2">giá thấp</option>

									</select>

								</div>


							</div> -->

						</div>

						<hr>

						<div class="row row-cols-1 row-cols-lg-4">
							
							@foreach($products as $product)
						<div class="col rounded PRODUCT_ID"  >
								<form action="{{route('cart.addOne')}}" method="POST">
						@csrf
							<div class="card border-white">
								<a href="{{route('home.product', [$product->brand->category->slug,$product->slug])}}" style="text-decoration: none;">
									<img src="{{asset('public')}}/uploads/products/{{$product->image}}" class="card-img-top img-fluid px-4" alt="...">
								</a>
								<div>
									<span class="text-white px-1 py-0 bg-warning rounded-lg text-center HIDDENSALEPRICE{{ $product->id }}"  {{ $product->product_detail->first()->sale_price==0 ? "hidden" : ""}}>giảm <span id="SALE_PRICE{{ $product->id }}">{{number_format( $product->product_detail->first()->sale_price  , 0 , ',', '.')}}</span> ₫</span>
								</div>
								<div class="card-body p-0">
									<h5 class="card-title text-dark">{{$product->name}} <span id="RAM{{$product->id}}">{{ $product->product_detail->first()->ram }}</span>
										<span>-</span>
										<span id="MEMORY{{$product->id}}">{{ $product->product_detail->first()->memory }}</span></h5>
										@if(count($product->product_detail->where('status',1)) >1)
										<div class="btn-group mr-2" role="group" aria-label="First group" id="PRODUCT{{ $product->id }}">
											@foreach($product->product_detail as $detail)

											<label class="form-check-label btn MEMORY{{ $product->id }} {{ ($detail->id==$product->product_detail->first()->id)?'btn-secondary': 'btn-outline-secondary'}}" id="DETAIL{{$detail->id}}" onclick="clickShowDetailEveryWhere({{  $detail->product->id }},{{  $detail->id }},3)" 
												ID_DETAIL{{  $detail->id }}="{{  $detail->id }}" 
												RAM{{  $detail->id }}="{{  $detail->ram }}" 
												MEMORY{{  $detail->id }}="{{  $detail->memory }}" 
												PRICE{{  $detail->id }}="{{  number_format($detail->price - $detail->sale_price, 0 , ',', '.') }}" 
												SALE_PRICE{{  $detail->id }}="{{  number_format($detail->sale_price , 0 , ',', '.') }}" 
												OLDPRICE{{ $detail->id }}="{{  number_format($detail->price, 0 , ',', '.') }}"  
												CPU{{  $detail->id }}="{{  $detail->cpu }}">
												{{  $detail->memory }}
												
												<input type="radio" name="pro_detail_id" value="{{  $detail->id }}" {{ ($detail->id==$product->product_detail->first()->id)?'checked': ''}} hidden>
											</label>
											@endforeach
										</div>
										@else
										 <input type="radio" name="pro_detail_id" value="{{$product->product_detail->where('status',1)->first()->id}}" checked hidden>
										@endif
										<div >
											<span class="text-white px-3 py-0 bg-danger rounded-pill text-center form-control-lg mr-3" ><span id="PRICE{{$product->id }}">{{  number_format($product->product_detail->first()->price - $product->product_detail->first()->sale_price , 0 , ',', '.')}}</span> ₫</span> 

											<del class="HIDDENSALEPRICE{{ $product->id }}"  {{ $product->product_detail->first()->sale_price==0 ? "hidden" : ""}}><span id="OLDPRICE{{$product->id }}">{{  number_format($product->product_detail->first()->price , 0 , ',', '.') }}</span> ₫</del> 

										</div>
									</div> 
									<div class="text-success">

										@if($product->screen_size)
										<i class="fa fa-desktop mt-2" aria-hidden="true"><span>{{ $product->screen_size }}</span>  </i>
										@endif
										@if($product->gpu) 
										<i class="fa fa-credit-card-alt  m-2" aria-hidden="true" > <span>{{ $product->gpu }}</span></i>
										@endif
										<i class="fa fa-microchip mt-2" aria-hidden="true" ></i><span class="ram{{$product->id}}" id="ram{{$product->id}}">{{ $product->product_detail->first()->ram }}</span>
										<i class="fa fa-server mt-2" aria-hidden="true" ></i><span id="memory{{$product->id}}">{{ $product->product_detail->first()->memory }}</span>
										<i class="fa fa-codepen mt-2" aria-hidden="true"></i><span id="CPU{{ $product->id }}">{{ $product->product_detail->first()->cpu }}</span>
									</div> 

								</div>

								<div class="text-center an_mua float-left mt-1">

									<!-- Nút thêm giỏ hàng -->
									<button  type="submit" class="btn btn-warning addCart" name="action" value="addCart" ><i class="fa fa-shopping-cart text-white" ></i></button>
									
									<!-- Nút thêm giỏ hàng và chuyển đến trang giỏ hàng -->
									<button type="submit" class="btn btn-danger" name="action" value="buyNow">Mua Ngay</button>
							</div>
								</form>

								<!-- so sáng sản phẩm -->
								<div class="float-left mt-1 ml-1 an_mua">
								<form action="{{ route('home.compare')}}" method="get" class="float-left">
										<input type="hidden" name="PRODUCT1" value="{{ $product->id }}">
										<button class="btn btn-secondary" type="submit">so sánh </button>
								</form>


								
								@if(Auth::guard('user')->check())

									<!-- wish list -->

									<a class="float-left ADDWL{{ $product->id }}" {{ (count($product->wish_list->where('user_id',Auth::guard('user')->user()->id))>0)?"hidden":"" }} onclick="ADDWL({{ Auth::guard('user')->user()->id }},{{ $product->id }})">
										<i class="fa fa-heart-o text-danger p-1" aria-hidden="true" style="font-size:30px;" ></i>
									</a>
									<a class="float-left DELLWL{{ $product->id }}" {{ (count($product->wish_list->where('user_id',Auth::guard('user')->user()->id))>0)?"":"hidden" }}  onclick="DELLWL({{ Auth::guard('user')->user()->id }},{{ $product->id }})">
										<i class="fa fa-heart text-danger p-1" aria-hidden="true" style="font-size:30px;"></i>
									</a>



								@endif
								</div>

						</div>

								@endforeach
								
							</div>
						</div>
						</div>
						{{$products->appends(request()->input())->links()}}
				</div>


	</div>
</div>

@stop()