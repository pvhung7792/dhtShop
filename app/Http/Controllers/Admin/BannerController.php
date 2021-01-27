<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Models\Banner;
use App\Models\Category;


class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::all();
        return view('backend.banner.index',compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('backend.banner.add',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddBannerRequest $request)
    {
        $banner = new Banner;
        $check = $banner->store($request);
        if ($check) {
            return redirect('admin/banner')->with('success','Thêm mới banner thành công!');
        }else{
            return redirect('admin/banner')->with('error','Thêm mới banner không thành công!');
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
        $banner = Banner::find($id);
        $category = Category::all();
        return view('backend.banner.edit',compact('banner','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannerRequest $request, $id)
    {
        $banner = new Banner;
        $check = $banner->edit($request,$id);
        if ($check) {
            return redirect('admin/banner')->with('success','Cập nhật banner thành công!');
        }else{
            return redirect('admin/banner')->with('error','Cập nhật banner không thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $banner = new Banner;
        $check = $banner->del($request,$id);
        if ($check) {
            return back()->with('success','Xóa dữ liệu thành công');
        }else {
            return back()->with('error','Xóa dữ liệu không thành công');
        }
    }
}
