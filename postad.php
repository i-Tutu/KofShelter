
<?php
 		//Initialise session
 	session_start();

 	$id = $_SESSION["id"];
 	require_once "img_class.php";

 	$alerter = ""; 
 	
  	// Check if the user is already logged in, if yes then redirect him to welcome page
	 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
 	 	//Login Successful	
 	 } 
	   	     
 else{
	 	header("location: login.php");
	   }

	 // Include config file
	require_once "dbconfig.php";

// function up_img($img) {
// 			$img = img;
// 			  $name_img = $id.time().$img;
// 			  echo $name_img;
// 			  $name_img = md5(base64_encode(name_img)).$img;
// 			  echo $name_img;
// }

            $rent_category = $description = $price = $place = $name_img = $img = "";
			$rent_category_err = $description_err = $price_err = $place_err = $img_err = "";
			 
			// Processing form data when form is submitted
			// if(isset($_POST['postad_btn'])){
				if($_SERVER["REQUEST_METHOD"] == "POST"){

					$code = 'post'.$id.'-'.time();
					$img = $code;
				// up_img("kofi.png");
				// echo($_POST['rent_category']);
			  // $img = "kofi.png";
			  // $name_img = $id.time().$img;
			  // echo $name_img;
			  // $name_img = md5(base64_encode(name_img)).$img;
			  // echo $name_img;
			    //Validate users
			if(empty(trim($_POST['rent_category']))){
			    $rent_category_err = "Please Rent Category is required";
			} else{
			      $rent_category = trim($_POST['rent_category']);
			  }
			  
			  if(empty(trim($_POST["description"]))){
        		$description_err = "Please Description is required.";
    			}   elseif(strlen(trim($_POST["description"])) > 501){
                $description_err = "Description cannot be greater than 500";
               }
         	 else{
          		$description = trim($_POST["description"]);
          		}

			  if(empty(trim($_POST["price"]))){
			    $price_err = "Please Rent Price is required";
			} else{
			      $price = trim($_POST["price"]);
			  }
			  
			  if(empty(trim($_POST["place"]))){
			      $place_err = "Please Place is required";
			}  else{
			       $place = trim($_POST["place"]);
			  }

			//   if(empty(trim($_POST["img"]))){
			//       $place_err = "Please image is required";
			// }  else{
			//        $img = trim($_POST["img"]);
			//   }

			  //Checking errors before accepting into database
    	if(empty($rent_category_err) && empty($description_err) && empty($price_err) && empty($place_err)){

    	//Prepare insert statement
    	$sql = "INSERT INTO post_ad (user_id, rent_category, description, price, place, img) VALUES(?, ? ,? ,? ,?, ?)";

 		if($stmt = $mysqli->prepare($sql)){
            //Binding variables
            $stmt->bind_param("ssssss", $param_user_id, $param_rent_category, $param_description, $param_price, $param_place, $param_img);

            //Set parameters
            $param_user_id = $id;
            $param_rent_category = $rent_category;
            $param_description = $description;
            $param_price = $price;
            $param_place = $place;
            $param_img = $img;

            //Execute the prepare statement
            if($stmt->execute()){


              // echo "New ad created successfully";
              
             		 if (1) {

					$img1 = img::upload('fileToUpload1');
					db_insert($img1, $code);
					}

					if (1) {
					$img2 = img::upload('fileToUpload2');
					db_insert($img2, $code);
					}

					if (1) {
					$img3 = img::upload('fileToUpload3');
					db_insert($img3, $code);
					}

					if (1) {
					$img4 = img::upload('fileToUpload4');
					db_insert($img4, $code);
					}
              //Redirect to login page
              // header("location: index.php");
					$alerter = "success";
        }   else{
                echo "Please something went wrong. Try again";

    die("ERROR: Could not . " . mysqli_error($mysqli));

               }

     
        }

       //close statement
     $stmt->close();
    }
    	      
     // $mysqli->close();

  }


	 // $id = $_SESSION["id"];

   $sql = "SELECT firstname, lastname, phone_number FROM users WHERE id = ? ";

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
									$stmt->bind_result($firstname, $lastname, $phone_number);

									 if($stmt->fetch()){

									// 			//Store data 
									 	}
								}
					}
				}	

			 
			// Define variables and initialize with empty values
			

  	//Retrieve name and phone number
