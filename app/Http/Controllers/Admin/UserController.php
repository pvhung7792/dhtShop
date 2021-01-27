<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*đổ ta danh sách thông tin người dùng*/
        $user=User::paginate(50);
        return view('backend.User.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('backend.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        /* cập nhật trạng thái và phân cấp người dùng*/
        $user = new User;
        $check = $user->edit($request,$id);
        if ($check) {
            return redirect('admin/user')->with('message','Cập nhật người dùng thành công!');
        }else{
            return redirect('admin/user')->with('error','Cập nhật người dùng không thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
    /*xóa người dùng, chỉ Quản trị mới được xóa người dùng*/
        if ($user->role==0 && Auth::guard('user')->user()->role ==2) {
            $res = $user->del($id);
            return redirect('admin/user')->with('message','Xóa người dùng thành công!');
        }else{
             return redirect('admin/user')->with('error','Xóa người dùng không thành công!');
        }
    }
}
