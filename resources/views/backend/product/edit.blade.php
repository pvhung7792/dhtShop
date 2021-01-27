@extends('backend.main') 

@section('title','Cập nhật sản phẩm')

@section('content_admin')


<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="h3 mb-2 text-gray-800">
        <h1>Quản Lý <span class="text-danger">Sản phẩm</span></h1>
    </div>
    <div class="card-body">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 text-primary"><span class="font-weight-bold">Cập nhật thông tin </span> sản phẩm</h6>
            </div>
            <div class="row">
                <div class="col-md-6 ">
                    <form class="m-4" method="POST" action="{{ route('product.update',$product->id) }}" enctype='multipart/form-data'>
                        @csrf @method('PUT')
                        <input type="text" name="id" value="{{$product->id}}" hidden>
                        <div class=" form-group">
                                <label class="font-weight-bold text-success" for="category">Tên danh mục </label>
                                <select class="form-control border border-success" id="category_id" name="category_id">
                                  @foreach($category as $cate)
                                  <option value="{{$cate->id}}" 
                                    @if((($cate->id==$product->brand->category_id)&&old('category_id')=='')||(old('category_id')==$cate->id))
                                        {{'selected'}}
                                    @endif>
                                    {{$cate->name}}</option>
                                  @endforeach
                              </select>
                        </div>

                        <div class=" form-group">
                            <label class="font-weight-bold text-success">Hãng sản xuất </label>
                            <select class="form-control border border-success" id="brand_id" name="brand_id">
                                @foreach($brand as $bra)
                                <option value="{{$bra->id}}" class="cate{{$bra->category_id}}"
                                    @if((($bra->id==$product->brand_id)&&old('brand_id')=='')||(old('brand_id')==$bra->id))
                                        {{'selected'}}
                                    @endif
                                    >{{$bra->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class=" form-group">
                            <label class="font-weight-bold text-success" for="name">Tên sản phẩm </label>
                            <input type="text" class=" form-control border border-success" id="name" name="name" value="{{(old('name'))?old('name'):$product->name}}">

                            @error('name')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class=" form-group">
                            <label class="font-weight-bold text-success" for="slug">Đường dẫn</label>
                            <input type="text" class=" form-control border border-success" id="slug" name="slug" value="{{(old('slug'))?old('slug'):$product->slug}}">

                            @error('slug')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class=" form-group">
                            <label class="font-weight-bold text-success" for="fileImage">Ảnh </label>
                            <input type="file" class=" form-control border border-success" id="fileImage" name="fileImage">

                            @error('fileImage')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class=" form-group">
                            <label class="font-weight-bold text-success" for="promotion_id">Khuyến mại đi kèm</label>
                            <select class="form-control border border-success" id="promotion_id" name="promotion_id">
                                @foreach($promotion as $promo)
                                <option value="{{$promo->id}}"  {{($promo->id==old('promotion_id')?'selected':'')}}>{{$promo->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold text-success" for="origin">Xuất sứ </label>
                            <input type="text" class=" form-control border border-success" id="origin" name="origin" value="{{(old('origin'))?old('origin'):$product->origin}}">

                            @error('origin')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class=" form-group col-md-6">
                            <label class="font-weight-bold text-success" for="year">Năm sản xuất </label>
                            <input type="text" class=" form-control border border-success" id="year" name="year" value="{{(old('year'))?old('year'):$product->year}}">

                            @error('year')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        
                        <div class=" form-group col-md-6">
                            <label class="font-weight-bold text-success" for="battery">Pin </label>
                            <input type="text" class=" form-control border border-success" id="battery" name="battery" value="{{(old('battery'))?old('battery'):$product->battery}}">

                            @error('battery')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class=" form-group col-md-6">
                            <label class="font-weight-bold text-success" for="sim">Sim</label>
                            <input type="text" class=" form-control border border-success" id="sim" name="sim" value="{{(old('sim'))?old('sim'):$product->sim}}">

                            @error('sim')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class=" form-group col-md-6">
                            <label class="font-weight-bold text-success" for="screen_size">Kích thước màn hình</label>
                            <input type="text" class=" form-control border border-success" id="screen_size" name="screen_size" value="{{(old('screen_size'))?old('screen_size'):$product->screen_size}}">

                            @error('screen_size')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class=" form-group col-md-6">
                            <label class="font-weight-bold text-success" for="gpu">GPU</label>
                            <input type="text" class=" form-control border border-success" id="gpu" name="gpu" value="{{(old('gpu'))?old('gpu'):$product->gpu}}">

                            @error('gpu')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class=" form-group col-md-6">
                            <label class="font-weight-bold text-success" for="os">Hệ điều hành</label>
                            <input type="text" class=" form-control border border-success" id="os" name="os" value="{{(old('os'))?old('os'):$product->os}}">

                            @error('os')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class=" form-group col-md-6">
                            <label class="font-weight-bold text-success" for="weight">Trọng lượng</label>
                            <input type="text" class=" form-control border border-success" id="weight" name="weight" value="{{(old('weight'))?old('weight'):$product->weight}}">

                            @error('weight')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        </div>

                        <div class=" form-group">
                            <label class="font-weight-bold text-success" for="in_box">Phụ kiện đi kèm</label>
                            <input type="text" class=" form-control border border-success" id="in_box" name="in_box" value="{{(old('in_box'))?old('in_box'):$product->in_box}}">

                            @error('in_box')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class=" form-group">
                            <label class="font-weight-bold text-success" for="status">Trạng thái </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1" 
                                @if(($product->status==1&&old('status')=='')||old('status')==1)
                                  {{'checked'}}
                                @endif
                                >
                                <label class="form-check-label" for="exampleRadios1">
                                    Hiện
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="0"
                                @if(($product->status==0&&old('status')=='')||(old('status')==0&&old('status')!=''))
                                  {{'checked'}}
                                @endif
                                >
                                <label class="form-check-label" for="exampleRadios2">
                                    Ẩn
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="m-4 text-warning">
                        <h6 class="text-primary font-weight-bold">Hướng dẫn thêm sửa</h6>
                        <strong>Tên sản phẩm:</strong><p>Ký tự nhập vào không dùng ký tự đặc biệt (có thể dùng khoảng trắng).</p>
                        <strong>Trạng thái:</strong><p>Lựa chọn trạng thái ẩn hiện của sản phẩm, nếu chọn "ẩn" thì sản phẩm sẽ không hiển thị ở trang người dùng.</p>
                        <strong>Đường dẫn:</strong><p>Phần hiển thị trên Url, sau khi nhập tên sản phẩm đường dẫn sẽ tự động được tạo, bạn có thể thay đổi đường dẫn nếu muốn.</p>
                        <p class="text-danger">Lưu ý: đường dẫn không nên dùng khoảng trắng mà nên dùng dấu gạch nối, vì nếu dùng khoảng trắng thì trên Url sẽ hiển thị thành "%"</p>
                        <strong>Ảnh logo:</strong><p>File ảnh phải có định dạng: jpg, jpeg, png, bmp, gif, svg, hoặc webp</p>
                        <strong>Xuất sứ, năm sản xuất, dung lượng pin, sim, kích thước màn hình, GPU, hệ điều hành, trọng lượng, phụ kiện đi kèm:</strong><p>Có thể để trống</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->


<script>
    var oldBrand = "{{(old('brand_id')?old('brand_id'):'')}}";

    $(document).ready( function(){
        var cate_id= $('#category_id').val();
        var hien='cate'+cate_id;
        $('#brand_id > option').each(function(){
            if($(this).hasClass(hien)){
                $(this).show();
                // $(this).attr('selected','selected');
            } else{
                $(this).hide();
                $(this).removeAttr('selected');
            }
        })
    });

    $('#category_id').on('change', function(){
        var cate_id= $('#category_id').val();
        var hien='cate'+cate_id;
        $('#brand_id > option').each(function(){
            if($(this).hasClass(hien)){
                $(this).show();
                // $(this).attr('selected','selected');
            } else{
                $(this).hide();
                $(this).removeAttr('selected');
            }
        }) 
        // $(#brand_id).val(cate_id);
        if (oldBrand == '') {
            $('.'+hien).first().attr('selected','selected');
        }

    });

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
</script>


@stop()
