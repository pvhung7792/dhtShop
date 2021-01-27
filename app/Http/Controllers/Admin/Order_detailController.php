<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Order_detailController extends Controller
{
    public function index()
    {
        //
    }

    public function show($id){
    	return view('backend.order.detail');
    }
}
