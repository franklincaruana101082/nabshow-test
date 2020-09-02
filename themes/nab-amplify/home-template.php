<?php
/*
 * Template Name: Home
 */
?>

<!DOCTYPE html>
<html class="premiere">
<head>

	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.ico" type="image/x-icon">

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="robots" content="noindex,follow">
	<title>NAB Amplify</title>
	<style>

		body {
			background-color: #404040;
			color: #fff;
			font-family: 'Open Sans', sans-serif;
			font-size: 16px;
			margin: 0;
			padding: 0;
		}

		body * {
			box-sizing: border-box;
		}

		#screen {
			min-height: 100vh;
			position: relative;
			width: 100%;
		}

		#content {
			display: table;
			height: 100%;
			padding: 50px;
			position: relative;
			width: 100%;
			z-index: 100;
		}

		#content > * {
			display: table-cell;
			vertical-align: middle;
		}


		#content > * > * {
			display: block;
			margin: 0 auto;
			max-width: 1200px;
			text-align: center;
		}

		#brand {
			margin: 30px auto;
		}


		#brand img {
			max-width: 300px;
		}

		#content h1 {
			color: #fdd80f;
			font-size: 600%;
			line-height: 1;
			margin: 20px 0 20px 0;
			z-index: 100;
		}

		#content p {
			margin: 0 0 10px 0;
		}

		a,
		a:visited {
			color: #fdd80f;
			transition: all 0.8s ease-in-out;
		}

		a:hover {
			color: #e5018b;
		}

		em {
			color: #fdd80f;
			font-style: normal;
		}

		sup {
			line-height: 0;
			position: relative;
			font-size: 20%;
		}

		sub {
			vertical-align: baseline;
		}

		sup {
			display: inline-block;
			margin-top: 20px;
			vertical-align: top;
		}

		p sup {
			margin-top: 7px;
			font-size: 40%;
		}

		#background,
		#transparency {
			position: absolute;
			height: 100%;
			left: 0;
			top: 0;
			width: 100%;
		}

		#transparency {
			background: rgba(0, 0, 0, 0.5);
			z-index: 50;
		}


		#background {
			position: absolute;
			z-index: 0;
		}

		#background img {
			height: 100%;
			object-fit: cover;
			-o-object-fit: cover;
			opacity: 0.4;
			top: 0;
			width: 100%;
		}

		#marketo-form {
			margin: 40px auto 40px auto;
		}

		.framing {
			max-width: 800px;
			margin-left: auto;
			margin-right: auto;
		}

		#screen form {
			width: 100% !important;
		}

		#screen .mktoForm .mktoOffset {
			width: 0 !important;
		}

		#screen form .mktoFormRow {
			display: inline-block;
			width: 50% !important;
		}


		#screen form .mktoFormRow:nth-of-type(3) {
			display: inline-block;
			margin: 0px auto;
			width: 100% !important;
		}

		#screen form .mktoFormRow:nth-of-type(3) > * {
			float: none;
			margin: 0 auto;
			width: 50% !important;
		}

		#screen .mktoButtonRow {
			margin: 0;
			text-align: center;
			width: 100% !important;
		}

		#screen form .mktoFormRow > * {
			padding: 0 5px;
			width: 100% !important;
		}

		#screen .mktoForm .mktoFieldWrap {
			width: 100% !important;
		}

		#screen form label {
			display: none;
		}

		#screen form .mktoGutter {
			width: 0 !important;
		}

		#screen form input {
			padding: 10px 17px;
			width: 100% !important;
		}

		#screen .mktoForm .mktoButtonWrap.mktoSimple .mktoButton {
			background-color: #e5018b;
			background-image: none;
			border: 0;
			border-radius: 8px;
			color: #fff;
			font-size: inherit;
			padding: 10px 30px;
		}


		#screen .mktoButtonWrap.mktoSimple {
			margin-left: 0 !important;
		}

		@-webkit-keyframes rotating /* Safari and Chrome */
		{
			from {
				-webkit-transform: rotate(0deg);
				-o-transform: rotate(0deg);
				transform: rotate(0deg);
			}
			to {
				-webkit-transform: rotate(360deg);
				-o-transform: rotate(360deg);
				transform: rotate(360deg);
			}
		}

		@keyframes rotating {
			from {
				-ms-transform: rotate(0deg);
				-moz-transform: rotate(0deg);
				-webkit-transform: rotate(0deg);
				-o-transform: rotate(0deg);
				transform: rotate(0deg);
			}
			to {
				-ms-transform: rotate(360deg);
				-moz-transform: rotate(360deg);
				-webkit-transform: rotate(360deg);
				-o-transform: rotate(360deg);
				transform: rotate(360deg);
			}
		}

		#brand img {
			-webkit-animation: rotating 75s linear infinite;
			-moz-animation: rotating 75s linear infinite;
			-ms-animation: rotating 75s linear infinite;
			-o-animation: rotating 75s linear infinite;
			animation: rotating 75s linear infinite;
		}


		@media screen and (max-width: 800px) {

			#content h1 {
				font-size: 500%;
			}

		}


		@media screen and (max-width: 630px) {

			#content h1 {
				font-size: 400%;
			}


			#screen form .mktoFormRow {
				display: block;
				width: 100% !important;
			}

			#screen form .mktoFormRow:nth-of-type(3) > * {
				width: 100% !important;
			}

		}

		@media screen and (max-width: 510px) {

			#content h1 {
				font-size: 350%;
			}


		}

		@media screen and (max-width: 410px) {

			#content h1 {
				font-size: 280%;
			}

			#brand img {
				max-width: 220px;
			}

		}

	</style>

	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,700;1,400&amp;display=swap" rel="stylesheet">
	<link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.ico" type="image/x-icon">

	<style id='mktoDesktopStyle'>
		.lpeCElement {
			position: absolute;
		}

		.imageSpan img {
			width: 100%;
			height: auto;
		}

	</style>

</head>

<body id="bodyId">

<!-- screen -->
<div id="screen" class="mktoContent">

	<!-- content -->
	<div id="content">

		<div class="wrap">
			<div class="inner">
				<div id="brand"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/nab-brand.png"></div>
				<p>Immerse yourself in a brand new, amplified NAB experience like you’ve never seen.</p>
				<h1>NAB Amplify<sup>TM</sup></h1>
				<p><em>Beta begins this November.</em></p>
				<p>Get on the list to be the first to know more.</p>

				<div id="marketo-form" class="framing">
					<script src="https://app-ab34.marketo.com/js/forms2/js/forms2.min.js"></script>
					<form id="mktoForm_1113"></form>
					<script>MktoForms2.loadForm( '//app-ab34.marketo.com', '927-ARO-980', 1113 );</script>
				</div>
				<div class="framing">
					<p>To learn more about how <em>NAB Amplify<sup>TM</sup></em> can help technology solution providers, generate leads, elevate brands and drive business
						opportunities to new levels, contact your account manager at <a href="mailto:exhibit@nab.org">exhibit@nab.org</a></p>
				</div>
			</div>
		</div>

	</div>
	<!-- content -->

	<!-- transparency -->
	<div id="transparency">


	</div>
	<!-- transparency -->

	<!-- background -->
	<div id="background">
		<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/spectral.png">
	</div>
	<!-- background -->


</div>
<!-- screen -->
<script type="text/javascript" src="//munchkin.marketo.net//munchkin.js"></script>
<script>Munchkin.init( '927-ARO-980', { customName: 'NAB21OV', wsInfo: 'j1RR' } );</script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/stripmkttok.js"></script>
</body>
</html>
