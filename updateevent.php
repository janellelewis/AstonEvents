<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php include('./templates/header.php');?>
<link href="filter.css" rel="stylesheet" />
<style>
body{
background-color: #E8E8E8;
}
input{
	width:40%;
    height:5%;
    border:1px;
	border-radius:05px;
	padding: 8px 15px 8px 15px;
	
}
</style>

</head>

<body>
<?php include('./templates/navigation.php');?>
<?php include('databaseconnector.php');?>

<div class="overflow-auto">

<h2>Update Event</h2>
 <p> My events <a href="myevents.php">Click Here</a>  </p>
<center>
<form action="" method="POST">
	<input type="text" name="eventid" placeholder="Enter Event ID" required /><br/>
	<input type="text" name="categoryid" placeholder="Enter Category ID" required /><br/>
	<input type="text" name="eventname" placeholder="Enter Event Name" required /><br/>
	<input type="date" name="eventdate" placeholder="Enter Event Date" required /><br/>
	<input type="time" name="eventstarttime" placeholder="Enter Event Start Time" required /><br/>
	<input type="time" name="eventendtime" placeholder="Enter Event End Time" required /><br/>
	<input type="text" name="duration" placeholder="Enter Event Duration" required /><br/>
	<input type="text" name="description" placeholder="Enter A Description" required /><br/>
	<input type="text" name="place" placeholder="Enter Event Location" required /><br/>

<input type="submit" name="update" value="update event"/><br/>
                 
</form>
</center>
</div>
</body>
</html>

<?php
if (isset($_POST['update']))
{
 try{
$eventId = $_POST['eventid'];
$catId = $_POST['categoryid'];
$eventName = $_POST['eventname'];
$eventDate = $_POST['eventdate'];
$startTime = $_POST['eventstarttime'];
$endTime = $_POST['eventendtime'];
$duration = $_POST['duration'];
$desc = $_POST['description'];
$place = $_POST['place'];

$query = "UPDATE `events` SET 
category_id=?,
event_name=?,
event_date=?,
event_dateTime =?,
event_endTime =?,
duration =?,
description=?,
place=? where event_id=?";


$stmt = $db->prepare($query); 
$stmt->execute([$catId, $eventName, $eventDate,  $startTime, $endTime, $duration, $desc,$place, $eventId]);
 echo "Event modified successfully";
 }
catch (Exception $e) {
    echo "Therev is a problem updating the event";
}

#$query_run =databaseconnector_query();

#if($query_run){
#echo '<script type ="text/javscript"> alert("Data Updated")</script>';
#}
#else{
#echo '<script type ="text/javscript"> alert("Data Not Updated")</script>';
#}

}
?>
