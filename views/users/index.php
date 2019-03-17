<?php

	include("../server/server.php");

      /* ********************** GET ID TO FIND USER ************************ */

      $id = mysqli_real_escape_string($db, $_GET['id']);

      /* ********************** GET USER FROM DB ************************ */

      $query = "SELECT * FROM users WHERE id = $id";
      $result = mysqli_query($db, $query);
      $user = mysqli_fetch_assoc($result);

      /* ********************** GET BREEDS FROM DB ************************ */

      $query = "SELECT * FROM breeds WHERE user_id = $id";
      $result = mysqli_query($db, $query);
      $breeds = mysqli_fetch_all($result, MYSQLI_ASSOC);

      /* ********************** GET COMMENTS FROM DB ************************ */

      $query = "SELECT * FROM comments WHERE user_id = $id";
      $result = mysqli_query($db, $query);
      $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

      /* ********************** GET LIKES FROM DB ************************ */

      $query = "SELECT * FROM likes WHERE user_id = $id";
      $result = mysqli_query($db, $query);
      $likes = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<?php include ('../partials/header.php'); ?>
    
  <div id="third-section">
    <div class="heading">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2>User: <strong>"<?php echo $user['username']; ?>"</strong></h2>
          </div> 
        </div>
      </div>
    </div>
  </div>

  <div id="third-section3" class="user-profile-div">
    <div class="container">
      <div class="row">
        <div class="triangle"></div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-5 text-center">
          <h1><?php echo $user['firstname'] . " " . $user['lastname']; ?></h1>
          <div class="profile-img text-center">
            <div class="thumbnail">
              <img src="<?php echo $user['avatar']; ?>" alt="User Profile Image">
              <div class="caption">
                <a href="mailto:<?php echo $user['email']; ?>"><?php echo $user['email']; ?></a>
              </div>
            </div>
            <div class="about"> 
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis ex facere laudantium numquam est. Adipisci sapiente libero dolores et inventore, nulla dolore nesciunt ab a, explicabo reprehenderit, beatae magnam pariatur?
            </div> 
          </div>  
        </div>
        <div class="col-md-8 col-sm-7">  
        	<div class="row">

					 <!-- ********************** BREEDS AND COMMENTS START ************************  -->

	          <div class="col-md-6 col-sm-5 text-center"> 

	          	<!-- **********************  BREEDS ************************  -->

	            <h3><?php echo $user['username']; ?>'s Breed's</h3>
	            <ul>
	              <?php
	                $number = 0;
	                foreach($breeds as $breed){
	              ?>
	                  <li class="listItemWidth"><a href="<?php echo ROOT_URL; ?>/views/dogs/show.php?id=<?php echo $breed['id']; ?>"><?php echo $breed['name']; ?></a></li>
	                  <?php
	                    $number++;
	                    if($number > 4) break;
	                }

	                $number = 0;
	                foreach($breeds as $breed){
	                	$number++;
	                }

	                if($number > 4 && $number != 5){ ?>
	                		<li>
	                  		<a role="button" data-toggle="collapse" href="#demoBreeds" aria-expanded="false" class="show-all">SHOW ALL BREEDS</a>
										  	<div id="demoBreeds" class="collapse">
										    	<?php 
										    		$number = 0;
										    		foreach ($breeds as $breed){
										    			$number++;
										    			if($number < 6){
										    				continue;
										    			}else{ ?>
																<ul>
																	<li class="listItemWidth"><a href="<?php echo ROOT_URL; ?>/views/dogs/show.php?id=<?php echo $breed['id']; ?>"><?php echo $breed['name']; ?></a></li>
																</ul>
										    		<?php }
										    				}
										    	?>
										  	</div>
										  </li>	
	                <?php } ?>             
	            </ul>

							<!-- **********************  COMMENTS ************************  -->


	            <h3><?php echo $user['username']; ?>'s Comment's</h3>
	            <ul>
	              <?php
	                $number = 0;
	                foreach($comments as $comment){ 
	              ?>
	                <li class="listItemWidth"><a href="<?php echo ROOT_URL; ?>/views/dogs/show.php?id=<?php echo $comment['breed_id']; ?>&comment=<?php echo $comment['id']; ?>"><?php echo $comment['content']; ?></a></li>

	              <?php 
	                  $number++;
	                  if($number > 4) break; // prikazace 3 komentara
	                }

	                $number = 0;
	                foreach($comments as $comment){
	                	$number++;
	                }

	                if($number > 4 && $number != 5){ ?>
	                		<li>
	                  		<a role="button" data-toggle="collapse" href="#demoComments" aria-expanded="false" class="show-all">SHOW ALL COMMENTS</a>
										  	<div id="demoComments" class="collapse">
										    	<?php 
										    		$number = 0;
										    		foreach ($comments as $comment){
										    			$number++;
										    			if($number < 6){
										    				continue;
										    			}else{ ?>
																<ul>
																	<li class="listItemWidth"><a href="<?php echo ROOT_URL; ?>/views/dogs/show.php?id=<?php echo $comment['breed_id']; ?>&comment=<?php echo $comment['id']; ?>"><?php echo $comment['content']; ?></a></li>
																</ul>
										    		<?php }
										    				}
										    	?>
										  	</div>
										  </li>	
	                <?php } ?>
	              
	            </ul>

         	 </div>

         	 <!-- **********************  BREEDS AND COMMENTS END ************************  -->

         	 <!-- **********************  BREEDS AND COMMENTS LIKED START ************************  -->

          <div class="col-md-6 col-sm-5 text-center">
	
						<!-- **********************  BREEDS LIKED ************************  -->

            <h3>Breed's That <?php echo $user['username']; ?> Liked</h3>
            <ul>
              <?php
                // foreach($breeds as $breed){
                  $number = 0;
                  foreach ($likes as $like){
                    if($like['type'] == "like"){
                    	// postoji lajk i treba ga ispisati

                      $likeBreedId = $like['breed_id'];
                      $query = "SELECT id, name FROM breeds WHERE id = $likeBreedId";
                      $result = mysqli_query($db, $query);

                      $array = mysqli_fetch_array($result);
                      // print_r($breedId);
                      $breedId = $array['id'];

                      // $breedName = mysqli_fetch_array($result);
                      $breedName = $array['name'];

              ?>
                <li class="listItemWidth"><a href="<?php echo ROOT_URL; ?>/views/dogs/show.php?id=<?php echo $breedId; ?>"><?php echo $breedName; ?></a></li>
              <?php
                      $number++;
                      if($number > 4) break;
                    }
                  }

                  	$number = 0;
		                foreach($likes as $like){
		                	if($like['type'] == "like"){
		                		$number++;
		                	}
		                }

                    if($number > 4 && $number != 5){ ?>
                		<li>
                  		<a role="button" data-toggle="collapse" href="#demoLikedBreeds" aria-expanded="false" class="show-all">SHOW ALL LIKED BREEDS</a>
									  	<div id="demoLikedBreeds" class="collapse">
									    	<?php 
									    		$number = 0;
									    		foreach ($likes as $like){
									    			if($like['type'] == "like"){			                      
									    				$number++;
									    			}
									    			if($number < 6 || $like['type'] != "like"){
									    				continue;
									    			}else{ ?>

														<?php 
															$likeBreedId = $like['breed_id'];
				                      $query = "SELECT id, name FROM breeds WHERE id = $likeBreedId";
				                      $result = mysqli_query($db, $query);

				                      $array = mysqli_fetch_array($result);
				                      // print_r($breedId);
				                      $breedId = $array['id'];

				                      // $breedName = mysqli_fetch_array($result);
				                      $breedName = $array['name'];
				                     ?>

															<ul>
																<li class="listItemWidth"><a href="<?php echo ROOT_URL; ?>/views/dogs/show.php?id=<?php echo $breedId; ?>"><?php echo $breedName; ?></a></li>
															</ul>
									    		<?php }
									    				}
									    	?>
									  	</div>
									  </li>	
                <?php } ?>
              
            </ul>


				<!-- **********************  COMMENTS LIKED ************************  -->


            <h3>Comments That <?php echo $user['username']; ?> Liked</h3>
            <ul>
              <?php
                $number = 0;
                foreach($likes as $like){
                  if($like['type_comment'] == "like"){
                    $likeCommentId = $like['comment_id'];

                    $query = "SELECT breed_id, content FROM comments WHERE id = $likeCommentId";
                    $result = mysqli_query($db, $query);

                    $array = mysqli_fetch_array($result);
                    $breedId = $array['breed_id'];

                    $comment = $array['content'];

              ?>
                <li class="listItemWidth"><a href="<?php echo ROOT_URL; ?>/views/dogs/show.php?id=<?php echo $breedId; ?>&comment=<?php echo $likeCommentId; ?>"><?php echo $comment; ?></a></li>
              <?php
                    $number++;
                    if($number > 4) break;
                  }                 
                }

                $number = 0;
                foreach($likes as $like){
                	if($like['type_comment'] == "like"){
                		$number++;
                    // echo $like['user_id'] . "  ";
                    // echo "  " . $like['comment_id'] . " ";
                    // echo $number;
                	}
                }

                if($number > 4 && $number != 5){ ?>
                		<li>
                  		<a role="button" data-toggle="collapse" href="#demoLikedComments" aria-expanded="false" class="show-all">SHOW ALL LIKED COMMENTS</a>
									  	<div id="demoLikedComments" class="collapse">
									    	<?php 
									    		$number = 0;
									    		foreach ($likes as $like){
									    			if($like['type_comment'] == "like"){			                      
									    				$number++;
									    			}
									    			if($number < 6 || $like['type_comment'] != "like"){
									    				continue;
									    			}//else{ ?>

														<?php
                              // if($like['type_comment'] == "like"){ 
  															$likeCommentId = $like['comment_id'];

  					                    $query = "SELECT breed_id, content FROM comments WHERE id = $likeCommentId";
  					                    $result = mysqli_query($db, $query);

  					                    $array = mysqli_fetch_array($result);
  					                    $breedId = $array['breed_id'];

  					                    $comment = $array['content'];
				                     ?>

															<ul>
																<li class="listItemWidth"><a href="<?php echo ROOT_URL; ?>/views/dogs/show.php?id=<?php echo $breedId; ?>&comment=<?php echo $likeCommentId; ?>"><?php echo $comment; ?></a></li>
															</ul>
									    		<?php //}
                              // }
								    				}
									    	?>
									  	</div>
									  </li>	
                <?php } ?>
              

            </ul>
          </div> <!-- breeds liked -->

          <!-- **********************  BREEDS AND COMMENTS LIKED END ************************  -->
      

        </div>  <!-- row -->

        </div>
      </div>
    </div>
  </div>


<?php include ('../partials/footer.php'); ?>
	