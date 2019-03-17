<?php


  /* ********************** GET ID OF LOGGED USER SO HE CAN GO TO HIS PROFILE BY CLICKING HIS USERNAME ************************ */
  session_start();
	$id = $_SESSION['id'];
  
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

  <!-- LINK FOR CONTACT PAGE -->
  <!-- <link rel="stylesheet" type="text/css" href="../public/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  
  <!-- LINK FOR CONTACT PAGE -->
  <link rel="stylesheet" href="../public/css/style.css">

</head>
<body>
    
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
                    <li><span></span><a href="<?php echo ROOT_URL; ?>/views/users/index.php?id=<?php echo $id; ?>" class="login">Logged in as <strong><?php echo $_SESSION['username']; ?></strong></a></li>
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

    