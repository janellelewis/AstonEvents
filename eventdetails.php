<!DOCTYPE html>
<html lang="en">
	
<head>
<?php include('./templates/header.php');?>
<style>
body{
background-color: #E8E8E8;
}
</style>
</head>

<body>
<?php include('./templates/navigation.php');?>
<?php include('databaseconnector.php');?>
<div class="container">

<h2>Event Details </h2>
 <h5> My events <a href="myevents.php">Click Here</a>  </h5>
<?php 
$id=$_GET['num'];

$result= $db->query("SELECT * FROM events WHERE event_id ='".$id."'");

echo "<table border= '1' class='table table-striped'>
<th>Event ID</th>
<th>Event Name</th>
<th>Event Date</th>
<th>Event Start Time</th>
<th>Event End Time</th>
<th>Duration</th>
<th>Place</th>
<th>Description</th>
<th>Picture(s)</th>

";




while($row=$result->fetch()){

   $result2 = $db->query("SELECT organiser_email FROM organiser WHERE organiser_id ='".$row['organiser_id']."'");

   while($row2=$result2->fetch()){
   
   $organiseremail = $row2['organiser_email'];
   
   }
    
    $img1 = $row['picture'];
	$img1 = base64_encode($img1);

$img2 = $row['picture_2'];
	$img2 = base64_encode($img2);

$img3 = $row['picture_3'];
	$img3 = base64_encode($img3);

   $ext = pathinfo(PATHINFO_EXTENSION);
//echo "<img src='data:image/".$ext.";base64,".$img."'/>";
	echo "<tr><td>". $row['event_id'].
    "</td><td> <a href='eventdetails.php?num=2'.>".$row['event_name'].
    " </a> </td><td>".
	$row['event_date']. 
    "</td><td>".$row['event_dateTime']. "</td><td>"
    .$row['event_endTime']. "</td><td>"
    .$row['duration']
	."</td><td>"
     .$row['place']
	."</td><td>"
    .$row['description']
	. "</td><td><img src='data:image/".$ext.";base64,".$img1."' width='50' height='50' />
    <img src='data:image/".$ext.";base64,".$img2."' width='50' height='50' />
    <img src='data:image/".$ext.";base64,".$img3."' width='50' height='50' />
    </td></tr>";
}
echo "</table>";


?>
<form method="post">
<center>
<h3>Add your interest rating</h3>
<label> Please add your rating below</label>
<select name = "interest_rating">
<option>Interest Rating</option>
<option value = "1"> 1</option>
</select>
  <button type="submit" class="btn" name="submitRating"> Submit </button>

</center>
</form>



<center>
<br>
<br>
<h6>Click the button below to email an event organiser</h6>
<?php echo "<button><b><a href='mailto:$organiseremail'>Click here </a></b></button>" ?>
</br>
</br>
</center>



<?php
//$conn=new PDO ("mysql:host = $hostname;dbname=$db",$Username, $Password)
//if(isset($_POST['submit123']))
if($_SERVER["REQUEST_METHOD"] == "POST") {

 if (isset($_POST['submitRating'])) {
  //echo "astart here...";
 try{
$id=$_GET['num'];
$stmt = $db->prepare("UPDATE `events` SET `interest_ranking` = `interest_ranking` +1 WHERE `event_id` = :id");
 $stmt->execute([':id' => $_GET['num']]);
 //echo "all good!!";
 }
catch (Exception $e) {
    echo "some problem updating the rating....";
}
 echo "Rating has been updated!";
 }
//$category=$_POST['interest_ranking'];
//$sql=$conn -> prepare("UPDATE events set interest_ranking = interest_ranking + 1");
//$conn ->beginTransaction();
//$sql -> execute(array('interest_ranking' => $interest_ranking));
//echo "<h2> rating added successfully</h2>";
//$conn ->commit();
}
//$conn->null;
?>

 

    
</div>
</body>
</html>