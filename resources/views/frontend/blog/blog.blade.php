@extends('frontend.blog.main')

@section('blog_main')


            <div class="col-lg-9">
                <div class="mr-3">
                 <div class="row my-3 bg-white border rounded px-2 py-3">
                        @if(isset($blog->first()->blog_cate))
                    <div class="col-lg-8 ">
                        <a href="{{route('blog_view',[$blog->first()->blog_cate->slug,$blog->first()->slug])}}" class="list-group list-group-item-action">
                            <img src="{{url('public')}}/uploads/blogs/{{$blog->first()->image}}" id="img" class="rounded pb-0 img-fluid">
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <div class="row pb-2">
                            <a href="{{route('blog_view',[$blog->first()->blog_cate->slug,$blog->first()->slug])}}" class="list-group list-group-item-action">
                                <h4 class="text-black">{{$blog->first()->title}}</h4>
                            </a>
                            <p class="text-secondary">{{$blog->first()->summary}}</p>
                            <small class="text-muted">{{$blog->first()->created_at->diffForHumans($now)}}</small>
                        </div>
                    </div>
                    @else
                        <h3 class="text-danger" style="margin-left: 30%;">Mục này chưa có bài viết</h3>
                    @endif
                </div>
                <div class="row bg-white border rounded pt-3 px-3">
                    @foreach ($blog as $key => $item)
                    {{-- {{dd($key)}} --}}
                        @if ($key > 0)
                           <div class="row">
                                <div class="col-lg-4">
                                    <a href="{{route('blog_view',[$item->blog_cate->slug,$item->slug])}}"><img src="{{url('public')}}/uploads/blogs/{{$item->image}}" alt="" class="img-fluid"></a>
                                </div>
                                <div class="col-lg-8">
                                    <a href="{{route('cate_show',$item->blog_cate->slug)}}" class="card-link">
                                        <p>{{$item->blog_cate->name}}</p>
                                    </a>
                                    <a href="{{route('blog_view',[$item->blog_cate->slug,$item->slug])}}" class="list-group-item-action"><h4>{{$item->title}}</h4></a>
                                    <p>{{$item->summary}}</p>
                                    <p class="text-secondary">{{$item->created_at->diffForHumans($now)}}</p>
                                </div>
                        </div>
                        <hr>
                        @endif

                    @endforeach


                </div>
                </div>
                <div class="text-center">
                    {{$blog->appends(['sort' => 'id'])->links()  }}
                </div>
            </div>





@stop()
