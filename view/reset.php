<?php
    require_once "includes/header.php";
    require_once "includes/nav.php";
?>
<section class="login-wrapper">
    <div class="container">
        <div class="login-form">
            <h4>Resset Your Password</h4>
            
            <div class="form-group">
                <label for="userEmail">Enter Your Registered Email</label>
                <input type="email" name="userEmail" placeholder="email@gmail.com"  class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-warning">Reset Password</button>
            </div>
            <div class="text-center">
                <a href="?v=login">Login</a>
            </div>
        </div>
    </div>
</section>
<?php require_once "includes/footer.php"; ?>
