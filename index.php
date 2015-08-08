<?php

require('AvailabilityService.php');

use HelgeSverre\DomainAvailability\AvailabilityService;
$service = new AvailabilityService(true);

$results = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$domains = preg_replace('/\s+/', '', $_POST['domains']);
	$domains_array = explode(',', $domains);

	foreach ($domains_array as $domain) {
		$available = $service->isAvailable($domain);
		if ($available) {
			$results[$domain] = 'is not registered';
		}
		else {
			$results[$domain] = 'is registered';
		}
	}
}

?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		

		<div class="container">
			<form action="" method="POST" role="form">
				<legend>Check Domain</legend>
			
				<div class="form-group">
					<label for="">Domains</label>
					<textarea class="form-control" name="domains" rows="10"></textarea>
				</div>
			
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
			<pre style="margin-top: 20px;" placeholder="Fill domain(s) here, for multiple domains please separated it by comma.">
				<?php
				if (count($results) > 0) {
					print_r($results);
				}
				?>
			</pre>
		</div>

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	</body>
</html>
