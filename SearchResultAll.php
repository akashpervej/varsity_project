<!DOCTYPE html>
<html>
<html lang="en">
<head>
  <title>Search Flights</title>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="https://lh3.googleusercontent.com/-HtZivmahJYI/VUZKoVuFx3I/AAAAAAAAAcM/thmMtUUPjbA/Blue_square_A-3.PNG" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="forcompany.css">
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="AdminSignin.css">
    <script src="login.js"> </script>
  <link rel="stylesheet" type="text/css" href="Search.css">
  <link rel="stylesheet" href="footer.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <script src="notavailable.js"></script>
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
                <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a>
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
                            <a tabindex="-1" href="#">Sign in</a>
                            <ul class="dropdown-menu">
                              <li><a tabindex="-1" href="Adminpage.html">Manager Sign in</a></li>
                              <li><a href="customersignin.html">Customer Sign in</a></li>
                              
                        
                    </li>
                            </ul>
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


<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">

    </div>
    <div class="col-sm-8 text-left"> 
      <h1>Search Results</h1>

<?php
include_once 'dbconnect2.php';



$selectdate = $_POST["selectdate"];


global $sql, $availableNumber;

    $sql = "SELECT * 
            FROM flight FL,  class C, airplane AP 
            WHERE (FL.number = C.number) AND (FL.airplane_id = AP.ID) 
            
            ORDER BY FL.number";


$result = mysqli_query($con,$sql);
$rowcount = mysqli_num_rows($result);


if($rowcount == 0){
    echo "<div class='alert alert-info'><strong>Search Result: </strong>".$rowcount." result</div>";
}
else{
echo "<div class='alert alert-info'><strong>Search Result: </strong>".$rowcount." results</div>";

echo "<table class='table table-bordered table-striped table-hover'>
      <thead>
      <tr>
        <th>Flight</th>
        <th>Aircraft</th>
        <th>Date</th>
        <th>Departure</th>
        <th>Departure Time</th>
        <th>Arrival</th>
        <th>Arrival Time</th>
        <th>Class</th>
        <th>Capacity</th>
        <th>Price</th>
        <th>Remain Seats</th>
        <th>Reserve</th>
      </tr>
      </thead>";
while($row = mysqli_fetch_array($result)) {
    echo "<tbody><tr>";
    echo "<td>" . $row['number'] . "</td>";
    echo "<td>" . $row['company']." ".$row['type']. "</td>";
    echo "<td>" . $selectdate . "</td>";
    echo "<td>" . $row['departure'] . "</td>";
    echo "<td>" . $row['d_time'] . "</td>";
    echo "<td>" . $row['arrival'] . "</td>";
    echo "<td>" . $row['a_time'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['capacity'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    
   
        //calculate number of remain seats
        $seatreserved = "SELECT flightno, classtype, COUNT(*)
                    FROM book B
                    WHERE B.date = '".$selectdate."' AND B.flightno = '".$row['number']."'AND B.classtype ='".$row['name']."' AND paid=1
                    GROUP BY flightno, classtype";
        $reserved = mysqli_query($con, $seatreserved);   
        $reservedNumber = mysqli_fetch_array($reserved);
        
        $capacity = mysqli_query($con, "SELECT capacity FROM class C WHERE C.number='".$row['number']."' AND C.name= '".$row['name']."'");
        $capacityNumber = mysqli_fetch_array($capacity);


        if(mysqli_num_rows($reserved)>0){            
            $availableNumber = $capacityNumber['capacity'] - $reservedNumber['COUNT(*)'];
        }else{
            $availableNumber = $capacityNumber['capacity'];
        }
    
        echo "<td>".$availableNumber."</td>";
    
    if($availableNumber>0){
    echo '<td>
        <form action="shoppingcart.php" method="post">
        <input type="hidden" name="flightno" value="'.$row['number'].'">
        <input type="hidden" name="classtype" value="'.$row['name'].'">
        <input type="hidden" name="price" value="'.$row['price'].'">
        <input type="hidden" name="date" value="'.$selectdate.'">
        <input type="hidden" name="type" value="all">
        <button type="submit" class="btn btn-primary">Add to Cart</button>
        </form>
        </td>';
    }else{
        echo "<td><button type='button' class='btn btn-warning' onclick='myFunction()'>Not Available</button></td>";
    }
    
    echo "</tr>";
}
echo " </tbody></table>";

}


//mysqli_free_result($result);

mysqli_close($con);
?>
 
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
</body>
</html>