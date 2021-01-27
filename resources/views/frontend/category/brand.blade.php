@extends('frontend.main')

@section('content')


		<div class="px-5">
			<div class="container-fluid">
				Trang chủ / {{$category->name}}/{{$brand->name}}
				<div class="row  my-1 border rounded bg-white">
					<div class="col-lg-12">

						<div id="carouselExampleInterval" class="row carousel slide p-1" data-ride="carousel">
							<div class="carousel-inner">
								
								@foreach($bannerCate as $banner)
								<div class="carousel-item {{ ($banner->id==$bannerCate->first()->id)?'active':'' }}">
									<a href="">
										<img src="{{asset('public')}}/uploads/banners/{{$banner->image}}" class="d-block w-100 rounded" alt="...">
									</a>

								</div>
								@endforeach
							</div>
							<a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
					
					
				</div>
				
			</div>
		
		
			<div class="container-fluid">
				<div class="row">
				<div class="col-lg-2 py-4">
							<form action="" method="POST" role="form">
								<h5>Hãng sản xuất</h5>
								<div > 
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option0" checked>
										<label class="form-check-label" for="inlineCheckbox1">Tất cả</label>
									</div>
									@foreach($category->brand as $brand)
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="inlineCheckbox{{$brand->id}}" value="{{$brand->id}}">
										<label class="form-check-label" for="inlineCheckbox{{$brand->id}}">{{$brand->name}}</label>
									</div>
									@endforeach
								</div>
								<!-- <button type="submit" class="btn btn-primary">Submit</button> -->
							</form>

							<form action="" method="POST" role="form">
								<h5 class="pt-4">Mức giá</h5>
								<div > 
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option0" checked>
										<label class="form-check-label" for="inlineCheckbox1">Tất cả</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
										<label class="form-check-label" for="inlineCheckbox1">Dưới 2 triệu</label>
									</div>
									<div class="form-check  ">
										<input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
										<label class="form-check-label" for="inlineCheckbox2">2 đến 6 triệu</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
										<label class="form-check-label" for="inlineCheckbox1">6 đến 10 triệu</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
										<label class="form-check-label" for="inlineCheckbox2">10 đến 15 triệu</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
										<label class="form-check-label" for="inlineCheckbox2">Trên 15 triệu</label>
									</div>
									
								</div>
								<!-- <button type="submit" class="btn btn-primary">Submit</button> -->
							</form>
						
						
					</div>

					<div class="col-lg-9">
						<div class="row">
							<div class="container-fluid border rounded p-4 bg-white my-3">
								<div class="row">
									<div class="col-lg-8">
										<legend><h2 class="">Điện thoại <span class="form-control-sm text-black-50"> ({{ count($product) }} sản phẩm)</span>
										</h2></legend>
									</div>
									<div class="col-lg-4">
										<div class="row">
											<div class="col-lg-5">Ưu tiên xem: </div>
												<select class="custom-select custom-select-lg|custom-select-sm col-lg-7">
													<option selected></option>
													<option value="1">giá cao</option>
													<option value="2">giá thấp</option>
												</select>
										</div>
									</div>
								</div>
								<hr>
								<div class="row row-cols-1 row-cols-lg-3">
						@foreach($product as $product)
						<form action="{{route('cart.addOne')}}" method="POST">
							@csrf
							<div class="col rounded">
						<div class="card border-white">
							<a href="{{route('home.product',$product->id)}}" style="text-decoration: none;">
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
								<input type="radio" hidden name="pro_detail_id" value="{{$detail->id}}" {{ ($detail->id==$product->product_detail->first()->id)?'checked': ''}} >
    							</label>
								@endforeach
								</div>
								@else
								<input type="radio" hidden name="pro_detail_id" value="{{$product->product_detail->first()->id}}" checked>
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
					<div class="text-center an_mua">

						<!-- Nút thêm giỏ hàng -->
						<button type="submit" class="btn btn-warning" name="action" value="addCart"><i class="fa fa-shopping-cart text-white" ></i></button>
						
						<!-- Nút thêm giỏ hàng và chuyển đến trang giỏ hàng -->
						<button type="submit" class="btn btn-danger" name="action" value="buyNow">Mua Ngay</button>
						</form>
						<!-- so sáng sản phẩm -->

								<form action="{{ route('home.compare')}}" method="get" class="float-left">
										<input type="hidden" name="PRODUCT1" value="{{ $product->id }}">
										<button class="btn btn-secondary" type="submit">so sánh </button>
								</form>


								@if(Auth::guard('user')->check())
								@if(count($product->wish_list->where('user_id',Auth::guard('user')->user()->id))>0)

								<form action="{{route('wish_list.destroy',$wish_list_all->Where('product_id',$product->id)->first()->id)}}" method="POST"
									class="float-left" >
									@csrf @method('DELETE')
									<input type="text" name="user_id" value="{{ Auth::guard('user')->user()->id }}" hidden>
									<input type="text" name="product_id"  value="{{ $product->id }}" hidden>
									<button type="submit" class="border-0 p-0 bg-white"><i class="fa fa-heart text-danger p-1" aria-hidden="true" style="font-size:30px;"></i></button>
								</form>

								@else
								<form action="{{route('wish_list.store')}}" method="POST" class="float-left">
									@csrf 
									<input type="text" name="user_id" value="{{ Auth::guard('user')->user()->id }}" hidden>
									<input type="text" name="product_id"  value="{{ $product->id }}" hidden>
									<button type="submit" class="border-0 p-0 bg-white"><i class="fa fa-heart-o text-danger p-1" aria-hidden="true" style="font-size:30px;"></i></button>
								</form>
								@endif
								@endif
					</div>

				</div>
						@endforeach
						
									

									</div>
								</div>
							</div>

						</div>
					</div>
					
				</div>
				
				
				
			</div>
		</div>

@stop()