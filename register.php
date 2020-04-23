
<?php
// Include config file
require_once "dbconfig.php";

  $alert = "";
 
// Define variables and initialize with empty values
$firstname = $lastname = $email = $phone_number = $password = $confirm_password = "";
$firstname_err = $lastname_err = $email_err = $phone_number_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    //Validate users
if(empty(trim($_POST["firstname"]))){
    $firstname_err = "Please Firstname is required";
} else{
      $firstname = trim($_POST["firstname"]);
  }
  
  if(empty(trim($_POST["lastname"]))){
      $lastname_err = "Please Lastname is required";
}  else{
       $lastname = trim($_POST["lastname"]);
  }

      //Validate email
 if(empty(trim($_POST["email"]))){
 $email_err = "Please Email is required";
}  else{
    $sql = "SELECT id FROM users WHERE email = ?";
        if($stmt = $mysqli->prepare($sql)){

        $stmt->bind_param("s", $param_email);

        //Set parameters
        $param_email = trim($_POST["email"]);

        //Execute the prepared statement
        if($stmt->execute()){
        //store result
        $stmt->store_result();

        if($stmt->num_rows == 1){
        $email_err = "Please email is already taken.";
    }
        else{
        $email = trim($_POST["email"]);
    }

}
        else{
        echo "Oops! something went wrong. Please try again.";
        }
    }

    //close statement
        $stmt->close();
  }
        
 
            //validate phone number
        if(empty(trim($_POST["phone_number"]))){
        $phone_number_err = "Please Phone number is required.";
    }   elseif(strlen(trim($_POST["phone_number"])) > 21){
                $phone_number_err = "Phone number cannot be greater than 20";
               }
          else{
          $phone_number = trim($_POST["phone_number"]);
          }     

            //validate password
        if(empty(trim($_POST["password"]))){
        $password_err = "Please Password is required.";
        }   elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    }  else{
        $password = trim($_POST["password"]);
}

        //validate confirm password
        if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please Confirm password is required";
    }  else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err  = "Password did not match.";
        }
          }

    //Checking errors before accepting into database
    if(empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($phone_number_err) && empty($password_err) && empty($confirm_Password)){

    //Prepare insert statement
    $sql = "INSERT INTO users (firstname, lastname, email, phone_number, password) VALUES(? ,? ,? ,? ,?)";

 if($stmt = $mysqli->prepare($sql)){
            //Binding variables
            $stmt->bind_param("sssss", $param_firstname, $param_lastname, $param_email, $param_phone_number, $param_password);

            //Set parameters
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_email = $email;
            $param_phone_number = $phone_number;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            //Execute the prepare statement
            if($stmt->execute()){

              //  $msg = "<div class="alert alert-success alert-dismissible fade show" role="alert">
              //   Registration Successful
              // </div> ";

              // //Redirect to login page
              // header("location: login.php");
              $alert = "Successful";
        }   else{
                echo "Please something went wrong. Try again";
               } 
        }

            //close statement
     $stmt->close();
    }
  
  //close connection
  $mysqli->close();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">    
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>KofShelter - Register</title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link href="css.css" rel="stylesheet">
</head>

<body>

	   <nav class="navbar sticky-top navbar-expand-lg"> 
	 		<div class="container">
          <div class=" logo">
      <!-- <a class="navbar-brand" href="index.php"><img alt="Brand" src="..."></a> --> 
        <a class="navbar-brand logo" href="index.php">KofShelter</a>
      </div>
		</div>
	</nav>

    <div class="mt-5 text-center mb-4">
      <h2>Please register to post ad</h2>
    </div>

    <!-- Alert -->
    <?php 
      if ($alert == "Successful") {
      
     ?>
      <div class="alert alert-success mt-4 mr-5 ml-5">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      Registered <strong>Successfully!</strong> 
      <a href="login.php">Login</a> 
    </div>
    <?php
      }
     ?>
    <!-- End of Alert -->

	  <!-- Register -->
    <div class="row">

      <div class="col-md-3"></div>

    <div class="col-md-6 mt-3">
      
        	<div class="card bg-light">
        		<div class="card-header">Register</div>
        	<div class="card-body">
        	               <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        	               	<div class="row">

        					  <div class="form-group col-md-6 <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
        					    <!-- <label>Firstname:</label> -->
        					    <input type="text" name="firstname" class="form-control" placeholder="Firstname"  value="<?php echo $firstname; ?>">
                      <span class="help-block text-danger"><?php echo $firstname_err; ?></span>
        					  </div>

        					  <div class="form-group col-md-6 <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
        					    <!-- <label>Latname:</label> -->
        					    <input type="text" name="lastname" class="form-control" placeholder="Lastname" value="<?php echo $lastname; ?>">
                      <span class="help-block text-danger"><?php echo $lastname_err; ?></span>
        					  </div>
        					</div>

        					  <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
        					   <!--  <label>Email:</label> -->
        					    <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>">
                      <span class="help-block text-danger"><?php echo $email_err; ?></span>
        					  </div>

        					  <div class="form-group <?php echo (!empty($phone_number_err)) ? 'has-error' : ''; ?>">
        					    <input type="tel" name="phone_number" class="form-control" placeholder="Phone Number" value="<?php echo $phone_number; ?>">
                      <span class="help-block text-danger"><?php echo $phone_number_err; ?></span>
                    </div>

        					  <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        					    <!-- <label>Password:</label> -->
        					    <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo $password; ?>">
                      <span class="help-block text-danger"><?php echo $password_err; ?></span>
        					  </div>

        					  <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
        					    <!-- <label>Password:</label> -->
        					    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" value="<?php echo $confirm_password; ?>">
                      <span class="help-block text-danger"><?php echo $confirm_password_err; ?></span>
        					  </div>

                    <div class="text-center">
        					  <button type="submit" class="btn btn-other">Submit</button>
                    </div>
        					</form>
            		</div>
            		<div class="card-footer">
            					<p>Ready have an account! <a href="login.php">Login</a></p>
            			</div>	
	     </div>

       <div class="col-md-3"></div>

     </div>
   </div>

    <div class="text-center mt-5">
      <a href="index.php">Back to Home</a>
     </div>
		<!-- End of Register -->

	<?php
    include("includethings/footertag.php");
  ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/\jquery.min.js"></script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/\bootstrap.min.js" crossorigin="anonymous"></script>      
</body>

</html>