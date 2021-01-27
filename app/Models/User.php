<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=['first_name','last_name','address','phone','email','password','remember_token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function User($request){
        /*lấy ra request để sửa trạng thái và phân cấp người dùng*/
        $id=$request->id;
        return ([
            'role'=>$request->role,
            'status'=>$request->status,
        ]);
    }
    public function edit($request,$id){
        /*tạo phương thức sửa trạng thái và phân cấp người dùng*/
        return User::where('id',$id)->update($request->only('role','status'));
    }
    public function del($id){
        /*tạo phương thức xóa người dùng*/
        return User::find($id)->delete();
    }

}
