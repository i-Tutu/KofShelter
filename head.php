
	<nav class="navbar sticky-top navbar-expand-lg "> 
	 		<div class="container">
	 			<form class="form-inline">
			    <div class=" logo"> 
			     <a class="navbar-brand logo" href="index.php">KofShelter</a>
			    </div></form>

			<form id="search" role="search" action="search_page.php" method="GET">
		      		<div class="input-group"><input type="text" name="search_result" class="form-control" placeholder="Search for Rent"><input type="submit" name="s" class="btn btn-nav" value="search"></div>
		    </form>

			  <form class="form-inline">
			    <div class="input-group">
			    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"><i class="fa fa-angle-down"></i></span>

			  </button>
			  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			  	<div class="itemright">
			    <div class="navbar-nav"><a class="nav-item nav-link font-weight-light" href="postad.php" >Post Ad</a>
			      <?php 

				 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
					 	?>
					 		<a class="nav-item nav-link" href="profile.php" >Profile</a>
					 		<a class="nav-item nav-link" href="logout.php" >Logout</a>
					 	 <?php
					 }
					 	else{

			      ?>
			      <a class="nav-item nav-link font-weight-light" href="login.php" >Login</a>
			      <a class="nav-item nav-link font-weight-light" href="register.php" >Register</a>
			       <?php
					 }

			      ?>
			    </div></div>
			  </div>
			</div></form>

		</div>
	</nav>