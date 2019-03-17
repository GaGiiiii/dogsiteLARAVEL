<?php

  include("views/server/server.php");

?>



<!DOCTYPE html>
<html>
<head>
  <!-- MOBILE RESPONSIVE -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- TITLE -->
  <title>Dog Breed's</title> 
  <!-- BOOTSTRAP -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- CSS -->
 	<link rel="stylesheet" type="text/css" href="public/css/landing.css">
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript" async></script>
</head>
<body>

    
    <div id="landing-header">
	 		<h1>Welcome to Dog Site!</h1>
			<a href="<?php echo ROOT_URL; ?>/views/dogs/index.php?page=1" class="btn btn-lg btn-success">View All Breed's</a>
    </div>
    
    <ul class="slideshow">
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
    </ul>

<?php include ('views/partials/footer(nocopy).php'); ?>
	