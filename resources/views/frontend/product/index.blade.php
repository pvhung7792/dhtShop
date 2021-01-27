@extends('frontend.main')

@section('content')

<div class="px-5">
  <div class="container-fluid">
    Trang chủ / {{$product->brand->category->name}} / {{$product->name}}
  </div>

  <!-- tất cả các thông tin về sản phẩm -->
 <div class="container-fluid border rounded p-4 bg-white my-3">
    <h4> {{$product->name}} <span id="RAM{{$product->id}}">{{ $product->product_detail->first()->ram }}</span>
      <span>  </span>
      <span id="MEMORY{{$product->id}}">{{ $product->product_detail->first()->memory }}</span></h4>
      <p>{{ count($product->comment->where('answer', '<>', '', 'and')) }} câu hỏi được trả lời</p> 
      <hr>
      <div class="row">
        <div class="col-lg-9">
          <div class="row">
            <div class="col-lg-6">
              
              <!-- Set up your HTML -->

              <!-- ảnh đi kèm với màu của sản phẩm -->
              <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                
                <div class="carousel-inner">
                  <div class="carousel-item active IMAGE IMAGE1">
                    <img src="{{ url('public') }}/uploads/product_colors/{{ $product->product_color->first()->image1 }}" class=" w-100" alt="..." id="IMAGE1">
                  </div>
                  @if(!empty($product->product_color->first()->image2))
                  <div class="carousel-item IMAGE">
                    <img src="{{ url('public') }}/uploads/product_colors/{{ $product->product_color->first()->image2 }}" class=" w-100" alt="..." id="IMAGE2">
                  </div>
                  @endif
                  @if(!empty($product->product_color->first()->image3))
                  <div class="carousel-item IMAGE">
                    <img src="{{ url('public') }}/uploads/product_colors/{{ $product->product_color->first()->image3 }}" class=" w-100" alt="..." id="IMAGE3">
                  </div>
                  @endif
                  @if(!empty($product->product_color->first()->image4))
                  <div class="carousel-item IMAGE">
                    <img src="{{ url('public') }}/uploads/product_colors/{{ $product->product_color->first()->image4 }}" class=" w-100" alt="..." id="IMAGE4">
                  </div>
                  @endif
                  @if(!empty($product->product_color->first()->image5))
                  <div class="carousel-item IMAGE">
                    <img src="{{ url('public') }}/uploads/product_colors/{{ $product->product_color->first()->image5 }}" class="w-100" alt="..." id="IMAGE5">
                  </div>
                  @endif
                </div>
                <a class="carousel-control-prev " href="#carouselExampleFade" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon bg-success" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                  <span class="carousel-control-next-icon bg-success p-2" aria-hidden="true"></span>
                  <span class="sr-only ">Next</span>
                </a>
              </div>

              <!-- chương trình khuyến mại đi kèm -->
              <div class="rounded p-3" style="background-color:#e9ecef">
                <h5 class="text-primary">Nhận ngay khuyến mại đặc biệt</h5>
                <hr>
                <p><i class="fa fa-check-circle text-primary" aria-hidden="true"></i>{{ $product->promotion->detail1 }}</p>
                <p><i class="fa fa-check-circle text-primary" aria-hidden="true"></i> {{ $product->promotion->detail2 }}</p>
                <p><i class="fa fa-check-circle text-primary" aria-hidden="true"></i> {{ $product->promotion->detail3 }}</p>
                <p><i class="fa fa-check-circle text-primary" aria-hidden="true"></i> {{ $product->promotion->detail4 }}</p>
                <p><i class="fa fa-check-circle text-primary" aria-hidden="true"></i>{{ $product->promotion->detail5 }}</p>
                <p>Gọi ngay để biết thêm thông tin khuyến mãi về sản phẩm và dịch vụ (8h00-22h00)
                  <span class="text-danger form-control-lg font-weight-bold">{{$config_home->phone }}</span>
                </p>
              </div>
            </div>

            <!-- thông tin về giá cả sản phẩm -->
            <div class="col-lg-6 border-right">
              <span class="font-weight-bold mr-2 text-dark" style="font-size: 30px">
                <span class="text-white px-3 py-0 bg-danger rounded-pill text-center form-control-lg " >
                  <span id="PRICE{{$product->id }}">
                    {{number_format( $product->product_detail->first()->price - $product->product_detail->first()->sale_price , 0 , ',', '.')}}
                  </span> ₫
                </span> 
              </span>
              <del class="text-secondary  ml-1 HIDDENSALEPRICE{{ $product->id }}" {{ $product->product_detail->first()->sale_price==0 ? "hidden" : ""}}>
                <span id="OLDPRICE{{$product->id }}">
                  {{number_format( $product->product_detail->first()->price  , 0 , ',', '.')  }}
                </span> ₫ 
              </del>  
              <span class="bg-warning rounded ml-2 HIDDENSALEPRICE{{ $product->id }}" {{ $product->product_detail->first()->sale_price==0 ? "hidden" : ""}}> 
                Giảm 
                <span id="SALE_PRICE{{ $product->id }}"> 
                  {{number_format(  $product->product_detail->first()->sale_price  , 0 , ',', '.') }}
                </span> ₫
              </span>
              <p class="border rounded px-3 my-3"> <i class="fa fa-clock-o text-danger" aria-hidden="true" style="font-size: 25px"></i> GIAO HÀNG TRÊN 63 TỈNH THÀNH </p>
              <!-- chọn thông số kỹ thuật -->
              <form action="{{ route('cart.addOne') }}" method="POST">
               @csrf
               @if(count($product->product_detail->where('status',1)) >1)
               <div class="mb-3 PRODUCT{{ $product->id }}" id="">
                @foreach($product->product_detail as $detail)
                <label class="btn  MEMORY{{ $product->id }} {{ ($detail->id==$product->product_detail->first()->id)?'btn-secondary': 'btn-outline-secondary'}}"  id="DETAIL{{$detail->id}}" onclick="clickShowDetailEveryWhere({{  $product->id }},{{  $detail->id }})" 
                  ID_DETAIL{{  $detail->id }}="{{  $detail->id }}" 
                  RAM{{  $detail->id }}="{{  $detail->ram }}" 
                  MEMORY{{  $detail->id }}="{{  $detail->memory }}" 
                  PRICE{{  $detail->id }}="{{number_format(  $detail->price - $detail->sale_price  , 0 , ',', '.')   }}" 
                  SALE_PRICE{{  $detail->id }}="{{number_format(   $detail->sale_price  , 0 , ',', '.')  }}" 
                  OLDPRICE{{ $detail->id }}="{{number_format(  $detail->price  , 0 , ',', '.')   }}"  
                  CPU{{  $detail->id }}="{{  $detail->cpu }}">
                  <h6>{{$detail->memory}} </h6>
                  <span>{{number_format( $detail->price-$detail->sale_price  , 0 , ',', '.') }}</span>₫
                  <input type="radio" name="pro_detail_id" value="{{ $detail->id }}" {{ ($detail->id==$product->product_detail->first()->id)?'checked': ''}} hidden>
                </label>
                @endforeach
              </div>
              @else
              <input type="radio" name="pro_detail_id" value="{{  $product->product_detail->where('status',1)->first()->id }}" checked hidden>
              @endif

              <!-- chọn màu sản phẩm -->
              <div >
                @foreach($product->product_color as $color)
                <label class="border rounded COLOR_PRID{{$color->product->id }} {{ ($color->id==$product->product_color->first()->id)?'border-warning' :''}}" id="COLOR_ID{{ $color->id }}" onclick="CHANGERCOLOR({{ $product->id }},{{  $color->id }})" IMAGE1="{{  $color->image1 }}" IMAGE2="{{  $color->image2 }}" IMAGE3="{{  $color->image3 }}" IMAGE4="{{  $color->image4 }}" IMAGE5="{{  $color->image5 }}">
                  <input type="radio" name="pro_color" id="COLORID{{$color->id }}" value="{{  $color->id }}" {{ ($color->id==$product->product_color->first()->id)?'checked': ''}} hidden>
                  <img  src="{{ url('public') }}/uploads/product_colors/{{ $color->logo }}" class="rounded" alt=""  height="50px"> 
                <p class="text-center">{{$color->name}}</p>
                </label>
                @endforeach
              </div>

              <div class="my-3">
                <a  class="text-warning pt-2" href="" id="ADDCART_ID{{ $product->id }}" hidden><i class="fa fa-shopping-cart" style="font-size: 30px"></i></a><!--  đã ẩn ko cần quan tâm đến nó -->
                <button class="btn btn-danger btn-lg btn-block" type="submit" name="action" value="buyNow"><h3>Mua Ngay</h3></button>
              </div>
            </form>
            <!-- thông số kỹ thuật -->
            <div class="rounded p-3" style="background-color:#e9ecef">
              <h4>Thông số kỹ thuật</h4> 

              <table class="table table-border">
                <tr>

                  <td>RAM</td>
                  <td><span class="ram{{$product->id}}" id="ram{{$product->id}}">{{ $product->product_detail->first()->ram }}</span></td>
                </tr>
                <tr>

                  <td>Bộ nhớ trong</td>
                  <td><span id="memory{{$product->id}}">{{ $product->product_detail->first()->memory }}</span></td>
                </tr>                         
                <tr>

                  <td>Màn hình</td>
                  <td >{{  $product->screen_size }}</td>

                </tr>

                <tr>
                  <td>CPU</td>
                  <td><span id="CPU{{ $product->id }}">{{ $product->product_detail->first()->cpu }}</span></td>
                </tr>
                <tr>
                  <td>GPU</td>
                  <td>{{  $product->gpu }}</td>
                </tr>
                <tr>
                  <td>Pin</td>
                  <td> {{  $product->battery }}</td>
                </tr>
                <tr>
                  <td>Thẻ sim</td>
                  <td>{{  $product->sim }}</td>
                </tr>
                <tr>
                  <td>Hệ điều hành</td>
                  <td> {{  $product->os }}</td>
                </tr>
                <tr>
                  <td>Xuất xứ</td>
                  <td>{{  $product->origin }}</td>
                </tr>
                <tr>
                  <td>Năm sản xuất</td>
                  <td>{{  $product->year }}</td>
                </tr>
              </table>
            </div><!-- end thông số kỹ thuật -->
          </div>
        </div>
      </div>     

      <!-- trong hộp sản phẩm .... -->
      <div class="col-lg-3">
        <h4>Trong hộp có:</h4>
        <div class="row">
          <div class="col-lg-2">
            <h4 class="text-danger"><i class="fa fa-archive" aria-hidden="true"></i></h4>
          </div>
          <div class="col-lg-10">
            <span class="text-primary"> {{ $product->in_box }}</span>
          </div>
        </div>
        <div>
          <h4>DHTshop cam kết:</h4>

          <div class="row">
            <div class="col-lg-2">
              <h4 class="text-danger"><i class="fa fa-star" aria-hidden="true"></i></h4>
            </div>
            <div class="col-lg-10">
              Hàng chính hãng
            </div>
          </div>
          <div class="row">
            <div class="col-lg-2">
              <h4 class="text-danger"><i class="fa fa-shield" aria-hidden="true"></i></h4>
            </div>
            <div class="col-lg-10">
              Bảo hành 12 Tháng chính hãng
            </div>
          </div>
          <div class="row">
            <div class="col-lg-2">
              <h4 class="text-danger"><i class="fa fa-truck" aria-hidden="true"></i></h4>
            </div>
            <div class="col-lg-10">
              Giao hàng trên 63 tỉnh thành
            </div>
          </div>
          <div class="row">
            <div class="col-lg-2">
              <h4 class="text-danger"><i class="fa fa-map-marker" aria-hidden="true"></i></h4>
            </div>
            <div class="col-lg-10">
              Bảo hành nhanh tại DHTshop trên toàn quốc
            </div>
          </div>
        </div>  
      </div>
    </div>

  </div><!-- end tất cả các thông tin về sản phẩm -->
