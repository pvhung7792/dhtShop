<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CompareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product_id1 = $request->PRODUCT1;
        $product_id2=$request->PRODUCT2;
        
            
                $Pro1=Product::find($product_id1);
                $Pro2=Product::find($product_id2);
                return view('frontend.compare.index', compact("Pro1","Pro2"));
        
        /* return view('frontend.compare.index', compact("Pro1","Pro2"));*/
    }

     public function search(Request $request)
    {
    	$data = $request->searchname;
    	$ListPro=Product::orderBy('updated_at','desc')->where('name','like',"%{$data}%")->get()->take(5);
    	
    	$output="";
    	
            foreach($ListPro as $row)
            {
               $output .= '<option value="'. $row->id.'">'.$row->name.'</option>';	
           }
          
           
    	return response()->json(['success'=>$output]);
        
        /* return view('frontend.compare.index', compact("Pro1","Pro2"));*/
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
       
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
}
