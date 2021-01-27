<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProDetailRequest;
use App\Http\Requests\AddProDetailRequest;
use App\Models\Product_detail;

class Product_detailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // request bao gồm product->id và product->name
        $pro = request();
        return view('backend.product.add_detail',compact('pro'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddProDetailRequest $request, Product_detail $product_detail)
    {
        // lấy id của product để sau khi thêm dữ liệu sẽ quay về trang detail của product được thêm chi tiết
        // product_id được truyền vào request qua 1 input
        $pro_id = request()->product_id;

        $check = $product_detail->store($request);
        if ($check) {
            return redirect('admin/product/'.$pro_id)->with('successDetail','Thêm mới chi tiết thành công!');
        }else{
            return redirect('admin/product/'.$pro_id)->with('errorDetail','Thêm mới chi tiết không thành công!');
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
        $pro_detail = Product_detail::find($id);
        return view('backend.product.edit_detail',compact('pro_detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProDetailRequest $request, $id)
    {
        // lấy id của product để sau khi thêm dữ liệu sẽ quay về trang detail của product được thêm chi tiết
        // product_id được truyền vào request qua 1 input
        $pro_id = request()->product_id;
        
        $pro_detail = new Product_detail;
        $check = $pro_detail->edit($id);
        if ($check) {
            return redirect('admin/product/'.$pro_id)->with('successDetail','Cập nhật chi tiết thành công!');
        }else{
            return redirect('admin/product/'.$pro_id)->with('errorDetail','Cập nhật chi tiết không thành công!');
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
        $product_detail = new Product_detail;
        $res = $product_detail->del($id);

        if ($res['check']==true) {
            return back()->with('successDetail',$res['mess']);
        }else if($res['check']==false) {
            return back()->with('errorDetail',$res['mess']);
        }
    }
}
