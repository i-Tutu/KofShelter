
<?php
// Initialize the session

require_once "dbconfig.php";

session_start();

if (isset($_GET['search_result'])) {
	$search = $_GET['search_result'];

	if($search == "" OR $search == " "){
	$location = $_SERVER['referer'];

	header("location: index.php");	
	}

	

	$count = 0;
	$searchwords = explode(" ", $search);
	$counter = count($searchwords);
	$sqlcondition = "";
		while ($count < $counter) {
			# code...
		
	$searchword = $searchwords[$count];

	$orvalue = ($counter-$count > 1) ? " OR " : " " ;
	

	$sqlcondition .= "(CONVERT(`rent_category` USING utf8) LIKE '%".$searchword."%' OR CONVERT(`description` USING utf8) LIKE '%".$searchword."%' OR CONVERT(`price` USING utf8) LIKE '%".$searchword."%' OR CONVERT(`place` USING utf8) LIKE '%".$searchword."%')".$orvalue;

	$count++;
		}
	
	$sqlresult = "SELECT  id, user_id, rent_category, description, price, place, img FROM `kofshelter`.`post_ad` WHERE ".$sqlcondition."ORDER BY `id` DESC";

}

else{

	if ($_SERVER['referer'] == "") {
		$location = "index.php";
	} 
	else{
	$location = $_SERVER['referer'];	
	}

	header("location: $location");
}

 
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">    
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>KofShelter - More Renting Homes</title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link href="css.css" rel="stylesheet">
</head>

<body>

	    <?php
			include("head.php");
		?>
    
		<div class="text-center mt-3">
			<h3>Results from search</h3>
		</div>

		<hr class="divider mr-5 ml-5">


<div class="container-fluid">
	<div class="row">

		<?php 
			$sql = $sqlresult;

			$post_query = mysqli_query($con, $sql) or die(mysqli_error($con));

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

				
				$sqlimg = "SELECT id, name_img FROM img_tb WHERE img ='$img_code'";
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
		        <h5 class="text-center"><b>Price:</b> <?= $price ?></h5>
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
	    else{
	    	?>

	    	<div class="mt-5 ml-5 text-center">
	    	<h5>No results found</h5>
			</div>

	    	<?php

	    }

		?>

  </div>

  </div>

   <br>
	  
	 <nav aria-label="Page navigation">
  <ul class="pagination justify-content-center">
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
    <!-- ckeckout -->
	<!-- <li class="page-item disabled"><a href="#">Previous</a></li>
	<li class="page-item"><a href="#">Next</a></li>	 -->
	<!-- checkout -->
  <!-- </ul> -->
  </ul>
</nav>

</div>
			   
   <?php

		include("footer.php");
		// include("../includethings/footertag.php");
	?>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/\jquery.min.js"></script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/\bootstrap.min.js" crossorigin="anonymous"></script>      
</body>

</html>