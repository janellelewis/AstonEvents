<<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include('./templates/header.php');?>
<title>Registration Page </title>
 <link rel="stylesheet" type="text/css" href="style.css">
<style>

body{
background-color: #E8E8E8;
}

input{
	width:40%;

}
</style>
</head>

<body>
<?php include('./templates/navigation.php');?>

<div class="container">


<div class="container">
<div class="header">
  	<h2>Register</h2>
  </div>
  <form method="POST" action="register.php">
	<div class="input-group">
  	  <label>First Name</label>
  	  <input type="text"
       name="firstname"
       required="true"
      />
  	</div>
	<div class="input-group">
  	  <label>Last Name</label>
  	  <input type="text"
       name="lastname"
        required="true" />
  	</div>
	<div class="input-group">
  	  <label>Course</label>
  	  <input type="text"
       name="course"
       required="true"/>
  	</div>
  	<div class="input-group">
  	  <label>Email Address</label>
  	  <input type="text"
       name="emailaddress"
        required="true"
        pattern=".+(\.ac\.uk|\.edu)"
        title="Please enter a UK University email address" />
  	</div>
	<div class="input-group">
  	  <label>Mobile Number</label>
  	  <input type="text" name="mobilenumber"
      required="true"/>
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1"
      required="true"
      pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
      title=" Your password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" />
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2"
      required="true"
      />
  	</div>
    <input type="hidden" name="submitted" value="true"/>
    <div class="input-group">
      <button type="submit" class="btn" name="submit"> Submit </button>
    </div>
    <p> Already an AstonEvents member? <a href="login.php">Sign in</a>  </p>
  </form>

</body>



</div>


<?php

//$username="";
//if the form has been submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // connect to the database
    require_once('databaseconnector.php');

    $errors = array();
      $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
          $course = $_POST['course'];
            $emailaddress = $_POST['emailaddress'];
              $mobilenumber = $_POST['mobilenumber'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($emailaddress)) { array_push($errors, "Email Address is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {
  	   array_push($errors, "The two passwords do not match");
    }

    // first check if a user already exist with the same username or not
  //  $query = "SELECT * FROM  WHERE username ='$username' LIMIT 1";
  //  try{
    //  $result = $db->query($query);
    //  $user = $result->fetch();
  //  }
  //  catch (PDOException $e) {
//      print $e->getMessage();
  //  }
    //if ($user) { // if user exists
  //    if ($user['username'] === $username) {
  //    }
    }//


  // Register user if there are no errors in the form
  if (count($errors) == 0) {
	  $password = password_hash($password_1, PASSWORD_DEFAULT); //encrypt the password before saving in the database

    $query = "INSERT INTO organiser (organiser_firstName, organiser_lastName, organiser_email, organiser_phoneNumber, organiser_password) VALUES(?,?,?,?, ?)";
  	$stmt= $db->prepare($query);
    $stmt->execute(array($firstname, $lastname, $emailaddress, $mobilenumber, $password));

    //add the session info and redirect to the page
  //  $_SESSION['username'] = $username;
  	//$_SESSION['usertype'] = 0;
  	//header('location: index.php');
  //  exit;
  }
  else {
    for ($i=0; $i<count($errors); $i++){
        echo "<p style='color:red'>". $errors[$i]. '</p>';
      }
    }

?>


</html>
</html>
