<?php

	include("server.php");

	/* ********************** IF LIKE IS PRESSED START ************************ */

	if(isset($_POST['liked'])){
		
		$breedIdString = mysqli_real_escape_string($db, $_POST['breedId']);
		$breedId = (int)$breedIdString;
		$userId = mysqli_real_escape_string($db, $_POST['userId']);
		$type = mysqli_real_escape_string($db, $_POST['type']);

	  $query = "SELECT * FROM likes";
		$result = mysqli_query($db, $query);
		$likes = mysqli_fetch_all($result, MYSQLI_ASSOC);

		/* ********************** IF DISLIKED CAN'T LIKE ************************ */

		foreach($likes as $like){
			if($like['user_id'] == $userId && $like['breed_id'] == $breedId && $like['type'] == "dislike"){
				exit();
			}
		}

		/* ********************** IF LIKED CAN'T LIKE AGAIN, INSTEAD UNLIKE ************************ */

		foreach($likes as $like){
		  if($like['user_id'] == $userId && $like['breed_id'] == $breedId && $like['type'] == "like"){
		  	// vec je lajkovan taj breed i sad moze samo da ga unlike

		  	$query = "SELECT likes FROM breeds WHERE id = $breedId";
			  $result = mysqli_query($db, $query);

			  $numberOfLikes = mysqli_fetch_array($result);
				$numberOfLikes = $numberOfLikes['likes'];

				$numberOfLikes -= 1;

				// insert

				mysqli_query($db, "UPDATE breeds SET likes = $numberOfLikes WHERE id = $breedId");

		    $query = "DELETE FROM likes WHERE user_id = {$userId} AND type = '$type' AND breed_id = $breedId";
    		mysqli_query($db, $query);

		    exit();
		  }
		}

		/* ********************** LIKING BREED ************************ */

		$query = "SELECT likes FROM breeds WHERE id = $breedId";
	  $result = mysqli_query($db, $query);

	  $numberOfLikes = mysqli_fetch_array($result);
		$numberOfLikes = $numberOfLikes['likes'];

		$numberOfLikes += 1;

		mysqli_query($db, "UPDATE breeds SET likes = $numberOfLikes WHERE id = $breedId");

		$query = "INSERT INTO likes (user_id, breed_id, type) VALUES ('$userId', '$breedId', '$type')";
	  mysqli_query($db, $query);

	  $liked = true;

	  echo $liked;

		exit();

	}

	/* ********************** IF LIKE IS PRESSED END ************************ */

	/* ********************** IF DISLIKE IS PRESSED START ************************ */

	if(isset($_POST['disliked'])){
		
		$breedIdString = mysqli_real_escape_string($db, $_POST['breedId']);
		$breedId = (int)$breedIdString;
		$userId = mysqli_real_escape_string($db, $_POST['userId']);
		$type = mysqli_real_escape_string($db, $_POST['type']);

		$query = "SELECT * FROM likes";
		$result = mysqli_query($db, $query);
		$likes = mysqli_fetch_all($result, MYSQLI_ASSOC);

		/* ********************** IF LIKED CAN'T LIKE ************************ */

		foreach($likes as $like){
			if($like['user_id'] == $userId && $like['breed_id'] == $breedId && $like['type'] == "like"){
				exit();
			}
		}

		/* ********************** IF DISLIKED CAN'T DISLIKE AGAIN, INSTEAD UNDISLIKE ************************ */

		foreach($likes as $like){
		  if($like['user_id'] == $userId && $like['breed_id'] == $breedId && $like['type'] == "dislike"){
		  	// vec je lajkovan taj breed i sad moze samo da ga dislike

		  	$query = "SELECT dislikes FROM breeds WHERE id = $breedId";
			  $result = mysqli_query($db, $query);

			  $numberOfDislikes = mysqli_fetch_array($result);
				$numberOfDislikes = $numberOfDislikes['dislikes'];

				$numberOfDislikes -= 1;

				// insert

				mysqli_query($db, "UPDATE breeds SET dislikes = $numberOfDislikes WHERE id = $breedId");

		    $query = "DELETE FROM likes WHERE user_id = {$userId} AND type = '$type' AND breed_id = $breedId";
    		mysqli_query($db, $query);

		    exit();
		  }
		}

		/* ********************** DISLIKING BREED ************************ */


	  $query = "SELECT dislikes FROM breeds WHERE id = $breedId";
	  $result = mysqli_query($db, $query);

	  $numberOfDislikes = mysqli_fetch_array($result);
		$numberOfDislikes = $numberOfDislikes['dislikes'];

		$numberOfDislikes += 1;

		mysqli_query($db, "UPDATE breeds SET dislikes = $numberOfDislikes WHERE id = $breedId");

		$query = "INSERT INTO likes (user_id, breed_id, type) VALUES ('$userId', '$breedId', '$type')";
	  mysqli_query($db, $query);

	 	$disliked = true;

	 	echo $disliked;

		exit();

	}

	/* ********************** IF DISLIKE IS PRESSED END ************************ */

	/* ********************** DISPLAYING LIKES / DISLIKES START ************************ */

	if(isset($_POST['displayLikes'])){
		
		$breedIdString = mysqli_real_escape_string($db, $_POST['breedId']);
		$breedId = (int)$breedIdString;

	  $query = "SELECT likes FROM breeds WHERE id = $breedId";
	  $result = mysqli_query($db, $query);

		$numberOfLikes = mysqli_fetch_array($result);
		$numberOfLikes = $numberOfLikes['likes'];

		echo $numberOfLikes;

		exit();
	
	}

	if(isset($_POST['displayDislikes'])){
		
		$breedIdString = mysqli_real_escape_string($db, $_POST['breedId']);
		$breedId = (int)$breedIdString;

	  $query = "SELECT dislikes FROM breeds WHERE id = $breedId";
	  $result = mysqli_query($db, $query);

	  $numberOfDislikes = mysqli_fetch_array($result);
		$numberOfDislikes = $numberOfDislikes['dislikes'];

		echo $numberOfDislikes;

		exit();

	}

	/* ********************** DISPLAYING LIKES / DISLIKES END ************************ */























		/* ********************** IF LIKE IS PRESSED START ************************ */

	if(isset($_POST['liked-comment'])){
		
		$commentIdString = mysqli_real_escape_string($db, $_POST['commentId']);
		$commentId = (int)$commentIdString;
		$userId = mysqli_real_escape_string($db, $_POST['userId']);
		$type = mysqli_real_escape_string($db, $_POST['type']);

	  $query = "SELECT * FROM likes";
		$result = mysqli_query($db, $query);
		$likes = mysqli_fetch_all($result, MYSQLI_ASSOC);

		foreach($likes as $like){

			/* ********************** IF DISLIKED CAN'T LIKE ************************ */

			if($like['user_id'] == $userId && $like['comment_id'] == $commentId && $like['type_comment'] == "dislike"){
				exit();
			}

			/* ********************** IF LIKED CAN'T LIKE AGAIN, INSTEAD UNLIKE ************************ */

		  if($like['user_id'] == $userId && $like['comment_id'] == $commentId && $like['type_comment'] == "like"){
		  	// vec je lajkovan taj breed i sad moze samo da ga unlike

		  	$query = "SELECT likes FROM comments WHERE id = $commentId";
			  $result = mysqli_query($db, $query);

			  $numberOfLikes = mysqli_fetch_array($result);
				$numberOfLikes = $numberOfLikes['likes'];

				$numberOfLikes -= 1;

				// insert

				mysqli_query($db, "UPDATE comments SET likes = $numberOfLikes WHERE id = $commentId");

		    $query = "DELETE FROM likes WHERE user_id = {$userId} AND type_comment = '$type' AND comment_id = $commentId";
    		mysqli_query($db, $query);

		    exit();
		  }
		}

		/* ********************** LIKING COMMENT ************************ */

		$query = "SELECT likes FROM comments WHERE id = $commentId";
	  $result = mysqli_query($db, $query);

	  $numberOfLikes = mysqli_fetch_array($result);
		$numberOfLikes = $numberOfLikes['likes'];

		$numberOfLikes += 1;

		mysqli_query($db, "UPDATE comments SET likes = $numberOfLikes WHERE id = $commentId");

		$query = "INSERT INTO likes (user_id, comment_id, type_comment) VALUES ('$userId', '$commentId', '$type')";
	  mysqli_query($db, $query);

	  $liked = true;

	 	echo $liked;

		exit();

	}

	/* ********************** IF LIKE IS PRESSED END ************************ */

	/* ********************** IF DISLIKE IS PRESSED START ************************ */

	if(isset($_POST['disliked-comment'])){
		
		$commentIdString = mysqli_real_escape_string($db, $_POST['commentId']);
		$commentId = (int)$commentIdString;
		$userId = mysqli_real_escape_string($db, $_POST['userId']);
		$type = mysqli_real_escape_string($db, $_POST['type']);

		$query = "SELECT * FROM likes";
		$result = mysqli_query($db, $query);
		$likes = mysqli_fetch_all($result, MYSQLI_ASSOC);

			

		foreach($likes as $like){

			/* ********************** IF LIKED CAN'T LIKE ************************ */

			if($like['user_id'] == $userId && $like['comment_id'] == $commentId && $like['type_comment'] == "like"){
				exit();
			}

			/* ********************** IF DISLIKED CAN'T DISLIKE AGAIN, INSTEAD UNDISLIKE ************************ */	

		  if($like['user_id'] == $userId && $like['comment_id'] == $commentId && $like['type_comment'] == "dislike"){
		  	// vec je lajkovan taj breed i sad moze samo da ga dislike

		  	$query = "SELECT dislikes FROM comments WHERE id = $commentId";
			  $result = mysqli_query($db, $query);

			  $numberOfDislikes = mysqli_fetch_array($result);
				$numberOfDislikes = $numberOfDislikes['dislikes'];

				$numberOfDislikes -= 1;

				// insert

				mysqli_query($db, "UPDATE comments SET dislikes = $numberOfDislikes WHERE id = $commentId");

		    $query = "DELETE FROM likes WHERE user_id = {$userId} AND type_comment = '$type' AND comment_id = $commentId";
    		mysqli_query($db, $query);

		    exit();
		  }
		}

		/* ********************** DISLIKING COMMENT ************************ */


	  $query = "SELECT dislikes FROM comments WHERE id = $commentId";
	  $result = mysqli_query($db, $query);

	  $numberOfDislikes = mysqli_fetch_array($result);
		$numberOfDislikes = $numberOfDislikes['dislikes'];

		$numberOfDislikes += 1;

		mysqli_query($db, "UPDATE comments SET dislikes = $numberOfDislikes WHERE id = $commentId");

		$query = "INSERT INTO likes (user_id, comment_id, type_comment) VALUES ('$userId', '$commentId', '$type')";
	  mysqli_query($db, $query);

	 	$disliked = true;

	 	echo $disliked;

		exit();

	}

	/* ********************** IF DISLIKE IS PRESSED END ************************ */

	/* ********************** DISPLAYING LIKES / DISLIKES START ************************ */

	if(isset($_POST['displayLikes-comment'])){
		
		$commentIdString = mysqli_real_escape_string($db, $_POST['commentId']);
		$commentId = (int)$commentIdString;

	  $query = "SELECT likes FROM comments WHERE id = $commentId";
	  $result = mysqli_query($db, $query);

		$numberOfLikes = mysqli_fetch_array($result);
		$numberOfLikes = $numberOfLikes['likes'];

		echo $numberOfLikes;

		exit();
	
	}

	if(isset($_POST['displayDislikes-comment'])){
		
		$commentIdString = mysqli_real_escape_string($db, $_POST['commentId']);
		$commentId = (int)$commentIdString;

	  $query = "SELECT dislikes FROM comments WHERE id = $commentId";
	  $result = mysqli_query($db, $query);

	  $numberOfDislikes = mysqli_fetch_array($result);
		$numberOfDislikes = $numberOfDislikes['dislikes'];

		echo $numberOfDislikes;

		exit();

	}

	/* ********************** DISPLAYING LIKES / DISLIKES END ************************ */







?>