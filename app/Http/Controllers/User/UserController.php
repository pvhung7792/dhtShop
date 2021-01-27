<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUserRequest;

use App\Http\Requests\ChangePassUserRequest;
use App\Http\Requests\ChangeContactRequest;
use App\Http\Requests\ForgetpassRequest;
use App\Http\Requests\Post_new_passRequest;

use Auth;
use Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Password_reset;


use Validator;
use Illuminate\Support\MessageBag;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Carbon\Carbon;

class UserController extends Controller
{
   public function login()
    {
        // dd(request()->prev);
        // gọi view hiện hị form đăng nhập
        return view('user.login');
    }

    public function post_login(Request $request){
        $login_data = [
            'email' => $request->email,
            'password'=>$request->password,  
        ];
        $rules=[
            'email'=>'required|email',
            'password'=>'required|min:6',
        ];
        $message=[
            'email.required'=>'không để trống',
            'email.email'=>'không đúng định dạng',
            'password.required'=>'không để trống',
            'password.min'=>'nhập ít nhất 6 kí tự',
        ];
        
        $check_login = Auth::guard('user')->attempt($login_data);
        $validator = Validator::make($request->all(),$rules,$message );
        if(!$check_login){ 
                     return response()->json([
                    'error'=>true,
                    'message'=>$validator->errors(),
                    'errorlogin'=>'Email hoặc mật khẩu không đúng'
                ], 200);   
                return response()->back()->with([
                'error'=>true,
            ], 200);
        }
        // else{
        //     return redirect()->route('home');
        // }
    }
    public function register()
    {
        // gọi view hiện hị form đăng ký
        return view('user.register');
    }
    public function post_register(RegisterUserRequest $request)
    {
        $request->merge(['password'=>bcrypt($request->password)]);
        $add = User::create($request->all());
	    if($add){    
             return redirect()->route('login');
	    };
    }

    public function showChangePass(){
        return view('user.changepassword');
    }

    public function changePass(ChangePassUserRequest $request){
            // so sánh mật khẩu đã nhập với mật khẩu gốc
        if (!(Hash::check($request->get('old_password'), Auth::guard('user')->user()->password))) {
             
            return redirect()->back()->with("error","Mật khẩu bạn nhập không đúng, vui lòng nhập đúng mật khẩu cũ để có thể thay đổi mật khẩu.");
        }else{
            //so sánh mật khẩu cũ và mật khẩu mới
            if(strcmp($request->get('old_password'), $request->get('new_password')) == 0){
            
            return redirect()->back()->with("error","mật khẩu không được trùng với mật khẩu cũ.");
           }else{
            //Change Password
            $user = Auth::guard('user')->user();
            $user->password = bcrypt($request->get('new_password'));
            $user->save();

            Auth::guard('user')->logout();

            return redirect()->route('login')->with("success","đổi mật khẩu thành công, vui lòng đăng nhập lại !");
           }
        }
    }

    public function showChangeContact(){
        return view('user.changecontact');
    }

    public function changeContact(ChangeContactRequest $request){
        $id=Auth::guard('user')->user()->id;
        $user =User::where('id',$id)->update($request->only('first_name','last_name','address','phone'));     
        if($user){    
             return redirect()->route('home')->with("success","cập nhật thông tin thành công!");
        }else{
            return redirect()->route('changeContact')->with("success","cập nhật thông tin không thành công!");
        }
    }

    public function forget_pass(){
        return view('user.forgetpass');
    }
     public function post_forget_pass(ForgetpassRequest $request){
        $email=$request->email;
       $check_email=User::where('email',$email)->first();
      
        
       if($check_email){
            $random=mt_rand();
            $data=[
                'name'=>$check_email->first_name,
                'ma_xacnhan'=>$random,
            ];
            $check_send_mail=Mail::send('user.send_mail.email_forgetpass',$data,function($message) use($check_email){
                $message->from('zzdetzzz@gmail.com','Quản trị DHTshop');
                $message->to($check_email->email,$check_email->first_name);
                $message->subject('Mã xác xác minh lấy lại mật khẩu');
            });
           
            if(count(Password_reset::where('email',$email)->get())>0){
                Password_reset::where('email',$email)->delete();
                
            }
            Carbon::setLocale('vi');
                $now = Carbon::now('Asia/Ho_Chi_Minh');
               /* dd($email);*/
                $data_add=[
                    'email'=>$email,
                    'token'=>$random,
                    'created_at'=>$now
                ];
                Password_reset::create($data_add);
                
                return redirect()->route('new_pass')->with('success','kiểm tra mail của bạn và nhập mã xác nhận');
            
       }else{
            return redirect()->back()->with("error","email chưa được đăng ký, vui lòng đăng ký tài khoản!");
       }
       

    }
     public function new_pass(){
        
        return view('user.newpass');
    }

     public function post_new_pass(Post_new_passRequest $request){
       $email=$request->email;
       $password=bcrypt($request->new_password);
       $token=$request->token;
       $time_now=Carbon::now('Asia/Ho_Chi_Minh');
       $check_token=Password_reset::where('email',$email)->where('token',$token)->orderBy('created_at','desc')->first();
       if($check_token && strtotime($check_token->created_at)> strtotime("$time_now -20 minute")){
       
        User::where('email',$email)->first()->update(['password'=>$password]);

        return redirect()->route('login')->with("error","Lấy lại mật khẩu thành công, vui lòng đăng nhập lại");
       }else{
        return back()->with("error","sai email hoặc mã của bạn đã hết hạn, kiểm tra lại mail và gửi lại mã");
       }
    }

   use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function order_new(Order $order){
        $user_id = Auth::guard('user')->user()->id;
        $new_order = $order->where('user_id',$user_id)->where('status','<','3')->orderBy('created_at','desc')->get();
        return view('user.neworder',compact('new_order'));
    }

    public function order_history(Order $order){
        $user_id = Auth::guard('user')->user()->id;
        $history = $order->where('user_id',$user_id)->where('status','>=','3')->orderBy('updated_at','desc')->get();
        return view('user.history',compact('history'));
    }

    public function order_detail(Order_detail $order_detail,Request $request){
        $order = Order::find($request->order_id);
        $order_detail = $order_detail->where('order_id',$request->order_id)->get();
        return view('user.orderdetail',compact('order','order_detail'));
    }

    public function order_cancel(Request $request){
        $current_status = Order::find($request->order_id)->status;
        if ($current_status != 0) {
            return back()->with('error','Đơn hàng không thể hủy, bạn chỉ có thể hủy đơn hàng chưa xác nhận');
        }else {
            Order::find($request->order_id)->update(['status'=>4]);
            return back()->with('success','Hủy đơn hàng thành công, bạn có thể xem lại đơn hàng trong phần lịch sử mua hàng');
        }
    }
    
}
