@extends('frontend.main')

@section('content')




<div class="px-5">
	<div class="container-fluid">
		<div class="row  my-1 border rounded bg-white">
			<div class="col-lg-8">
				<div id="carouselExampleInterval" class="row carousel slide p-1" data-ride="carousel">
					<div class="carousel-inner">
						@foreach($banner as $bann)
						<div class="carousel-item {{ ($bann->id==$banner->first()->id)?'active':'' }}">
							<a href="{{$bann->link}}">
								<img src="{{asset('public')}}/uploads/banners/{{$bann->image}}" class="d-block w-100  rounded" alt="...">
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
			<div class="col-lg-4">
				<div class="row ">
					@foreach($bnp as $bnp)
					<a href="" class="m-1">
						<img src="{{asset('public')}}/uploads/banners/{{$bnp->image}}" class="img-fluid rounded" alt="Responsive image" >
					</a>
					@endforeach
				</div>


			</div>

		</div>
	</div>


	<div class="my-3">
		<div class="container-fluid">
			<div class="row border rounded bg-white">
				@foreach($category_all as $cate)
				<div class="col-lg-2 border p-3 d-flex justify-content-center text-center">
					<form action="{{route('home.category',$cate->slug)}}" >
						<input type="hidden" name="categoryID" value="{{ $cate->id }}">
						<button type="submit" class="btn">
						 	<div src="..." alt="..." class="rounded-circle" style="background-color: #e5e1ea; width: 90px; height: 90px" >
								<img src="{{url('public')}}/uploads/logos/{{$cate->logo}}" alt="" class="m-3" width="60%">
							</div>
							{{$cate->name}}
						</button>
					</form>
					
				</div>
				@endforeach
			</div>
		</div>
	</div>
	<!-- khuyến mãi đặc biệt -->
	<div>
		<div class="container-fluid border rounded p-4 bg-white my-3">
			<h2 class="text-danger font-weight-bold"><i class="fa fa-fire" aria-hidden="true"></i> KHUYẾN MÃI HOT</h2>
			<hr>
			<div class="row row-cols-1 row-cols-lg-4">
				@foreach($host_sale as $product_detail)
					<div class="col rounded" >
				<form action="{{route('cart.addOne')}}" method="POST">
					@csrf
						<div class="card row border-white">
							<a href="{{route('home.product',[$product_detail->product->brand->category->slug,$product_detail->product->slug])}}" class=" card-img-top text-center" >
								<img src="{{asset('public')}}/uploads/products/{{$product_detail->product->image}}" class=" img-fluid" alt="..." style="max-width: 220px">
							</a>
							<div>
								<span class="text-white px-1 bg-warning rounded-lg text-center ml-3" {{ $product_detail->sale_price==0 ? "hidden" : ""}}>giảm 
									<span>{{number_format($product_detail->sale_price, 0 , ',', '.')}}</span> ₫ 
								</span>
							</div>
							<div class="card-body px-3 py-2">
								<h5 class="card-title text-dark">{{$product_detail->product->name}} <span id="RAM">{{$product_detail->ram}}</span>-<span id="MEMORY">{{$product_detail->memory}}</span></h5>
								<div >
									<span class="text-white px-3 py-0 bg-danger rounded-pill text-center form-control-lg mr-3" >
										<span>{{number_format($product_detail->price-$product_detail->sale_price, 0 , ',', '.')}}</span> ₫
									</span> 
									<del {{ $product_detail->sale_price==0 ? "hidden" : ""}}>
										<span>{{number_format($product_detail->price, 0 , ',', '.')}}</span> ₫
									</del>
								</div>
							</div>
						</div>

						<div class="text-center an_mua float-left mt-1">
							<!-- Thêm giỏ hàng -->
							<input type="text" name="pro_detail_id" value="{{$product_detail->id}}" hidden>
							<button  class="btn btn-warning addCart" type="submit" name="action" value="addCart" title="Thêm vào giỏ hàng"><i class="fa fa-shopping-cart text-white"></i></button>
								
							<!-- Thêm giỏ hàng va chuyển đén trang giỏ hàng -->
							<button  class="btn btn-danger" type="submit" name="action" value="buyNow">Mua Ngay</button>

							<!-- so sáng sản phẩm -->
				</form>
						</div>
						<div class="float-left ml-1 mt-1 an_mua">
							<form action="{{ route('home.compare')}}" method="get" class="float-left">
								<input type="hidden" name="PRODUCT1" value="{{ $product_detail->product->id }}">
								<button class="btn btn-secondary" type="submit">so sánh </button>
							</form>

							@if(Auth::guard('user')->check())

									<!-- wish list -->

								<a class="float-left ADDWL{{ $product_detail->product->id }}" {{ (count($product_detail->product->wish_list->where('user_id',Auth::guard('user')->user()->id))>0)?"hidden":"" }} onclick="ADDWL({{ Auth::guard('user')->user()->id }},{{ $product_detail->product->id }})">
									<i class="fa fa-heart-o text-danger p-1" aria-hidden="true" style="font-size:30px;" ></i>
								</a>
								<a class="float-left DELLWL{{ $product_detail->product->id }}" {{ (count($product_detail->product->wish_list->where('user_id',Auth::guard('user')->user()->id))>0)?"":"hidden" }}  onclick="DELLWL({{ Auth::guard('user')->user()->id }},{{$product_detail->product->id }})">
									<i class="fa fa-heart text-danger p-1" aria-hidden="true" style="font-size:30px;"></i>
								</a>
							@endif
							</div>
					</div>
				@endforeach
				</div>
			</div>
		</div>
		<!-- điện thoại nổi bật -->
		@foreach($category_all as $cate)
		<div>
			<div class="container-fluid border rounded p-4 bg-white my-3">
				<h2 class="font-weight-bold"></i> {{ $cate->name }} NỔI BẬT</h2>
				<!-- <a href="{{route('home.category',$cate->slug)}}"> xem tất cả</a> -->
				<form action="{{route('home.category',$cate->slug)}}">
					<input type="hidden" name="categoryID" value="{{ $cate->id }}">
					 <button type="submit" class="btn text-danger p-0">
				 	Xem tất cả
				 </button>
				</form>
				<hr>
				<div class="row row-cols-1 row-cols-lg-4">
					@foreach($cate->brand as $brand)
					@foreach($brand->product->where('status',1)->take(2) as $product)
						<div class="col rounded PRODUCT_ID" >
					<form action="{{route('cart.addOne')}}" method="POST">
						@csrf
							<div class="card border-white">
								<a href="{{route('home.product',[$product->brand->category->slug,$product->slug])}}" class="card-img-top text-center" style="text-decoration: none;">
									<img src="{{asset('public')}}/uploads/products/{{$product->image}}" class=" img-fluid" alt="..." style="max-width: 220px">
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

									
									<!-- <a  class="btn btn-secondary"href="{{ route('home.compare',[$product->id,0]) }}">so sánh</a> -->
									<!-- Nút thêm giỏ hàng và chuyển đến trang giỏ hàng -->
									<button type="submit" class="btn btn-danger" name="action" value="buyNow">Mua Ngay</button>

								</form>

								<!-- so sáng sản phẩm -->
							</div>
							<div class="float-left ml-1 an_mua mt-1">
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
						@endforeach

					</div>
				</div>

			</div>
			@endforeach
			<!-- laptop ban chay -->

			<!-- table nổi bật -->

		</div>


		@stop()	