<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_color;
use App\Http\Requests\AddProductColorRequest;
use App\Http\Requests\UpdateProductColorRequest;



class Product_colorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $product= request();
        // dd($product);
        return view('backend.product.add_color', compact('product') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddProductColorRequest $request, Product_color $color)
    {
        // dd($color->add());
        if($color->add()){
            return redirect()->route('product.show',$request->product_id)->with('successColor','Thêm mới màu sắc thành công');
        }else{
            return redirect()->route('product.show',$request->product_id)->with('errorColor','them that bai');
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
        $product = Product::find($id);
        $pro_color = Product_color::where('product_id',$id)->get();
        return view('backend.product.color', compact('product','pro_color'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pro_color= Product_color::find($id);
        // dd($pro_color->product_id);
        return view('backend.product.edit_color',compact('pro_color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductColorRequest $request , Product_color $color)
    {
        // dd(request()->all());
        // $color->edit($request->id);
        if($color->edit($request->id)){
            return redirect()->route('product.show',$request->product_id)->with('successColor','Cập nhật màu sắc thành công');
        }else{
            return redirect()->route('product.show',$request->product_id)->with('errorColor','Thêm mới thất bại, vui lòng thử lại sau');
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
        if(Product_color::del($id)){
            return redirect()->back()->with('successColor','Xóa màu sắc thành công');
        }else{
            return redirect()->back()->with('errorColor','them that bai');
        }
    }
}
