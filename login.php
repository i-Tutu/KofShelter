<?php
 		//Initialise session
 	session_start();
 	
 	// Check if the user is already logged in, if yes then redirect him to welcome page
	 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	 	header("location: postad.php");
	 	exit;
	 }	

	//Include dbconfig
	require_once "dbconfig.php";

	//Variables
	$email = $password = "";
	$email_err = $password_err = "";

	//Processing from data
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		//check emptiness of username
		if(empty(trim($_POST["email"]))){
			$email_err = "Please email is required";
	}	else{
			$email = trim($_POST["email"]);
		}

		//check emptiness of password
		if(empty(trim($_POST["password"]))){
			$password_err = "Please password is required";
	}	else{
			$password = trim($_POST["password"]);
		}


		//Verifying credentials
		if(empty($email_err) && empty($password_err)){

		//Select statement
		$sql = "SELECT id , email, password FROM users WHERE email= ?";

		if($stmt = $mysqli->prepare($sql)){
				//Bind Variables
				$stmt->bind_param("s", $param_email);

				//Set parameters
				$param_email = $email;

				//Executing statement
				if($stmt->execute()){
							//Store result
						$stmt->store_result();
						
						// Check if username exists, if yes then verify password
						if($stmt->num_rows == 1 ){
									//Bind Variables
									$stmt->bind_result($id, $email, $hashed_password);

									if($stmt->fetch()){
												if(password_verify($password, $hashed_password)){

												//Store data in variables
												$_SESSION["loggedin"] = true;
												$_SESSION["id"] = $id;
												$_SESSION["email"] = $email;

												//Redirect user to Post_Ad page
												header("location: postad.php");
											}  else{
											// Display an error message if password is not valid
													$password_err = "Password you entered is not valid";
												}
										}
								}	else{
								// Display an error message if username doesn't exist
								$email_err = "No account found with that Email";
							}
					} else{
					echo "Oops! Something went wrong. Please try again later.";
				}
			}
			 // Close statement
        $stmt->close();
	}   

		 // Close connection
    $mysqli->close();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">    
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>KofHouse - Login</title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="linearicons/style.css">
	<link href="css.css" rel="stylesheet">
</head>

<body>

	   <nav class="navbar sticky-top navbar-expand-lg "> 
	 		<div class="container">
			    <div class=" logo">
	 		<!-- <a class="navbar-brand" href="index.php"><img alt="Brand" src="..."></a> --> 
			  <a class="navbar-brand logo" href="index.php">KofShelter</a>
			</div>
		</div>
	</nav>

		<div class="mt-5 text-center mb-4">
			<h2>Please login to post ad</h2>
		</div>

	<div class="row">	

		<div class="col-md-3"></div>

		  <!-- Login -->
		 <div class="col-md-6">
		  <div class="card bg-light cardcontainer">
		   <div class="card-header">Login</div>
		    <div class="card-body">	

	              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

	              	
					  <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
					    <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>">
					    <span class="help-block text-danger"><?php echo $email_err; ?></span>
					  </div>
				

					  <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
					    <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo $password; ?>">
					    <span class="help-block text-danger"><?php echo $password_err; ?></span>
					  </div>

					  <div class="form-group form-check">
					    <label class="form-check-label">
					      <input class="form-check-input" type="checkbox"> Remember me
					    </label>
					  </div>

					  <div class="text-center">
					  <button type="submit" class="btn btn-other">Login</button>
					  </div>
					</form>		
		   </div>			
		    <div class="card-footer">
					<p>Don't have an account? <a href="register.php">Register</a></p>
			</div>
	      </div>
	   </div> 

	   	  <div class="col-md-3"></div>

	</div>

		<div class="text-center mt-5">
     	<a href="index.php">Back to Home</a>
     </div>
		<!-- End of Login -->

	<?php
		include("includethings/footertag.php");
	?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/\jquery.min.js"></script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/\bootstrap.min.js" crossorigin="anonymous"></script>      
</body>

</html>