<!-- end tất cả các thông tin về sản phẩm -->


  <!-- sản phẩm tương tự -->
  <div>
    <div class="container-fluid border rounded p-4 bg-white my-3">
      <h3 class="font-weight-bold"></i> Sản Phẩm Tương Tự</h3>
      <hr>
      <div class="row row-cols-1 row-cols-lg-4">
        @foreach($product_detail_all->where('price','>',$product->product_detail->first()->price-2000000)->where('price','<',$product->product_detail->first()->price+2000000)->take(5) as $product_detail)
          <div class="col rounded">
        <form action="{{route('cart.addOne')}}" method="POST">
          @csrf
            <a href="{{route('home.product',[$product_detail->product->brand->category->slug,$product_detail->product->slug])}}" class="nav-link">
              <div class="card row border-white">
                <img src="{{asset('public')}}/uploads/products/{{$product_detail->product->image}}" class="card-img-top img-fluid px-4" alt="...">
                <div>
                  <span class="text-white px-1 py-0 bg-warning rounded-lg text-center " {{ $product_detail->sale_price==0 ? "hidden" : ""}}>giảm {{number_format( $product_detail->sale_price   , 0 , ',', '.') }} ₫ </span>    
                </div>
                <div class="card-body p-0">
                  <h5 class="card-title text-dark">{{$product_detail->product->name}} <span id="RAM">{{$product_detail->ram}}</span>-<span id="MEMORY">{{$product_detail->memory}}</span></h5>
                  <div >
                    <span class="text-white px-3 py-0 bg-danger rounded-pill text-center form-control-lg mr-3"  >{{number_format( $product_detail->price-$product_detail->sale_price   , 0 , ',', '.') }} ₫</span> <del  {{ $product_detail->sale_price==0 ? "hidden" : ""}}>{{number_format( $product_detail->price   , 0 , ',', '.') }} ₫</del>
                  </div>
                </div>
              </div>
            </a>
            <div class="text-center an_mua float-left">
              <!-- Thêm giỏ hàng -->
              <input type="text" name="pro_detail_id" value="{{$product_detail->id}}" hidden>
              <button  class="btn btn-warning addCart" type="submit" name="action" value="addCart"><i class="fa fa-shopping-cart text-white" ></i></button>
            
              <!-- Thêm giỏ hàng va chuyển đén trang giỏ hàng -->
              <button class="btn btn-danger" type="submit" name="action" value="buyNow">Mua Ngay</button>
            </form>
            <!-- so sáng sản phẩm -->
          </div>
          <div class="float-left ml-1 an_mua">
                <form action="{{ route('home.compare')}}" method="get" class="float-left">
                    <input type="hidden" name="PRODUCT1" value="{{ $product_detail->product->id }}">
                    <button class="btn btn-secondary" type="submit">so sánh </button>
                </form>
          </div>

                

                <!-- @if(Auth::guard('user')->check()) -->

                  <!-- wish list -->

                  <!-- <a class="float-left ADDWL{{ $product_detail->product->id }}" {{ (count($product_detail->product->wish_list->where('user_id',Auth::guard('user')->user()->id))>0)?"hidden":"" }} onclick="ADDWL({{ Auth::guard('user')->user()->id }},{{ $product_detail->product->id }})">
                    <i class="fa fa-heart-o text-danger p-1" aria-hidden="true" style="font-size:30px;" ></i>
                  </a>
                  <a class="float-left DELLWL{{ $product_detail->product->id }}" {{ (count($product_detail->product->wish_list->where('user_id',Auth::guard('user')->user()->id))>0)?"":"hidden" }}  onclick="DELLWL({{ Auth::guard('user')->user()->id }},{{ $product_detail->product->id }})">
                    <i class="fa fa-heart text-danger p-1" aria-hidden="true" style="font-size:30px;"></i>
                  </a>
 -->


              <!--   @endif -->
        </div>
        @endforeach
      </div>
    </div>
  </div>
   <!-- end sản phẩm thương tự -->

  <!-- sản phẩm yêu thích -->
  @if(Auth::guard('user')->check() && count($wish_list_all->where('user_id',Auth::guard('user')->user()->id))>0)
  <div>
    <div class="container-fluid border rounded p-4 bg-white my-3">
      <h3 class="font-weight-bold"></i> Sản Phẩm Yêu Thích Của Bạn</h3>
      <hr>
      <div class="row row-cols-1 row-cols-lg-4">
       @foreach($wish_list_all->where('user_id',Auth::guard('user')->user()->id) as $myWL)
       @foreach($product_all->where('id',$myWL->product_id)->where("id","<>",$product->id) as $Pro)
       <div class="col rounded">
       <form action="{{route('cart.addOne')}}" method="POST">
        @csrf
        <a href="{{route('home.product',[$Pro->brand->category->slug,$Pro->slug])}}" style="text-decoration: none;">
          <div class="card border-white">
            <img src="{{asset('public')}}/uploads/products/{{$Pro->image}}" class="card-img-top img-fluid px-4" alt="...">
            <div>
              <span class="text-white px-1 py-0 bg-warning rounded-lg text-center HIDDENSALEPRICE{{ $Pro->id }}" {{ $Pro->product_detail->first()->sale_price==0 ? "hidden" : ""}}>giảm <span id="SALE_PRICE{{ $Pro->id }}">{{number_format( $Pro->product_detail->first()->sale_price   , 0 , ',', '.')  }}</span> ₫</span>
            </div>
            <div class="card-body p-0">
              <h5 class="card-title text-dark">{{$Pro->name}} <span id="RAM{{$Pro->id}}">{{ $Pro->product_detail->first()->ram }}</span>
                <span>-</span>
                <span id="MEMORY{{$Pro->id}}">{{ $Pro->product_detail->first()->memory }}</span></h5>

                @if(count($Pro->product_detail->where('status',1)) >1)
                <div class="btn-group mr-2" role="group" aria-label="First group" id="PRODUCT{{ $Pro->id }}">
                  @foreach($Pro->product_detail as $detail)

                  <label type="button" class="btn  MEMORY{{ $Pro->id }} {{ ($detail->id==$Pro->product_detail->first()->id)?'btn-secondary': 'btn-outline-secondary'}}" id="DETAIL{{$detail->id}}" onclick="clickShowDetailEveryWhere({{  $Pro->id }},{{  $detail->id }})" 
                    IDPRODUCT_DETAIL{{  $detail->id }}="{{  $detail->id }}" 
                    RAM{{  $detail->id }}="{{  $detail->ram }}" 
                    MEMORY{{  $detail->id }}="{{  $detail->memory }}" 
                    PRICE{{  $detail->id }}="{{number_format(  $detail->price - $detail->sale_price  , 0 , ',', '.')   }}" 
                    SALE_PRICE{{  $detail->id }}="{{number_format(  $detail->sale_price  , 0 , ',', '.')   }}" 
                    OLDPRICE{{ $detail->id }}="{{number_format(  $detail->price  , 0 , ',', '.')   }}"  
                    CPU{{  $detail->id }}="{{  $detail->cpu }}">{{  $detail->memory }}
                    <input type="radio" hidden name="pro_detail_id" value="{{  $detail->id }}" {{ ($detail->id==$product->product_detail->first()->id)?'checked': ''}} >

                  </label>
                  @endforeach
                </div>
                @else
                <input type="radio" hidden name="pro_detail_id" value="{{  $Pro->product_detail->where('status',1)->first()->id }}" checked>
                @endif
                <div >
                  <span class="text-white px-3 py-0 bg-danger rounded-pill text-center form-control-lg mr-3" ><span id="PRICE{{$Pro->id }}">{{number_format(  $Pro->product_detail->first()->price - $Pro->product_detail->first()->sale_price  , 0 , ',', '.') }}</span> ₫</span> 
                  <del class="HIDDENSALEPRICE{{ $Pro->id }}" {{ $Pro->product_detail->first()->sale_price==0 ? "hidden" : ""}}><span id="OLDPRICE{{$Pro->id }}">{{number_format(  $Pro->product_detail->first()->price  , 0 , ',', '.')  }}</span> ₫</del>  
                </div>
              </div> 
              <div class="text-success">

                @if($Pro->screen_size)
                <i class="fa fa-desktop mt-2" aria-hidden="true"><span>{{ $Pro->screen_size }}</span>  </i>
                @endif
                @if($Pro->gpu) 
                <i class="fa fa-credit-card-alt  m-2" aria-hidden="true" > <span>{{ $Pro->gpu }}</span></i>
                @endif
                <i class="fa fa-microchip mt-2" aria-hidden="true" ></i><span class="ram{{$Pro->id}}" id="ram{{$Pro->id}}">{{ $Pro->product_detail->first()->ram }}</span>
                <i class="fa fa-server mt-2" aria-hidden="true" ></i><span id="memory{{$Pro->id}}">{{ $Pro->product_detail->first()->memory }}</span>
                <i class="fa fa-codepen mt-2" aria-hidden="true"></i><span id="CPU{{ $Pro->id }}">{{ $Pro->product_detail->first()->cpu }}</span>
              </div> 
            </div>
          </a>
          <div class="text-center an_mua float-left">

            <!-- Nút thêm giỏ hàng -->
            <button  class="btn btn-warning addCart" type="submit" name="action" value="buyNow"><i class="fa fa-shopping-cart text-white" ></i></button>
            
            <!-- Nút thêm giỏ hàng và chuyển đến trang giỏ hàng -->
            <button  class="btn btn-danger" type="submit" name="action" value="buyNow">Mua Ngay</button>
            </form>
           <!-- so sáng sản phẩm -->
          </div>
          <div class="float-left ml-1 an_mua">
                <form action="{{ route('home.compare')}}" method="get" class="float-left">
                    <input type="hidden" name="PRODUCT1" value="{{ $Pro->id }}">
                    <button class="btn btn-secondary" type="submit">so sánh </button>
                </form>
          </div>

                
               <!--  @if(Auth::guard('user')->check()) -->

                  <!-- wish list -->

                 <!--  <a class="float-left ADDWL{{ $Pro->id }}" {{ (count($Pro->wish_list->where('user_id',Auth::guard('user')->user()->id))>0)?"hidden":"" }} onclick="ADDWL({{ Auth::guard('user')->user()->id }},{{ $Pro->id }})">
                    <i class="fa fa-heart-o text-danger p-1" aria-hidden="true" style="font-size:30px;" ></i>
                  </a>
                  <a class="float-left DELLWL{{ $Pro->id }}" {{ (count($Pro->wish_list->where('user_id',Auth::guard('user')->user()->id))>0)?"":"hidden" }}  onclick="DELLWL({{ Auth::guard('user')->user()->id }},{{ $Pro->id }})">
                    <i class="fa fa-heart text-danger p-1" aria-hidden="true" style="font-size:30px;"></i>
                  </a>
 -->


              <!--   @endif -->


        </div>

        @endforeach
        @endforeach

      </div>

    </div>

  </div><!-- end sản phẩm yêu thích -->
  @endif




  <!-- hỏi đáp về sản phẩm -->
  <div class="">
    <div class="container-fluid">
      <div class="row">
        <!-- hỏi đáp về sản phẩm -->
        <div class="col-lg-12 border rounded p-4 bg-white mb-3">
          <legend>
            <h3> Hỏi Đáp về {{$product->name}}</h3>
          </legend>

          <form action="{{route('question.add')}}" method="POST" >
            @csrf
            
            <div class="form-group">
              <textarea type="text" name="question" id="question" class="form-control" rows="3" placeholder="Viết bình luận (Vui lòng nhập tiếng việt có dấu)" required="required" maxlength="255"></textarea>
            </div>


            <input type="text" name="user_id" value="{{ (Auth::guard('user')->check())?Auth::guard('user')->user()->id:'' }}" hidden>
            <input type="text" name="product_id" value="{{ $product->id }}" hidden>
            @if(Auth::guard('user')->check())
            <button type="submit" class="btn btn-primary">gửi câu hỏi</button>
            @else
            <h4 class="text-warning text-center">Vui lòng đăng nhập để có thể để lại câu hỏi của bạn</h4>
            @endif
          </form>

          <legend> <p></p></legend>


          @foreach($comments as $comment)
          <div >
            <div >
              <div >
                <span class="bg-secondary text-white px-3 py-1 mx-2" style="font-size: 20px">{{ strtoupper(substr($comment->user->first_name ,0,1))}}</span><strong>{{ $comment->user->first_name }}</strong> <span class="text-secondary ml-3"> {{ $comment->created_at->diffForHumans($now) }} </span>
              </div>  
            </div>
            <div class="ml-5 pl-3">
              <p>{{ $comment->question }}</p>
              @if($comment->answer)
              <div class="ml-5 p-2 mb-3 rounded" style="background-color:#e9ecef">
                <div class="m-2">
                  <div >
                    <span class="bg-danger text-white px-2 m-2" style="font-size: 20px">QTV</span><strong>DHTshop</strong> <span class="text-secondary ml-3"> {{ $comment->updated_at->diffForHumans($now) }} </span>
                  </div>  
                </div>

                <div class="ml-5 pl-2">
                  <p>Chào {{ $comment->user->first_name}} {{ $comment->user->last_name}},</p>
                  <p>{{ $comment->answer }}</p>

                  <p>Thân mến!</p>
                </div>

              </div>
              @else
              @if(Auth::guard('user')->check()&&Auth::guard('user')->user()->role>0)
              <p><a class="text-primary hien_form_traloi{{ $comment->id }}" type="button"  > <span class="answer-comment answer-comment-4576411 f-cmpost" data-id="4576411" onclick="clickRep({{ $comment->id }})">Trả lời</span> </a></p>

              <div class="form_traloi{{ $comment->id }}" style="display: none">
                <form action="{{ route('addAnswer',$comment->id) }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <textarea name="answer" id="input" class="form-control" rows="3" required="required" maxlength="255" placeholder="Viết bình luận (Vui lòng nhập tiếng việt có dấu)" ></textarea>
                  </div>



                  <button type="submit" class="btn btn-primary">gửi câu trả lời</button>
                </form>
              </div>
              @endif
            </div>
            @endif
          </div>

          @endforeach
        </div>
          <div class="text-center" style="margin-left: 40%;">
                    {{ $comments->links() }}
          </div>
        <!--end hỏi đáp về sản phẩm -->
      </div>

    
</div>


<script type="text/javascript">
  function CHANGERCOLOR(m,n){
        
        console.log(m,n);
        let idColor = "#COLOR_ID"+n;
        let classCLPR =".COLOR_PRID"+m;
        $(classCLPR).removeClass('border-warning');
        $(idColor).addClass('border-warning');
        let URLcolor = "{{ url('public') }}/uploads/product_colors/";
        $(".IMAGE").removeClass("active");
        $(".IMAGE1").addClass("active");
        $("#IMAGE1").attr('src', URLcolor+$(idColor).attr("IMAGE1"));
        $("#IMAGE2").attr('src', URLcolor+$(idColor).attr("IMAGE2"));
        $("#IMAGE3").attr('src', URLcolor+$(idColor).attr("IMAGE3"));
        $("#IMAGE4").attr('src', URLcolor+$(idColor).attr("IMAGE4"));
        $("#IMAGE5").attr('src', URLcolor+$(idColor).attr("IMAGE5"));
        
      }

</script>


@stop() 