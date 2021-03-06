
<?php
// Initialize the session
session_start();

// Include config file
require_once "dbconfig.php";

// $id = $_SESSION["id"];
// $sql = "SELECT rent_category, description, price FROM post_ad WHERE id = ?";

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
// 									$stmt->bind_result($rent_category, $description, $price);

// 									 if($stmt->fetch()){

// 									// 			//Store data 
// 									 	}
// 								}
// 					}
// 				}

// $sql = "SELECT phone_number FROM users WHERE id = ? ";

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
// 									$stmt->bind_result($phone_number);

// 									 if($stmt->fetch()){

// 									// 			//Store data 
// 									}
// 						}
// 				}
// 	}

   
 
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">    
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>KofShelter - Home</title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap/css/aos.css" rel="stylesheet">
	<link href="bootstrap/js/bootstrap.min.js" rel="stylesheet">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link href="css.css" rel="stylesheet">
</head>

<body>

	   <?php
			include("head.php");
		?>
    
    <div class="container-fluid">
	    <div class="card cardslider" > 
	    	<!-- <img class="card-img-top" src="image.jpeg" alt="Lamp"> --> 
	    	<div id="carouselControls" class="carousel slide" data-ride="carousel">
			  <div class="carousel-inner">
			    <div class="carousel-item active">
			      <!-- <img class="d-block w-100" src="..." alt="First slide"> -->
			      <img class="d-block w-100" src="img/apartment1.jpg" alt="Lamp">
			    </div>
			    <div class="carousel-item">
			      <!-- <img class="d-block w-100" src="..." alt="Second slide"> -->
			      <img class="d-block w-100" src="img/apartment2.jpg" alt="Lamp">
			    </div>
			    <div class="carousel-item">
			      <img class="d-block w-100" src="img/apartment3.jpg" alt="Lamp">
			    </div>
			    <div class="carousel-item">
			      <img class="d-block w-100" src="img/apartment5.jpg" alt="Lamp">
			    </div>
			    <div class="carousel-item">
			      <img class="d-block w-100" src="img/apartment6.jpg" alt="Lamp">
			    </div>
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
	    	<div class="card-footer text-center">Do you need a house to rent in Koforidua? Search here! </div>
	    </div>


		<div class="text-center mt-3">
			<h3>Rent Trending</h3>
		</div>

		<hr class="divider mr-5 ml-5">

	<div class="row">

		<?php 
			$sql = "SELECT id, user_id, rent_category, description, price, place, img FROM post_ad WHERE 1 ORDER BY id DESC";
			$post_query = mysqli_query($con, $sql);

			if (mysqli_num_rows($post_query) > 0) {
				# code...
			while ($post_data = mysqli_fetch_array($post_query)) {
				# code...
				$rent_category = $post_data['rent_category'];
				$price = $post_data['price'];
				$place = $post_data['place'];
				$img_code = $post_data['img'];
				$post_id = $post_data['id'];
				$post_userid = $post_data['user_id'];

				
				$sqlimg = "SELECT id, name_img FROM img_tb WHERE post_img ='$img_code'";
				$img_query = mysqli_query($con, $sqlimg);

				if (mysqli_num_rows($img_query) > 0) {
					# code...
					$img = mysqli_fetch_array($img_query);
					$img = $img['name_img'];
				
				
			
		 ?>
		  <div class="col-sm-6 col-md-4">
		    <div class="thumbnail">
		      <img class="card-img-top" src="postimgs/<?= $img ?>" alt="KofShelterHome">
		      <div class="caption">
		        <h4><b><?= $rent_category ?></b></h4>
		        <h5 class="text-center"><b>Price:</b> GHC <?= $price ?></h5>
		        <h5 class="text-center"><b>Place:</b> <?= $place ?></h5>
		         <div class="card-footer mb-3 text-center">
		         <form action="display.php" method="GET"> 
		         <input type="hidden" name="post" value="<?= $post_id?>">
		         <input type="hidden" name="user" value="<?= $post_userid?>">
		         <input type="hidden" name="image" value="<?= $img_code?>">		
		         <input type="submit" name="target" class="infolink" value="More Info">  <small><i class="fa fa-angle-down"></i></small></a>
		         </form>
		         </div>
		      </div>
		    </div>
		  </div>
		     <?php 
		     	}
			}
	    }

		?>

  </div>

   <br>
	  
    <!-- <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li> -->

<nav aria-label="Page navigation">
  <ul class="pagination justify-content-center">
    <!-- <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
    </li> -->
    <li class="page-item">
      <a class="page-link next" href="search_page.php">Next</a>
    </li>
  </ul>
</nav>


	

</div>


	<?php
		include("footer.php");
	?>

</body>

</html>