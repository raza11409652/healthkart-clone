<?php
    require_once "includes/header.php";
    require_once "includes/nav.php";
?>
<div class="flex">
    <div class="left">
        <div class="container mt-3">
            <h5>Register now It's free</h5>
            <form id="registerForm" method="post">
              <div class="form-group mt-4">
                  <label for=""> <i class="fa fa-user"></i> Enter Name</label>
                  <input type="text" required name="name" placeholder="Enter Name" class="form-control">
              </div>
              <div class="form-group">
                  <label for=""> <i class="fa fa-envelope"></i> Enter email</label>
                  <input type="email" required name="email" placeholder="Email" class="form-control">
              </div>
              <div class="form-group">
                  <label for=""> <i class="fa fa-mobile"></i> Enter mobile</label>
                  <input type="text" required name="mobile" placeholder="Indian Mobile Number" class="form-control">
              </div>
              <div class="form-group">
                  <label for=""> <i class="fa fa-lock"></i> Enter password</label>
                  <input type="password" required name="password" placeholder="**************" class="form-control">
              </div>
              <div class="form-group">
                  <button class="btn btn-info" type="submit">Register</button>
              </div>
            </form>
            <div class="text-center">
                <a href="?v=login">Login</a>
            </div>
        </div>
    </div>
    <div class="right">
        <ol class="process-3">
            <li class="process_item wow zoomIn" data-wow-duration="1s">
                <div class="process__number"><span>1</span></div>
                <div class="process__body">
                    <h4>Reason 1</h4>
                    <p>Manage your orders</p>
                </div>
            </li>
            <li class="process_item wow zoomIn" data-wow-duration="2s">
                <div class="process__number"><span>2</span></div>
                <div class="process__body">
                    <h4>Reason 2</h4>
                    <p> Get exclusive deals and offers</p>
                </div>
            </li>
            <li class="process_item wow zoomIn" data-wow-duration="3s">
                <div class="process__number"><span>3</span></div>
                <div class="process__body">
                <h4>Reason 3</h4>
                    <p>Personalized recommendations.</p>
                </div>
            </li>
        </ol>
    </div>
</div>
<?php require_once "includes/footer.php"; ?>
