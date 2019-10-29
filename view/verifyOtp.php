<?php
    require_once "includes/header.php";
    require_once "includes/nav.php";
    $err = false ;
    $errMsg = null;
    if(isset($_GET['user']) && isset($_GET['email'])){
      $email = $_GET['user'] ;
      $user = $_GET['email'];
      $hashEmail = md5($email);
      // echo $hashEmail  . $user ;
      if($hashEmail == $user){
        //valid
      }else{
        $err =true ;
        $errMsg = "Invalid checksum";
      }
    }
    else{
      $err = true ;
      $errMsg = "invalid url ";
    //  header('Location:?v=login');
    }
?>
<section class="login-wrapper">
    <div class="container">
      <?php
        if($err==true){
          ?>
          <div class="alert alert-warning text-center">
              <?php echo $errMsg ?>
               <br> <a href="./">HOME</a>
          </div>
          <?php
        }else{
          ?>
          <div class="login-form">
              <h4>Verify OTP</h4>
              <p >
              OTP has been sent to <?php echo $email ?>
              </p>
              <form id="otpForm" method="post">
                <div class="form-group">
                  <input hidden type="text" name="email" value="<?php echo $email ?>">
                    <label for="userEmail">Enter five digit OTP</label>
                    <input type="text" name="otp"
                     placeholder="OTP" required  class="form-control text-center">
                </div>
                <div class="form-group">
                    <button class="btn btn-info">Verify</button>
                </div>
              </form>
              <!-- <div class="text-center">
                  <a href="?v=login">Login</a>
              </div> -->
          </div>
          <?php
        }
       ?>

    </div>
</section>
<?php require_once "includes/footer.php"; ?>
