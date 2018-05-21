<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="
		width=device-width,
		height=device-height,
		initial-scale=1,
		minimum-scale=1,
		maximum-scale=1,
		user-scalable=0"/>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,400i,500,800i" rel="stylesheet">
	<link rel="stylesheet" href="../../templates/css/style2.css">
	<link rel="stylesheet" href="../../templates/css/home.css">
	<link rel="stylesheet" href="../../templates/css/authorization.css">
	<link rel="stylesheet" href="../../templates/css/about.css">
	<link rel="stylesheet" href="../../templates/css/feed.css">
	<link rel="stylesheet" href="../../templates/css/cabinet.css">

	<title>Camarama</title>
</head>
<body>
	<?php 
		require 'application/views/layouts/header.php';
		echo $content; 
		require 'application/views/layouts/footer.php';
	?>
</body>
</html>