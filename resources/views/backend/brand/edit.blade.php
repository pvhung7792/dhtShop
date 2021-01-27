@extends('backend.main') 

@section('title','Cập nhật thương hiệu')

@section('content_admin')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản Lý <span class="text-warning">thương hiệu</span></h1>
    
    <div class="card-body">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 text-primary"><span class="font-weight-bold">Cập nhật</span> thương hiệu</h6>
            </div>
            <div class="row">
                <div class="col-md-6 ">
                    <form class="m-4" method="POST" action="{{ route('brand.update',$brand->id) }}" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <input type="text" name="id" value="{{$brand->id}}" hidden>
                        <div class=" form-group">
                            <label class="font-weight-bold text-success" for="name">Tên thương hiệu </label>
                            <input type="text" class="form-control border border-success" id="name" name="name" value="{{(old('name'))?old('name'):$brand->name}}">
                            @error('name')
                                <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class=" form-group">
                            <label class="font-weight-bold text-success">Chọn danh mục </label>
                            <select name="category_id" class="form-control border border-success">
                                @foreach($category as $cate)
                                <option value="{{$cate->id}}" 
                                    @if((($cate->id==$brand->category_id)&&old('category_id')=='')||(old('category_id')==$cate->id))
                                        {{'selected'}}
                                    @endif>
                                    {{$cate->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class=" form-group">
                            <label class="font-weight-bold text-success">Trạng thái </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="1" id="radio1"
                                @if(($brand->status==1&&old('status')=='')||old('status')==1)
                                  {{'checked'}}
                                @endif
                                >
                                <label class="form-check-label" for="radio1">
                                    Hiện
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="0" id="radio2"
                                @if(($brand->status==0&&old('status')=='')||(old('status')==0&&old('status')!=''))
                                  {{'checked'}}
                                @endif
                                >
                                <label class="form-check-label" for="radio2">
                                    Ẩn
                                </label>
                            </div>
                        </div>
                        <div class=" form-group">
                            <label class="font-weight-bold text-success">Đường dẫn </label>
                            <input type="text" class="form-control border border-success" id="slug" name="slug" value="{{(old('name'))?old('name'):$brand->slug}}">
                            @error('slug')
                                <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold text-success">Ảnh logo </label>
                            <!-- <input type="text" name="oldImgName" value="{{$brand->logo}}" hidden> -->
                            <input type="file" class="form-control border border-success" id="logoImg" name="logoImg" >
                            @error('logoImg')
                                <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                                <small class="help-block text-danger" id="imageErr"></small>
                            </div>
                        <div class="form-group"> 
                            <img src="{{url('public')}}/uploads/brands/{{$brand->logo}}" alt="" style="max-height: 150px">
                        </div>  
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="m-4 text-warning">
                        <h6 class="text-primary font-weight-bold">Hướng dẫn thêm sửa</h6>
                        <strong>Tên nhãn hiệu:</strong><p>Ký tự nhập vào không dùng ký tự đặc biệt (có thể dùng khoảng trắng).</p>
                        <strong>Trạng thái:</strong><p>Lựa chọn trạng thái ẩn hiện của nhãn hiệu, nếu chọn "ẩn" thì nhãn hiệu sẽ không hiển thị ở trang người dùng.</p>
                        <strong>Đường dẫn:</strong><p>Phần hiển thị trên Url, sau khi nhập tên nhãn hiệu đường dẫn sẽ tự động được tạo, bạn có thể thay đổi đường dẫn nếu muốn.</p>
                        <p class="text-danger">Lưu ý: đường dẫn không nên dùng khoảng trắng mà nên dùng dấu gạch nối, vì nếu dùng khoảng trắng thì trên Url sẽ hiển thị thành "%"</p>
                        <strong>Ảnh logo:</strong><p>File ảnh phải có định dạng: jpg, jpeg, png, bmp, gif, svg, hoặc webp</p>
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
    function removeAccents(str) {
      var AccentsMap = [
      "aàảãáạăằẳẵắặâầẩẫấậ",
      "AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬ",
      "dđ", "DĐ",
      "eèẻẽéẹêềểễếệ",
      "EÈẺẼÉẸÊỀỂỄẾỆ",
      "iìỉĩíị",
      "IÌỈĨÍỊ",
      "oòỏõóọôồổỗốộơờởỡớợ",
      "OÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢ",
      "uùủũúụưừửữứự",
      "UÙỦŨÚỤƯỪỬỮỨỰ",
      "yỳỷỹýỵ",
      "YỲỶỸÝỴ"    
      ];
      for (var i=0; i<AccentsMap.length; i++) {
        var re = new RegExp('[' + AccentsMap[i].substr(1) + ']', 'g');
        var char = AccentsMap[i][0];
        str = str.replace(re, char);
    }
    return str;
}

$('#name').on('focusout', function(){
    var name = $('#name').val();
    name = name.trim();
    name = removeAccents(name);
    var slug = name.replace(/\s/g, "-");
    slug = slug.toLowerCase();
    $("#slug").val(slug);
})

$('form').submit(function(e){
    // var upload = $('#logoImg');
    var fileSize = $('#logoImg')[0].files[0].size;
    if (fileSize > 1024*10*1024) {
        e.preventDefault();
        $('#imageErr').html('file vượt quá giới hạn');
    }
    // console.log(fileSize);
})

</script>

@stop()

