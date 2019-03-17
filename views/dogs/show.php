<?php

  include("../server/server.php");
	include("../server/messages.php");

	/* ********************** GET ID FROM COMMENT SCROLL START ************************ */

	$scrollCommentId = $_GET['comment'];

  /* ********************** GET ID FROM COMMENT SCROLL END ************************ */



  
  /* ********************** GET ID FROM LOGGED USER AND SHOWING BREED ************************ */

  $idlog = $_SESSION['id'];
  $id = mysqli_real_escape_string($db, $_GET['id']);
  $id = htmlentities($id);

  $_SESSION['showid'] = $id;


	/* ********************** GET BREED FROM DB ************************ */

	$query = "SELECT * FROM breeds WHERE id = $id";
	$result = mysqli_query($db, $query);
	$breed = mysqli_fetch_assoc($result);

	if($id != $breed['id'] || $id == ""){
		header("Location: index.php?page=1");
	}

	// var_dump($breeds);

	/* ********************** FREE THE RESULT FROM MEMORY ************************ */

	mysqli_free_result($result);

	/* ********************** DELETE BREED FROM DB ************************ */

  if(isset($_POST['deletebreed'])){
    $query = "DELETE FROM breeds WHERE id = {$id}";
    mysqli_query($db, $query);

    $query = "DELETE FROM likes WHERE breed_id = {$id}";
    mysqli_query($db, $query);

    $query = "SELECT id FROM comments WHERE breed_id = {$id}";
    $result = mysqli_query($db, $query);
    $array = mysqli_fetch_array($result);
    $commentId = $array['id'];

    $query = "DELETE FROM likes WHERE comment_id = {$commentId}";
    mysqli_query($db, $query);

    $query = "DELETE FROM comments WHERE breed_id = {$id}";
    mysqli_query($db, $query);


    header("Location: index.php?page=1");
  }

	/* ********************** INSERT COMMENT ************************ */

	if(isset($_POST['addcoment'])){

      $missingComment = true;
		  
      $commentcontent = mysqli_real_escape_string($db, $_POST['commentcontent']);
      $userid = mysqli_real_escape_string($db, $_POST['userid']);
      $breedid = mysqli_real_escape_string($db, $_POST['breedid']);
      $commentcontent = htmlentities($commentcontent);

      if(!empty($commentcontent)){
        $missingComment = false;
      }

      // ubaci u bazu

      date_default_timezone_set("Europe/Belgrade");
      $currentDate = date("Y-m-d H:i:s");

      if(!$missingComment){
        $sql = "INSERT INTO comments (content, user_id, breed_id, created) VALUES ('$commentcontent', '$userid', '$breedid', '$currentDate')";
        mysqli_query($db, $sql);
        header("Location: show.php?id=$id");
      }

	}

  /* ********************** EDIT COMMENT ************************ */

	if(isset($_POST['editcomment'])){

      $missingComment = true;
      
      $commentcontent = mysqli_real_escape_string($db, $_POST['commenteditcontent']);
      $commentcontent = htmlentities($commentcontent);
      $editid = $_POST['editcommentid'];


      if(!empty($commentcontent)){
        $missingComment = false;
      }

      // update u bazu

      date_default_timezone_set("Europe/Belgrade");
      $lastEdit = date("Y-m-d H:i:s");

      if(!$missingComment){

        $sql = "UPDATE comments SET content = '$commentcontent', lastEdit = '$lastEdit' WHERE id = $editid";
        mysqli_query($db, $sql);
        header("Location: show.php?id=$id");

      }

	}

  /* ********************** DELETE COMMENT ************************ */

	if(isset($_POST['deletecomment'])){
		
		$deleteid = $_POST['commentid'];
		// echo "$deleteid";
    $query = "DELETE FROM comments WHERE id = {$deleteid}";
    mysqli_query($db, $query);

    $query = "DELETE FROM likes WHERE comment_id = {$deleteid}";
    mysqli_query($db, $query);

    header("Location: show.php?id=$id");

	}


  /* ********************** GET COMMENTS FROM DB ************************ */

  $queryComment = "SELECT * FROM comments";
  $resultComment = mysqli_query($db, $queryComment);
  $comments = mysqli_fetch_all($resultComment, MYSQLI_ASSOC);

  $numberOfCommentsForBreed = 0;

  foreach($comments as $comment){
    if($comment['breed_id'] == $_GET['id']){
      $numberOfCommentsForBreed++;
    }
  }

  // var_dump($breeds);

  /* ********************** FREE THE RESULT FROM MEMORY ************************ */

  mysqli_free_result($resultComment);

  /* ********************** DATE FUNCTION START ************************ */

  function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
  }

  date_default_timezone_set("Europe/Belgrade");

  /* ********************** DATE FUNCTION END ************************ */

