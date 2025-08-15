<?php
session_start();
$email=$_SESSION['email'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Train Details</title>
    <link rel="stylesheet" href="details.css">
</head>
<body>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $servername="localhost";
   $username="root";
   $password="Hemanth@10";
   $dbase="booking";
   $conn=mysqli_connect($servername,$username,$password,$dbase);
   $sql="truncate table valid_id;";
   $result=mysqli_query($conn,$sql);
   $from=mysqli_real_escape_string($conn, $_POST["from"]);
   $to=mysqli_real_escape_string($conn, $_POST["to"]);
   $checkQuery = "SELECT r.route_id,t.train_id,r.from_station,r.to_station,t.timings FROM routes r join train_timings t on r.route_id=t.route_id where r.from_station='$from' and r.to_station='$to'";
   $checkResult = mysqli_query($conn, $checkQuery);
   echo "<div id='header'><h2>Online Booking</h2></div>";
   if (mysqli_num_rows($checkResult) > 0) {
      echo "<table>";
      echo "<tr><th>Route ID</th><th>Train ID</th><th>From Station</th><th>Destination</th><th>Timings</th></tr>";
      while($row=mysqli_fetch_assoc($checkResult)){
        echo "<tr>";
        echo "<td>" .$row["route_id"]. "</td>";
        echo "<td>" .$row["train_id"]. "</td>";
        echo "<td>" .$row["from_station"]. "</td>";
        echo "<td>" .$row["to_station"]. "</td>";
        echo "<td>" .$row["timings"]. "</td>";
        echo "</tr>";
        $sql="INSERT into valid_id(train_id) values ({$row['train_id']})";
        $result=mysqli_query($conn,$sql);
      }
      echo "</table>";
      echo "<form action='payment.php' method='post'>";
      echo "<input type='radio' name='count' value='1' required/> Single";
      echo "<input type='radio' name='count' value='2'required/> Double";
      echo "<input type='radio' name='count' value='3'required/> Triple";
      echo "<input type='radio' name='count' value='4'required/> Family";
      echo " <input type='date' name='travel-date' id='date' placeholder='YYYY-MM-DD' required/>   ";
      echo "   Name: <input type='text' name='Name' style='position:relative; display:inline-block; height:25px;width:75px;border-style:solid;background-color:white; 'required/>";
      echo " Train ID:<input type='text' name='id' style='position:relative; display:inline-block; height:25px;width:75px;border-style:solid;background-color:white; 'required/>";
      echo "       <button type='submit' style='background-color: blue; color:white;'>Book Ticket</button>";
      echo "</form>";
      echo "<div id='note'>";
      echo "<pre>";
      echo "Note:  ";
      echo "<h3>Single</h3> : 1 person, ";
      echo "<h3>Double</h3> : 2 persons, ";
      echo "<h3>Triple</h3> : 3 persons, ";
      echo "<h3>Family</h3> : 4 persons ";
      echo "</pre>";
      echo "</div>";

} else {
      echo "<div id='no_train'><h2>No trains available for this route!!</h2></div>";
}

   mysqli_close($conn);
   }

?>