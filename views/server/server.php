<?php 

	include("db.php");

	session_start();

	$username = "";
	$email = "";
	$firstname = "";
	$lastname = "";
	$avatar = "";

	if(isset($_POST['register'])){

		$missingUsername = true;
		$missingEmail = true;
		$missingPassword = true;
		$notMatchingPasswords = false;
		$invalidEmail = false;
		$takenUsername = false;
		$takenEmail = false;
		
		$wrongCombination = false;
		$successLogin = false;

		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$passwordconfirm = mysqli_real_escape_string($db, $_POST['passwordconfirm']);
		$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
		$lastname = mysqli_real_escape_string($db, $_POST['lastname']);
		$avatar = mysqli_real_escape_string($db, $_POST['avatar']);

		$username = htmlentities($username);
		$email = htmlentities($email);
		$password = htmlentities($password);
		$passwordconfirm = htmlentities($passwordconfirm);
		$firstname = htmlentities($firstname);
		$lastname = htmlentities($lastname);
		$avatar = htmlentities($avatar);

		/* ********************** ENSURE THAT FORM FIELDS ARE FILLED VALID ************************ */

		if(!empty($username)){
			$missingUsername = false;
		}

		if(!empty($email)){
			$missingEmail = false;
		}

		if(!empty($password)){
			$missingPassword = false;
		}

		if($password != $passwordconfirm){
			$notMatchingPasswords = true;
		}

		/* ********************** KVESCNABL ************************ */

    if($email && filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      $invalidEmail = true;
    }

    /* ********************** IS IT TAKEN ************************ */

    $query = "SELECT id FROM `users` WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($db, $query);

    if(mysqli_num_rows($result) > 0){
    	$takenUsername = true;
    }

    $query = "SELECT id FROM `users` WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($db, $query);

    if(mysqli_num_rows($result) > 0){
    	$takenEmail = true;
    }

    /* ********************** IF THERE ARE NO ERRORS SAVE USER TO DB ************************ */

    // if(count($errors) == 0){
    if(!$missingUsername && !$missingPassword && !$missingEmail && !$notMatchingPasswords && !$invalidEmail && !$takenUsername && !$takenEmail){
    	
    	$passwordDB = md5(md5($password));
    	$sql = "INSERT INTO users (username, email, password, firstname, lastname, avatar) VALUES ('$username', '$email', '$passwordDB', '$firstname', '$lastname', '$avatar')";
    	mysqli_query($db, $sql);
    	$_SESSION['username'] = $username;

    	header("Location: ../contact.php");

    }

	}

	/* ********************** IF LOGIN BUTTON IS CLICKED ************************ */

	if(isset($_POST['login'])){

		$missingUsername = true;
		$missingPassword = true;
		$wrongCombination = false;
		$successLogin = false;
		
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		$username = htmlentities($username);
		$password = htmlentities($password);

		/* ********************** ENSURE THAT FORM FIELDS ARE FILLED VALID ************************ */

		if(!empty($username)){
			$missingUsername = false;
		}

		if(!empty($password)){
			$missingPassword = false;
		}

		if(!$missingUsername && !$missingPassword){
			
			$password = md5(md5($password));
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$result = mysqli_query($db, $query);
			if(mysqli_num_rows($result) == 1){

				/* ********************** LOG USER IN ************************ */

				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";

				$successMessage = "Login successfull.";
      	$_SESSION['successLogin'] = true;

				header("Location: ../dogs/index.php?page=1");

			}else{
				$wrongCombination = true; 
			}

		}

	}

	/* ********************** LOGOUT ************************ */

	if(isset($_GET['logout'])){
		session_destroy();
		unset($_SESSION['username']);

  	$successMessage = "Logout successfull.";
    $successM = true;

		header("Location: ../auth/login.php");
	}


	/* ********************** GET ID OF CURRENT USER ************************ */

	$isAdmin = false;

	if(isset($_SESSION['username'])){
		$currentUserUsername = $_SESSION['username'];
		$query = "SELECT id FROM `users` WHERE username = '$currentUserUsername' LIMIT 1";
		$result = mysqli_query($db, $query);
		$currentUserId = mysqli_fetch_array($result);
		$_SESSION['id'] = $currentUserId['id'];

		$query = "SELECT role FROM `users` WHERE username = '$currentUserUsername' LIMIT 1";
		$result = mysqli_query($db, $query);
		$currentUserRole = mysqli_fetch_array($result);
		if($currentUserRole['role'] == "admin"){
		  $isAdmin = true;
		}
	}	

?>