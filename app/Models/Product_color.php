<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product_color extends Model
{
    protected $fillable=['name','logo','image1','image2','image3','image4','image5','status','product_id'];

    public function add(){
        if(request()->hasFile('fileLogo')){
            $file = request()->fileLogo;
            $file_name = time().'-'.$file->getClientOriginalName();
            $file->move(public_path('uploads\product_colors'),$file_name);
        }else{
            echo "string logo";
        }
        // dd(request()->all());
        request()->merge(['logo'=>$file_name]);

        $file = request()->fileImage;
        // dd(request()->fileImage);
        if(request()->hasFile('fileImage')){
            foreach($file as $key => $fi){
                // dd($loop->index+1);
            $file_image = time().'-'.$fi->getClientOriginalName();
            $fi->move(public_path('uploads\product_colors'),$file_image);
            // echo ('image'.($key+1));
            request()->merge(['image'.($key+1)=>$file_image]);
            }
        }else{
            echo "string image";
        }

        $data = request()->except('_token','fileImage');
        // dd($data);
        $color = Product_color::create($data);
        //  dd($color);
        // $config = request()->all();
        // dd($config);
        return $color;
    }
    public static function del($id){

       //xóa ảnh
        $oldLogo = Product_color::find($id)->logo;
        $old_logo_path = public_path().'/uploads/product_colors/'.$oldLogo;
        if(!empty($oldLogo)){
            if(file_exists(public_path().'/uploads/product_colors/'.$oldLogo)){
                unlink($old_logo_path);
            }
        }
        // unlink($old_logo_path);

        for($i=1;$i<6;$i++){
            $image = 'image'.$i;
            // echo $image;
            $oldImage = Product_color::find($id)->$image;
            // echo $oldImage;
            $old_image_path = public_path().'/uploads/product_colors/'.$oldImage;
            if(!empty($oldImage)){
                if(file_exists(public_path().'/uploads/product_colors/'.$oldImage)){
                    unlink($old_image_path);
                }
            }

    		//
        }

        //xóa DB
        $color= Product_color::find($id)->delete();
        return $color;
    }
    public function edit($id){
        if(request()->hasFile('fileLogo')){
            // xóa anh
            $oldLogo = Product_color::find($id)->logo;
            $old_logo_path = public_path().'/uploads/product_colors/'.$oldLogo;
            if(!empty($oldLogo)){
                if(file_exists(public_path().'/uploads/product_colors/'.$oldLogo)){
                    unlink($old_logo_path);
                }
            }
            // them ảnh
            $file = request()->fileLogo;
            $file_logo = time().'-'.$file->getClientOriginalName();
            $file->move(public_path('uploads\product_colors'),$file_logo);

        }else{
            $file_logo =  Product_color::find($id)->logo;
        }
        request()->merge(['logo'=>$file_logo]);
        for($i=1;$i<6;$i++){
            $fileImage = 'fileImage'.$i;
            $image = 'image'.$i;
            // echo  $image;
            if(request()->hasFile("$fileImage")){
                //Xóa anh
                $oldImage = Product_color::find($id)->$image;

                $old_image_path = public_path().'/uploads/product_colors/'.$oldImage;
    		    if(!empty($oldImage)){
                    if(file_exists(public_path().'/uploads/product_colors/'.$oldImage)){
                        unlink($old_image_path);
                    }
                }
                //thêm ảnh
                $file = request()->$fileImage;
                $file_name = time().'-'.$file->getClientOriginalName();
                $file->move(public_path('uploads\product_colors'),$file_name);
            }else{
                $file_name =  Product_color::find($id)->$image;
            }
        request()->merge(["$image"=>$file_name]);
         $data = request()->except('_token','_method');
        }
        // dd($data);
        $color = Product_color::find($id)->update($data);
        // dd($color);
        return $color;
    }
    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

}
