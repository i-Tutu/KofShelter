
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
	    	<div class="card-footer text-center">
	    	   <p>Do you need a house to rent in Koforidua? Search here!</p>
	    	 </div>
	    </div>

	<div class="container-fluid">
		
		<div class="text-center mt-3">
			<h3>Rent Trending</h3>
		</div>

		<hr class="divider mr-5 ml-5">

			<div class="row" id="listing-area">
				
		  	</div>

		  	<div class="text-center" id="end-area">
				<button class="btn btn-other next"> Next </button>
		  	</div>

		   <br>

		</div>


	<?php
		include("footer.php");
	?>

	 <script type="text/javascript">
    $(document).ready(function(){
        var start = 0;
        var page_scroll = "home-listing";
        // console.log("heyo");

         $.ajax({

          url: "scroll.php?page_scroll="+page_scroll+"&start="+start,
          method: "GET",
          processdata: false,
          data:'',
          success:function(data){
            if (data=="<!-- end -->") {
              $('#end-area').html('<div class="col-lg-12"><h3><b>End Of Results</b></h3></div>');
            }
            $('#listing-area').html($('#listing-area').html()+data);
            start = start + 9;
            // console.log("hey "+start);
          //  console.log("data is "+data);
        }
            
          


        })



      $('.next').click(function(){
        
        $.ajax({

          url: "scroll.php?page_scroll="+page_scroll+"&start="+start,
          method: "GET",
          processdata: false,
          data:'',
          success:function(data){
            if (data=="<!-- end -->") {
              $('#end-area').html('<div class="col-lg-12"><h3><b>End Of Results</b></h3></div>');
            }
            $('#listing-area').html($('#listing-area').html()+data);
            start = start + 9;
            // console.log("hey "+start);
            console.log("data is "+data);

            
          }


        })
      })
    })
  </script>


</body>

</html>