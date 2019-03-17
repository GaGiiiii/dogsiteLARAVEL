<?php
    
    session_start();
    if(!empty($_SESSION['username'])){
      header("Location: ../dogs");
    }

 	include("../server/server.php");
 	include("../server/messages.php");

// ********************** IF USER IS LOGGED IN THEY CANT ACCESS HERE ************************



 ?>

 <?php include("../partials/header.php"); ?>



<div id="third-section">
    <div class="heading">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2>Register</h2>
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

					<!-- FORM START -->

          <form class="form-contact" id="form-contact" method="POST">
          	
          	<!-- ERROR -->

            <div class="row">
              <div class="message-default-col col-md-7">
                <div class="error-default">  
                  <?php
                    if($notMatchingPasswords){ ?>
                      <i class="fa fa-times-circle"></i>
                      <?php writeMessage("Passwords do not match.");
                    }
                  ?>
                </div>  
              </div> 
            </div>
            
            <!-- USERNAME -->

            <div class="row">
	            <div class="usernameRL col-md-7">
                <div class="error-input">
                  <?php 
                    if($missingUsername){ ?>
                      <i class="fa fa-times-circle"></i>
                      <?php writeMessage("Username field is required.");
                    }
                  ?>
	              </div>
	              <input class="input-contact" type="text" name="username" id="username" placeholder="Username" value="<?php echo $_POST['username']; ?>">
	            </div>
	          </div>

	          <!-- EMAIL -->

	          <div class="row">
	            <div class="emailRL col-md-7">
	            	<div class="error-input">
                  <?php 
                    if($missingEmail){ ?>
                      <i class="fa fa-times-circle"></i>
                      <?php writeMessage("Email field is required.");
                    }
                    if($invalidEmail){ ?>
                    <i class="fa fa-times-circle"></i>
                    	<?php writeMessage("Email format is invalid.");
                    }
                  ?>
	              </div>
	              <input class="input-contact" type="email" name="email" id="email" placeholder="Email" value="<?php echo $_POST['email']; ?>">
	            </div>
	          </div>

						<!-- FIRSTNAME -->

	          <div class="row">
	            <div class="firstnameRL col-md-7">
	              <input class="input-contact" type="text" name="firstname" id="firstname" placeholder="First Name" value="<?php echo $_POST['firstname']; ?>">
	            </div>
	          </div>

	          <!-- LASTNAME -->

	          <div class="row">
	            <div class="lastnameRL col-md-7">
	              <input class="input-contact" type="text" name="lastname" id="lastname" placeholder="Last Name" value="<?php echo $_POST['lastname']; ?>">
	            </div>
	          </div>  

						<!-- PASSWORD -->

	          <div class="row"> 
	            <div class="passwordRL col-md-7">
	            	<div class="error-input">
                  <?php 
                    if($missingPassword){ ?>
                      <i class="fa fa-times-circle"></i>
                      <?php writeMessage("Password field is required.");
                    }
                  ?>
	              </div>
	              <input class="input-contact" type="password" name="password" id="password" placeholder="Password" value="<?php echo $_POST['password']; ?>">
	            </div>
	          </div> 

						<!-- CONFIRMPASSWORD -->

	          <div class="row">  
	            <div class="passwordconfirmRL col-md-7">
	              <input class="input-contact" type="password" name="passwordconfirm" id="passwordconfirm" placeholder="Confirm Password" value="<?php echo $_POST['passwordconfirm']; ?>">
	            </div> 
            </div>

						<!-- AVATAR -->

            <div class="row">  
	            <div class="avatarRL col-md-7">
	              <input class="input-contact" type="text" name="avatar" id="avatar" placeholder="Avatar URL" value="<?php echo $_POST['avatar']; ?>">
	            </div> 
            </div>  

						<!-- SUBMIT -->

            <div class="submit submitregister">
              <input type="submit" name="register" value="Register">
            </div>
          </form>

          <!-- FORM END -->

        </div>
      </div>
    </div>
  </div>



 <?php include("../partials/footer.php"); ?>