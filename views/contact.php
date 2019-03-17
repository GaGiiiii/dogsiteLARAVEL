<?php

  include("server/server.php");
  include("server/messages.php");

  if($_POST){

    $missingName = true;
    $missingEmail = true;
    $missingSubject = true;
    $missingMessage = true;
    $invalidEmail = false;

    $sentMail = false;

    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $subject = mysqli_real_escape_string($db, $_POST['subject']);
    $message = mysqli_real_escape_string($db, $_POST['message']);

    $name = htmlentities($name);
    $email = htmlentities($email);
    $subject = htmlentities($subject);
    $message = htmlentities($message);

    /* ********************** EMPTY FIELDS ************************ */

    if(!empty($name)){
      $missingName = false;
    }

    if(!empty($email)){
      $missingEmail = false;
    }

    if(!empty($subject)){
      $missingSubject = false;
    }

    if(!empty($message)){
      $missingMessage = false;
    }

  /* ********************** VALID EMAIL ************************ */

    if($email && filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      $invalidEmail = true;
    }

  /* ********************** IF NO ERRORS ************************ */

    if(!$missingName && !$missingEmail && !$missingSubject && !$missingMessage && !$invalidEmail){

      $emailTo = "dragoslav.gagi8@yahoo.com";
      $name = $_POST['name'];
      $email = $_POST['email'];
      $subject = $_POST['subject'];
      $message = "Name: " . $name . "\nEmail: " . $email . "\nSubject: " . $subject . "\nMessage: \n" . $_POST['message'];
      $headers = "From: " . $_POST['email'];

      if(mail($emailTo, $subject, $message, $headers)){
        $sentMail = true;
      }

    }

  } // IF OD POST REQUESTA

?>


<?php include('partials/header(forContact).php'); ?>


  <div id="third-section">
    <div class="heading">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2>Send Us A Message</h2>
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
        <div class="col-md-9 col-sm-9 col-xs-10" id="form-col">

          <form class="form-contact" id="form-contact" method="POST">
            
            <!-- ERROR / SUCCESS -->

            <div class="row">
              <div class="message-default-col col-md-12">
                <div class="<?php if($sentMail) echo 'success-default'; ?>">
                  <?php 
                    if($sentMail){ ?>
                      <i class="fa fa-check"></i>
                      <?php writeMessage("Successfully sent message.");
                    }
                  ?>
                </div>
              </div> 
            </div>

            <div class="row">

              <!-- NAME -->

              <div class="name col-md-4">
                <div class="error-input">
                  <?php 
                    if($missingName){ ?>
                      <i class="fa fa-times-circle"></i>
                      <?php writeMessage("Name field is required.");
                    }
                  ?>
                </div>
                <input class="input-contact" type="text" name="name" id="name" placeholder="Name" value='<?php echo $_POST["name"]; ?>'>
              </div>

              <!-- EMAIL -->

              <div class="email col-md-4">
                <div class="error-input">
                  <?php 
                    if($missingEmail){ ?>
                      <i class="fa fa-times-circle"></i>
                      <?php writeMessage("Email field is required.");
                    }
                    if($invalidEmail){ ?>
                    <i class="fa fa-times-circle"></i>
                      <?php writeMessage("Invalid email format.");
                    }
                  ?>
                </div>
                <input class="input-contact" type="email" name="email" id="email" placeholder="Email" value="<?php echo $_POST['email']; ?>">
              </div>

              <!-- SUBJECT -->

              <div class="subject col-md-4">
                <div class="error-input">
                  <?php 
                    if($missingSubject){ ?>
                      <i class="fa fa-times-circle"></i>
                      <?php writeMessage("Subject field is required.");
                    }
                  ?>
                </div>
                <input class="input-contact" type="text" name="subject" id="subject" placeholder="Subject" value="<?php echo $_POST['subject']; ?>">
              </div> 

            </div>
            <div class="row">
          
              <!-- MESSAGE -->
    
              <div class="text col-md-12">
                <div class="error-input">
                  <?php 
                    if($missingMessage){ ?>
                      <i class="fa fa-times-circle"></i>
                      <?php writeMessage("Message field is required.");
                    }
                  ?>
                </div>
                <textarea class="textarea-contact" name="message" placeholder="Message"><?php echo $_POST['message']; ?></textarea>
              </div> 

            </div>                              
            <div class="submit">
              <input type="submit" value="Send Now">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>






<?php include('partials/footer(stickyForContact).php'); ?>