<?php

  include("../server/server.php");
	include("../server/messages.php");

  /* ********************** GET BREEDS FROM DB ************************ */

	$query = "SELECT * FROM breeds";
	$result = mysqli_query($db, $query);
	$breeds = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// var_dump($breeds);

	/* ********************** FREE RESULT FROM MEMORY ************************ */

	mysqli_free_result($result);

  /* ********************** GET COMMENTS FROM DB ************************ */

  $queryComment = "SELECT * FROM comments";
  $resultComment = mysqli_query($db, $queryComment);
  $comments = mysqli_fetch_all($resultComment, MYSQLI_ASSOC);

  $numberOfCommentsForBreed = 0;

  /* ********************** PAGINATION  ************************ */

  $numberOfBreeds = 0;
	$perPage = 6;
	$breedsAdded = 0;
	foreach ($breeds as $breed){
		$numberOfBreeds++;
	}
	$page = $_GET['page'];
	$_SESSION['currentPage'] = $page;

	if($page < 1){
		header("Location: index.php?page=1");
	}

	if($numberOfBreeds % 6 == 0){
		if($page > (int)($numberOfBreeds / $perPage) || !$page || !is_numeric($page)){
    	header("Location: index.php?page=1");
		}
	}else{
		if($page > (int)($numberOfBreeds / $perPage + 1) || !$page || !is_numeric($page)){
	    header("Location: index.php?page=1");
		}
	}

	

?>

