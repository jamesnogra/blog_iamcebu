<!DOCTYPE html>
<html lang="en">


    <head>
        <title>I Am Cebu - Blog @yield('title')</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" type="text/css" href="{{url('/css/bootstrap/css/bootstrap.min.css')}}">
		<script src="{{url('/js/jquery.js')}}"></script>
		<script src="{{url('/js/bootstrap.js')}}"></script>
        <link href='https://fonts.googleapis.com/css?family=Lato:100,300,500' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
        
		<link rel="stylesheet" type="text/css" href="{{url('/css/main.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('/css/globe.css')}}">
		@yield('my-scripts')
    </head>


    <body>

		<div class="container-fluid" id="top-navigation-container">
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-3">
					<div id="main-globe">
						<div class="j-globe-container">
							<div class="j-land j-land-big j-start-10-10 j-animation-property j-very-slow-land-1"></div>
							<div class="j-land j-land-big j-start-40-40 j-animation-property j-very-slow-land-2"></div>
							<div class="j-land j-land-small j-start-35-30 j-animation-property j-very-slow-land-3"></div>
							<div class="j-land j-land-small j-start-80-10 j-animation-property j-very-slow-land-4"></div>
							<div class="j-cloud j-cloud-small j-start-20-10 j-animation-property j-very-slow-land-4"></div>
							<div class="j-cloud j-cloud-small j-start-70-20 j-animation-property j-very-slow-land-1"></div>
							<div class="j-cloud j-cloud-big j-start-25-30 j-animation-property j-very-slow-land-2"></div>
							<div id="top-globe-logo-text">I Am Cebu</div>
						</div>
					</div>
				</div>
				<div class="col-sm-7" id="main-top-nav-links">
					<a href="{{url('')}}"><div class="top-nav-links">Home</div></a>
					<a href="{{url('/articles/tag/travel')}}"><div class="top-nav-links">Travel</div></a>
					<a href="{{url('/articles/tag/technology')}}"><div class="top-nav-links">Technology</div></a>
					<a href="{{url('/articles/tag/design')}}"><div class="top-nav-links">Design</div></a>
					<a href="{{url('/about-page')}}"><div class="top-nav-links">About</div></a>
				</div>
				<div class="col-sm-1"></div>
			</div>
		</div>
			
		<div id="main-content">
			<div class="col-sm-1"></div>
			<div class="col-sm-7">
				@yield('content')
			</div>
			<div class="col-sm-3">
				<?php $latestArticles = \App\Article::orderBy('id', 'desc')->take(7)->get(); ?>
				<div class="card-shadow">
					<div class="each-article-container-title">Latest Articles</div>
					<div class="each-article-container-content">
						@foreach($latestArticles as $article)
							<a href="{{url('/'.$article->code.'/'.$article->title)}}">{{$article->title}}</a><br />
						@endforeach
					</div>
				</div>
				<br />
				<div class="card-shadow">
					<div class="each-article-container-title">Article Tags</div>
					<div class="each-article-container-content">
						<?php
							$allTags = [];
							foreach($latestArticles as $article) {
								$tempArrayTags = explode(",", $article['tags']);
								foreach ($tempArrayTags as $tag) {
									if (strlen($tag) > 1) {
										$allTags[] = trim($tag);
									}
								}
							}
							$uniqueTags = array_unique($allTags);
							foreach ($uniqueTags as $tag) {
								echo '<a class="btn btn-default tags-button" href="'.url('/articles/tag').'/'.trim($tag).'">'.trim($tag).'</a>';
							}
						?>
					</div>
				</div>
			</div>
			<div class="col-sm-1"></div>
		</div>

		<!--<div id="top-main-div-skewed-color" style="z-index:1!important;"></div>-->

		<div id="padding-footer"></div>
		<div id="main-footer">
			© 2016 IAmCebu. All rights reserved. |
			@if(Auth::check())
				<a href="{{url('edit-profile')}}">My Profile</a> |
				<a href="{{url('my-articles')}}">My Articles</a> |
				<a href="{{url('logout')}}">Logout</a>
			@else
				<a href="{{url('login')}}">Sign In</a>
			@endif
		</div>
		
    </body>


</html>