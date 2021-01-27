@extends('backend.main')


@section('content_admin')


    <!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh Sách Thống Kê</h1>
                                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                                </div>

                                <!-- Content Row -->
                                <div> <h4 class="text-danger">Thống kê sản phẩm - thu nhập</h4></div>
                                <div class="row">


                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        hôm nay </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $order_finish_today->sum('total_quantity') }}   <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <h3 class="text-warning">{{ number_format($order_finish_today->sum('total_price'), 0 , ',', '.').' ₫'}}  </h3></div>
                                                    </div>
                                                    <!-- <div class="col-auto">
                                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        hôm qua</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ $order_finish_yesterday->sum('total_quantity') }} <i class="fa fa-long-arrow-right" aria-hidden="true"></i>  <h3 class="text-warning">{{  number_format($order_finish_yesterday->sum('total_price'), 0 , ',', '.').' ₫'}}</h3></div>
                                                    </div>
                                                    <!-- <div class="col-auto">
                                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        trong  7 ngày</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $order_finish_week->sum('total_quantity') }} <i class="fa fa-long-arrow-right" aria-hidden="true"></i>  <h3 class="text-warning">{{ number_format($order_finish_week->sum('total_price'), 0 , ',', '.').'₫'}}</h3></div>
                                                    </div>
                                                    <!-- <div class="col-auto">
                                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pending Requests Card Example -->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        trong 30 ngày</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $order_finish_month->sum('total_quantity') }} <i class="fa fa-long-arrow-right" aria-hidden="true"></i>  <h3 class="text-warning">{{ number_format($order_finish_month->sum('total_price'), 0 , ',', '.').' ₫'}}</h3></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Content Row -->

                                <div class="row">

                                    <!-- Area Chart -->
                                    <div class="col-xl-4 col-lg-6">
                                        <div class="card shadow mb-4">
                                            <!-- Card Header - Dropdown -->
                                            <div
                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Thống kê chi tiết</h6>
                                            
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <h5 class="text-success">Tổng số danh mục : <span class="text-danger">{{ count($category_all) }}/{{ count($cate_all) }}</span></h5>
                                            <h5 class="text-success">Số sản phẩm đang bán : <span class="text-danger">{{ count($product_all) }}/{{ count($pro_block) }}</span></h5>
                                            <h5 class="text-success">Số tài khoản đã đăng ký : <span class="text-danger">{{ count($user_all) }}</span></h5>
                                        </div>
                                    </div>
                                </div>
                                <!-- Pie Chart -->
                                <div class="col-xl-8 col-lg-6">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header - Dropdown -->
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="font-weight-bold text-warning">Đơn hàng đang chờ: <span class="text-danger">{{count($order_on_wait)}}</span> <a href="{{route('order.index')}}?status=0" class=" bg-success p-2 ">xem tất cả</a> </h6> 

                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body table-responsive">
                                          @if(count($order_on_wait)>0)
                                            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>STT</th>
                                                        <th>Số lượng</th>
                                                        <th>Tiền(VNĐ)</th>
                                                        <th>Địa chỉ</th>
                                                        <th>Thời gian</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($order_on_wait as $order)
                                                    <tr>
                                                        <td>{{$loop->index+1}}</td>
                                                        <td>{{$order->total_quantity}}</td>
                                                        <td>{{number_format($order->total_price)}}</td>
                                                        <td>{{$order->address}}</td>
                                                        <td>{{date_format($order->created_at, 'd/m/Y H:i:s')}}</td>
                                                        <td>
                                                            <a href="{{route('order.show',$order->id)}}" class="text-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                          <!-- Content Row -->
                          <div class="row">
             <!-- Content Column -->
             <div class="col-lg-6 mb-4">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Top sản phẩm bán chạy trong ngày</h6>
                </div>
                <!-- Card Body -->
                <div class="p-0 card-body">
                    <table class="table table-hover">
                       <thead>
                <tr>
                   <th>STT</th>
                   <th>Tên sản phẩm</th>
                   <th>Số lượng</th>
                   
               </tr>
           </thead>
           <tbody>
            @foreach($array_pro_quantity as $item)
            <tr>
               <td>{{$loop->index+1}}</td>
               <td>{{ $item['name'] }}</td>
               <td>{{ $item['quantity'] }}</td>
              
           </tr>
           @endforeach
       </tbody>
             </table>
         </div>
     </div>
 </div>

 <!-- Color System -->

 <div class="col-lg-6 mb-4">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Top sản phẩm bán chạy trong 7 ngày</h6>

        </div>
        <!-- Card Body -->
        <div class="p-0 card-body">
          <table class="table table-hover">
             <thead>
                <tr>
                   <th>STT</th>
                   <th>Tên sản phẩm</th>
                   <th>Số lượng</th>
                   
               </tr>
           </thead>
           <tbody>
            @foreach($array_pro_quantity_week as $item)
            <tr>
               <td>{{$loop->index+1}}</td>
               <td>{{ $item['name'] }}</td>
               <td>{{ $item['quantity'] }}</td>
              
           </tr>
           @endforeach
       </tbody>
   </table>
</div>
</div>

</div>   
            <div class="col-lg-6 mb-4">

                    <!-- Illustrations -->
               <div class="card shadow mb-4">
                   <!-- Card Header - Dropdown -->
                   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                     <h6 class="m-0 font-weight-bold text-primary">Top sản phẩm bán chạy trong 30 ngày</h6>

                 </div>
               <!-- Card Body -->
               <div class="p-0 card-body">
                   <table class="table table-hover">
                     <thead>
                <tr>
                   <th>STT</th>
                   <th>Tên sản phẩm</th>
                   <th>Số lượng</th>
                   
               </tr>
           </thead>
           <tbody>
            @foreach($array_pro_quantity_month as $item)
            <tr>
               <td>{{$loop->index+1}}</td>
               <td>{{ $item['name'] }}</td>
               <td>{{ $item['quantity'] }}</td>
              
           </tr>
           @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="row">



    <!-- Approach -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ghi chú</h6>
        </div>
        <div class="card-body">
            <p class="text-dark">SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                CSS bloat and poor page performance. Custom CSS classes are used to create
            custom components and custom utility classes.</p>
            <p class="mb-0 text-dark">Before working with this theme, you should become familiar with the
            Bootstrap framework, especially the utility classes.</p>
        </div>
    </div>

</div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



@stop()