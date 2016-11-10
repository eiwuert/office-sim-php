<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<title></title>
	<script
			  src="https://code.jquery.com/jquery-1.12.4.min.js"
			  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
			  crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.js"></script>
	<link href="https://unpkg.com/basscss@8.0.2/css/basscss.min.css" rel="stylesheet">
</head>
<body>
<div class="clearfix">
	<div class="col col-3">
		<button id="simulate">Simulate</button>
	</div>
</div>
<div class="clearfix">
  <div class="col col-3">
  	<h3 class="center">Marketing Leads Generated</h3>
  	<canvas id="marketingCumulative" width="200" height="200"></canvas>

  </div>
  <div class="col col-3">
  	<h3 class="center">Marketing Leads Monthly</h3>
  	<canvas id="marketingMonthly" width="200" height="200"></canvas>
  </div>
</div>

<div class="clearfix">

	 <div class="col col-3">
  		<h3 class="center">Referral Hit/Miss Ratio</h3>
  		<canvas id="referalHitMiss" width="200" height="200"></canvas>
  	</div>
  	
  	<div class="col col-3">
  		<h3 class="center">Advertising Hit/Miss Ratio</h3>
  		<canvas id="advertisingHitMiss" width="200" height="200"></canvas>
	</div>
  	
  	<div class="col col-3">
  		<h3 class="center">In Person Hit/Miss Ratio</h3>
  		<canvas id="InPersonHitMiss" width="200" height="200"></canvas>
	</div>
</div>
 
 <script type="text/javascript" src="statistics.js"></script>
</body>
</html>
