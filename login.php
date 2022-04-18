<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
  
    <link rel="stylesheet" href="styles.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   </head>
<body>
  <?php
    include 'connect.php';
    if(isset($_POST['submit'])){
      $Email=$_POST['Email'];
      $_SESSION['Email']=$Email;
      $Password=$_POST['Password'];
      $emailsearsh="select* from registration00 where Email ='$Email'";
      $query=mysqli_query($con,$emailsearsh);
      $email_count=mysqli_num_rows($query);
      if($email_count){
        $email_pass=mysqli_fetch_assoc($query);
        $dppass=$email_pass['Password'];
        $pass_decode=password_verify($Password, $dppass);
        if($pass_decode){
          echo '
          <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successfully!</strong> You login successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
          ';
          ?>
          <script>
            location.replace("index.php");
          </script>
          <?php
        }else{
          echo "Password incorrect";
        }
      }
      else{
        echo "Invalid Email";
      }
    }
  ?>

<nav class="navbar navbar-dark bg-dark fixed-top " id="removeMargin" >
  
  <div class="container-fluid ">
    <a class="navbar-brand" href="index.php"> <b> iPfly</b>-<small>The Professional Portfolio Creation Service</small></a>
    
  </div>
</nav>


  <div class="main_div">
    <div class="title">Login Form</div>
    <!-- <div class="social_icons">
      <a href="#"><i class="fab fa-facebook-f"></i> <span>Facebook</span></a>
      <a href="#"><i class="fab fa-twitter"></i><span>Twitter</span></a>
    </div> -->
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="input_box">
        <input type="text" placeholder="Email " name="Email"required>
        <div class="icon"><i class="fas fa-user"></i></div>
      </div>
      <div class="input_box">
        <input type="password" placeholder="Password" name="Password" required>
        <div class="icon"><i class="fas fa-lock"></i></div>
      </div>
      <div class="option_div">
        <div class="check_box">
          <input type="checkbox">
          <span>Remember me</span>
        </div>
        <!-- <div class="forget_div">
          <a href="#">Forgot password?</a>
        </div> -->
      </div>
      <div class="input_box button">
        <input type="submit" value="Login" name="submit">
      </div>
      <div class="sign_up">
        Not a member? <a href="user_reg.php">Signup now</a>
      </div>
    </form>
  </div>
</body>
</html>
