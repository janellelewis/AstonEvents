   <?php session_start();  ?>
<div class="container">
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark" >
  <a class="navbar-brand" href="index.php">AstonEvents</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="about.php">About</a>
    </li>

      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="createevent.php">Create an Event</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="events.php" > All Events</a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="eventsport.php" > Sport Events</a>
  </li>
    
    <li class="nav-item">
    <a class="nav-link" href="eventculture.php" > Culture Events</a>
  </li>
     <li class="nav-item">
    <a class="nav-link" href="eventother.php" > Other Events</a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="eventsbyrating.php" > Events by Ratings</a>
  </li>
      <li class="nav-item">
    <a class="nav-link" href="myevents.php" >My Events</a>
  </li>
    
       </ul>
      <ul class="nav navbar-nav ml-auto">
	   <?php
     	if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == True ){
        echo "<li style='display: inline; padding: 8px; color:#FFFFFF;'> Hi " . $_SESSION['firstname']. "!
      <li class='nav-item'><a class='nav-link' href='logout.php'>Logout</a></li>";
      }
      else{
    echo "<li class='nav-item'><a class='nav-link' href='login.php'>Login</a></li>";
      }
      ?>
	    
     	 

    </ul>
  </div>
</nav>
<br/><br/>

</div>
 

     
          
