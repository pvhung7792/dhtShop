<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="description" content="">
		<meta name="author" content="">
		<!-- <link rel="icon" href="../../../../favicon.ico"> -->

		<title>{{ config('main.name', 'DHTshop') }}</title>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<!-- owl -->
		
		<!-- icon -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="{{ url('public') }}/frontend/JSclien.js"></script>
		<!-- Custom styles for this template -->
		<!-- <link href="navbar-top-fixed.css" rel="stylesheet"> -->
		<!-- Link sweat alert 2 -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.min.js"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.min.css">
		<style>
			.an_mua{
				visibility:hidden;
				/*display: none;*/
			}
			.col:hover .an_mua{
				visibility: visible;
				/*display: block;*/
			}
			.col:hover {
				border: 1px solid #dee2e6;
			}
			.tungdo img{
				max-width: 100%;
				/*max-width: 680px;*/
                display: block; margin-left: auto; margin-right: auto;
			}
			.tungdo h2{
				font-size: 20px;

			}
			.tungdo a{
				font-size: 16px;

			}
			#img{
				height: 376.63px;
				/*max-height: 100% !important;*/
				/*object-fit: cover;*/
			}
		</style>
		@yield('style')

	</head>

	<body style="background-color: #e9ecef">
		
		@if(Auth::guard('user')->check())

<script type="text/javascript">
   
  
        function ADDWL(a,b){
           
			           
            $.ajax({
                'url':'{{route("wish_list.store") }}',
                'type':'POST',
                'data':{
                    'user_id':a,
                    'product_id':b,

                     _token: '{{csrf_token()}}',
                },

                success:function(data){
                /*	alert('ok');*/
                	
                    if(data.error==true){
                      alert(data.message);
 
                    }else{
                        $('.ADDWL'+b).prop('hidden',true);
                        $('.DELLWL'+b).prop('hidden',false);
                    }
                }
            })
           
        };

        function DELLWL(a,b){
            console.log(a,b);
           
            $.ajax({
                'url':'{{route("wish_list.destroy",Auth::guard('user')->user()->id) }}',
                'type':'POST',
                'data':{
                    'user_id':a,
                    'product_id':b,
                    _method: "DELETE",
                     _token: '{{csrf_token()}}',
                },

                success:function(data){
                 /*  alert(data.error);*/
                    if(data.error==true){
                      alert(data.message);
                    }else{
                        $('.ADDWL'+b).prop('hidden',false);
                        $('.DELLWL'+b).prop('hidden',true);
                    }
                }
            })
        };
    
</script>
	
@endif
		<div class="bg-danger">
			<div class="container-fluid">
				<nav class="navbar navbar-expand-md navbar-dark my-0 py-0 ml-2">
					<a class="navbar-brand nav-link" href="{{route('home')}}">
					<img src="{{url('public')}}/uploads/logos/{{$config_home->logo}}" alt=""  height="50px" width="150px" ></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarCollapse">

						<form class="form-inline mt-2 mt-md-0  col-lg-6"  method="get" action="{{ route('home.search') }}">
							<input class="form-control w-75"  type="text" placeholder="{{ (session('message'))? (session('message')) : 'Search'}}" aria-label="Search" name="searchname">
							<button class="btn btn-outline-dark my-2 my-sm-0 bg-dark text-white" type="submit">
								<i class="fa fa-search" aria-hidden="true"></i>
							</button>
						</form>
						<ul class="navbar-nav">
							<li class="nav-item mx-5">
								<a class="nav-link" href="{{route('cart.index')}}" ><i class="fa fa-shopping-cart" style="font-size: 30px"></i> <sup class="text-white" id="cart" style="font-size: 20px"> {{$total_cart}}</sup></a>
							</li>
							
							@if(! Auth::guard('user')->check())
							<li class="nav-item mx-3">
								<a class="nav-link" href="{{ route('login') }}">
									<i class="fa fa-user-o text-white" aria-hidden="true" style="font-size: 20px"></i>
									 Đăng Nhập
								</a>
							</li>
							<li class="nav-item mx-3">
								<a class="nav-link" href="{{ route('register') }}">
									<i class="fa fa-users text-white" aria-hidden="true" style="font-size: 20px"></i>
									Đăng Ký
								</a>
							</li>
							@else

							
                           
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::guard('user')->user()-> first_name }} {{ Auth::guard('user')->user()-> last_name }}
                                </a>

								 <div class="dropdown-menu mt-0">
								 	<a href="{{route('orderNew')}}" class="nav-link text-secondary"><i class="fa fa-book mr-2" style="font-size: 20px"></i>Đơn hàng mới</a>
								 	<a href="{{route('orderHistory')}}" class="nav-link text-secondary"><i class="fa fa-history mr-2" style="font-size: 20px"></i>Lịch sử mua</a>
								 	<a class="nav-link text-secondary" href="{{ route('changeContact') }}"><i class="fa fa-address-card mr-2" aria-hidden="true" style="font-size: 20px"></i>Đổi thông tin</a>
								 	<a class="nav-link text-secondary" href="{{ route('showChangePass') }}"><i class="fa fa-key mr-2" aria-hidden="true" style="font-size: 20px"></i>Đổi mật khẩu</a>
								 	<a class="nav-link text-secondary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out mr-2" aria-hidden="true" style="font-size: 20px"></i>Đăng xuất
								 	</a>
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
								 	
								 </div>
                                
                            </li>
								
                            @if(Auth::guard('user')->user()-> role==1 || Auth::guard('user')->user()-> role==2)
                             <li class="nav-item m-1">
                            	<a href="{{ route('home.index') }}" class="btn btn-success">Quản lý ADMIN</a>
                            </li>
                            @endif
							
							@endif

							 
							
						</ul>

					</div>
				</nav>
			</div>
			
		</div>
		<div class="bg-dark">
			<div class="container-fluid">
				<nav class="navbar navbar-expand-md navbar-dark pt-0 pb-0">
					<div class="collapse navbar-collapse" id="navbarCollapse">

						
						<ul class="navbar-nav mr-auto ml-2">
							@foreach($category_all as $cate)
							<li class="nav-item dropdown">
								<form action="{{route('home.category',$cate->slug)}}" class="float-left">
									<input type="hidden" name="categoryID" value="{{ $cate->id }}">
									 <button type="submit" class="btn text-white">
								 	{{ $cate->name }}
								 </button>
								</form>
								
								 <button type="button" class="btn text-white dropdown-toggle dropdown-toggle-split mr-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								 	
								 </button>
								 <div class="dropdown-menu">
								 	@foreach($cate->brand as $bra)
									 
									 	<form action="{{route('home.category',$cate->slug)}}" class="dropdown-item">
											<input type="hidden" name="BRANDid[]" value="{{ $bra->id }}">
											<input type="hidden" name="categoryID" value="{{ $cate->id }}">
											 <button type="submit" class="btn">
										 	{{$bra->name}}
										 	</button>
										</form>
								 	
									
								 	@endforeach
								 </div>
								
							</li>
							@endforeach
							
							<li class="nav-item">
								<a class="nav-link text-white" href="{{route('tin-tuc')}}">Tin Tức</a>
							</li>
						</ul>
					
					</div>
				</nav>
			</div>	
		</div>

