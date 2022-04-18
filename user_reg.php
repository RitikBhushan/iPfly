<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
   
    <link rel="stylesheet" href="style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   
     <?php include 'connect.php' ?>
   </head>
<body>
<nav class="navbar navbar-dark bg-dark fixed-top " id="removeMargin" >
  
  <div class="container-fluid ">
    <a class="navbar-brand" href="index.php"> <b> iPfly</b>-<small>The Professional Portfolio Creation Service</small></a>
    
  </div>
</nav>
  <div class="container">
    <div class="title">Registration</div>
    <div class="content">
      <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" placeholder="Enter your name" required name="Name" required>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" placeholder="Enter your username" required name="Username" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" placeholder="Enter your email" required name="Email" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" placeholder="Enter your number" required name="Mobile" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" placeholder="Enter your password" required name="Password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" placeholder="Confirm your password" required name="cpassword" required>
          </div>
        </div>
        <div class="button">
          <input type="submit" value="Register" name="submit">
        </div>
        <div class="sign_up">
        already a member? <a href="login.php">Login now</a>
      </div>
      </form>
    </div>
  </div>
  <?php
  if (isset($_POST['submit'])) {
    $Name=mysqli_real_escape_string($con,$_POST['Name']);
    $Username=mysqli_real_escape_string($con,$_POST['Username']);
    $Email=mysqli_real_escape_string($con,$_POST['Email']);
    $Mobile=mysqli_real_escape_string($con,$_POST['Mobile']);
    $Password=mysqli_real_escape_string($con,$_POST['Password']);
    $cpassword=mysqli_real_escape_string($con,$_POST['cpassword']);
    $pass=password_hash($Password, PASSWORD_BCRYPT);
    $cpass=password_hash($cpassword, PASSWORD_BCRYPT);
    $emailquery="select* from registration00 where Email='$Email' ";
    $query=mysqli_query($con,$emailquery);
    $emailcount=mysqli_num_rows($query);
    if($emailcount>0){
      echo "Email already exist";
    }
    else{
      if($Password===$cpassword){
        $insertquery="insert into registration00(Name,Username, Email, Mobile, Password, cpassword) values('$Name','$Username','$Email','$Mobile','$pass','$cpass')";
        $iquery=mysqli_query($con,$insertquery);
        echo'
        <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successfully!</strong> Congratulation you are now a part of iPfly.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
        ';
      }else{
        echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Failed!</strong> Password does not match.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
        ';
      }
    }
  }
?>
</body>
</html>
