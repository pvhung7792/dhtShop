<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Product_detail;

use App\Models\Brand;

class CategoryController extends Controller
{
    public function index(Request $request){

        $id=$request->categoryID;
        $category=Category::where('status',1)->whereId($id)->first();
        /*$BRANDid = $request->ValueBrand;*/
        

            $bannerCate=Banner::where('status',1)->where('cate_id',$id)->get();
            $brand=Brand::where('status',1)->where('category_id',$id)->get();
            $arr_brand= array();
            $arr_product= array();
            $arr_product_detail= array();
            $arr_productDetail= array();
            
            
            if($request->BRANDid){

                $arr_brand=$request->BRANDid;
                
            }else{
                foreach ($brand as $value) {
               
                    $arr_brand[]=$value->id;
                 
                }
            
            }

            
            $product = Product::whereIn('brand_id',$arr_brand)->get();
            
             foreach ($product as $value) {
                                $arr_product[]=$value->id;
                            };

                     $pricelevel=$request->price;
            if($pricelevel){
                            
                        $price_max=$pricelevel*5000000;
                        $price_min=($pricelevel-1)*5000000;
                        if($pricelevel==5){
                            $product_detail=Product_detail::whereIn('product_id',$arr_product)->where('price','>',$price_min)->get();
                        }else{
                            $product_detail=Product_detail::whereIn('product_id',$arr_product)->whereBetween('price',[$price_min,$price_max])->get();
                        }
                        
                        foreach ($product_detail as $value) {
                            $arr_productDetail[]=$value->product_id;
                        }
                         $arr_productDetail=array_unique($arr_productDetail);
                         $product = $product->whereIn('id',$arr_productDetail);
                       
                }else{
                    
                };

           
             $SapXepDK = $request->THSLDK;
          
            /*ưu tiên xem theo sắp xếp*/
                    if($SapXepDK){
                        switch ($SapXepDK) {
                        case 1:
                            $product=$product->sortByDesc('created_at');
                            break;
                        case 2:
                            $product=$product->sortBy('created_at');
                            break;
                        case 3:
                            $product_detail=Product_detail::whereIn('product_id',$arr_product)->orderBy('price',"desc")->get();
                            foreach ($product_detail as $value) {
                                $arr_product_detail[]=$value->product_id;
                            }

                            $arr_product_detail=array_unique($arr_product_detail);
                            /* sắp xếp $product theo 1 mảng có sẵn $arr_product_detail*/
                            $product = $product->sortBy(function ($product) use ($arr_product_detail) {
                                        return array_search($product->id,$arr_product_detail);});
                            break;
                        case 4:
                           $product_detail=Product_detail::whereIn('product_id',$arr_product)->orderBy('price',"asc")->get();
                            foreach ($product_detail as $value) {
                                $arr_product_detail[]=$value->product_id;
                            }

                            $arr_product_detail=array_unique($arr_product_detail);
                            
                            $product = $product->sortBy(function ($product) use ($arr_product_detail) {
                                        return array_search($product->id,$arr_product_detail);});
                            break;
                        default:
                             $product=$product->sortByDesc('created_at');
                            break;
                        }
                    };

                

               
                
                
        
           

            return view('frontend.category.index',compact('category','bannerCate','brand','product','SapXepDK','arr_brand','pricelevel'));
        

       
    }
    public function brand(Request $request){
        
        $brand_id=$request->brandID;
        $brand=Brand::where('status',1)->whereId($brand_id)->first();
        
        if($brand){
            $product=$brand->product;
            $category=Category::where('status',1)->whereId($brand->category_id)->first();
            $bannerCate=Banner::where('status',1)->where('cate_id',$brand->category_id)->get();
            return view('frontend.category.brand',compact('category','bannerCate','brand','product'));
        }else{
            return redirect('/');
        }
    }
    
}
