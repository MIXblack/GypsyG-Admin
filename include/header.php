<?php

	$url = "http://localhost/MIXblack/GypsyG/Code/Company/";
	$year = date('n') > 6 ? date('Y').'-'.(date('Y') + 1) : (date('Y') - 1).'-'.date('Y');

?>

<!doctype html>
<html lang="en" dir="ltr">
	<head>

		<?php include('head.php'); ?>

	</head>
	
	<body class="app sidebar-mini" onload="startTime()">
