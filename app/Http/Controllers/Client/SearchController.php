<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
   public function  searchname(Request $request){
   	$reqname = $request->searchname;
   	if(isset($reqname)){
   		$products = Product::where('name', 'like', '%' . $reqname . '%')->paginate(12);
         $count = count(Product::where('name', 'like', '%' . $reqname . '%')->get());
         // dd($count);
   		return view('frontend.category.search', compact('products','count'));
   	}else{
   		return redirect()->back()->with("message","Vui lòng nhập từ khóa tìm kiếm");
   	}
   	
   }
}
