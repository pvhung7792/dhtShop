<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SendOrderRequest;
use App\Helpers\Cart;
use App\Models\Order;
use App\Models\Order_detail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = isset(request()->status)?request()->status:'5';
        // dd($status);
        if (isset(request()->status)) {
            $order = Order::where('status',request()->status)->orderBy('updated_at','desc')->get();
        }else{
            $order = Order::orderBy('updated_at','desc')->get();
        }
        return view('backend.order.index',compact('order','status'));
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
    public function store(SendOrderRequest $request)
    {
        // dd(request()->all());
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $order_detail = Order_detail::where('order_id',$id)->get();
        return view('backend.order.detail',compact('order','order_detail'));     
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
    public function destroy($id)
    {
        //
    }

    public function updateStatus(){
        
        Order::find(request()->order_id)->update([
            'status'=>request()->status,
        ]);

        return back()->with('success','Cập nhật trạng thái thành công');
    }
}
