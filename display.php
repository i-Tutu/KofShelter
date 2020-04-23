
<?php
// Initialize the session
session_start();

// Include config file
require_once "dbconfig.php";

if (isset($_GET['target'])) {
	# code...
	$postid = $_GET["post"];
	$postidimage = $_GET["image"];
	$post_userid = $_GET["user"];

}	
else{
	header("location: index.php");
}

// $id = $_SESSION["id"];

//    $sql = "SELECT firstname, lastname, phone_number,email FROM users WHERE id = ? ";

//    if($stmt = $mysqli->prepare($sql)){
// 				//Bind Variables
// 				$stmt->bind_param("s", $param_id);

// 				// Set parameters
// 				$param_id = $id;


// 				//Executing statement
// 				if($stmt->execute()){
// 							//Store result
// 						$stmt->store_result();
						
// 						// Check if username exists, if yes then verify password
// 						if($stmt->num_rows == 1 ){
// 									//Bind Variables
// 									$stmt->bind_result($firstname, $lastname, $phone_number,$email);

// 									 if($stmt->fetch()){

// 									// 			//Store data 
// 									 	}
// 								}
// 					}
// 				}

// 	$sql = "SELECT rent_category, description, price FROM post_ad WHERE id = ? ";

//     if($stmt = $mysqli->prepare($sql)){
// 				//Bind Variables
// 				$stmt->bind_param("s", $param_id);

// 				// Set parameters
// 				$param_id = $id;


// 				//Executing statement
// 				if($stmt->execute()){
// 							//Store result
// 						$stmt->store_result();
						
// 						// Check if username exists, if yes then verify password
// 						if($stmt->num_rows == 1 ){
// 									//Bind Variables
// 								$stmt->bind_result($rent_category, $description, $price);

// 									 if($stmt->fetch()){

// 									// 			//Store data 
// 									 	}
// 								}
// 					}
// 				}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">    
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>KofShelter - More</title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link href="css.css" rel="stylesheet">
</head>

<body>

	    <?php
			include("head.php");
		?>

	<div class="container-fluid">
		<div class="row">
	  <!-- Slider -->
		 	<div class="col-md-8 mt-5">
				<div class="card bg-light cardcontainer">
				   <div class="card-header">Images</div>
				    <div class="card-body">

		<?php 
			
				$sqlimg = "SELECT id, name_img FROM img_tb WHERE img ='$postidimage'";
				$img_query = mysqli_query($con, $sqlimg);
				// or die(mysqli_error($con))

				if (mysqli_num_rows($img_query) > 0) {
					# code...
					$counter = "active";
			
		 ?>

	    	<div id="carouselControls" class="carousel slide" data-ride="carousel">
			  <div class="carousel-inner text-center">
					<?php

					while ($img = mysqli_fetch_array($img_query)) {
						$img = $img['name_img'];
										
					
					 ?>
			    <div class="carousel-item <?= $counter?>">
			      <img class="card-img-top" src="postimgs/<?= $img ?>" alt="KofShelter">
			    </div>

			    <?php
			    	$counter = "";

			    	}

			    ?>
			    
			  </div>
			  <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>

			<?php 
		   
	    }

		?>

				 </div>
			</div>
		</div>	
			<!-- Slider end -->

			<!-- Profile Info -->
			<div class="col-md-4 mt-5">
		<?php 
			$sql = "SELECT firstname, lastname, phone_number, email FROM users WHERE id =$post_userid";
			$users_query = mysqli_query($con, $sql);

			if (mysqli_num_rows($users_query) > 0) {
				# code...
			if ($users_data = mysqli_fetch_array($users_query)) {
				# code...
				$firstname = $users_data['firstname'];
				$lastname = $users_data['lastname'];
				$phone_number = $users_data['phone_number'];
				$email = $users_data['email'];
			
		 ?>
				<div class="card bg-light cardcontainer">
				   <div class="card-header">Owner Info</div>
				    <div class="card-body">
					  <div>
						<h4><b>Name: </b></h4>
						<h5><?= $firstname." ".$lastname ?></h5>
						<h4><b>Phone Number: </b></h4>
						<h5><?= $phone_number ?></h5>
						<h4><b>Email: </b></h4>
						<h5><?= $email ?></h5>
					         	 
					   </div>			
					    
				   </div>
				 </div>

				  <?php 
				}
			}

				?>
				
			</div>
			<!-- Profile Info End -->
        </div>
  

  				<!-- More Info -->
			<div class="text-center mt-5">

		<?php
					 
			$sql = "SELECT rent_category, description, price, place FROM post_ad WHERE id = $postid";
			$post_ad_query = mysqli_query($con, $sql);

			if (mysqli_num_rows($post_ad_query) > 0) {
				# code...
			if ($users_data = mysqli_fetch_array($post_ad_query)) {
				# code...
				$rent_category = $users_data['rent_category'];
				$description = $users_data['description'];
				$price = $users_data['price'];
				$place = $users_data['place'];
			
		 ?>
				<div class="card bg-light cardcontainer">
				   <div class="card-header">More Info</div>
				    <div class="card-body">
					  <div class="row">
					  	<div class="col-md-6">
						<h4><b> Home Type </b></h4>
						<h5><?= $rent_category ?></h5>

						<h4><b>Description </b></h4>
						<h5><?= $description ?></h5>
					    </div>

					    <div class="col-md-6">
						<h4><b>Price </b></h4>
						<h5><?= $price ?></h5>

						<h4><b>Place </b></h4>
						<h5><?= $place ?></h5>
					    </div>     	 
					   </div>			
					    
				   </div>
				 </div>

				   <?php 
				}
			}

				?>
				
			</div>
			<!-- More Info End -->
</div>

	<?php
		include("footer.php");
	?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/\jquery.min.js"></script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/\bootstrap.min.js" crossorigin="anonymous"></script>      
</body>

</html>