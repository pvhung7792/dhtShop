<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Http\Requests\AddBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = Brand::all();
        return view('backend.brand.index',compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('backend.brand.add',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddBrandRequest $request)
    {
        $brand = new Brand;
        $brand->add($request);

        if ($brand) {
            return redirect('admin/brand')->with('success','Thêm mới nhãn hiệu thành công!');
        }else{
            return redirect('admin/brand')->with('error','Thêm mới nhãn hiệu không thành công!');
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
        $brand = Brand::find($id);
        $category = Category::all();
        return view('backend.brand.edit',compact('brand','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, $id)
    {
        $brand = new Brand;
        $check = $brand->edit($request,$id);
        if ($check) {
            return redirect('admin/brand')->with('success','Cập nhật nhãn hiệu thành công!');
        }else{
            return redirect('admin/brand')->with('error','Cập nhật nhãn hiệu không thành công!');
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
        $brand = new Brand;
        $res = $brand->del($id);

        if ($res['check']==true) {
            return back()->with('success',$res['mess']);
        }else if($res['check']==false) {
            return back()->with('error',$res['mess']);
        }
    }
}
