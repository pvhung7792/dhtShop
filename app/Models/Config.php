<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;

class Config extends Model
{
    protected $fillable=['logo','phone','address','email','bottom_footer','status'];

    public function add(){
        if(request()->hasFile('fileLogo')){
            $file = request()->fileLogo;
            $file_name = time().'-'.$file->getClientOriginalName();
            $file->move(public_path('uploads\logos'),$file_name);
        }else{
            echo "string2";
        }
        //
        // dd(request()->all());
        request()->merge(['logo'=>$file_name]);
        $data = request()->except('_token','fileLogo');
        // dd($data);
        $config = Config::create($data);
        if(request()->status == 1){
            $config_data = Config::where('id','!=',$config->id)->update(['status' => 0]);
        }
        //  dd($config);
        // $config = request()->all();
        // dd($config);
        return $config;
    }
    public static function del($id){
        $config= Config::find($id);
        // dd($config->status);
        if($config->status==0){
           // xóa anh
           $old = Config::find($id)->logo;
           $old_path = public_path().'/uploads/logos/'.$old;
           if(!empty($old_path)){
            if(file_exists(public_path().'/uploads/logos/'.$old)){
                unlink($old_path);
            }
            }
            $check = $config->delete();
        }else{
            $check =  false;
        }
        return $check;
    }
    public function edit($id){
//
        if(request()->hasFile('fileLogo')){
            // xóa anh
            $old = Config::find($id)->logo;
            $old_path = public_path().'/uploads/logos/'.$old;
            if(!empty($old)){
                if(file_exists(public_path().'/uploads/logos/'.$old)){
                    unlink($old_path);
                }
            }

            //thêm ảnh
            $file = request()->fileLogo;
            $file_name = time().'-'.$file->getClientOriginalName();
            $file->move(public_path('uploads\logos'),$file_name);
        }else{
            $file_name = Config::find($id)->logo;
        }
        //
        // dd(request()->all());
        request()->merge(['logo'=>$file_name]);
        $data = request()->except('_token','fileLogo');
        // dd(request()->all());

        $config = Config::find($id)->update($data);


        if(request()->status == 1){
            Config::where('id','!=',$id)->update(['status' => 0]);
        }


        //  dd($config);
        // $config = request()->all();
        // dd($config);
        return $config;
    }
}
