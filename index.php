<!DOCTYPE html>
<html lang="en">
<head>
	<title>MavicBooking.com | Search Flight And Hotels In Cheap To High End</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="https://lh3.googleusercontent.com/-HtZivmahJYI/VUZKoVuFx3I/AAAAAAAAAcM/thmMtUUPjbA/Blue_square_A-3.PNG" />
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="forcompany.css">
	<link rel="stylesheet" href="homepage.css">
	<link rel="stylesheet" href="AdminSignin.css">
	<link rel="stylesheet" href="footer.css">
	<link rel="stylesheet" href="testimonials.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<script src="login.js"> </script>
	<script src="jump.js"> </script>
	<script src="testimonials.js"></script>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top bg-def">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand mr-5" href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a>			
				<a class="navbar-brand mr-5" href="aboutUs.php"><span class="glyphicon"></span> About Us</a>			
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					
					<li id = "cart">
						<a class="navbar-brand" href="cartshow.php"><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</a>
					</li>


					<li class="dropdown" id = "new">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"> Sign in&nbsp;</span><span class="caret"></span>
						</a>
						<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
						  <li><a href="signup.html">Register</a></li>
						  
						  <li class="dropdown-submenu">
							<a tabindex="-1" href="customersignin.html">Sign in</a>
						  </li>
						
						</ul>
					</li>
					  <li class="dropdown" id = "old">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" ><span class="glyphicon glyphicon-user" id="wuser">Welcome!</span>
						<span class="caret"></span>
						</a>
						<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
							<li><a href="showhistory.php">History</a></li>							
							<li><a href="#" id="logout">Sign out</a></li>
						</ul>
						</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="text-center">
		<h1><img src="images/Logo.png" alt=""></h1> 
		<p>We specialize in your air plan!</p> 
	</div>

	<div class="container" id="homepage">
		<h1><b>Search Flights</b></h1>
		<br />
		<p><b>Choose your flight option</b></p>
		<div class="btn-group btn-group-justified">			
			<div class="btn-group">
			<button id="button1" type="button" href="#oneway" class="btn btn-primary">One-way</button>
			</div>
			<div class="btn-group">
			<button id="button2" type="button" href="#roundtrip" class="btn btn-primary">Round-trip</button>
			</div>
			<div class="btn-group">
			<button id="button3" type="button" href="#all" class="btn btn-primary">Search all flights</button>
			</div>
		</div>
		<hr />
	<div id="oneway">
		<form role="form" action="SearchResultOneway.php" method="post">
		  <div class="row">
		  <div class="col-sm-6">
		    <label for="from">From:</label>
		    <input type="text" class="form-control" id="from" name="from" placeholder="City or Code" required>
		  </div>
		  <div class="col-sm-6">
		    <label for="to">To:</label>
		    <input type="text" class="form-control" id="to" name="to" placeholder="City or Code" required>
		  </div>
		  </div>
		  <hr >
		  <div class="row">
			  <div class="col-sm-6">
			    <label for="depart">Depart:</label>
			    <input type="date" class="form-control" id="depart" name="depart" required>
			  </div>
		  </div>   
		   <div class="row">
		   <hr >
		  <div class="col-sm-6">
		    <label for="class">Class:</label>
		    <select class="form-control" name="class">
		      <option value="Economy">Economy</option>
		      <option value="Business">Business</option>   
		    </select>
		  </div> 
		  </div> 
		  <br>
		  <div class="row">
		  <div class="col-sm-6"> 
		    <label class="radio-inline">
		      <input type="radio" name="stop" value="nonstop" checked>Non-Stop
		    </label>
		    <label class="radio-inline">
		      <input type="radio" name="stop" value="1stop">1 Stop
		    </label>
		  </div> 
		  </div> 
		  <br>
		  <div class="btn-group btn-group-justified">	
				<div class="btn-group">
					<button type="submit" class="btn btn-success">Submit</button>
				</div>
				<div class="btn-group">
					<button type="reset"  class="btn btn-info" value="Reset">Reset</button>
				</div>
		  </div>
		</form>
	</div>


	<div id="roundtrip">
		<form role="form" action="SearchResultRoundtrip.php" method="post">
			 <div class="row"> 
			  <div class="col-sm-6">
			    <label for="from">From:</label>
			    <input type="text" class="form-control" id="from" name="from" placeholder="Code " required>
			  </div>
			  <div class="col-sm-6">
			    <label for="to">To:</label>
			    <input type="text" class="form-control" id="to" name="to" placeholder="Code" required>
			  </div>
			 </div>
			 <hr >
			<div class="row">  
			  <div class="col-sm-6">
			    <label for="depart">Depart:</label>
			    <input type="date" class="form-control" id="depart" name="depart" required>
			  </div>  
			  <div class="col-sm-6">
			    <label for="return">Return:</label>
			    <input type="date" class="form-control" id="return" name="return" required>
			  </div>
			 </div>
			 <hr >
			 <div class="row">   
			  <div class="col-sm-6">
			    <label for="class">Class:</label>
			    <select class="form-control" name="class">
			      <option value="Economy">Economy</option>
			      <option value="Business">Business</option>   
			    </select>
			  </div> 
			 </div>
			 <br>
			  <div class="form-group"> 
			    <label class="radio-inline">
			      <input type="radio" name="stop" value="nonstop" checked>Non-Stop
			    </label>   
			  </div> 
			  <div class="btn-group btn-group-justified">	
				<div class="btn-group">
					<button type="submit" class="btn btn-success">Submit</button>
				</div>
				<div class="btn-group">
					<button type="reset"  class="btn btn-info" value="Reset">Reset</button>
				</div>
		  	  </div>
			</form>
	</div>
	<div id="all">
		<form role="form" action="SearchResultAll.php" method="post">
			 <div class="row"> 
			  <div class="col-sm-6">
			  <label for="selectdate">Select a date:</label>
			  <input type="date" class="form-control" id="selectdate" name="selectdate" required>
			  </div>
			 </div>
			 <br>
			<div class="row">   
			  <div class="col-sm-6">
			  <button type="submit" class="btn btn-primary">Show ALL</button>
			  </div>
			</div> 
			</form>

	</div>	

	</div>

	
	
	<div class="feat">
    <div class="container">
      <div class="row">
        <div class="section-head col-sm-12">
          <h4 clas>Why Choose Us?</h4>
          <p>When you choose us, you'll feel the benefit of 10 years' experience of Booking System. Because we know the digital world and we know that how to handle it. With working knowledge of online, Hotel , Air Booking</p>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="item"> <span class="icon feature_box_col_one"><i class="fa fa-globe"></i></span>
            <h6>Modern Facalities</h6>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Obcaecati, laudantium!</p>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="item"> <span class="icon feature_box_col_two"><i class="fa fa-anchor"></i></span>
            <h6>Best Service</h6>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fuga, impedit!</p>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="item"> <span class="icon feature_box_col_three"><i class="fa fa-hourglass-half"></i></span>
            <h6>24 x 7 User Support</h6>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nam, odit?</p>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="item"> <span class="icon feature_box_col_four"><i class="fa fa-database"></i></span>
            <h6>Business Growth</h6>
            <p>Everyone wants to live on top of the mountain, but all the happiness and growth occurs while you're climbing it</p>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="item"> <span class="icon feature_box_col_five"><i class="fa fa-upload"></i></span>
            <h6>Market Strategy</h6>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores assumenda nihil dicta adipisci itaque soluta.</p>
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
          <div class="item"> <span class="icon feature_box_col_six"><i class="fa fa-camera"></i></span>
            <h6>Affordable cost</h6>
            <p>Love is a special word, and I use it only when I mean it. You say the word too much and it becomes cheap.</p>
          </div>
        </div>
      </div>
    </div>
  </div>


	<footer class="footer">
  	 <div class="container">
		<div class="text-center">
			<h2 class="f-b-t">Mavic Booking</h2>
		</div>
  	 	<div class="row">
  	 		<div class="footer-col">
  	 			<h4>company</h4>
  	 			<ul>
  	 				<li><a href="#">about us</a></li>
  	 				<li><a href="#">our services</a></li>
  	 				<li><a href="#">privacy policy</a></li>
  	 				<li><a href="#">affiliate program</a></li>
  	 			</ul>
  	 		</div>
  	 		<div class="footer-col">
  	 			<h4>get help</h4>
  	 			<ul>
  	 				<li><a href="#">FAQ</a></li>
  	 				<li><a href="#">shipping</a></li>
  	 				<li><a href="#">returns</a></li>
  	 				<li><a href="#">order status</a></li>
  	 				<li><a href="#">payment options</a></li>
  	 			</ul>
  	 		</div>
  	 		<div class="footer-col">
  	 			<h4>Why Choose Us</h4>
  	 			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus perferendis omnis ex placeat nihil officiis natus animi nesciunt, dolores eum.</p>
  	 		</div>
  	 		<div class="footer-col">
  	 			<h4>follow us</h4>
  	 			<div class="social-links">
  	 				<a href="#"><i class="fab fa-facebook-f"></i></a>
  	 				<a href="#"><i class="fab fa-twitter"></i></a>
  	 				<a href="#"><i class="fab fa-instagram"></i></a>
  	 				<a href="#"><i class="fab fa-linkedin-in"></i></a>
  	 			</div>
  	 		</div>
  	 	</div>
  	 </div>
  </footer>
  <?php
 @include 'chatbot.php'; 
  ?>
</body>
</html>