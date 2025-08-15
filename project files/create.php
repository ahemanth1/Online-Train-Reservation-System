<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Create Account</title>
  <link rel="stylesheet" href="create.css" />
</head>
<body>
  <header>
    <div class="header">
     <h2>Online Booking</h2> 
    </div>
  </header>
  <div id="wish">
    <div id="welcome">Welcome!!</div>
    <div class="mat">New here?? </div>
    <div class="mat" >Just enter your details...</div>
</div>
  <div class="form-container">
    <h2>Create Account</h2>
    <form action="" method="post">
      <input type="text" name="name" value="<?php echo $_SESSION['name'] ?? ''; ?>" placeholder="Name" required />
      <input type="number" name="age" value="<?php echo $_SESSION['age'] ?? ''; ?>" placeholder="Age" required />
      <input type="email" name="email"  placeholder="Email" required />
      <input type="password" name="password"  placeholder="Password" required />
      <button type="submit">Create</button>
    </form>
  </div>
  <div id="empty"></div>
</body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
   $servername="localhost";
   $username="root";
   $password="Hemanth@10";
   $dbase="booking";
   $conn=mysqli_connect($servername,$username,$password,$dbase);
   $_SESSION['email']=$_POST["email"];
    $_SESSION['name']=$_POST["name"];
    $_SESSION['age']=$_POST["age"];
    $_SESSION['number']=rand(100000,999999);
    $email=$_SESSION['email'];
    $sql="SELECT * from user_profile where email='$email'";
    $result=mysqli_query($conn,$sql);
    $_SESSION['password']=$_POST["password"];
    $pass=$_SESSION['password'];
    $sql="SELECT * from user_profile where password='$pass'";
    $pas=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)!=0 ||  mysqli_num_rows($pas)!=0){
       echo "<script>alert('email already exist or password already in use....');</script>";
    }
    else{
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
    $mail->Subject = 'Account Verification';
    $mail->Body    = 'Your OTP to verify your account is '. $_SESSION['number'].". Enter your OTP carefully and Don't share this to the third party";

    $mail->send();
} catch (Exception $e) {
    echo "<script>alert('something went wrong try again...');</script>";
}
      header("Location:otpsender.php");
}
} 
?>
