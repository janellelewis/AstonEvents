<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
	
<head>
<?php include('./templates/header.php');?>
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
<?php include('databaseconnector.php');?>

<div class="container">
<div class="header">
<h3> Create an event </h3>
</div>
<div class="container">

  	
  <form method="POST" action="createevent.php"  enctype="multipart/form-data">
  <div class="input-group">
  	  <label>Category</label>
  	 <select name="category" id="category" required="true">
     <option value="option">Please select an option</option>
    <option value="1">Sport</option>
  <option value="2">Culture</option>
  <option value="3">Others</option>
</select>
       
  	</div>
	<div class="input-group">
  	  <label>Event Name</label>
  	  <input type="text"
       name="eventname"
       required="true"
      />
  
	
	<div class="input-group">
  	  <label>Event Date</label>
  	  <input type="date"
       name="eventdate"
        required="true" />
  
  	</div>
	<div class="input-group">
  	  <label>Event Start Time</label>
  	  <input type="time"
       name="eventstarttime"
       required="true"min="08:00" max="21:00" required />
    <small>Events can start no earlier than 8am, each day.</small>
  	</div>
  	<div class="input-group">
  	  <label>Event End Time</label>
  	  <input type="time"
       name="eventendtime"
        required="true"
         min="08:00" max="22:00" required />
    <small>Events have to finish no later than 10pm, each day.</small>
  	</div>
	<div class="input-group">
  	  <label>Duration (Days)</label>
  	  <input type="text" name="duration"
      required="true"/>
  	</div>
  	<div class="input-group">
  	  <label>Description </label>
    <small>(up to 200 characters)</small>
  	  <textarea type="text" name="description"
      required="true"
     rows="4" cols="50"/>
    Insert text here 
    </textarea>
    
    <div class="input-group">
  	  <label>Event Location</label>
  	  <input type="text" name="place"
      required="true"/>
  	</div>
    
  	</div>
  	<div class="input-group">
  	  <label>Upload a Picture</label>
      <input type="file" name="upload1" accept=".png,.gif,.jpg,.webp" required>
 	
  	</div>
<div class="input-group">
      <input type="file" name="upload2" accept=".png,.gif,.jpg,.webp">
 	
  	</div>
  <div class="input-group">
      <input type="file" name="upload3" accept=".png,.gif,.jpg,.webp">
 	
  	</div>
    <input type="hidden" name="submitted" value="true"/>
    <div class="input-group">
    <input type="submit" name="submit" value="Submit">
    </div>
    <p> For all scheduled events <a href="events.php">Click Here</a>  </p>
  </form>

</body>



</div>


<?php

//$username="";
//if the form has been submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // connect to the database
    require_once('databaseconnector.php');
     try {
    $errors = array();
 	$category = $_POST['category'];
    $eventname = $_POST['eventname'];
    $eventdate = $_POST['eventdate'];
    $eventstarttime = $_POST['eventstarttime'];
    $eventendtime = $_POST['eventendtime'];
    $duration = $_POST['duration'];
    $description = $_POST['description'];
    $place = $_POST['place'];
    //$picture = $_POST['picture'];
    $picture1 = file_get_contents($_FILES['upload1']['tmp_name']);
	$picture2 = file_get_contents($_FILES['upload2']['tmp_name']);
   	$picture3 = file_get_contents($_FILES['upload3']['tmp_name']);

  // Register user if there are no errors in the form
 
    //echo "It is start of...";
    $organiserID = 1; 
	$interestRanking = 1; 
    $query = "INSERT INTO events (organiser_id,category_id, event_name,event_date, event_dateTime, 
    						event_endTime, duration,description, place, picture, picture_2, picture_3, interest_ranking) 
    
    VALUES(:organiser_id,:category_id, :event_name,:event_date, :event_dateTime, :event_endTime, :duration ,:description,
    						:place,:picture,:picture_2, :picture_3, :interest_ranking)";
  	$stmt= $db->prepare($query);
    $stmt->execute([
	':organiser_id' => $organiserID,
    ':category_id'  => $category,
    ':event_name' => $eventname,
    ':event_date' =>  $eventdate,
    ':event_dateTime' =>  $eventstarttime,
    ':event_endTime' => $eventendtime,
    ':duration' =>  $duration,
    ':description' => $description,
    ':place' =>  $place,
    ':picture' => $picture1,
    ':picture_2' => $picture2,
    ':picture_3' => $picture3,
    ':interest_ranking' => $interestRanking
	]);
    //echo "It is executed...";
    //add the session info and redirect to the page
  //  $_SESSION['username'] = $username;
  	//$_SESSION['usertype'] = 0;
  	//header('location: index.php');
  //  exit;
  

echo "OK";
  } catch (Exception $ex) { echo $ex->getMessage(); }




}

  else {
    for ($i=0; $i<count($errors); $i++){
        echo "<p style='color:red'>". $errors[$i]. '</p>';
      }
    }



?>




</html>