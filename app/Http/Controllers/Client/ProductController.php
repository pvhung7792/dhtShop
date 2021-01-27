<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wish_list;
use App\Models\Comment;
use Carbon\Carbon;
use Auth;
use App\Http\Requests\PostCommentRequest;

class ProductController extends Controller
{
    public function index($cate_slug,$pro_slug){
        // dd($pro_slug);
        //dd($category_id,$product_id);
        $product_id = Product::where('slug',$pro_slug)->first()->id;

        $product = Product::where('status',1)->whereId($product_id)->first();
        if($product){
            $comments=Comment::where('status',1)->where('product_id',$product->id)->orderBy('updated_at','desc')->paginate(5);
                /*tính thời gian để đưa ra thời gian trênh lệch với hiện tại*/
                Carbon::setLocale('vi');
                $now = Carbon::now('Asia/Ho_Chi_Minh');//thời gian hiện tại
                /*$comment=Comment::find($id);*/
                /*$timeold=$comment->created_at;*/
                /*dd($timeold->diffForHumans($now));*/ //sa sánh thời gian muốn lấy với thời gian hiện tại
                if (Auth::guard('user')->check()) {
                    $wish = Wish_list::where('user_id',Auth::guard('user')->user()->id)->paginate(10);
                    return view('frontend.product.index',compact('product','comments','now',"wish"));
                }
            return view('frontend.product.index',compact('product','comments','now'));
        }
        
    }
    
    public function question(PostCommentRequest $request)
    {

        $commet=$request->except('_token');
        Comment::create($commet);
        return redirect()->back();
    }
}