?>

<!DOCTYPE html>
<html>
<head>
  <!-- MOBILE RESPONSIVE -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- TITLE -->
  <title>Dog Breed's</title> 
  <!-- BOOTSTRAP -->
  <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
  <!-- <link rel="stylesheet" type="text/css" href="../../public/css/font-awesome.min.css"> -->
  

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->

  <!-- <link rel="stylesheet" type="text/css" href="../../public/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  
  <link rel="stylesheet" href="../../public/css/style.css">
  <link rel="stylesheet" href="../../public/css/show.css">

</head>
<body>

		<?php if($scrollCommentId) {?>
	
  		<input id="scroll-comment-id" type="hidden" value="<?php echo $scrollCommentId; ?>">

    <?php } ?>

    
    
  <!--  NAVBAR  -->
    
    <header class="site-header" id="top">
      <nav class="navbar navbar-default">
        <div class="container">
          <div class="row">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
              <div class="logo-wrapper">
                  <a class="navbar-brand" href="/projects/dogsite/">
                      <p>D<em>og Site</em></p>
                  </a>
              </div>  
            </div>
            <div class="collapse navbar-collapse" id="main-menu">
              <ul class="nav navbar-nav navbar-right">
                  <li><span></span><a href="<?php echo ROOT_URL; ?>/views/dogs/index.php?page=1" class="breeds">Breeds</a></li>
                  <li><span></span><a href="<?php echo ROOT_URL; ?>/views/contact.php" class="contact">Contact</a></li>

                  <?php if(isset($_SESSION['username'])){ ?>
                    <li><span></span><a href="<?php echo ROOT_URL; ?>/views/users/index.php?id=<?php echo $idlog; ?>" class="login">Logged in as <strong><?php echo $_SESSION['username']; ?></strong></a></li>
                    <li name="logout"><!-- <button type="submit" name="logout"> --><span></span><a href="<?php echo ROOT_URL; ?>/views/dogs/index.php?logout='1'" class="register">Logout</a><!-- </button> --></li>
                  <?php }else{ ?>
                    <li><span></span><a href="<?php echo ROOT_URL; ?>/views/auth/login.php" class="login">Login</a></li>
                    <li><span></span><a href="<?php echo ROOT_URL; ?>/views/auth/register.php" class="register">Register</a></li>
                  <?php } ?> 
              </ul>
            </div>
          </div> 
        </div>
      </nav>
    </header>
  
  <!--  NAVBAR  -->

  <a href="#" id="back-to-top" title="Back to top">&uarr;</a>


<div class="container">
  <div class="row">
