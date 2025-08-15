<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Verification</title>
    <link rel="stylesheet" href="otp.css" />
</head>
<body>
   <div id="header"><h2 id="name">Online Booking</h2></div>
    <h2 id="state">An OTP has been sent to your inbox for varification!! </h2>
    <div id="otp-container">  
    <form action="" method="post">
        <h2>Enter OTP</h2>
        <input type="text" name="otp" placeholder="Enter OTP">
        <button type="submit">submit</button>
    </form>
</div>
  <h2 id="note">Note: If mail not received, Fill your details again...</h2>
<div id="empty"></div>
</body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
   if($_SESSION['number']==$_POST["otp"]){
   $servername="localhost";
   $username="root";
   $password="Hemanth@10";
   $dbase="booking";
   
   $conn=mysqli_connect($servername,$username,$password,$dbase);
   $name=mysqli_real_escape_string($conn, $_SESSION["name"]);
   $age=(int) $_SESSION["age"];
   $email=mysqli_real_escape_string($conn, $_SESSION["email"]);
   $passw=mysqli_real_escape_string($conn, $_SESSION["password"]);
   $sql="INSERT INTO user_profile(name,age,email,password) VALUES('$name',$age,'$email','$passw');";
   $result=mysqli_query($conn,$sql);
    mysqli_close($conn);
    echo "<script>alert('Account has been created!!');</script>";
    header("Location:log.php");
   }
    else{
        echo "<script>alert('OTP Missmatch!! please reload the page.');</script>";
        header("Location:create.php");
    }
}
?>
