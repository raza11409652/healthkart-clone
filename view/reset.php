<?php
    require_once "includes/header.php";
    require_once "includes/nav.php";
    $err = false ;
    $msg  = null ;
    $token = null ;
    $user = null ;
    function getUserId($email , $connect){
      $query = "Select * from user where user_email='{$email}'" ;
      $res = mysqli_query($connect , $query) ;
      $data = mysqli_fetch_array($res) ;
      return $data['user_id'];
    }
    function validRequest($token ,$userId , $connect){
      $query = "Select * from user_token where user_token_val='{$token}' && user_token_ref='{$userId}'" ;
    #  echo $query;
      $res = mysqli_query($connect , $query) ;
      $count = mysqli_num_rows($res) ;
      if($count==1) return true;
      return false;
    }

    if(isset($_GET['token']) &&  isset($_GET['user'])){
      $token = $_GET['token'] ;
      $user = $_GET['user'] ;
      $userId = getUserId($user , $connection);
      // echo $userId;
      if($userId==null || $userId <1){
        $err = true ;
        $msg = "Invalid CheckSum" ;
      }else if(validRequest($token , $userId , $connection) == false){
        $err = true ;
        $msg = "Invalid CheckSum" ;
      }
    }else{
      $err = true ;
      $msg = "Invalid Url";
    }

?>
<section class="login-wrapper">
    <div class="container">
      <?php
      if($err == true){
        ?>
        <div class="alert alert-warning text-center">
        <i class="fa fa-bullhorn" aria-hidden="true"></i>
              <?php echo $msg ?>
        </div>
        <?php
      } else{

        ?>
        <div class="login-form">
            <h4>Reset Your Password</h4>
          <form id="resetForm" method="post">
            <div class="form-group">
                <label for="userEmail">Enter Your new password</label>
                <input type="password" required name="password" placeholder="********"  class="form-control">
            </div>
            <input type="text" hidden name="user" value="<?php echo $userId ?>">
            <div class="form-group">
                <label for="userEmail">Enter Your confirm password</label>
                <input type="password" required name="confPassword" placeholder="********"  class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-warning">Reset Password</button>
            </div>
          </form>
            <div class="text-center">
                <a href="?v=login">Login</a>
            </div>
        </div>
        <?php
      }
      ?>
    </div>
</section>
<?php require_once "includes/footer.php"; ?>
