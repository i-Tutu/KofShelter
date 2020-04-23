<?php

session_start();

// Include config file
require_once "dbconfig.php";

// function search_query($search){

// 	$search = $search;
	
	
// 	$count = 0;
// 	$searchwords = explode(" ", $search);
// 	$counter = count($searchwords);
// 	$sqlcondition = "";
// 		while ($count < $counter) {
// 			# code...
		
// 	$searchword = $searchwords[$count];

// 	$orvalue = ($counter-$count > 1) ? " OR " : " " ;
	

// 	$sqlcondition .= "(CONVERT(`rent_category` USING utf8) LIKE '%".$searchword."%' OR CONVERT(`description` USING utf8) LIKE '%".$searchword."%' OR CONVERT(`price` USING utf8) LIKE '%".$searchword."%' OR CONVERT(`place` USING utf8) LIKE '%".$searchword."%')".$orvalue;

// 	$count++;
// 		}
	
// 	$sqlresult = "SELECT  id, user_id, rent_category, description, price, place, img FROM `kofshelter`.`post_ad` WHERE ".$sqlcondition."ORDER BY `id` DESC";

// 	return $sqlresult;

// }

if(isset($_GET['page_scroll'])){
			$start = $_GET['start'];
			$page_scroll = $_GET['page_scroll'];

			$output = '';

			if ($page_scroll == "home-listing") {
				# code...
				$sql = "SELECT post_ad.id, post_ad.user_id, post_ad.rent_category, post_ad.description, post_ad.price, post_ad.place, post_ad.img, img_tb.name_img FROM post_ad, img_tb WHERE post_ad.id > 0 AND img_tb.img = post_ad.img ORDER BY id DESC";
				// echo "echo";

			} elseif($page_scroll == "search-listing") {
				// # code...
				// $search = $_GET['search'];
				// $sql = search_query($search);

				exit;
			} else {
				# code...
				exit;
			}
			
		 
			

			$post_query = mysqli_query($con, $sql);
			$no_post = mysqli_num_rows($post_query);
			if ($no_post > 0) {
				# code...
				$post_data = mysqli_fetch_all($post_query);
				// print_r($post_data[0]);
				$i = 0;
			
				$i = $start;

			while ($i < $start + 9) {
				if ($i >= $no_post) {
					# code...
					
					echo '<!-- end -->';
					
					exit;
				}
				# code...
				$rent_category = $post_data[$i][2];
				$price = $post_data[$i][4];
				$place = $post_data[$i][5];
				$img_code = $post_data[$i][6];
				$post_id = $post_data[$i][0];
				$post_userid = $post_data[$i][1];
				$img = $post_data[$i][7];
				// echo $img;
				
				
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
		         <input type="hidden" name="post" value="<?= $post_id ?>">
		         <input type="hidden" name="user" value="<?= $post_userid ?>">
		         <input type="hidden" name="image" value="<?= $img_code ?>">		
		         <input type="submit" name="target" class="infolink" value="More Info">  <small><i class="fa fa-angle-down"></i></small></a>
		         </form>
		         </div>
		      </div>
		    </div>
		  </div>
		  <?php
		     
		     $i++;
			}

			
	    }

		


}



?>
