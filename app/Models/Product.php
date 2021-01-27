<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product_detail;
use App\Models\Product_color;
use App\Models\Order_detail;
use App\Models\Wish_list;
use App\Models\Comment;
class Product extends Model
{

    protected $fillable=['brand_id','slug','promotion_id','name','image','sim','status','origin','year','battery','screen_size','in_box','gpu','os','weight'];

    public function add(){
        // upload ảnh
        $file = request()->fileImage;
        $image_name = time().'-'.$file->getClientOriginalName();
        $file->move(public_path('uploads\products'),$image_name);
        // upload dữ liệu
        request()->merge(['image'=>$image_name]);
        $data = request()->except('_token','fileImage','category');
        $product = Product::create($data);
        return [
            'check' => $product,
            'pro_id' => $product ? $product->id:''
        ];
    }

    public function edit(){
        $id = request()->id;
        $product = Product::find($id);
        $image_name = $product->image;

        if(request()->hasFile('fileImage')){
            // Xóa ảnh cũ
            $oldImageName = $product->image;
            $old_img_path = public_path().'/uploads/products/'.$oldImageName;
            // unlink($old_img_path);
            if (file_exists($old_img_path)) {
                // dd('imgage exxtis');
                unlink($old_img_path);
            }
            // Thêm ảnh mới
            $file = request()->fileImage;
            $image_name = time().'-'.$file->getClientOriginalName();
            $file->move(public_path('uploads\products'),$image_name);
        }
        //  update dữ liệu
        request()->merge(['image'=>$image_name]);
        $data = request()->except('_token','fileImage','category','_method','id');
        $check = Product::find($id)->update($data);

        return $check;
    }

    public function del_pro($id){
        // $pro_detail_count = Product_detail::where('product_id',$id)->count();
        // $pro_color_count = Product_color::where('product_id',$id)->count();
        // $comment_count = Comment::where('product_id',$id)->count();
        // $wish_list_count = Wish_list::where('product_id',$id)->count();


        // kiêm tra xem nếu sản phẩm này vẫn còn trong đơn hàng thì không được xóa
        $order_detail_count = 0;

        $pro_detail= Product_detail::where('product_id',$id)->get();
        foreach ($pro_detail as $detail) {
             $order_detail_count += Order_detail::where('pro_detail_id',$detail->id)->count();
        }

        
        if ($order_detail_count>0) {
            return [
                'check'=>false,
                'mess' =>'Không thể xóa sản phẩm này, còn '.$order_detail_count.' sản phẩm trong đơn hàng'
            ];
        }else{
            // Xóa comment liên quan đến sản phẩm
            $comment = Comment::where('product_id',$id)->get();
            foreach ($comment as $cmt) {
                Comment::find($cmt->id)->delete();
            }
            // Xóa wish list liên quan đến sản phẩm
            $wish_list = Wish_list::where('product_id',$id)->get();
            foreach ($wish_list as $wl) {
                Wish_list::find($wl->id)->delete();
            }
            // Xóa ảnh sản phẩm theo màu
            $pro_color = Product_color::where('product_id',$id)->get();
            $product_color = new Product_color;
            foreach ($pro_color as $color) {
                $product_color->del($color->id);
            }
            // Xóa detail sản phẩm
            $pro_detail = Product_detail::where('product_id',$id)->get();
            foreach ($pro_detail as $detail) {
                Product_detail::find($detail->id)->delete();
            }

            $product = Product::find($id);
            $check =  $product->delete();

            if ($check) {
            // nếu được xóa thì xóa cả ảnh sản phẩm
                $image = $product->image;
                $image_path = public_path().'/uploads/products/'.$image;
                // unlink($image_path);
                if (file_exists($image_path)) {
                // dd('imgage exxtis');
                unlink($image_path);
                }
            }

            return [
                'check'=>$check,
                'mess' =>($check)?'Xóa sản phẩm thành công':'Có lỗi xảy ra, vui lòng thử lại'
            ];
        }
    }

     public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
    public function promotion(){
        return $this->belongsTo('App\Models\Promotion', 'promotion_id', 'id');
    }
    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'id');
    }
    public function product_detail(){
        return $this->hasMany('App\Models\Product_detail','product_id','id');
    }
    public function product_color(){
        return $this->hasMany('App\Models\Product_color','product_id','id');
    }
    public function wish_list(){
        return $this->hasMany('App\Models\Wish_list','product_id','id');
    }
     public function comment(){
        return $this->hasMany('App\Models\Comment','product_id','id');
    }
}