@yield('content')

		<div class="bg-white">
			<footer class="footer mx-5 py-2 ">
				<div class="container-fluid text-center">
					<div class="row">
						<div class="col-lg-6">
							<p>Tư vấn mua hàng (Miễn phí)
								<span class="text-danger form-control-lg font-weight-bold">{{$config_home->phone}}</span>
							</p>
							<p class="text-primary">
								<i class="fa fa-facebook-square" aria-hidden="true" style="font-size: 40px"></i>
								<span class="">{{$config_home->email}}</span>

							</p>
							<p class="">
								<i class="fa fa-youtube-play text-danger" aria-hidden="true" style="font-size: 40px"></i>
								<span class=" ">{{$config_home->email}}</span>

							</p>
							
							
						</div>
						<div class="col-lg-6">
							<p>Góp ý, khiếu nại dịch vụ (8h00-22h00)
								<span class="text-danger form-control-lg font-weight-bold">{{$config_home->phone}}</span>
							</p>
							<p> Địa chỉ cửa hàng:
							<span class="text-danger form-control-lg font-weight-bold">{{$config_home->address}}</span>
							</p>
						</div>
					</div>
					
					<span class="text-muted form-control-sm">{{$config_home->bottom_footer}}</span>
				</div>
			</footer>
		</div>
		<script>
			$('.addCart').click(function(e){
            e.preventDefault();
            let form = $(this).parents('form:first');
            token = form.serializeArray()[0].value;
            proDetailId = form.serializeArray()[1].value;
            console.log(form.serializeArray());
            $.ajax({
               url: "{{route('cart.addOne')}}",
                  type:'POST',
                  data: {pro_detail_id:proDetailId, _token:token},
                  success: function(data) {
                  	// setInterval(function(){ alert("Thêm giỏ hàng thành công"); }, 1000);
                     Swal.fire({
                     	title: 'Thêm giỏ hàng thành công',
			            type: 'success',
			            timer: 1000
                     });
                     let qty =$('#cart').text();
                     qty = Number(qty) + 1;
                     $('#cart').text(qty);
                  }
            });
         });

		</script>

		<script>
			@if(Auth::guard('user')->check())


   
  
        function ADDWL(a,b){
           
			           
            $.ajax({
                'url':'{{route("wish_list.store") }}',
                'type':'POST',
                'data':{
                    'user_id':a,
                    'product_id':b,

                     _token: '{{csrf_token()}}',
                },

                success:function(data){
                /*	alert('ok');*/
                	
                    if(data.error==true){
                      alert(data.message);
 
                    }else{
                        $('.ADDWL'+b).prop('hidden',true);
                        $('.DELLWL'+b).prop('hidden',false);
                    }
                }
            })
           
        };

        function DELLWL(a,b){
            console.log(a,b);
           
            $.ajax({
                'url':'{{route("wish_list.destroy",Auth::guard('user')->user()->id) }}',
                'type':'POST',
                'data':{
                    'user_id':a,
                    'product_id':b,
                    _method: "DELETE",
                     _token: '{{csrf_token()}}',
                },

                success:function(data){
                 /*  alert(data.error);*/
                    if(data.error==true){
                      alert(data.message);
                    }else{
                    	 
                        $('.ADDWL'+b).prop('hidden',false);
                        $('.DELLWL'+b).prop('hidden',true);
                    }
                }
            })
           
        };
    
    


@endif
		</script>
	</body>
</html>
@yield('script')
