
<?php
// Initialize the session
session_start();

// Include config file
require_once "dbconfig.php";

$id = $_SESSION["id"];

   $sql = "SELECT firstname, lastname, phone_number,email FROM users WHERE id = ? ";

   if($stmt = $mysqli->prepare($sql)){
				//Bind Variables
				$stmt->bind_param("s", $param_id);

				// Set parameters
				$param_id = $id;


				//Executing statement
				if($stmt->execute()){
							//Store result
						$stmt->store_result();
						
						// Check if username exists, if yes then verify password
						if($stmt->num_rows == 1 ){
									//Bind Variables
									$stmt->bind_result($firstname, $lastname, $phone_number,$email);

									 if($stmt->fetch()){

									// 			//Store data 
									 	}
								}
					}
				}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">    
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>KofShelter - Profile</title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link href="css.css" rel="stylesheet">
</head>

<body>

	    <?php
			include("head.php");
		?>

	<div class="row">

	<div class="col-md-3"></div>

	  <!-- Profile -->
 	<div class="col-md-6 mt-5">
		<div class="card bg-light cardcontainer">
		   <div class="card-header">Profile
		   	<a class="float-right" href=""><i class="fa fa-edit"></i></a>
		   </div>
		    <div class="card-body">
		    		<div>	
		 			     <label>Firstname: <?= $firstname ?></label>
		 			  </div>

		 			  <div>	
		 			     <label>Lastname: <?= $lastname; ?></label>
		 			  </div>

		 			  <div>
		 			     <label>Phone: </label>
		 			     <label><?= $phone_number; ?></label>
		 			  </div>

		 			  <div>
		 			     <label>Email: </label>
		 			     <label><?= $email; ?></label>
			         </div>

			         <div>
			         	
			         	<a class="btn " href="reset_password.php">Reset Password</a>
			         	 
			         </div>			
			    
		   </div>
		 </div>
	</div>

		<div class="col-md-3"></div>

</div>

     <div class="text-center mt-5">
     	<a href="index.php">Back to Home</a>
     </div>
		<!-- End of Profile -->

	<?php
		include("footer.php");
	?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/\jquery.min.js"></script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/\bootstrap.min.js" crossorigin="anonymous"></script>      
</body>

</html>