@extends('frontend.main')

@section('content')		


		<div class="px-5">
			<div class="text-center p-3"><h1 >So sánh sản phẩm </h1>
			</div>
			<div class="container-fluid bg-white p-5 mb-3">

				

					
				
				@if(!empty($Pro1)|| !empty($Pro2))
				<div class="row my-3"> <!-- tên sản phẩm -->
					<div class="col-3"></div>
					<div class="col text-center">
						@if(!empty($Pro1))
							<h5 class="rounded bg-success p-2">{{ $Pro1->name }} <span id="RAM{{$Pro1->id}}">{{ $Pro1->product_detail->first()->ram }}</span> 
								<span id="MEMORY{{$Pro1->id}}"> {{ $Pro1->product_detail->first()->memory }}</span>

								<form action="{{ route('home.compare')}}" method="get" class="float-right">
									@if(!empty($Pro2))
										<input type="hidden" name="PRODUCT1" value="{{ $Pro2->id }}">
									@endif
										<button  type="submit" class="border-0 p-0 bg-success"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
								</form>
								</h5>
								<img src="{{ url('public') }}/uploads/products/{{ $Pro1->image }}" alt="" >
						
						
						@endif

					</div>
					<div class="col text-center">
						@if(!empty($Pro2)) <!-- name product -->
							<h5 class="rounded bg-success p-2">{{ $Pro2->name }} 
								<span id="RAM{{$Pro2->id . '_1'}}">{{ $Pro2->product_detail->first()->ram }}</span> 
								<span id="MEMORY{{$Pro2->id . '_1'}}"> {{ $Pro2->product_detail->first()->memory }}</span>
								<!-- so sáng sản phẩm -->

								<form action="{{ route('home.compare')}}" method="get" class="float-right">
									@if(!empty($Pro2))
										<input type="hidden" name="PRODUCT1" value="{{ $Pro1->id }}">
										@endif
										<button class="border-0 p-0 bg-success" type="submit"><i class="fa fa-times-circle float-right text-dark" aria-hidden="true"></i></button>
								</form>
								</h5>
								<img src="{{ url('public') }}/uploads/products/{{ $Pro2->image }}" alt="" >
								@else
								<form class="row form ml-1" action="{{ route('home.compare') }}" method="get" >
							
									<input class="form-control w-75"  type="text" placeholder="Search" aria-label="Search" id="searchname2" name="searchname" value="">
									<input type="hidden" name="PRODUCT1" value="{{ $Pro1->id }}">
									<input type="hidden" name="PRODUCT2" value="" id="PRODUCT2">
									<button class="btn btn-outline-dark my-sm-0 bg-dark text-white" type="submit" >
										<i class="fa fa-search " aria-hidden="true" ></i>
									</button>
								</form>
										<select id="PROList" class="w-75 ml-1 mt-0 custom-select float-left" hidden size="5">
									
										</select>
						@endif


					</div>
				</div>
				
				<div class="row text-center">
					<div class="col-3"></div>
					<div class="col">
						@if(!empty($Pro1))
							<p class="text-danger font-weight-bold"><span id="PRICE{{$Pro1->id }}">{{ $Pro1->product_detail->first()->price - $Pro1->product_detail->first()->sale_price }}</span>đ 
								<del id="OLDPRICE{{$Pro1->id }}" hidden>{{ $Pro1->product_detail->first()->price }}</del> <span class="text-white px-1 py-0 bg-warning rounded-lg text-center" hidden>giảm <span id="SALE_PRICE{{ $Pro1->id }}">{{ $Pro1->product_detail->first()->sale_price }}</span> ₫</span></p>
						@endif
					</div>
					<div class="col">
						@if(!empty($Pro2))
							<p class="text-danger font-weight-bold"><span id="PRICE{{$Pro2->id . '_1' }}">{{ $Pro2->product_detail->first()->price - $Pro2->product_detail->first()->sale_price }}</span>đ 
								<del id="OLDPRICE{{$Pro2->id . '_1' }}" hidden>{{ $Pro2->product_detail->first()->price }}</del> 
								<span class="text-white px-1 py-0 bg-warning rounded-lg text-center" hidden>giảm <span id="SALE_PRICE{{ $Pro2->id . '_1' }}">{{ $Pro2->product_detail->first()->sale_price }}</span> ₫</span></p>
						@endif
					</div>
				</div>

				<div class="row text-center"> <!-- logo màu sản phẩm -->
					<div class="col-3"></div>
					<div class="col">
						@if(!empty($Pro1))
							<!-- logo từng màu của sản phẩm -->
						@foreach($Pro1->product_color as $Procolor)
						<img src="{{ url('public') }}/uploads/product_colors/{{ $Procolor->logo }}" alt="" width="50px">
						@endforeach
						@endif
					</div>
					<div class="col">
						@if(!empty($Pro2))
							<!-- logo từng màu của sản phẩm -->
						@foreach($Pro2->product_color as $Procolor)
						<img src="{{ url('public') }}/uploads/product_colors/{{ $Procolor->logo }}" alt="" width="50px">
						@endforeach

						@endif
					</div>
				</div>
				<div class="row text-center">
					<div class="col-3"></div>
					<div class="col">
						@if(!empty($Pro1))
							<p class="m-3"><a href="{{ route('home.product',[$Pro1->brand->category->slug,$Pro1->slug]) }}">Xem chi tiết <i class="fa fa-chevron-right" aria-hidden="true"></i> </a></p>
						@endif
					</div>
					<div class="col">
						@if(!empty($Pro2))
							<p class="m-3"><a href="{{ route('home.product',[$Pro2->brand->category->slug,$Pro2->slug]) }}">Xem chi tiết <i class="fa fa-chevron-right" aria-hidden="true"></i> </a></p>
						@endif
					</div>
				</div>
				<div class="row border-bottom">
					<div class="col-3"><h4>Thông số kỹ thuật</h4></div>
					<div class="col">
								@if(!empty($Pro1))
								<div class="btn-group mr-2" role="group" aria-label="First group" id="PRODUCT">
								<form action="{{route('cart.addOne')}}" method="POST" id="form1">
									@csrf
								@foreach($Pro1->product_detail as $detail)
									<input type="hidden" name="action" value="buyNow">
    							<label type="button" class="btn MEMORY{{ $Pro1->id }} {{ ($detail->id==$Pro1->product_detail->first()->id)?'btn-secondary': 'btn-outline-secondary'}}" id="DETAIL{{$detail->id}}" onclick="clickShowDetailEveryWhere({{  $Pro1->id }},{{  $detail->id }})" 
    								IDPRODUCT_DETAIL{{  $detail->id }}="{{  $detail->id }}" 
    								RAM{{  $detail->id }}="{{  $detail->ram }}" 
    								MEMORY{{  $detail->id }}="{{  $detail->memory }}" 
    								PRICE{{  $detail->id }}="{{  $detail->price - $detail->sale_price }}" 
    								SALE_PRACE{{  $detail->id }}="{{  $detail->sale_price }}" 
    								OLDPRICE{{ $detail->id }}="{{  $detail->price }}"  
    								CPU{{  $detail->id }}="{{  $detail->cpu }}">
    								{{  $detail->memory }}

    								 <input type="radio" hidden name="pro_detail_id" value="{{  $detail->id }}" {{ ($detail->id==$Pro1->product_detail->first()->id)?'checked': ''}} >
    							</label>
								@endforeach
    								</form>
								</div>
								@endif
							</div>
					<div class="col"> 
						
								@if(!empty($Pro2))
									<form action="{{route('cart.addOne')}}" method="POST" id="form2">
									@csrf
									<input type="hidden" name="action" value="buyNow">
									<div class="btn-group mr-2" role="group" aria-label="First group" id="PRODUCT{{ $Pro2->id . '_1'}}">
									@foreach($Pro2->product_detail as $detail)


	    							<label type="button" class="btn MEMORY{{ $Pro2->id . '_1'}} {{ ($detail->id==$Pro2->product_detail->first()->id)?'btn-secondary': 'btn-outline-secondary'}}" id="DETAIL{{$detail->id .'_1'}}" onclick="clickShowDetailEveryWhere('{{  $Pro2->id.'_1'}}','{{$detail->id .'_1'}}')" 
	    								IDPRODUCT_DETAIL{{  $detail->id ."_1"}}="{{  $detail->id }}" 
	    								RAM{{  $detail->id . "_1"}}="{{  $detail->ram }}" 
	    								MEMORY{{  $detail->id . "_1"}}="{{  $detail->memory }}" 
	    								PRICE{{  $detail->id . "_1"}}="{{  $detail->price - $detail->sale_price }}" 
	    								SALE_PRACE{{  $detail->id . "_1"}}="{{  $detail->sale_price }}" 
	    								OLDPRICE{{ $detail->id . "_1"}}="{{  $detail->price }}"  
	    								CPU{{  $detail->id . "_1"}}="{{  $detail->cpu }}">
	    								{{  $detail->memory }}

	    								 <input type="radio" hidden name="pro_detail_id" value="{{  $detail->id }}" {{ ($detail->id==$Pro2->product_detail->first()->id)?'checked': ''}} >
	    							</label>

									@endforeach
								</div>
									</form>
								@endif
								
					</div>
				</div>

				<div class="row my-3">
					<div class="col-3">RAM</div>
					<div class="col">
						@if(!empty($Pro1))
							<span id="ram{{$Pro1->id}}">{{ $Pro1->product_detail->first()->ram }}</span>
						@endif
					</div>
					<div class="col">
						@if(!empty($Pro2))
							<span id="ram{{$Pro2->id . '_1'}}">{{ $Pro2->product_detail->first()->ram }}</span>
						@endif
					</div>
				</div>
				<div class="row my-3">
					<div class="col-3">Bộ nhớ trong</div>
					<div class="col">
						@if(!empty($Pro1))
							<span id="memory{{$Pro1->id}}">{{ $Pro1->product_detail->first()->memory }}</span>
						@endif
					</div>
					<div class="col">
						@if(!empty($Pro2))
							<span id="memory{{$Pro2->id . '_1'}}">{{ $Pro2->product_detail->first()->memory }}</span>
						@endif
					</div>
				</div>
				<div class="row my-3">
					<div class="col-3">CPU</div>
					<div class="col">
						@if(!empty($Pro1))
							<span id="CPU{{$Pro1->id}}">{{ $Pro1->product_detail->first()->cpu }}</span>
						@endif
					</div>
					<div class="col">
						@if(!empty($Pro2))
							<span id="CPU{{ $Pro2->id . '_1' }}">{{ $Pro2->product_detail->first()->cpu }}</span>
						@endif
					</div>
				</div>
				<div class="row my-3">
					<div class="col-3">Màn hình</div>
					<div class="col">
						@if(!empty($Pro1))
							{{ $Pro1->screen_size }}
						@endif
					</div>
					<div class="col">
						@if(!empty($Pro2))
							{{ $Pro2->screen_size }}
						@endif
					</div>
				</div>
				
				<div class="row my-3">
					<div class="col-3">GPU</div>
					<div class="col">
						@if(!empty($Pro1))
							{{ $Pro1->gpu }}
						@endif
					</div>
					<div class="col">
						@if(!empty($Pro2))
							{{ $Pro2->gpu }}
						@endif
					</div>
				</div>
				<div class="row my-3">
					<div class="col-3">Dung lượng pin</div>
					<div class="col">
						@if(!empty($Pro1))
							{{ $Pro1->battery }}
						@endif
					</div>
					<div class="col">
						@if(!empty($Pro2))
							{{ $Pro2->battery }}
						@endif
					</div>
				</div>
				<div class="row my-3">
					<div class="col-3">Thẻ sim</div>
					<div class="col">
						@if(!empty($Pro1))
							{{ $Pro1->sim}}
						@endif
					</div>
					<div class="col">
						@if(!empty($Pro2))
							{{ $Pro2->sim }}
						@endif
					</div>
				</div>
				<div class="row my-3">
					<div class="col-3">Hệ điều hành</div>
					<div class="col">
						@if(!empty($Pro1))
							{{ $Pro1->os }}
						@endif
					</div>
					<div class="col">
						@if(!empty($Pro2))
							{{ $Pro2->os }}
						@endif
					</div>
				</div>
				<div class="row my-3">
					<div class="col-3">Xuất xứ</div>
					<div class="col">
						@if(!empty($Pro1))
							{{ $Pro1->origin }}
						@endif
					</div>
					<div class="col">
						@if(!empty($Pro2))
							{{ $Pro2->origin }}
						@endif
					</div>
				</div>
				<div class="row my-3">
					<div class="col-3">Năm sản xuất</div>
					<div class="col">
						@if(!empty($Pro1))
							{{ $Pro1->year }}
						@endif
					</div>
					<div class="col">
						@if(!empty($Pro2))
							{{ $Pro2->year }}
						@endif
					</div>
				</div>
				<div class="row my-3 border-bottom">
					<div class="col-3"><h4>Thiết kế sản phẩm</h4></div>
					<div class="col"></div>
					<div class="col"></div>
				</div>
				<div class="row">
					<div class="col-3"></div>
					<div class="col-lg text-center">
						@if(!empty($Pro1))
						<!-- ảnh lớn -->
						<img src="{{ url('public') }}/uploads/product_colors/{{ $Pro1->product_color->first()->image1 }}" alt=""  class="w-100 IMGPRO1">
						<!-- ảnh con -->
						<img src="{{ url('public') }}/uploads/product_colors/{{ $Pro1->product_color->first()->image1 }}" alt="" width="50px" class="imgPro1">
						@if(!empty($Pro1->product_color->first()->image2))
						<img src="{{ url('public') }}/uploads/product_colors/{{ $Pro1->product_color->first()->image2 }}" alt="" width="50px" class="imgPro1">
						@endif
						@if(!empty($Pro1->product_color->first()->image3))
						<img src="{{ url('public') }}/uploads/product_colors/{{ $Pro1->product_color->first()->image3 }}" alt="" width="50px" class="imgPro1">
						@endif
						@if(!empty($Pro1->product_color->first()->image4))
						<img src="{{ url('public') }}/uploads/product_colors/{{ $Pro1->product_color->first()->image4 }}" alt="" width="50px" class="imgPro1">
						@endif
						@if(!empty($Pro1->product_color->first()->image5))
						<img src="{{ url('public') }}/uploads/product_colors/{{ $Pro1->product_color->first()->image5 }}" alt="" width="50px" class="imgPro1">
						@endif
						@endif
					</div>
					
					<div class="col-lg text-center">
						@if(!empty($Pro2))
						<!-- ảnh lớn -->
						<img src="{{ url('public') }}/uploads/product_colors/{{ $Pro2->product_color->first()->image1 }}" alt="" class="w-100 IMGPRO2">
						<!-- ảnh con -->
						<img src="{{ url('public') }}/uploads/product_colors/{{ $Pro2->product_color->first()->image1 }}" alt="" width="50px" class="imgPro2">
						@if(!empty($Pro2->product_color->first()->image2))
						<img src="{{ url('public') }}/uploads/product_colors/{{ $Pro2->product_color->first()->image2 }}" alt="" width="50px" class="imgPro2">
						@endif
						@if(!empty($Pro2->product_color->first()->image3))
						<img src="{{ url('public') }}/uploads/product_colors/{{ $Pro2->product_color->first()->image3 }}" alt="" width="50px" class="imgPro2">
						@endif
						@if(!empty($Pro2->product_color->first()->image4))
						<img src="{{ url('public') }}/uploads/product_colors/{{ $Pro2->product_color->first()->image4 }}" alt="" width="50px" class="imgPro2">
						@endif
						@if(!empty($Pro2->product_color->first()->image5))
						<img src="{{ url('public') }}/uploads/product_colors/{{ $Pro2->product_color->first()->image5 }}" alt="" width="50px" class="imgPro2">
						@endif
						@endif
					</div>
				</div>

				<div class="row my-3">
					<div class="col-3"></div>
					<div class="col-lg text-center">
						@if(!empty($Pro1))
						
						<a  class="text-warning pt-2" href="" id="ADDCART_ID{{ $Pro1->id }}" hidden><i class="fa fa-shopping-cart" style="font-size: 30px"></i></a>

						
						<button id='submitform1' class="btn border-0 text-white"><h5 class="rounded bg-danger p-3 text-center">MUA NGAY </h5></button>
						@endif
					</div>
					<div class="col-lg text-center">
						@if(!empty($Pro2))
						
						<a  class="text-warning pt-2" href="" id="ADDCART_ID{{ $Pro2->id . '_1' }}" hidden=><i class="fa fa-shopping-cart" style="font-size: 30px"></i></a>
						
						<button id='submitform2' class="btn border-0 text-white"><h5 class="rounded bg-danger p-3 text-center">MUA NGAY </h5></button>
						@endif
					</div>
					
				</div>
				@else
				<div class="row my-3">
					<div class="col-3"></div>
					<div class="col">
						<form class="row form ml-1" action="{{ route('home.compare') }}" method="get" >
							
									<input class="form-control w-75"  type="text" placeholder="Search" aria-label="Search" id="searchname2" name="searchname" value="">
									<input type="hidden" name="PRODUCT1" value="" id="PRODUCT2">
									<input type="hidden" name="PRODUCT2" value="">
									<button class="btn btn-outline-dark my-sm-0 bg-dark text-white" type="submit" >
										<i class="fa fa-search " aria-hidden="true" ></i>
									</button>
								</form>
										<select id="PROList" class="w-75 ml-1 mt-0 custom-select float-left" hidden size="5">
									
										</select>
					</div>
					<div class="col"></div>
				</div>
				@endif
			</div>
		</div>


		<script type="text/javascript">
						$("#searchname2").keyup(function(){
							
							let searchname2 = this.value;
							console.log(searchname2);
							if(searchname2!=""){
								console.log("ok");
								$.ajax({
								type:"GET",
								url: "{{ route('compare.search') }}",
								data:{searchname:searchname2},
								success:function(data){
									$('#PROList').prop("hidden", false);
    								$('#PROList').html(data.success);
       								$("option").click(function(){
       									
       										$("#PRODUCT2").val(this.value);
       								
       									$("#searchname2").val(this.text)
       									$("select").prop("hidden",true);
       								})
       								
								}

							})

							}
							
						})
					</script>

					<script type="text/javascript">
						$(".imgPro1").click(function(){
							console.log(this.src);
							$(".IMGPRO1").attr('src', this.src);
						});
						$(".imgPro2").click(function(){
							console.log(this.src);
							$(".IMGPRO2").attr('src', this.src);
						})
					</script>

					<script>
						$('#submitform1').click(function(){
							$('#form1').submit();
						});
						$('#submitform2').click(function(){
							$('#form2').submit();
						});
					</script>
	@stop()