function db_insert($name_img,$code){
		global $mysqli, $id;

	if ($name_img != 0) {
			# code...
		$date = date('d/m/Y');
        
    	//Prepare insert statement
     $sql = "INSERT INTO img_tb (user_id, post_img, name_img, up_date) VALUES(?, ? ,?, ?)";

 		if($stmt = $mysqli->prepare($sql)){
            //Binding variables
            $stmt->bind_param("ssss", $param_user_id, $param_post_img, $param_name_img, $param_up_date);

            //Set parameters
            $param_user_id = $id;
            $param_name_img = $name_img;
            $param_post_img = $code;
            $param_up_date = $date;
            

            //Execute the prepare statement
            if($stmt->execute()){

              // echo "New img created successfully";
              
              //Redirect to login page
              // header("location: index.php");
        	}   else{
                echo "Please something went wrong. Try again";

    			die("ERROR: Could not . " . mysqli_error($mysqli));

            } 


            //close statement
     		$stmt->close();

     	}
   	}

}

	
$mysqli->close();
	
?>	 


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">    
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>KofShelter - Post Ad</title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="js.js" rel="stylesheet">
	<link href="css.css" rel="stylesheet">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="dropify/css/dropify.min.css">
	<link href="bootstrap/css/aos.css" rel="stylesheet">
</head>

