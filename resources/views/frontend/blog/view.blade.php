@extends('frontend.blog.main')

@section('style')
<style>

</style>
@stop()

@section('blog_main')

<div class="row ">
	<div class="col-lg-8 bg-white border rounded tungdo offset-lg-2">
			<h1 class="pt-3">{!! $blog1->title !!}</h1>
			<br>
            {!! $blog1->content !!}
	</div>
</div>




@stop()
