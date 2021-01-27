 @extends('backend.main')

@section('linkCkeditor')
<script src="https://cdn.ckeditor.com/4.15.1/full/ckeditor.js"></script>
@stop()
@section('content_admin')


  <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Sửa <span class="text-warning">Blog</span></h1>
                    <!-- <p class="mb-4">vui lòng chắc chắn rằng không còn bất cứ <span class="text-warning">sản phẩm "S"</span> hoặc <span class="text-warning">ảnh quảng cáo "A"</span> hoặc <span class="text-warning">banner "B"</span> nào liên quan đến <span class="text-warning">Danh Mục</span> trước khi <span class="text-warning">XÓA</span>. Hoặc có thể <span class="text-warning">ẨN</span> danh mục thay vì xóa nó .</p> -->
                      <div class="card-body">


                    <!-- <div class="collapse" id="collapseExample"> -->
                        <!-- thêm show vào class để trạng thái ban đầu là hiện -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 text-primary"><span class="font-weight-bold">thêm hoặc sửa </span> thư mục</h6>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 ">
                                    <form class="m-4" method="POST" action="{{route('blog.update',$blog->id)}}" enctype="multipart/form-data"  >
                                        @csrf @method('PUT')
                                        <input type="text" name='id' value="{{$blog->id}}" hidden>
                                        <input type="text" name='blog_cate_id' value="{{$blog->blog_cate_id}}" hidden>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Chủ đề</label>
                                            <input class="form-control" id="exampleFormControlTextarea1" name="title" rows="3" value="{{$blog->title}}">
                                            @error('title')
                                                <small class="help-block text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class=" form-group">
                                            <label class="font-weight-bold text-success" for="name">Ảnh đại diện</label>
                                            <input type="file" class="form-control border border-success" name="fileImage" value="">
                                            <img src="{{url('public')}}/uploads/blogs/{{$blog->image}}" width="150px" alt="">
                                            @error('fileImage')
                                                <small class="help-block text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Tóm tắt</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" name="summary" rows="3" >{{$blog->summary}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Nội dung</label>
                                            <textarea class="form-control" id="editor" name="content" rows="8">{{$blog->content}}</textarea>
                                        </div>

                                        <div class=" form-group">
                                            <label class="font-weight-bold text-success" for="status">Trạng thái</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1"
                                                @if(($blog->status==1&&old('status')=='')||old('status')==1)
                                                    {{'checked'}}
                                                @endif>
                                              <label class="form-check-label" for="exampleRadios1">
                                                Hiện
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="0"
                                                @if(($blog->status==0&&old('status')=='')||(old('status')==0&&old('status')!=''))
                                                    {{'checked'}}
                                                @endif
                                                >
                                                <label class="form-check-label" for="exampleRadios2">
                                                    Ẩn
                                                </label>
                                            </div>
                                        </div>
                                        <button type="submit"  class="btn btn-primary">submit</button>
                                    </form>
                                </div>

                                <div class="col-md-6">
                                    <div class="m-4">
                                        <h6 class="text-primary font-weight-bold">Hướng dẫn thêm sửa</h6>

                                    </div>

                                </div>
                            </div>

                        </div>

                    <!-- </div> -->
                </div>
                    <!-- DataTales Example -->


                </div>
                                    <!-- DataTales Example -->
        <script>
            CKFinder.setupCKEditor();
             CKEDITOR.replace('editor');
        </script>
                <!-- /.container-fluid -->

@stop()
