<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title>index</title>
		<meta name="description" content="" />
		<meta name="author" content="Robert Stein" />

		<meta name="viewport" content="width=device-width; initial-scale=1.0" />

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico" />
		<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<style>
			.image {
				margin : 20px;
			}
		
			span.rollover {
				opacity: 1;
				-o-transition-duration: 1s;
				-moz-transition-duration: 1s;
				-webkit-transition: -webkit-transform 1s;
				background: center center no-repeat #FFF;
				cursor: pointer;
				height: 400px;
				width: 260px;
				position: absolute;
				z-index: 10;
				opacity: 0;
				-webkit-transition: opacity .15s linear;
			}

			span.rollover:hover {
				opacity: .89;
				-o-transition-duration: 1s;
				-moz-transition-duration: 1s;
				-webkit-transition: -webkit-transform 1s;
				-webkit-box-shadow: 0px 0px 0px #000;
				-moz-box-shadow: 0px 0px 0px #000;
				box-shadow: 0px 0px 0px #000;
				-webkit-transition: opacity .15s linear;
			}
		</style>

	</head>

	<body>
		
		<div>
			<header>
				<h1>index</h1>
			</header>
			<nav>
				<p>
					<a href="/">Home</a>
				</p>
				<p>
					<a href="/contact">Contact</a>
				</p>
			</nav>

			<a class="image"  href="#"> <span class="rollover" >
				<div style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 18px; color: black; padding: 5px;">
					Bildtitel
					<br>
					________________
					<br>
					Untertitel irgendwas

				</div> </span> <img src="img/DSC_0093_01.png" height="431" class="bild" width="286"> </a>
				
			<a class="image"  href="#"> <span class="rollover" >
				<div style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 18px; color: black; padding: 5px;">
					Bildtitel
					<br>
					________________
					<br>
					Untertitel irgendwas

				</div> </span> <img src="img/DSC_0048.png" height="190" class="bild" width="286"> </a>
				
			<a class="image"  href="#"> <span class="rollover" >
				<div style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 18px; color: black; padding: 5px;">
					Bildtitel
					<br>
					________________
					<br>
					Untertitel irgendwas

				</div> </span> <img src="img/notbusiness1.jpg" height="190" class="bild" width="286"> </a>

			<script></script>
			<footer>
				<p>
					&copy; Copyright  by Robert Stein
				</p>
			</footer>
		</div>
	</body>
</html>
