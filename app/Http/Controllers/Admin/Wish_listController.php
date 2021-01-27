<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wish_list;
class Wish_listController extends Controller
{
    public function index()
    {
        //
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$wish_list=$request->except('_token');
       $user_id=$request->user_id;
       $product_id=$request->product_id;
       $check_WL=Wish_list::where('user_id',$user_id)->where('product_id',$product_id)->get();
       if(count($check_WL)==0){
        $add_wl=Wish_list::create($wish_list);
       /* return response()->json([
                    'error'=>true,
                    'message'=>'has error when add wish list'
                    ], 200);*/
        if(!$add_wl){
             return response()->json([
                    'error'=>true,
                    'message'=>'has error when add wish list'
                    ], 200);
           
        }else{
            return response()->json(['error'=>false], 200);
        }
    }else{
        return response()->json([
                    'error'=>true,
                    'message'=>'has error when add wish list'
                    ], 200);
    }
        
        
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $user_id=$request->user_id;
        $product_id=$request->product_id;

        $id= Wish_list::where("user_id",$user_id)->where('product_id',$product_id)->first()->id;
       
        $wish_list = Wish_list::find($id)->delete();
       /* dd($wish_list);*/
        if(!$wish_list){
             return response()->json([
                    'error'=>true,
                    'message'=>'has error when remove wish list'
                    ], 200);
         
        }else{
           return response()->json([
                    'error'=>false], 200);
        };
    }
}
