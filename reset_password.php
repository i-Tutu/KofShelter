<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "dbconfig.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
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

    <title>KofHouse - Reset Password</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="linearicons/style.css">
    <link href="css.css" rel="stylesheet">
</head>

<body>

         <?php
            include("head.php");
         ?>

    <div class="row">

    <div class="col-md-3"></div>

                  <!-- Reset Password -->
              <div class="col-md-6 mt-5">  
                <div class="card bg-light cardcontainer">
                   <div class="card-header">Reset Password</div>
                    <div class="card-body">
                    
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <p>Please fill out this form to reset your password.</p>
                        
                        <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                        <input type="password" name="new_password" class="form-control" placeholder="New Password" value="<?php echo $new_password; ?>">
                        <span class="help-block"><?php echo $new_password_err; ?></span>
                        </div>

                         <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                         <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                         <span class="help-block"><?php echo $confirm_password_err; ?></span>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn " value="Submit">
                            <a class="btn btn-default" href="profile.php">Cancel</a>
                        </div>
                    </form>     
                </div>          
            </div>
        </div>

        <div class="col-md-3"></div>

</div>
        <div class="text-center mt-5">
        <a href="index.php">Back to Home</a>
     </div>
        <!-- End of Reset Password -->

    <?php
        include("footer.php");
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/\jquery.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/\bootstrap.min.js" crossorigin="anonymous"></script>      
</body>
</html>