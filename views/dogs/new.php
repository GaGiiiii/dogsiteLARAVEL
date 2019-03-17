<?php

  include("../server/server.php");
 	include("../server/messages.php");

    /* ********************** IF NOT ADMIN REDIRECT ************************ */

    if(!$isAdmin){
      // unset($_SESSION['successLogin']); ne mora jer kad god addujes new breed opet ces otici na index gde ce se napraviti session variable.
      header("Location: index.php?page=" . $_SESSION['currentPage']);
    }

    /* ********************** INSERTING BREED ************************ */

 		if(isset($_POST['sendbreed'])){

      $missingName = true;
      $missingImage = true;
      $missingDescription = true;
 			
 			$breedname = mysqli_real_escape_string($db, $_POST['breedname']);
 			$breedimage = mysqli_real_escape_string($db, $_POST['breedimage']);
 			$breeddescription = mysqli_real_escape_string($db, $_POST['breeddescription']);
 			
 			$breedname = htmlentities($breedname);
 			$breedimage = htmlentities($breedimage);
 			$breeddescription = htmlentities($breeddescription);

 			if(!empty($breedname)){
        $missingName = false;
 			}

 			if(!empty($breedimage)){
 		    $missingImage = false;  
 			}

 			if(!empty($breeddescription)){
 			  $missingDescription = false;
 			}

 			/* ********************** INSERT BREED IN DB ************************ */
      
 			date_default_timezone_set("Europe/Belgrade");
 			$currentDate = date("Y-m-d H:i:s");

      $userid = mysqli_real_escape_string($db, $_POST['userid']);

 			if(!$missingName && !$missingImage && !$missingDescription){
 				$sql = "INSERT INTO breeds (name, image, description, created, user_id) VALUES ('$breedname', '$breedimage', '$breeddescription', '$currentDate', '$userid')";
 				mysqli_query($db, $sql);
        // unset($_SESSION['successLogin']); ne mora jer kad kod addujes new breed opet ces otici na index gde ce se napraviti session variable.
 				header("Location: index.php?page=" . $_SESSION['lastPage']);
 			}


 		}

 ?>



<?php include("../partials/header.php"); ?>



	<div id="third-section">
    <div class="heading">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2>Add New Breed</h2>
          </div> 
        </div>
      </div>
    </div>
  </div>
  
  <div id="third-section3">
    <div class="container">
      <div class="row">
        <div class="triangle"></div>
      </div>
      <div class="row">
        <div class="col-md-7 col-sm-7 col-xs-10" id="form-col">
          <div id="error-success-message">
            <?php include("../server/errors.php"); ?>
          </div>

					<!-- FORM START -->

          <form class="form-contact" id="form-contact" method="POST">
            
            <!-- BREED NAME -->

            <div class="row">
	            <div class="usernameRL col-md-7">
                <div class="error-input">
                  <?php 
                    if($missingName){ ?>
                      <i class="fa fa-times-circle"></i>
                      <?php writeMessage("Name field is required.");
                    }
                  ?>
                </div>
	              <input class="input-contact" type="text" name="breedname" id="username" placeholder="Breed Name" value="<?php echo $_POST['breedname']; ?>">
	            </div>
	          </div>

	          <!-- IMAGE -->

	          <div class="row">
	            <div class="emailRL col-md-7">
                <div class="error-input">
                  <?php 
                    if($missingImage){ ?>
                      <i class="fa fa-times-circle"></i>
                      <?php writeMessage("Image field is required.");
                    }
                  ?>
                </div>
	              <input class="input-contact" type="text" name="breedimage" id="email" placeholder="Image URL" value="<?php echo $_POST['breedimage']; ?>">
	            </div>
	          </div>

						<!-- DESCRIPTION -->

            <div class="row">        
              <div class="text text-breeddescription col-md-7">
                <div class="error-input">
                  <?php 
                    if($missingDescription){ ?>
                      <i class="fa fa-times-circle"></i>
                      <?php writeMessage("Description field is required.");
                    }
                  ?>
                </div>
                <textarea class="textarea-contact" name="breeddescription" placeholder="Description"><?php echo $_POST['breeddescription']; ?></textarea>
              </div>   
            </div>

            <!-- USER ID -->

            <input type="hidden" name="userid" value="<?php echo $_SESSION['id']; ?>"> 

						<!-- SUBMIT -->

            <div class="submit submitregister">
              <input type="submit" name="sendbreed" value="Add Breed">
            </div>

          </form>

          <!-- FORM END -->

        </div>
      </div>
    </div>
  </div>



 <?php include("../partials/footer(sticky).php"); ?>