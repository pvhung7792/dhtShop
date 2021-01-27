@extends('backend.main') 

@section('title','Sửa banner')

@section('content_admin')



<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Quản Lý <span class="text-danger">Banner</span></h1>
    <div class="card-body">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 text-primary"><span class="font-weight-bold">Sửa</span> banner</h6>
            </div>
            <div class="row">
                <div class="col-md-6 ">
                    <form class="m-4" method="POST" action="{{ route('banner.update',$banner->id) }}" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <input type="text" hidden name="id" value="{{$banner->id}}">
                        <div class=" form-group">
                            <label class="font-weight-bold text-success" for="name">Tên banner</label>
                            <input type="text" class="form-control border border-success" name="name" value="{{(old('name'))?old('name'):$banner->name}}">
                            @error('name')
                                <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold text-success">Danh mục đặt banner</label>
                            <select name="cate_id" class="form-control" id="select">
                                <option value="" {{(old('cate_id')==''||$banner->cate_id=='home')?'selected':''}}>Trang chủ</option>
                                @foreach($category as $cate)
                                <option value="{{$cate->id}}" 
                                @if((($cate->id==$banner->cate_id)&&old('cate_id')=='')||(old('cate_id')==$cate->id))
                                        {{'selected'}}
                                @endif
                                >{{$cate->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div id="select_pos" class="form-group" >
                            <label class="font-weight-bold text-success">Vị trí trên trang chủ</label>
                            <select name="home_pos" class="form-control" id="select_pos_val">
                                <option value="1">Banner chính trang home</option>
                                <option value="2">Banner phụ</option>
                            </select>
                        </div>

                        <div class=" form-group">
                            <label class="font-weight-bold text-success">Tiêu đề</label>
                            <input type="text" class=" form-control border border-success" name="title" value="{{(old('title'))?old('title'):$banner->title}}">
                            @error('title')
                                <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class=" form-group">
                            <label class="font-weight-bold text-success">Liên kết </label>
                            <input type="text" class=" form-control border border-success" name="link" value="{{(old('link'))?old('link'):$banner->link}}">
                            @error('link')
                                <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class=" form-group">
                            <label class="font-weight-bold text-success">Trạng thái </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="1" id='radio1'
                                @if(($banner->status==1&&old('status')=='')||old('status')==1)
                                  {{'checked'}}
                                @endif>
                                <label class="form-check-label" for="radio1">
                                    Hiện
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="0" id='radio2'
                                @if(($banner->status==0&&old('status')=='')||(old('status')==0&&old('status')!=''))
                                  {{'checked'}}
                                @endif>
                                <label class="form-check-label" for="radio2">
                                    Ẩn
                                </label>
                            </div>
                        </div>
                        <div class=" form-group">
                            <label class="font-weight-bold text-success" for="image">Ảnh banner </label>
                            <!-- <input type="text" name="oldImgName" value="{{$banner->image}}" hidden> -->
                            <input type="file" class="form-control border border-success" id="image" name="image">
                            <img src="{{url('public')}}/uploads/banners/{{$banner->image}}" class="img-fluid w-75">
                            @error('image')
                                <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                                <small class="help-block text-danger" id="imageErr"></small>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="m-4 text-warning">
                        <h6 class="text-primary font-weight-bold">Hướng dẫn thêm sửa</h6>
                        <strong>Tên banner:</strong><p>Ký tự nhập vào không dùng ký tự đặc biệt (có thể dùng khoảng trắng), tên banner chỉ dùng cho mục đích tìm kiếm trong trang admin, nên không bắt buộc phải nhập</p>
                        <strong>Chọn vị trí đặt banner:</strong><p>Lựa chọn nơi đặt banner (trang chủ hoặc các trang danh mục khác).</p><p>Đối với vị trí là trang chủ, bạn cần lựa chọn thêm vị trí đặt banner</p>
                        <strong>Trạng thái:</strong><p>Lựa chọn trạng thái ẩn hiện của banner, nếu chọn "ẩn" thì banner sẽ không hiển thị ở trang người dùng.</p>
                        <strong>Đường dẫn:</strong><p>Phần hiển thị trên Url, sau khi nhập tên banner đường dẫn sẽ tự động được tạo, bạn có thể thay đổi đường dẫn nếu muốn.</p>
                        <p class="text-danger">Lưu ý: đường dẫn không nên dùng khoảng trắng mà nên dùng dấu gạch nối, vì nếu dùng khoảng trắng thì trên Url sẽ hiển thị thành "%"</p>
                        <strong>Ảnh banner:</strong><p>File ảnh phải có định dạng: jpg, jpeg, png, bmp, gif, svg, hoặc webp</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@stop()

@section('script')
<script>

    function abc(select_pos_val){
        var select = $('#select').val();
        if (select=='') {
            $('#select_pos').show();
            $('#select_pos_val').val(select_pos_val);
        }else {
            $('#select_pos').hide();
            $('#select_pos_val').val('');
        }
    }

    $('#select').on('change',function(){
        var select_pos_val = 1;
        abc(select_pos_val);
    })

    $(document).ready(function(){
        var select_pos_val = "{{(old('home_pos'))?old('home_pos'):$banner->home_pos}}";
        abc(select_pos_val);
    })

    $('form').submit(function(e){
    // var upload = $('#logoImg');
    var fileSize = $('#image')[0].files[0].size;
    if (fileSize > 20*1024*1024) {
        e.preventDefault();
        $('#imageErr').html('file vượt quá giới hạn');
    }
    // console.log(fileSize);
})
</script>
@stop()