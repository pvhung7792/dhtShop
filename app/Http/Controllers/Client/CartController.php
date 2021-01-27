<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Cart;
use App\Models\Product;
use App\Models\Product_detail;
use Auth;
use Mail;
use App\Http\Requests\SendOrderRequest;
use App\Models\Order;
use App\Models\Order_detail;
// use App\Models\Product_color;
class CartController extends Controller
{
    public function index(){
        $cart_data = new Cart;
        return view('frontend.cart.index',compact('cart_data'));
    }

     public function purchase(){
        if(! Auth::guard('user')->check()){
            $previous_page = 'cart'; 
            return redirect('/login?prev=cart')->with([
                'error'=>'Vui lòng đăng nhập trước khi đặt hàng',
                'pre_page'=>'cart',
            ]);
        }else{
            $cart_data = new Cart;
            $user = Auth::guard('user')->user();
            return view('frontend.cart.purchase',compact('cart_data','user'));
        }
    }

    public function checkout(SendOrderRequest $request){
        if(! Auth::guard('user')->check()){
            $previous_page = 'cart'; 
            return redirect('/login?prev=cart')->with([
                'error'=>'Vui lòng đăng nhập trước khi đặt hàng',
            ]);
        }else{
            $order = new Order;
            $order_detail = new Order_detail;
            $cart = new Cart;
            $order_id = $order->add();
            $order_detail->add($order_id);
            $check_email = Auth::guard('user')->user();
            $data=[
                'name'=>Auth::guard('user')->user()->first_name,
                'order_detail'=>Order_detail::where('order_id',$order_id)->get(),
                'order'=>Order::find($order_id),
            ];
            $check_send_mail=Mail::send('user.send_mail.email_recipe',$data,function($message) use($check_email){
                $message->from('zzdetzzz@gmail.com','Quản trị DHTshop');
                $message->to($check_email->email,$check_email->first_name);
                $message->subject('Đơn hàng DHTshop');
            });
            $cart->clear();
           
            return redirect('/gio-hang')->with('message','Đặt hàng thành công!');
        }
    }


    public function addOne(Cart $cart,Product $product){
        // dd(request()->all());
        $pro_detail_id = request()->pro_detail_id;
        $pro_detail = Product_detail::find($pro_detail_id);
        $product = Product::find($pro_detail->product_id);
        $pro_color_id = (request()->pro_color == null) ? $product->product_color->first()->id : request()->pro_color;
        
        $check = $cart->addOne($pro_detail_id,$pro_color_id);

        if(request()->action == "addCart"){
            return back();
        }elseif(request()->action == "buyNow"){
            return redirect('/gio-hang');
        };
    }

    public function delete($pro_detail_id,$pro_color_id,Cart $cart){
        
        $cart->del($pro_detail_id,$pro_color_id);
        // session('cart')->pull($id);
        return back();
    }

    public function updateQty($pro_detail_id,$pro_color_id,$quantity,Cart $cart){
        if ($quantity==0) {
            $cart->del($pro_detail_id,$pro_color_id);   
        }else{
            $cart->updateQty($pro_detail_id,$pro_color_id,$quantity);
        }
        return back();
    }

    public function updateColor($pro_detail_id,$old_color_id,$new_color_id,Cart $cart){
        $cart->updateColor($pro_detail_id,$old_color_id,$new_color_id);
        return back();
    }

}