<!--     <div class="col-md-3">
      <div class="list-group">
        <li class="list-group-item active">Info 1</li>
        <li class="list-group-item">Info 2</li>
        <li class="list-group-item">Info 3</li>
      </div>
    </div> -->
    <div class="col-md-9 show-breed-col">
      <section class="tabs-content" id="blog">
        <div class="wrapper">
          <div id="first-tab-group" class="tabgroup">
            <div id="tab1">
              <img src="<?php echo $breed['image']; ?>" alt="">
              <div class="text-content">
                <h4><?php echo $breed['name']; ?></h4>
                <ul class="info-post show-ul">

                        <?php 

                          $user_id = $breed['user_id'];
                          $query = "SELECT username FROM users WHERE id = '$user_id'";
                          $result = mysqli_query($db, $query);
                          $breedAuthorUsername = mysqli_fetch_array($result);
                          $breedAuthorUsername = $breedAuthorUsername['username'];

                        ?>

                  <li><i class="fa fa-user"></i><em><strong><a href="<?php echo ROOT_URL; ?>/views/users?id=<?php echo $user_id; ?>" class="show-a"><?php echo $breedAuthorUsername; ?></a></strong></em></li>
                  <li><i class="fa fa-calendar"></i><strong>Created: <?php echo time_elapsed_string($breed['created']); ?></strong></li>
                  <?php if(!$breed['lastedit'] == ""){ ?>
										<li><i class="fa fa-pencil"></i><strong>Updated: <?php echo time_elapsed_string($breed['lastedit']); ?></strong></li>
				      		<?php } ?>
                  <li><i class="fa fa-wechat"></i><strong><?php echo $numberOfCommentsForBreed; ?> Comments</strong></li>
                  
									<?php if($_SESSION['id']){ ?>

		                  <li>
		                    <form id="likes-dislikes" method="POST" style="display: inline;">

													<?php

													$query = "SELECT * FROM likes";
													$result = mysqli_query($db, $query);
													$likes = mysqli_fetch_all($result, MYSQLI_ASSOC);

														foreach($likes as $like){
		  												
		  												if($like['user_id'] == $_SESSION['id'] && $like['breed_id'] == $_GET['id'] && $like['type'] == "like"){
		  													$liked = true;
		  													break;
		  												}else{
		  													$liked = false;
		  													// break; ne sme
		  												}

		  												if($like['user_id'] == $_SESSION['id'] && $like['breed_id'] == $_GET['id'] && $like['type'] == "dislike"){
																$disliked = true;
																break;
															}else{
																$disliked = false;
																// break; ne sme
															}

		  											}
													?>


                          <button type="submit" name="like" value=" " class="like-input" id="like"><i class="fa fa-thumbs-up <?php if($liked) echo 'liked'; ?>"></i></button><span id="display-likes"><?php echo $breed['likes']; ?></span>
                          <button type="submit" name="dislike" value=" " class="dislike-input" id="dislike"><i class="fa fa-thumbs-down <?php if($disliked) echo 'disliked'; ?>"></i></bitton><span id="display-dislikes"><?php echo $breed['dislikes']; ?></span>



                          <!-- <input type="submit" name="like" value=" " class="like-input" id="like"><span id="display-likes"><?php // echo $breed['likes']; ?></span> -->
		                      <!-- <input type="submit" name="dislike" value=" " class="dislike-input" id="dislike"><span id="display-dislikes"><?php  // echo $breed['dislikes']; ?></span> -->
		                      <input id="hidden-likes" type="hidden" value="<?php echo $breed['likes']; ?>">
		                      <input id="hidden-dislikes" type="hidden" value="<?php echo $breed['dislikes']; ?>">
		                      <input id="hidden-liked-disliked-breed-id" type="hidden" value="<?php echo $breed['id']; ?>">
		                      <input id="hidden-user-id" type="hidden" value="<?php echo $_SESSION['id']; ?>">
		                    </form>
		                  </li>

	                <?php }else{ ?>  

	                  <li>
	                      <input type="submit" name="like-loggedOut" value=" " class="like-input-loggedOut" id="like-loggedOut" data-target="#login-register-modal-id" data-toggle="modal"><span id="display-likes"><?php echo $breed['likes']; ?></span>
	                      <input type="submit" name="dislike-loggedOut" value=" " class="dislike-input-loggedOut" id="dislike-loggedOut" data-target="#login-register-modal-id" data-toggle="modal"><span id="display-dislikes"><?php echo $breed['dislikes']; ?></span>

												<div class="modal fade" id="login-register-modal-id" role="dialog">
			                    <div class="modal-dialog">
			                      <!-- Modal content-->
			                      <div class="modal-content">
			                        <div class="modal-header">
			                          <button type="button" class="close" data-dismiss="modal">&times;</button>
			                          <h4 class="modal-title">You need to be logged in to vote !<br></h4>
			                        </div>
			                        <div class="modal-body">
			                            <a href="<?php echo ROOT_URL; ?>/views/auth/login.php"><button type="button" class="btn btn-primary">Login</button></a>
			                            <a href="<?php echo ROOT_URL; ?>/views/auth/register.php"><button type="button" class="btn btn-default">Register</button></a>
			                        </div>
			                      </div> 
			                    </div>
			                  </div>

	                  </li>

                  <?php } ?>
                  
                </ul>
                <p class="show-p"><?php echo $breed['description']; ?></p>
                <?php if (($_SESSION['username'] && $_SESSION['id'] == $breed['user_id']) || $isAdmin) { ?>
                	<a class="btn btn-xs btn-warning show-a" href="/projects/dogsite/views/dogs/edit.php?id=<?php echo $breed['id']; ?>">Edit</a>
                
                  <!--Delete breed used for modal button-->
                  <input type="submit" class="btn btn-xs btn-danger" data-target="#deleteBreedModal<?php echo $breed['id']; ?>" data-toggle="modal" value="Delete">

                  <!-- Modal to delete breed -->
                  <div class="modal fade" id="deleteBreedModal<?php echo $breed['id'] ?>" role="dialog">
                    <div class="modal-dialog">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Are you sure that you want to delete breed:<br>"<?php echo $breed['name']; ?>" ?</h4>
                        </div>
                        <div class="modal-body">
                          <form id="deleteForm" method="POST">
                            <input type="hidden" name="commentid" value="<?php echo $comment['id']; ?>">
                            <button type="submit" name="deletebreed" class="btn btn-danger">YES</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                          </form> 
                        </div>
                      </div> 
                    </div>
                  </div>

                <?php } ?>	
              </div>
            </div>
          </div>
        </div>
      </section>

		
			<!--COMMENT SECTION START-->
      <div class="well">
        <!--Setting up the add new comment button that is used for collapsing-->
        <div class="text-right">
          <a class="btn btn-success pull-right" role="button" data-toggle="collapse" href="#collapseComment" aria-expanded="false" aria-controls="collapseComment">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new comment
          </a>
        </div>
          <!--Comment section title-->
        <h4><strong>Comments <span class="glyphicon glyphicon glyphicon-comment" aria-hidden="true"></span></strong></h4>
      
        <!--Collapse Add a comment form START-->
        <div class="collapse" id="collapseComment">
          <div class="well" style="border-left: 5px solid #00C851;">
              <?php if(!isset($_SESSION['username'])){ ?>
            <!--If the user is not logged in, direct him to the login page-->
            <h5>You need to login before you can comment. <a href="<?php echo ROOT_URL; ?>/views/auth/login.php">Click here</a> to go to the login page.</h5>
              <?php } ?>
              <?php if(isset($_SESSION['username'])){ ?>
            <!--If the user is logged in, show the new comment form-->
            <h4>Write your comment <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span></h4>
            <form id="add-comment-form" method="POST">
              <div class="form-group">
                <input class="form-control" type="text" disabled value="<?php echo $_SESSION['username'] ?>">
              </div>
              <div class="form-group">
                <div class="error-input" id="missing-comment-error">
                  <?php 
                    if($missingComment){ ?>
                      <i class="fa fa-times-circle"></i>
                      <?php writeMessage("Comment field is required.");
                    }
                  ?>
                </div>
                <textarea class="form-control" id="comment-content" name="commentcontent" placeholder="Write your comment..." form="add-comment-form" rows="5" cols="70"></textarea>
              </div>
              <input type="hidden" name="breedid" value="<?php echo $_GET['id']; ?>">
              <input type="hidden" name="userid" value="<?php echo $_SESSION['id']; ?>">
              <div class="form-group">
                <button type="submit" name="addcoment" class="btn btn-success btn-sm">Comment <span class="glyphicon glyphicon-comment" aria-hidden="true"></span></button>
              </div>
            </form>
              <?php } ?>
          </div>
        </div>
        <!--Collapse Add a comment form END-->
        
        <hr>

  <!--Check if there are comments, if there are none say no comments.-->
    <?php if (sizeof($comments) === 0) { ?>
  		<em style="color: grey;">No comments yet.</em>
    <?php } ?>

  <!--Display comments by looping through them-->
  <?php foreach($comments as $comment) {
  		if($comment['breed_id'] == $_GET['id']){
  ?>

  <div class="row">
    <div class="col-md-12" id="comment<?php echo $comment['id']; ?>">
      <strong>
          <?php if ($_SESSION['username'] && $_SESSION['id'] == $comment['user_id']) { ?>
        <!--If the current user owns the comment, change the color of the user icon-->
        <span style="color: orange;" class="glyphicon glyphicon-user" aria-hidden="true"></span>
          <?php } else { ?>
        <!--Else just display it black-->
        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
          <?php } ?>
        <!--Print out the author username-->

				<!-- GETTING USERNAME FROM COMMENT AUTHOR ************-->

				<?php 

					$user_id = $comment['user_id'];
					$query = "SELECT username FROM users WHERE id = '$user_id'";
					$result = mysqli_query($db, $query);
					$commentAuthorUsername = mysqli_fetch_array($result);
					$commentAuthorUsername = $commentAuthorUsername['username'];

				?>

				<!-- GETTING USERNAME FROM COMMENT AUTHOR END ***********-->

        <a href="<?php echo ROOT_URL; ?>/views/users?id=<?php echo $user_id; ?>"><?php echo $commentAuthorUsername; ?></a>

					

	
      </strong>

      <!--Show when the comment was made-->
      <span class="pull-right">
        <?php echo time_elapsed_string($comment['created']); ?>
        <br>

        <?php if($_SESSION['id']){ ?>

          <form id="likes-dislikes-comments<?php echo $comment['id']; ?>" method="POST" style="display: inline;">


          	<?php

							$query = "SELECT * FROM likes";
							$result = mysqli_query($db, $query);
							$likes = mysqli_fetch_all($result, MYSQLI_ASSOC);

							foreach($likes as $like){
								
									if($like['user_id'] == $_SESSION['id'] && $like['comment_id'] == $comment['id'] && $like['type_comment'] == "like"){
										$liked = true;
										break;
									}else{
										$liked = false;
										// break; ne sme
									}

									if($like['user_id'] == $_SESSION['id'] && $like['comment_id'] == $comment['id'] && $like['type_comment'] == "dislike"){
										$disliked = true;
										break;
									}else{
										$disliked = false;
										// break; ne sme
									}

								}
						?>

						<button type="submit" name="like-comment<?php echo $comment['id']; ?>" value=" " class="like-comment-input" id="like-comment<?php echo $comment['id']; ?>"><i class="fa fa-thumbs-up <?php if($liked) echo 'liked'; ?>"></i></button><span id="display-likes-comment<?php echo $comment['id']; ?>"> <?php echo $comment['likes']; ?></span>
						<button type="submit" name="dislike-comment<?php echo $comment['id']; ?>" value=" " class="dislike-comment-input" id="dislike-comment<?php echo $comment['id']; ?>"><i class="fa fa-thumbs-down <?php if($disliked) echo 'disliked'; ?>"></i></button><span id="display-dislikes-comment<?php echo $comment['id']; ?>"> <?php echo $comment['dislikes']; ?></span>



            <!-- <input type="submit" name="like-comment<?php //echo $comment['id']; ?>" value=" " class="like-comment-input" id="like-comment<?php //echo $comment['id']; ?>"><span id="display-likes-comment<?php //echo $comment['id']; ?>"><?php //echo $comment['likes']; ?></span> -->
            <!-- <input type="submit" name="dislike-comment<?php// echo $comment['id']; ?>" value=" " class="dislike-comment-input" id="dislike-comment<?php// echo $comment['id']; ?>"><span id="display-dislikes-comment<?php// echo $comment['id']; ?>"><?php //echo $comment['dislikes']; ?></span> -->



            <input id="hidden-likes-comment<?php echo $comment['id']; ?>" type="hidden" value="<?php echo $comment['likes']; ?>">
            <input id="hidden-dislikes-comment<?php echo $comment['id']; ?>" type="hidden" value="<?php echo $comment['dislikes']; ?>">
            <input id="hidden-user-id" type="hidden" value="<?php echo $_SESSION['id']; ?>">
          </form>
        
        <?php }else{ ?>
          
          <input type="submit" name="like-comment-loggedOut" value=" " class="like-input-loggedOut" id="like-comment-loggedOut" data-target="#login-register-modal-id" data-toggle="modal"><span id="display-likes"><?php echo $comment['likes']; ?></span>
          <input type="submit" name="dislike-loggedOut" value=" " class="dislike-input-loggedOut" id="dislike-loggedOut" data-target="#login-register-modal-id" data-toggle="modal"><span id="display-dislikes"><?php echo $comment['dislikes']; ?></span>

          <div class="modal fade" id="login-register-modal-id" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">You need to be logged in to vote !<br></h4>
                </div>
                <div class="modal-body">
                    <a href="<?php echo ROOT_URL; ?>/views/auth/login.php"><button type="button" class="btn btn-primary">Login</button></a>
                    <a href="<?php echo ROOT_URL; ?>/views/auth/register.php"><button type="button" class="btn btn-default">Register</button></a>
                </div>
              </div> 
            </div>
          </div>

        <?php } ?>  

      </span>

      <!--Printing the comment-->
      <p>
      	<br>
      	<?php
      		echo $comment['content'];
      		if(!$comment['lastedit'] == ""){
      			echo "<br><br><strong>Last edit:</strong> " . time_elapsed_string($comment['lastedit']) . "<br>";
      			// echo "<br>";
      		} 		
      	?>	
      </p>
      

      <!--If the visitor is logged in and the owner of the comment, show the edit and delete buttons-->
      <?php if (($_SESSION['username'] && $_SESSION['id'] == $comment['user_id']) || $isAdmin) { ?>
    
      <br> 
      <!--Edit button used for collapsing the edit comment form-->
      <a class="btn btn-xs btn-warning aga" role="button" name="<?php echo $comment['id']; ?>" data-toggle="collapse" href="#collapseEdit<?php echo $comment['id'] ?>" aria-expanded="false" aria-controls="collapse<?php echo $comment['id'] ?>">
        Edit</a>


      <!--Delete comment used for modal button-->
      <input type="submit" class="btn btn-xs btn-danger" data-target="#myModal<?php echo $comment['id'] ?>" data-toggle="modal" value="Delete">

      <!-- Modal to delete comment -->
      <div class="modal fade" id="myModal<?php echo $comment['id'] ?>" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Are you sure that you want to delete your comment:<br>"<?php echo $comment['content']; ?>" ?</h4>
            </div>
            <div class="modal-body">
              <form id="delete-form" method="POST" style="display: inline;">
                <input type="hidden" name="commentid" value="<?php echo $comment['id']; ?>">
                <input type="submit" name="deletecomment" class="btn btn-danger" value="YES">
                <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
              </form> 
            </div>
          </div>
          
        </div>
      </div>
  




      <!--Edit comment form-->
      <div class="collapse" id="collapseEdit<?php echo $comment['id'] ?>">
        <div class="well well-edit" style="border-left: 5px solid #ffbb33; margin-top: 15px;">
          <h4>Edit your comment <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></h4>
          <form id="edit-comment-form<?php echo $comment['id']; ?>" method="POST">
            <div class="form-group">
              <input class="form-control" type="text" disabled value="<?php echo $_SESSION['username'] ?>">
            </div>
            <div class="form-group">
              <div class="error-input" id="missing-edit-comment-error<?php echo $comment['id']; ?>">
                <?php 
                  if($missingComment && $editid == $comment['id']){ ?>
                    <i class="fa fa-times-circle"></i>
                    <?php writeMessage("Comment field is required.");
                  }
                ?>
              </div>
              <textarea class="form-control" id="comment-edit-content<?php echo $comment['id']; ?>" name="commenteditcontent" placeholder="Your comment text..." form="edit-comment-form<?php echo $comment['id']; ?>" rows="5" cols="70"><?php echo $comment['content'] ?></textarea>
            </div>
            <input type="hidden" name="editcommentid" value="<?php echo $comment['id']; ?>">
            <div class="form-group">
              <button type="submit" name="editcomment" class="btn btn-warning btn-sm">Edit comment <span class="glyphicon glyphicon-comment" aria-hidden="true"></span></button>
            </div>
          </form>
        </div>
      </div>
        <?php } ?>
      <hr>
    </div>
  </div>
    <?php } // IF CLOSE
      } // FOREACH CLOSE
    ?>
</div>
<!--COMMENT SECTION END-->
    </div>  
  </div>    
</div>





<?php include ('../partials/footer.php'); ?>
	