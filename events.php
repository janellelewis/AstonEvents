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

<h2>Events page</h2>
 <p> My events <a href="myevents.php">Click Here</a>  </p>
<p> Click on any event name to find more details about the event!</p>


<?php $result= $db->query('SELECT * FROM events');

echo "<table border= '1' class='table table-striped'>
  
<th>Event ID</th>
<th>Event Name</th>
<th>Event Date</th>
<th>Event Start Time</th>
<th>Event End Time</th>
<th>Description</th>
" ;





while($row=$result->fetch()){
$event_id = $row['event_id'];
	echo "<tr><td>". $row['event_id'].
    "</td><td> <a href='eventdetails.php?num=$event_id'>".$row['event_name'].
    " </a> </td><td>".
	$row['event_date']. 
    "</td><td>".$row['event_dateTime']. "</td><td>"
    .$row['event_endTime']. "</td><td>"
    .$row['description']
	. "</td></tr>";
}
echo "</table>";


?>


</div>

</body>

</html>
