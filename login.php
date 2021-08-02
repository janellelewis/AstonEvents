<?php
ob_start(); // needs to be added here
	

?>

<!DOCTYPE html>
<html lang="en">
	
<head>

<?php include('./templates/header.php');?>
<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
<style>
body{
background-color: #E8E8E8;
}
</style>
</head>

<body>
<?php include('./templates/navigation.php');?>

<div class="container">

<div class="header">
	<h2>Login</h2>
</div>


<form action="" method="post">

	  	<div class="input-group">
				  <label>User Name</label>
					<input type="text" name="username" size="20" maxlength="50" />
			</div>
			<div class="input-group">
    			<label>Password:</label>
					<input type="password" name="password" size="20" maxlength="50" />
			</div>
			<div class="input-group">
	      <button type="submit" class="btn" name="submit"> Submit </button>
	    </div>
			<p>
				Not a member? <a href="register.php">Register here</a>
			</p>
    <input type="hidden" name="submitted" value="TRUE" />
</form>




</div>

</body>


</html>
<?php


	if (isset($_POST['submit'])){
		//session_start();
		include("databaseconnector.php");
		
		$username=$_POST['username'];
		$password=$_POST['password'];
     
		if(empty($username) || empty($password)){
			echo "input error!";
		}
		else {
			$user=$db->query("SELECT organiser_id, organiser_firstName, organiser_lastName, organiser_email, organiser_password
                            FROM organiser WHERE organiser_email='".$username."'");
		}
	  
		if (!empty($user)) {
         echo "Logged In successfully"; 
         $row=$user->fetch(); 
        
        if ($row['organiser_password'] == $_POST['password']){
        		
        		session_start();
        		
        		$_SESSION['id'] = $row['organiser_id'];
        		$_SESSION['username'] = $row['organiser_email'];
				$_SESSION['firstname'] = $row['organiser_firstName'];
        		$_SESSION["loggedIn"] = true;
           echo "<script type='text/javascript'> document.location = 'createevent.php'; </script>";
          exit(); 
       		
        }
        else{
          echo "<p style='color:red'>Error signing in, username or password does not match </p>";
         // echo "<p style='color:red'>Error signing in, password does not match </p>";
        }
     
        
		} else {
		
			echo "<p style='color:red'>Error signing in, Username not found </p>";
		}
	}

//protection against sql injection
if (isset($_GET['username'])){
  $id = $_GET['username'];
  
   if ( is_string($username) == true){
    try{
      $dbh = new PDO(include('databaseconnector.php'));
      
      
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      
      $user=$db->query("SELECT organiser_id, organiser_firstName, organiser_lastName, organiser_email, organiser_password
                            FROM organiser WHERE organiser_email='".$username."'");
      
      $sth = $dbh->prepare($user=$db->query);
     
      $sth->bindParam('".$username."', $username);
     
      $sth->execute();
      
      $sth->setFetchMode(PDO::FETCH_ASSOC);
  
      $result = $sth->fetchColumn();
    
      print( htmlentities($result) );
      
      
      $dbh = null;
    }
    catch(PDOException $e){
      
      error_log('PDOException - ' . $e->getMessage(), 0);
      
      http_response_code(500);
      die('Error establishing connection with database');
    }
   } else{
    
    http_response_code(400);
    die('Error processing bad or malformed request');
   }
}
?>

<html>

</html>