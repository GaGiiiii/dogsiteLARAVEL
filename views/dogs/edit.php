<?php

  include("../server/server.php");
  include("../server/messages.php");

    /* ********************** GET ID OF BREED THAT U WANT TO EDIT ************************ */

    $id = mysqli_real_escape_string($db, $_GET['id']);

    /* ********************** GET BREED FROM DB ************************ */

    $query = "SELECT * FROM breeds WHERE id = $id";
    $result = mysqli_query($db, $query);
    $breed = mysqli_fetch_assoc($result);

    // var_dump($breeds);

    /* ********************** FREE RESULT FROM MEMORY ************************ */

    mysqli_free_result($result);

    /* ********************** YOU CANT EDIT BREED IF YOU ARE NOT ADMIN OR CREATOR ************************ */

    if(($_SESSION['id'] != $breed['user_id']) && !$isAdmin){
      header("Location: show.php?id=$id");
    }

    /* ********************** UPDADINT BREED ************************ */

    if(isset($_POST['updatebreed'])){

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

      /* ********************** UPDATE DB ************************ */

      date_default_timezone_set("Europe/Belgrade");
      $lastEdit = date("Y-m-d H:i:s");

      if(!$missingName && !$missingImage && !$missingDescription){
        $sql = "UPDATE breeds SET name = '$breedname', image = '$breedimage', lastedit = '$lastEdit', description = '$breeddescription' WHERE id = $id";
        mysqli_query($db, $sql);
        header("Location: show.php?id=$id");
      }

    }

 ?>



<?php include("../partials/header.php"); ?>



  <div id="third-section">
    <div class="heading">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2>Update <strong>"<?php echo $breed['name']; ?>"</strong></h2>
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

            
          <?php include("../server/errors.php"); ?>


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
                <input class="input-contact" type="text" name="breedname" id="username" placeholder="Breed Name" value="<?php echo $breed['name']; ?>">
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
                <input class="input-contact" type="text" name="breedimage" id="email" placeholder="Image URL" value="<?php echo $breed['image']; ?>">
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
                <textarea class="textarea-contact" name="breeddescription" placeholder="Description"><?php echo $breed['description']; ?></textarea>
              </div>   
            </div> 

            <!-- SUBMIT -->

            <div class="submit submitregister">
              <input type="submit" name="updatebreed" value="Update">
            </div>

          </form>

          <!-- FORM END -->

        </div>
      </div>
    </div>
  </div>



 <?php include("../partials/footer(sticky).php"); ?>