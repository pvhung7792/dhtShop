@extends('frontend.main')

@section('content')


<div class="px-5">
	<div class="container-fluid">
		Trang chủ / {{$category->name}}
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
	<form action="" method="get"  id="FormSLDK">
							<input type="hidden" name="categoryID" value="{{ $category->id }}">
	<div class="container-fluid">
		

		<div class="row">
			<div class="col-lg-2 py-4">
				
					<h5>Hãng sản xuất {{ count($brand)}}</h5>
					<div > 
						
							
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="brandall" name="brandall" value="0" {{count($arr_brand)== count($brand)  ?"checked" :"" }}>
								<label class="form-check-label" for="inlineCheckbox1">Tất cả</label>
							</div>
						
						
							<input type="hidden" name="categoryID" value="{{ $category->id }}">
						@foreach($brand as $bran)
						<div class="form-check">
								<input class="form-check-input BRANDid" type="checkbox" name="BRANDid[]" value="{{$bran->id}}" @if(count($arr_brand)!= count($brand) && in_array($bran->id, $arr_brand)) {{ "checked"}} @endif>
								<label class="form-check-label" >{{$bran->name}}</label>
						</div>
						@endforeach
						
					</div>
					<!-- <button type="submit" class="btn btn-primary">Submit</button> -->
				</form>
<script type="text/javascript">
	
	/*$('input#brandall').click(function(){
		console.log(!$('input#brandall').checked);
		if(!$('input#brandall').checked){
			$("#FormSLDK").submit();
		}else{
			$('input#brandall').prop('checked',true);
		}
		
		
	});*/
	