<body>				
		<?php
			include("head.php");
		?>
       
       <br>

	  <!-- Post Ad -->
	  <div class="text-center"><h3>Post Ad</h3></div>
	  		
	  		<!-- Alert -->
	  		<?php 
	  			if ($alerter == "success") {
	  			
	  		?>
		<div class="alert alert-success mt-1 mr-5 ml-5">
		  <a href="display.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Success!</strong> Ad Posted 
		  <a href="display.php">Click here to view</a> 
		</div>
			<?php
				}
			?>
			<!-- End of 

				Alert -->

		<form action="" method="POST"  enctype="multipart/form-data">

	<div class="card bg-light mt-3 mr-5 ml-5">

		<div class="card-header">Ad Details</div>
			<div class="card-body">
	 				
				<div class="row">

				 	<div class="col-md-6">
				 	 <h4>Rent Category</h4>
				 	  <div class="form-group">
							<select class="form-control" name="rent_category">
							<option value="">-- Select Rent Category --</option>
							<option value="Single Room">Single Room</option>
							<option value="Single Room with Potch">Single Room with Potch</option>
							<option value="Self-Contained">Self-Contained</option>	
							<option value="Apartment">Apartment</option>		
							</select>
							<span class="help-block text-danger"><?php echo $rent_category_err; ?></span>
					  </div>
				 	</div>
				</div>
	 	 </div>

	 	 <div class="container">
	 	 	<h4>Picture</h4>
	 	 	<p class="heading"><small><i class="fa fa-square"></i></small> Accepted format are png, jpeg, jpg and gif. </p>
	 	 	<p class="heading"><small><i class="fa fa-square"></i></small> Max allowed size for uploaded file is 4MB.</p>
	 	 	<p class="heading"><small><i class="fa fa-square"></i></small> First picture is at least required to display to the public.</p>

					<div class="row">
					<div class="col-md-3">
						<div class="panel-content">
							<input type="file" name="fileToUpload1" class="dropify" data-max-file-size="10MB" data-allowed-file-extensions="png jpeg jpg gif">
						</div>
					</div>
					<div class="col-md-3">
						<div class="panel-content">
							<input type="file" name="fileToUpload2" class="dropify" data-max-file-size="10MB" data-allowed-file-extensions="png jpeg jpg gif">
						</div>
					</div>
					<div class="col-md-3">
						<div class="panel-content">
							<input type="file" name="fileToUpload3" class="dropify" data-max-file-size="10MB" data-allowed-file-extensions="png jpeg jpg gif">
						</div>
					</div>
					<div class="col-md-3">
						<div class="panel-content">
							<input type="file" name="fileToUpload4" class="dropify" data-max-file-size="10MB" data-allowed-file-extensions="png jpeg jpg gif">
						</div>
					</div>

					</div>
         </div>

	 	 	<div class=" col-md-7 mt-3">
	 	 		<h4 class="mb-2">Description</h4>
				<textarea class="form-control" rows="4" placeholder="Write your description. Please provide detail description." name="description"></textarea>
				<span class="help-block text-danger"><?php echo $description_err; ?></span>	 	 		
	 	 	</div>		
	 	 	       <div class="mt-2 mb-2 ml-3">
	 	 			<small>500 characters only. </small>
	 	 			</div>

	 	 	<div class="col-md-7 mt-3 mb-3">
	 	 		<h4 class="mb-2">Price</h4>	
	 	 		<input type="text" class="form-control" placeholder=" Rent Price Example 200 per month" name="price">
	 	 		</div>
	 	 		<span class="help-block text-danger"><?php echo $price_err; ?></span>
	 	 	</div>

	</div>

				<!--End of Ad Details  -->

			<div class="card bg-light mt-3 mr-5 ml-5">
			<div class="card-header">Ad Contact Information</div>
			<div class="card-body">
		
	 	<div class="row">

	 		<div class="col-md-6">
	 			  <div>
	 			     <h4>Name: </h4>
	 			     <h5><?= $firstname ?> <?= $lastname ?></h5> 
	 			  </div>

	 			  <div>
	 			     	<h4>Phone Number: </h4>
	 			     	<h5><?= $phone_number; ?></h5>
	 			  </div>

	 			  <div>
	 			     	<h4>Place: </h4>
	 			     	<input type="text" class="form-control" placeholder=" Example Adweso " name="place">
	 			     	<span class="help-block text-danger"><?php echo $place_err; ?></span>
	 			  </div>
	 		</div>

	 	   </div>
	 	   
	 	 </div>	
	 	 <div class="card-footer">
	 	 	<label class="form-check-label ml-5 mb-3">
			<input class="form-check-input" type="checkbox" required>
			By publishing an ad to KofShelter, you agree and accept the <a href="footer_content/termandcon.php">Terms and Conditions</a> of KofHouse. 
					    </label>
	 	 	<div class="text-center">
	 	 		<input type="submit" class="btn btn-other" value="Post Ad" name="postad_btn"/>
	 	 	</div>
	 	 </div>
	  
	   </div>

	</form>

	   				<div class="text-center mt-5">
     	               <a href="index.php">Back to Home</a>
                    </div>

		 
		<!-- End of content -->

	<?php
		include("footer.php");
	?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/\jquery.min.js"></script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/\bootstrap.min.js" crossorigin="anonymous"></script>



	<script src="jquery/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="dropify/js/dropify.min.js"></script>

	<script>
	$(function() {
		$('.dropify').dropify();

		var drEvent = $('#dropify-event').dropify();
		drEvent.on('dropify.beforeClear', function(event, element) {
			return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
		});

		drEvent.on('dropify.afterClear', function(event, element) {
			alert('File deleted');
		});

		$('.dropify-fr').dropify({
			messages: {
				default: 'Glissez-déposez un fichier ici ou cliquez',
				replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
				remove: 'Supprimer',
				error: 'Désolé, le fichier trop volumineux'
			}
		});
	});
	</script>      
</body>

</html>