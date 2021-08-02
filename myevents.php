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
</style>

</head>

<body>
<?php include('./templates/navigation.php');?>
<?php include('databaseconnector.php');?>


<div class="overflow-auto">

<h2>My Events</h2>
 <p> Events <a href="events.php">Click Here</a> 
</p>
<p> Click on any event name to update the event.</p>

<?php $result= $db->query("SELECT * FROM events WHERE organiser_id ='".$_SESSION['id']."'");

echo "<table border= '1' class='table table-striped'>
  
<th>Event ID</th>
<th>Event Name</th>
<th>Category ID</Th>
<th>Event Date</th>
<th>Event Start Time</th>
<th>Event End Time</th>
<th>Duration</th>
<th>Description</th>
<th>Place</th>
" ;




while($row=$result->fetch()){
$event_id = $row['event_id'];
	echo "<tr><td>". $row['event_id'].
    "</td><td> <a href='updateevent.php?num=$event_id'>".$row['event_name'].
    " </a> </td><td>".
      $row['category_id']. "</td><td>"
	.$row['event_date']. 
    "</td><td>".$row['event_dateTime']. "</td><td>"
    .$row['event_endTime']. "</td><td>"
    .$row['duration']. "</td><td>"
    .$row['description']. "</td><td>"
    .$row['place']. "
    </td></tr>";
}
echo "</table>";


?>


</div>

</body>

</html>