</script>
				
					<h5 class="pt-4">Mức giá</h5>
					<div > 
						<div class="form-check ">
							<input class="form-check-input PriceAll" type="radio" name="priceAll" value="0" {{ ($pricelevel<1)?'checked':""}}>
							<label class="form-check-label" for="inlineCheckbox1">Tất cả</label>
						</div>
						<div class="form-check ">
							<input class="form-check-input PriceOne" type="radio" name="price" id="price1" value="1" {{($pricelevel==1)?"checked":"" }}>
							<label class="form-check-label" >Dưới 5 triệu</label>
						</div>
						<div class="form-check  ">
							<input class="form-check-input PriceOne" type="radio" name="price" id="price2" value="2" {{($pricelevel==2)?"checked":"" }}>
							<label class="form-check-label" >5 đến 10 triệu</label>
						</div>
						<div class="form-check ">
							<input class="form-check-input PriceOne" type="radio" name="price" id="price3" value="3" {{($pricelevel==3)?"checked":"" }}>
							<label class="form-check-label" >10 đến 15 triệu</label>
						</div>
						<div class="form-check ">
							<input class="form-check-input PriceOne" type="radio" name="price" id="price4" value="4" {{($pricelevel==4)?"checked":"" }}>
							<label class="form-check-label" >15 đến 20 triệu</label>
						</div>
						<div class="form-check ">
							<input class="form-check-input PriceOne" type="radio" name="price" id="price5" value="5" {{($pricelevel==5)?"checked":"" }}>
							<label class="form-check-label" >Trên 20 triệu</label>
						</div>

					</div>
					<!-- <button type="submit" class="btn btn-primary">Submit</button> -->
				


			</div>
			<script type="text/javascript">
				

			</script>
			<div class="col-lg-10">
				<div class="row">
					<div class="container-fluid border rounded p-4 bg-white my-3">
						<div class="row">
							<div class="col-lg-8">
								<legend><h2 class="">{{$category->name}} <span class="form-control-sm text-black-50"></span>
								</h2></legend>
							</div>
							<div class="col-lg-4">
								<div class="row">
									<div class="col-lg-5">Ưu tiên xem: </div>
									
										<select class="custom-select custom-select-lg|custom-select-sm col-lg-7" name="THSLDK" id="THSLDK">
											<option value="0"></option>
											<option value="1" {{ ($SapXepDK==1)?"selected":"" }}>mới nhất</option>
											<option value="2" {{ ($SapXepDK==2)?"selected":"" }}>cũ nhất</option>
											<option value="3" {{ ($SapXepDK==3)?"selected":"" }}>giá cao</option>
											<option value="4" {{ ($SapXepDK==4)?"selected":"" }}>giá thấp</option>

										</select>
									</form>
								</div>
								<script type="text/javascript"> 
									
								</script>

							</div>

						</div>

						<hr>

						<div class="row row-cols-1 row-cols-lg-3">
							
							@foreach($product->where('status',1) as $prod)
						<div class="col rounded PRODUCT_ID"  >
							<form action="{{route('cart.addOne')}}" method="POST">
						@csrf
							<div class="card border-white">
								<a href="{{route('home.product',[$prod->brand->category->slug,$prod->slug])}}" style="text-decoration: none;">
									<img src="{{asset('public')}}/uploads/products/{{$prod->image}}" class="card-img-top img-fluid px-4" alt="...">
								</a>
								<div>
									<span class="text-white px-1 py-0 bg-warning rounded-lg text-center HIDDENSALEPRICE{{ $prod->id }}"  {{ $prod->product_detail->first()->sale_price==0 ? "hidden" : ""}}>giảm <span id="SALE_PRICE{{ $prod->id }}">{{number_format( $prod->product_detail->first()->sale_price  , 0 , ',', '.')}}</span> ₫</span>
								</div>
								<div class="card-body p-0">
									<h5 class="card-title text-dark">{{$prod->name}} <span id="RAM{{$prod->id}}">{{ $prod->product_detail->first()->ram }}</span>
										<span>-</span>
										<span id="MEMORY{{$prod->id}}">{{ $prod->product_detail->first()->memory }}</span></h5>
										@if(count($prod->product_detail->where('status',1)) >1)
										<div class="btn-group mr-2" role="group" aria-label="First group" id="PRODUCT{{ $prod->id }}">
											@foreach($prod->product_detail as $detail)

											<label class="form-check-label btn MEMORY{{ $prod->id }} {{ ($detail->id==$prod->product_detail->first()->id)?'btn-secondary': 'btn-outline-secondary'}}" id="DETAIL{{$detail->id}}" onclick="clickShowDetailEveryWhere({{  $detail->product->id }},{{  $detail->id }},3)" 
												ID_DETAIL{{  $detail->id }}="{{  $detail->id }}" 
												RAM{{  $detail->id }}="{{  $detail->ram }}" 
												MEMORY{{  $detail->id }}="{{  $detail->memory }}" 
												PRICE{{  $detail->id }}="{{  number_format($detail->price - $detail->sale_price, 0 , ',', '.') }}" 
												SALE_PRICE{{  $detail->id }}="{{  number_format($detail->sale_price , 0 , ',', '.') }}" 
												OLDPRICE{{ $detail->id }}="{{  number_format($detail->price, 0 , ',', '.') }}"  
												CPU{{  $detail->id }}="{{  $detail->cpu }}">
												{{  $detail->memory }}
												
												<input type="radio" name="pro_detail_id" value="{{  $detail->id }}" {{ ($detail->id==$prod->product_detail->first()->id)?'checked': ''}} hidden>
											</label>
											@endforeach
										</div>
										@else
										 <input type="radio" name="pro_detail_id" value="{{$prod->product_detail->where('status',1)->first()->id}}" checked hidden>
										@endif
										<div >
											<span class="text-white px-3 py-0 bg-danger rounded-pill text-center form-control-lg mr-3" ><span id="PRICE{{$prod->id }}">{{  number_format($prod->product_detail->first()->price - $prod->product_detail->first()->sale_price , 0 , ',', '.')}}</span> ₫</span> 

											<del class="HIDDENSALEPRICE{{ $prod->id }}"  {{ $prod->product_detail->first()->sale_price==0 ? "hidden" : ""}}><span id="OLDPRICE{{$prod->id }}">{{  number_format($prod->product_detail->first()->price , 0 , ',', '.') }}</span> ₫</del> 

										</div>
									</div> 
									<div class="text-success">

										@if($prod->screen_size)
										<i class="fa fa-desktop mt-2" aria-hidden="true"><span>{{ $prod->screen_size }}</span>  </i>
										@endif
										@if($prod->gpu) 
										<i class="fa fa-credit-card-alt  m-2" aria-hidden="true" > <span>{{ $prod->gpu }}</span></i>
										@endif
										<i class="fa fa-microchip mt-2" aria-hidden="true" ></i><span class="ram{{$prod->id}}" id="ram{{$prod->id}}">{{ $prod->product_detail->first()->ram }}</span>
										<i class="fa fa-server mt-2" aria-hidden="true" ></i><span id="memory{{$prod->id}}">{{ $prod->product_detail->first()->memory }}</span>
										<i class="fa fa-codepen mt-2" aria-hidden="true"></i><span id="CPU{{ $prod->id }}">{{ $prod->product_detail->first()->cpu }}</span>
									</div> 

								</div>

								<div class="text-center an_mua mt-1 float-left">

									<!-- Nút thêm giỏ hàng -->
									<button  type="submit" class="btn btn-warning addCart" name="action" value="addCart" ><i class="fa fa-shopping-cart text-white" ></i></button>
									
									<!-- Nút thêm giỏ hàng và chuyển đến trang giỏ hàng -->
									<button type="submit" class="btn btn-danger" name="action" value="buyNow">Mua Ngay</button>

								</form>
								<!-- so sáng sản phẩm -->
								</div>
								<div class="float-left ml-1 mt-1 an_mua">
								<form action="{{ route('home.compare')}}" method="get" class="float-left">
										<input type="hidden" name="PRODUCT1" value="{{ $prod->id }}">
										<button class="btn btn-secondary" type="submit">so sánh </button>
								</form>

								@if(Auth::guard('user')->check())

									<!-- wish list -->

									<a class="float-left ADDWL{{ $prod->id }}" {{ (count($prod->wish_list->where('user_id',Auth::guard('user')->user()->id))>0)?"hidden":"" }} onclick="ADDWL({{ Auth::guard('user')->user()->id }},{{ $prod->id }})">
										<i class="fa fa-heart-o text-danger p-1" aria-hidden="true" style="font-size:30px;" ></i>
									</a>
									<a class="float-left DELLWL{{ $prod->id }}" {{ (count($prod->wish_list->where('user_id',Auth::guard('user')->user()->id))>0)?"":"hidden" }}  onclick="DELLWL({{ Auth::guard('user')->user()->id }},{{ $prod->id }})">
										<i class="fa fa-heart text-danger p-1" aria-hidden="true" style="font-size:30px;"></i>
									</a>



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

		

	
	<div class="row border rounded p-4 bg-white my-3">
			@foreach($brand as $bran)
			<form method="get" class=" float-left">
				<input type="hidden" name="BRANDid[]" value="{{ $bran->id }}">
				<input type="hidden" name="categoryID" value="{{ $category->id }}">
				 <button type="submit" class="btn">
			 	<img src="{{asset('public')}}/uploads/brands/{{$bran->logo}}" alt="" class="img-fluid" style="max-height: 50px">
			 	</button>
			</form>
			
			@endforeach

		</div>
</div>


@stop()