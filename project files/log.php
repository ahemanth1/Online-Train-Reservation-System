<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link rel="stylesheet" href="logstyle.css" />
</head>
<body>
  <div class="header"><h2>Online Booking</h2></div>
  <div id="wish">
    <h2 id="wel">Welcome Back...</h2>
    <h2 id="mat">Make your journey more comfortable!!</h2>
</div>
  <div class="login-container">
    <h2>Login</h2>
    <form action="log.php" method="post">
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Password" required />
      <a href="" id="for">forgot password</a>
      <button type="submit">Login</button>
      <div id="create">don't have an account?<a href="create.php">create account</a></div>
    </form>
  </div>

</body>
</html>

<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $servername="localhost";
   $username="root";
   $password="Hemanth@10";
   $dbase="booking";
   
   $conn=mysqli_connect($servername,$username,$password,$dbase);
   $email=mysqli_real_escape_string($conn, $_POST["email"]);
   $passw=mysqli_real_escape_string($conn, $_POST["password"]);

   $_SESSION['email']=$email;
   $checkQuery = "SELECT * FROM user_profile WHERE email = '$email'";
   $checkResult = mysqli_query($conn, $checkQuery);
   if (mysqli_num_rows($checkResult) == 0) {
      echo "<script>alert('you don\\'t have an account!!'); window.location.href='create.php';</script>";
} else {
  $checkQuery = "SELECT * FROM user_profile WHERE password = '$passw' AND email='$email'";
   $checkResult = mysqli_query($conn, $checkQuery);
   if(mysqli_num_rows($checkResult) > 0){
   header("Location:index.php");
   }
   else{
    echo "<script>alert('incorrect password');</script>";
   }
}

   mysqli_close($conn);
   }
?>