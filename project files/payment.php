<?php 
session_start();
$email=$_SESSION['email'];
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $servername="localhost";
   $username="root";
   $password="Hemanth@10";
   $dbase="booking";
$conn=mysqli_connect($servername,$username,$password,$dbase);
$id=$_POST["id"];
$sql1="SELECT * from valid_id where train_id=$id";
$check=mysqli_query($conn,$sql1);
if(mysqli_num_rows($check)>0){
$_SESSION['id']=$id;
$count=$_POST["count"];
$_SESSION['count']=$count;
$name=$_POST["Name"];
$_SESSION['name']=$name;
$date=$_POST["travel-date"];
$_SESSION['date']=$date;
$sql="SELECT * from routes r join train_timings t on r.route_id=t.route_id where t.train_id=$id";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$rate=$row["rates"];
$total=$count * $rate;
$_SESSION['total']=$total;
$_SESSION['from_station']=$row["from_station"];
$_SESSION['to_station']=$row["to_station"];
$_SESSION['timings']=$row["timings"];
$sql="truncate table valid_id;";
$result=mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <link rel="stylesheet" href="payment.css">
</head>
<body>
    <div id="header"><h2>Online Booking</h2></div>
    <h2 id="title">Payment Confirmation</h2>
    <div class="payment-container">
        <div class="details">
            <p><strong>Train ID:</strong> <?php echo $id; ?></p>
            <p><strong>Name:</strong> <?php echo $name; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>From Station:</strong> <?php echo $row["from_station"]; ?></p>
            </div>
            <div>
            <p><strong>Destination:</strong> <?php echo $row["to_station"]; ?></p>
            <p><strong>Train Timing:</strong> <?php echo $row["timings"]; ?></p>
            <p><strong>Date of Travel:</strong> <?php echo $date; ?></p>
            <p class="total-amount">Total Amount: ₹<?php echo $total; ?></p>
        </div>
        <form action="status.php" method="post">
            <button type="submit" name="confirm">Confirm</button>
        </form>
    </div>
</body>
</html>
<?php
}
else {
    $sql="truncate table valid_id;";
    $result=mysqli_query($conn,$sql);
    echo "<script>alert('ID missmatch'); window.location.href='index.php';</script>";
}
}
?>