@extends('frontend.main')

@section('content')
<div class="mx-5 my-3">

	<div class="container-fluid rounded">

		<div class="p-2">
			<div class="row ">
				<nav class="nav ">
                    <a class="nav-link {{(isset($blog_cate))?'text-dark':''}} " href="{{route('tin-tuc')}}"><h5>Tin Mới</h5></a>
                    @foreach ($blog_cate_all as $item)
                    <a class="nav-link {{(isset($blog_cate)&&$item->id==$blog_cate->id)?'':'text-dark'}}" href="{{route('cate_show',$item->slug)}}"><h5 class="text-capitalize">{{$item->name}}</h5></a>
                    @endforeach
                </nav>
            </div>
            <div class="row">
            @yield('blog_main')
                        <div class="col-lg-3 bg-white border rounded pt-3 mt-3 text-center"{{(isset($blog1))?'hidden':''}}>
                            <h5 class="text-center">Sản phẩm mới</h5>
                                <div class="card-body ">
                                        @foreach ($product_new as $item)
                                            <hr>
                                            <a href="{{route('home.product',[$item->brand->category->slug,$item->slug])}}" class="card-link">
                                                <h5>{{$item->name}}</h5>
                                                <img src="{{url('public')}}/uploads/products/{{$item->image}}" alt="">
                                            </a>
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
