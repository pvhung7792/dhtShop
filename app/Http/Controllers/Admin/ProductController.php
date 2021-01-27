<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Promotion;
use App\Models\Product;
use App\Models\Product_detail;
use App\Models\Product_color;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::get();
        return view('backend.product.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::all();
        $brand=Brand::all();
        $promotion=Promotion::all();
        return view('backend.product.add',compact('category','brand','promotion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddProductRequest $request, Product $product)
    {
         $product = new Product;
         $res = $product->add($request);
        if($res['check']){
            return redirect()->route('product.show',$res['pro_id'])->with('success','Thêm mới thành công');
        }else{
            return redirect()->route('product.index')->with('error','Thêm mới thất bại');
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
        // chuyển sang trang xem danh sách những chi tiết mà product đó có
        // lấy product để hiển thị những giá chị chung
        $product = Product::find($id);
        // lấy danh sách product detail để hiển thị thành bảng những giá trị khác nhau kèm giá
        $pro_detail = Product_detail::where('product_id',$id)->get();
        $pro_color = Product_color::where('product_id',$id)->get();
        return view('backend.product.detail',compact('product','pro_detail','pro_color'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $category=Category::all();
        $brand=Brand::all();
        $promotion=Promotion::all();
        return view('backend.product.edit',compact('category','brand','promotion','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $check = $product->edit();
        if($check){
            return redirect()->route('product.show',$request->id)->with('success','Cập nhật thành công');
        }else{
            return redirect()->route('product.show')->with('error','Cập nhật thất bại');
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
        $product = new Product;
        $res = $product->del_pro($id);
        // dd($res['mess']);
        if ($res['check']==true) {
            return back()->with('success',$res['mess']);
        }else if($res['check']==false) {
            return back()->with('error',$res['mess']);
        }
        // $product = new Product;
        // $res = $product->del($id);
        // // dd($res['mess']);
        // if ($res['check']==true) {
        //     return back()->with('success',$res['mess']);
        // }else if($res['check']==false) {
        //     return back()->with('error',$res['mess']);
        // }
    }

    public function del_pro($id)
    {
        $product = new Product;
        $res = $product->del_pro($id);
        // dd($res['mess']);
        if ($res['check']==true) {
            return back()->with('success',$res['mess']);
        }else if($res['check']==false) {
            return back()->with('error',$res['mess']);
        }
    }
}
