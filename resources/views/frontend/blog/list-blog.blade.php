@extends('frontend.layout.master')
@section('content')

<div class="col-sm-9">
	<div class="blog-post-area">
		<h2 class="title text-center">Latest From our Blog</h2>
		<div class="single-blog-post">
			@foreach($blog as $bl)
				<h3>{{$bl->title}}</h3>
				<div class="post-meta">
					<ul>
						<li><i class="fa fa-user"></i> Mac Doe</li>
						<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
						<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
					</ul>
					<span>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star-half-o"></i>
					</span>
				</div>
				<a href="">
					<img src="{{ asset('upload/product/' . $bl->image)}}" alt="">
				</a>
				<p>{{$bl->description}}</p>
				<a class="btn btn-primary" href="{{url('/blog-detail/' . $bl->id)}}	">Read More</a>
			@endforeach
		</div>
		<div class="pagination-area">
			{{$blog->links()}}
		</div>
	</div>
</div>
@endsection