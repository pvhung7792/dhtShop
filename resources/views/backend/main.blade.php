@if(! Auth::guard('user')->check())
<p>vui lòng đăng nhập trức khi sử dụng <a href="{{ route('login') }}">{{ route('login') }}</a></p>

@elseif(Auth::guard('user')->user()->role==0)
<p>Bạn không có quyền truy cập vào trang này</p>
@elseif(Auth::guard('user')->check() && (Auth::guard('user')->user()->role==1 || Auth::guard('user')->user()->role==2))


<!-- phần đầu (header) -->

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>@yield('title')</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Custom fonts for this template-->
        <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="{{ url('public') }}/backend/css/sb-admin-2.min.css" rel="stylesheet">
        <link href="{{ asset('public') }}/backend/css/sb-admin-2.min.css" rel="stylesheet">

        <!-- data table -->
        <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <!-- <script src="https://cdn.ckeditor.com/4.15.1/full/ckeditor.js"></script> -->
        <script src="{{url('public')}}/backend/ckeditor/ckfinder/ckfinder.js"></script>
        <!-- Link sweat alert 2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.2/dist/sweetalert2.min.css">
    @yield('linkCkeditor')
    </head>

    <body id="page-top">

    <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home.index') }}">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fa fa-smile-o" aria-hidden="true"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">DHTshop Admin <sup>2</sup></div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home.index') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Trang Chủ Admin</span></a>
                </li>

                    <!-- Divider -->
                <hr class="sidebar-divider my-0">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Trang người dùng</span></a>
                </li>

                    <!-- Divider -->
                <hr class="sidebar-divider">

                    <!-- Heading -->
                <div class="sidebar-heading">
                    Quản lý dữ liệu 
                </div>
                <li class="nav-item">
                    <a class="nav-link py-1" href="{{route('category.index')}}">
                        <span class="font-weight-bold">Danh Mục</span>
                    </a>
                    <a class="nav-link py-1" href="{{route('brand.index')}}">
                        <span class="font-weight-bold">Hãng Sản Xuất</span>
                    </a>
                    <a class="nav-link py-1" href="{{route('product.index')}}">
                        <span class="font-weight-bold">Sản Phẩm</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    Quản lý đơn hàng
                </div>
                <li class="nav-item">
                    <a class="nav-link py-1" href="{{route('order.index')}}">
                        <span class="font-weight-bold">Danh Sách Đơn Hàng</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    Quản lý giao diện
                </div>
                <li class="nav-item">
                    <a class="nav-link py-1" href="{{route('config.index')}}">
                        <span class="font-weight-bold">Cấu Hình</span>
                    </a>
                    <a class="nav-link py-1" href="{{route('banner.index')}}">
                        <span class="font-weight-bold">Banner</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    Quản lý người dùng
                </div>
                <li class="nav-item">
                    <a class="nav-link py-1" href="{{route('user.index')}}">
                        <span class="font-weight-bold">Người Dùng</span>
                    </a>
                    <a class="nav-link py-1" href="{{route('comment.index')}}">
                        <span class="font-weight-bold">Bình Luận</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    Quản lý khác
                </div>
                <li class="nav-item">
                    <a class="nav-link py-1" href="{{route('promotion.index')}}">
                        <span class="font-weight-bold">Khuyến Mại</span>
                    </a>
                    <a class="nav-link py-1" href="{{route('blog_cate.index')}}">
                        <span class="font-weight-bold">Tin tức</span>
                    </a>
                    
                </li>

                    <!-- <div>
                        <div class="bg-white px-4">
                            <a href="{{route('category.index')}}">Danh Mục</a>
                            <a href="{{route('brand.index')}}">Hãng Sản Xuất</a>
                            <a href="{{route('banner.index')}}">Banner</a>
                            <a href="{{route('user.index')}}">Người Dùng</a>
                            <a href="{{route('promotion.index')}}">Chương trình khuyến mại</a>
                            <a href="{{route('config.index')}}">Quản lý cấu hình</a>
                            <a href="{{route('blog_cate.index')}}">Quản lý blog</a>
                        </div>
                    </div> -->


                <!-- <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">

                        <span class="font-weight-bold">Sản Phẩm - Đơn Hàng</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">

                            <a class="collapse-item" href="{{route('product.index')}}">Sản Phẩm</a>
                            <a class="collapse-item" href="{{route('comment.index')}}">Hỏi Đáp</a>
                            <a class="collapse-item" href="{{route('order.index')}}">Đơn Hàng</a>

                        </div>
                    </div>
                </li> -->
                    <!-- Nav Item - Utilities Collapse Menu -->

                <!-- <hr class="sidebar-divider"> -->

                <!-- <div class="sidebar-heading">
                    Thông tin thêm
                </div> -->

                <!-- Nav Item - Pages Collapse Menu -->
                <!-- <li class="nav-item">
                    <a class="nav-link py-1" href="#">
                        <span class="font-weight-bold">Danh sách bán chạy</span>
                    </a>
                </li> -->



            </ul>
                <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">


                        <!-- Topbar Search -->
                        

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            <!-- Nav Item - Alerts -->
                            

                                <!-- Nav Item - Messages -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                    <!-- Counter - Messages -->
                                    <span class="badge badge-danger badge-counter">{{ $numb_q }}</span>
                                </a>
                                    <!-- Dropdown - Messages -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="messagesDropdown">
                                    <h6 class="dropdown-header">
                                        Câu hỏi Khách Hàng
                                    </h6>
                                    @foreach($question_home as $ques)
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <div class="icon-circle bg-primary">
                                                {{ strtoupper(substr($ques->user->first_name ,0,1)) }}
                                            </div>
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate">{{ $ques->question }}</div>
                                            <div class="small text-gray-500">{{ $ques->user->first_name }} ·  {{ $ques->created_at->diffForHumans($now) }} </div>
                                        </div>
                                    </a>
                                    @endforeach
                                    <a class="dropdown-item text-center small text-gray-500" href="{{ route('comment.index') }}">xem tất cả các câu hỏi </a>
                                </div>
                            </li>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                             <!-- Nav Item - User Information -->
                             <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::guard('user')->user()-> first_name }} {{ Auth::guard('user')->user()-> last_name }}</span>

                                        @if(Auth::guard('user')->user()->role==1)
                                        <div class="icon-circle bg-danger">
                                            ADM
                                        </div>
                                        @endif
                                        @if(Auth::guard('user')->user()->role==2)
                                        <div class="icon-circle bg-danger">
                                            QTV
                                        </div>
                                        @endif


                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav><!-- kết thúc phần đầu (header) -->




@yield('content_admin')





                 <!-- phần cuối footer -->

 </div>
                <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span> &copy; DHT-editcode tháng 12 năm 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span aria-hidden="true">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        @yield('script')
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <!-- <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
        <script>
            $('.del-btn').click(function(e){
                e.preventDefault();
                let form = $(this).parent('form');
                Swal.fire({
                    title: "Bạn có chắc chắn muốn xóa?",
                    type: 'warning',
                    confirmButtonText: 'Có',
                    showCancelButton: true,
                    cancelButtonText: 'Không',
                    cancelButtonColor: 'red',
                    preConfirm: function() {
                        form.submit();
                    }
                })
            })
        </script>

        
</body>

</html>
@endif
