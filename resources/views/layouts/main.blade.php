<!DOCTYPE html>
<html lang="en">


    <head>
        <title>I Am Cebu - Blog</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" type="text/css" href="{{url('/css/bootstrap.css')}}">
		<script src="{{url('/js/jquery.js')}}"></script>
		<script src="{{url('/js/bootstrap.js')}}"></script>
        <link href='https://fonts.googleapis.com/css?family=Lato:100,300,500' rel='stylesheet' type='text/css'>
        
		<link rel="stylesheet" type="text/css" href="{{url('/css/main.css')}}">
		<link rel="stylesheet" type="text/css" href="{{url('/css/globe.css')}}">
		@yield('my-scripts')
    </head>


    <body>
	
		<div id="top-main-div-skewed-color"></div>
		
		<div class="container-fluid">
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
						</div>
					</div>
				</div>
				<div class="col-sm-7" id="main-top-nav-links">
					<div class="top-nav-links">Home</div>
					<div class="top-nav-links">Travel</div>
					<div class="top-nav-links">Technology</div>
					<div class="top-nav-links">Design</div>
					<div class="top-nav-links">About</div>
				</div>
				<div class="col-sm-1"></div>
			</div>
		</div>
			
		<div id="main-content">
			@yield('content')
		</div>
		
    </body>


</html>