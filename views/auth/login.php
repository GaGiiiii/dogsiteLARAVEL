<?php

  session_start();
      if(!empty($_SESSION['username'])){
      header("Location: ../dogs");
    }

  include("../server/server.php");
 	include("../server/messages.php");

  // ********************** IF USER IS LOGGED IN HE CANT ACCESS HERE ************************



 ?>

 <?php include("../partials/header.php"); ?>



<div id="third-section">
    <div class="heading">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2>Login</h2>
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
                    // include("../server/errors.php"); 
                    if($wrongCombination){ ?>
                      <i class="fa fa-times-circle"></i>
                      <?php  writeMessage("Wrong username and password combination.");
                    }
                  ?>
                </div>  
              </div> 
            </div>

            <!-- USERNAME -->

            <div class="row">
	            <div class="usernameRL message-input-col col-md-7">
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

						<!-- PASSWORD -->

	          <div class="row"> 
	            <div class="passwordRL message-input-col col-md-7">
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

						<!-- SUBMIT -->

            <div class="submit submitregister">
              <input type="submit" name="login" value="Login">
            </div>
          </form>

          <!-- FORM END -->

        </div>
      </div>
    </div>
  </div>



 <?php include("../partials/footer(sticky).php"); ?>