<?php include ('../partials/header.php'); ?>


  <div id="third-section">
    <div class="heading">
      <div class="container">
        <div class="row tex-center">
          <div class="col-md-12">
            <h2>Breeds</h2>
            <div class="submit submit-breed">
            	<?php if($isAdmin){ ?>
              	<a href="<?php echo ROOT_URL; ?>/views/dogs/new.php"><input type="submit" value="Add New Breed"></a>
							<?php }else{ ?>
              	<div><button type="submit" class="buttonW3 tooltipW3 disabledW3">Add New Breed<span class="tooltiptextW3">You are not an Admin</span></button></div>
              	<!-- <a class="buttonW3 tooltipW3 disabledW3" href="#">Add New Campground<span class="tooltiptextW3">You are not an Admin</span></a> -->
              <?php } ?>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </div>

  <?php 
    if($_SESSION['successLogin']){
      echo "Successfully loged in :)";
      unset($_SESSION['successLogin']);
    }
    
  ?>


  <div id="third-section3" class="bg-color-eee">
    <div class="container">
      <div class="row">
        <div class="triangle"></div>
      </div>
      <div class="row">

      <div class="cards-container">  
       
      <!-- CARD COL -->

      <?php for($i = $perPage * $page - 6; $i < ($perPage * $page); $i++) : ?>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="card-container manual-flip">
            <div class="card">
              <div class="front">
                <div class="cover">
                	<a href="<?php echo ROOT_URL; ?>/views/dogs/show.php?id=<?php echo ($breeds[$i])['id']; ?>"><img src="<?php echo ($breeds[$i])['image']; ?>" alt="Couldn't find the image"></a>
                </div>

                <div class="content">
                <div class="footer footer-edit">
                <button class="btn btn-simple" onclick="rotateCard(this)">
                <i class="fa fa-mail-forward"></i> More Info
                </button>
                </div>
                </div>
              </div> <!-- end front panel -->
              <div class="back">
                <div class="content">
                  <div class="main">
                    <h3 class="text-center"><?php echo ($breeds[$i])['name']; ?></h3>
                    <p class="text-center"><?php echo substr(($breeds[$i])['description'], 0, 169) . '...'; ?></p>

                    <div class="stats-container">
                      <div class="stats">
                        <h4>
                          <?php
                            foreach($comments as $comment){
                              if($comment['breed_id'] == ($breeds[$i])['id']){
                                $numberOfCommentsForBreed++;
                              }
                            }
                            echo $numberOfCommentsForBreed;
                            $numberOfCommentsForBreed = 0;
                          ?> 
                        </h4>
                        <p>
                        Comments
                        </p>
                      </div>
                      <div class="stats">
                        <h4><?php echo ($breeds[$i])['likes']; ?></h4>
                        <p>
                        Likes
                        </p>
                      </div>
                      <div class="stats">
                        <h4><?php echo ($breeds[$i])['dislikes']; ?></h4>
                        <p>
                        Dislikes
                        </p>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="footer">
                  <button class="btn btn-simple btn-simple-left" rel="tooltip" title="Flip Card" onclick="rotateCard(this)">
                    <i class="fa fa-reply"></i> Back
                  </button>
                  <button class="btn btn-simple-right btn-simple" rel="tooltip" title="See Full Post">
                    <a href="<?php echo ROOT_URL; ?>/views/dogs/show.php?id=<?php echo ($breeds[$i])['id']; ?>">Read Full Post  <i class="fa fa-mail-forward"></i></a>
                  </button>
                </div>
              </div> <!-- end back panel -->
            </div> <!-- end card -->
          </div> <!-- end card-container -->
        </div>

        <?php 
        	$breedsAdded++;
        	if($breedsAdded >= ($perPage) || !($breeds[$i + 1])['name']){
        		break;

        	}
        ?>

			<?php endfor; ?>


	<!-- CARD COL -->

	</div>


      </div>
    </div>


	<div class="container" style="text-align: center;" id="pagination-container">              
	  <ul class="pagination">

	  	<?php if($page == 1){ ?>
	    	<li class="disabled"><a>FIRST</a></li>
	    <?php }else{ ?>
	    <li><a href="<?php echo ROOT_URL; ?>/views/dogs/index.php?page=1">FIRST</a></li>
			<?php } ?>


			<?php if($page == 1){ ?>
	    	<li class="disabled"><a> << </a></li>
			<?php }else{ ?>
	    	<li><a href="<?php echo ROOT_URL; ?>/views/dogs/index.php?page=<?php echo $page - 1; ?>"> << </a></li>
	  	<?php } ?>


	    <li><a href="<?php echo ROOT_URL; ?>/views/dogs/index.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>

			
			<?php if($numberOfBreeds % 6 == 0){ ?>

				<!-- ako imamo 18 breedova 18 / 6 = 3 onda 3 + 1 = 4, a page ostaje 3 i onda page nikad nece biti == 4 i uvek ce moci da se ode u last iako on ne postoji -->

				<?php if($page == (int)($numberOfBreeds / $perPage)){  ?>
		    	<li class="disabled"><a> >> </a></li>
				<?php }else{ ?>
		    	<li><a href="<?php echo ROOT_URL; ?>/views/dogs/index.php?page=<?php echo $page + 1; ?>"> >> </a></li>
				<?php } ?>

			<?php }else{ ?>

				<?php if($page == (int)($numberOfBreeds / $perPage + 1)){  ?>
		    	<li class="disabled"><a> >> </a></li>
				<?php }else{ ?>
		    	<li><a href="<?php echo ROOT_URL; ?>/views/dogs/index.php?page=<?php echo $page + 1; ?>"> >> </a></li>
				<?php } ?>	

			<?php } ?>	


	    <?php if($numberOfBreeds % 6 == 0){ ?>

	    	<!-- ako imamo 18 breedova 18 / 6 = 3 onda 3 + 1 = 4, a page ostaje 3 i onda page nikad nece biti == 4 i uvek ce moci da se ode u last iako on ne postoji -->

				<?php if($page == (int)($numberOfBreeds / $perPage)){ ?>
		    	<li class="disabled"><a>LAST</a></li>
		  	<?php }else{ ?>
		    	<li><a href="<?php echo ROOT_URL; ?>/views/dogs/index.php?page=<?php echo (int)($numberOfBreeds / $perPage); ?>">LAST</a></li>
		  	<?php } ?>

		  <?php }else{ ?>	

		  	<?php if($page == (int)($numberOfBreeds / $perPage + 1)){ ?>
		    	<li class="disabled"><a>LAST</a></li>
		  	<?php }else{ ?>
		    	<li><a href="<?php echo ROOT_URL; ?>/views/dogs/index.php?page=<?php echo (int)($numberOfBreeds / $perPage) + 1; ?>">LAST</a></li>
		  	<?php } ?>

		  <?php } ?>	

	  </ul>
	</div>

</div>


<?php 

	$_SESSION['lastPage'] = (int)($numberOfBreeds / $perPage) + 1;
	
?>

<?php include ('../partials/footer.php'); ?>
	