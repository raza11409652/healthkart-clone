<?php
    require_once "includes/header.php";
    require_once "includes/nav.php";
    $callBackUrl = null;
    if(isset($_GET['callback'])){
      $callBackUrl = $_GET['callback'];
    //  echo $callBackUrl;
    }
?>
<section class="login-wrapper">
    <div class="container">
        <div class="login-form">
            <h4>Why Login   ?</h4>
            <p >
            Manage your orders.
            Get exclusive deals and offers
            Personalized recommendations.
            </p>
            <form id="loginForm" method="post">
              <input type="text" name="callback" value="<?php echo $callBackUrl ?>" hidden>
              <div class="form-group">
                  <label for="userEmail">Enter Your Registered Email</label>
                  <input type="email" required name="userEmail" placeholder="email@gmail.com"  class="form-control">
              </div>
              <div class="form-group">
                  <label for="userPassword">Enter Password</label>
                  <input name="userPassword" required placeholder="**********" type="password" class="form-control">
              </div>
              <p class="float-right">
                  <a href="?v=forget" class="">Forget Password?</a>
              </p>
              <div class="form-group mt-4">
                  <button class="btn btn-danger" type="submit">Login</button>
              </div>
            </form>
            <div class="text-center">
                <a href="?v=register">New user ? Register Now</a>
            </div>
        </div>
    </div>
</section>
<?php require_once "includes/footer.php"; ?>
