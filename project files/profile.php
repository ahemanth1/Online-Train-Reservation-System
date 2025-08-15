<?php
 session_start();
   $servername="localhost";
   $username="root";
   $password="Hemanth@10";
   $dbase="booking";
  $conn=mysqli_connect($servername,$username,$password,$dbase);
 $email=$_SESSION['email'];
 $sql="SELECT * from user_profile where email='$email'";
 $result=mysqli_query($conn,$sql);
 $row=mysqli_fetch_assoc($result);
 $name=$row['name'];
 $age=$row['age'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="profile.css" />
</head>
<body>
    <div id="header"><h2>Online Booking</h2></div>
    <div id="user_det">
        <h2 id="name">Name:<span><?php echo $name;?></span><br></h2> 
         <h2 id="age">Age:<span><?php echo $age;?></span><br></h2>
         <h2 id="email">Email:<span><?php echo $email;?></span></h2>
    </div>
    <h2 id="history">History</h2>
</body>
</html>
<?php
$sql="SELECT * from ticket where email='$email'";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
    echo '<div id="ticket_det">
        <div class="ticket-left">
          <h2>Name: <span>' . $row["name"] . '</span></h2>
          <h2>Email: <span>' . $row["email"] . '</span></h2>
          <h2>From Station: <span>' . $row["from_station"] . '</span></h2>
          <h2>Destination: <span>' . $row["to_station"] . '</span></h2>
        </div>
        <div class="ticket-right">
          <h2>Total Amount: <span>' . $row["amount"] . '</span></h2>
          <h2>Travel Date: <span>' . $row["travel_date"] . '</span></h2>
          <h2>No.of Persons: <span>' . $row["section"] . '</span></h2>
          <h2>Train Timings: <span>' . $row["timing"] . '</span></h2>
        </div>
      </div><br>';

}
?>