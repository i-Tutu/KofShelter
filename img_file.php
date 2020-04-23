
<?php
session_start();
    // Include config file
	require_once "dbconfig.php";
	require_once "img_class.php";
	$id = $_SESSION['id'];



// 	function up_img($img) {
// 			$img = img;
// 			  $name_img = $id.time().$img;
// 			  echo $name_img;
// 			  $name_img = md5(base64_encode(name_img)).$img;
// 			  echo $name_img;
// }

//   $img = "kofi.png";
// 			  $name_img = $id.time().$img;
// 			  echo $name_img;
// 			  $name_img = md5(base64_encode(name_img)).$img;
// 			  echo $name_img;

if(isset($_POST["submit"])) {
	$code = 'post'.$id.'-'.time();


if (1) {
	# code...

$img1 = img::upload('fileToUpload');
db_insert($img1, $code);
}

if (1==0) {
$img2 = img::upload('fileToUpload');
db_insert($img2, $code);
}

if (1==0) {
$img3 = img::upload('fileToUpload');
db_insert($img3, $code);
}

if (1==0) {
$img4 = img::upload('fileToUpload');
db_insert($img4, $code);
}
//$name_img = basename($_FILES["fileToUpload"]["name"]);

}


// Check if file already exists
// if (file_exists($target_file)) {
//     echo "Sorry, file already exists.";
//     $uploadOk = 0;
// } 

function db_insert($name_img,$code){
		global $mysqli;

		$date = date('d/m/Y');
        
    	//Prepare insert statement
    	$sql = "INSERT INTO img_tb (name_img, post_id, up_date) VALUES(?, ? ,?)";

 		if($stmt = $mysqli->prepare($sql)){
            //Binding variables
            $stmt->bind_param("sss", $param_name_img, $param_post_id, $param_up_date);

            //Set parameters
            $param_name_img = $name_img;
            $param_post_id = $code;
            $param_up_date = $date;
            

            //Execute the prepare statement
            if($stmt->execute()){

              echo "New img created successfully";
              
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


?>



<!DOCTYPE html>
<html>
<body>

<form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>


