<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Http\Requests\AddPromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promo = Promotion::all();
        return view('backend.promotion.index', compact('promo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         return view('backend.promotion.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddPromotionRequest $request, Promotion $promo)
    {
        // dd($promo->add()) ;
        if($promo->add()){
            return redirect()->route('promotion.index')->with('success','Thêm mới thành công');
        }else{
            return redirect()->back()->with('error','them that bai');
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
        return view('backend.promotion.detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $promo = Promotion::find($id);
        return view('backend.promotion.edit', compact('promo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePromotionRequest $request, $id, Promotion $promo)
    {
        // dd($request->id);
        // $promo->edit($request->id);
        if($promo->edit($request->id)){
            return redirect()->route('promotion.index')->with('success','Cập nhật thành công');
        }else{
            return redirect()->back()->with('error','Cập nhật that bai');
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
        // dd(Promotion::del($id));
        if(Promotion::del($id)){
            return redirect()->back()->with('success','Xóa thành công');
        }else{
            return redirect()->back()->with('error','Xóa thất bại vẫn còn sản phẩm đang sử dụng chương trình khuyến mại này.');
        }
    }

    /**
     * Hiển thị danh sách các sản phẩm chưa áp dụng chương trình khuyến mại nào.
     *
     * @return \Illuminate\Http\Response
     */

    public function add_detail($id)
    {
        return view('backend.promotion.add_detail');
    }
}
