<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog_cate;
use App\Models\Blog;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function index(){
        $blog = Blog::where('status',1)->orderBy('updated_at','desc')->paginate(6);
        // $blog->except()->first();
        // dd($blog);
        Carbon::setLocale('vi');
        $now = Carbon::now();
        return view('frontend.blog.index',compact('blog','now'));
    }

    public function show($slug){
        $blog_cate = Blog_cate::where('slug',$slug)->first();
        $blog = Blog::where('blog_cate_id',$blog_cate->id)->where('status',1)->orderBy('updated_at','desc')->paginate(3);
        // dd($blog->first()->image);
        Carbon::setLocale('vi');
        $now = Carbon::now();
        return view('frontend.blog.blog',compact('blog_cate','blog','now'));
    }
    public function view($slug_cate, $slug){
            $blog_cate = Blog_cate::where('slug',$slug_cate)->first();
            $blog1 = Blog::where('slug',$slug)->first();
            // dd($blog->title);
            Carbon::setLocale('vi');
            $now = Carbon::now();
            return view('frontend.blog.view', compact('blog1','blog_cate','now'));
        }
    // public function new(){
    //     // $blog_cate = Blog_cate::where('slug',$slug_cate)->first();
    //     // $blog = Blog::where('slug',$slug)->first();
    //     // dd($blog->title);
    //     return view('frontend.blog.new');
    // }
}
