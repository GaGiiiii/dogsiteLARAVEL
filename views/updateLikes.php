<?php 
	
  include("server/server.php");
  
  $id = $_SESSION['showid'];

  if(array_key_exists("content", $_POST)){
	 	$sql = "UPDATE breeds SET likes = likes + 1 WHERE id = $id";
    mysqli_query($db, $sql);
	}  


?>