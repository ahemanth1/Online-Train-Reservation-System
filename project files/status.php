<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $servername="localhost";
   $username="root";
   $password="Hemanth@10";
   $dbase="booking";
$conn=mysqli_connect($servername,$username,$password,$dbase);
$id=$_SESSION['id'];
$name=$_SESSION['name'];
$email=$_SESSION['email'];
$from_station=$_SESSION['from_station'];
$to_station=$_SESSION['to_station'];
$date=$_SESSION['date'];
$total=$_SESSION['total'];
$count=$_SESSION['count'];
$timings=$_SESSION['timings'];
$sql="INSERT into ticket(train_id,name,email,from_station,to_station,travel_date,amount,section,timing) values($id,'$name','$email','$from_station','$to_station','$date','$total','$count','$timings');";
$result=mysqli_query($conn,$sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Booking Confirmed</title>
  <link rel="stylesheet" href="status.css" />
</head>
<body>
  <div id="header"><h2>Online Booking</h2></div>

  <div id="confirmation">
    <p> Ticket successfully booked on <span><?php echo $date; ?></span></p>
    <a href="index.php"><button>Go to Home Page</button></a>
  </div>
</body>
</html>
<?php
 $mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'railwaybookingon@gmail.com';       
    $mail->Password   = 'rsck uqfm tdia ytpg';    
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;
    $mail->setFrom('railwaybookingon@gmail.com', 'OnlineBooking');
    $mail->addAddress($_SESSION['email']); 

    $mail->isHTML(true);
    $mail->Subject = 'Ticket Confirmation';
    $mail->Body    = 'Mr.'.$name.', your Train Booking is conformed with train id '.$id.' on '.$date.' from '.$from_station.' to '.$to_station.'. Your total charge is '.$total.' and train timings are '.$timings.'.';

    $mail->send();
} catch (Exception $e) {
    echo "<script>alert('something went wrong try again...');</script>";
}
?>