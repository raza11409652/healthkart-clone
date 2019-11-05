<nav class="navbar navbar-expand-lg fixed-top ">
  <div class="container-fluid">
    <a class="navbar-brand" href="./">
      <img  src="image/logo.png"/>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="./">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?v=bmi">BMI</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li> -->
      </ul>
      <ul class="navbar-nav ">
        <?php
        if(isset($_SESSION) && !empty($_SESSION['loggedIn'])
        && !empty($_SESSION['userLoggedIn'])){
          ?>

          <li class=" nav-item ml-1">
            <!-- <a href="?v=logout" class="btn btn-danger">Logout</a> -->
            <div class="dropdown">
  <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Account
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="?v=orders">Orders</a>
    <!-- <a class="dropdown-item" href="#">Another action</a> -->
    <a class="dropdown-item" href="?v=logout">Logout</a>
  </div>
</div>
          </li>
          <li class=" nav-item ml-1">
            <a href="?v=cart" class="btn btn-info">cart
              <span id="cart_counter">0</span> </a>
          </li>
          <?php
        }else{
          ?>
          <li class=" nav-item ">
              <a href="?v=register" class="btn btn-theme-primary">Register</a>
            </li>
            <li class=" nav-item ml-1">
              <a href="?v=login" class="btn btn-danger">Login</a>
            </li>
          <?php
        }
         ?>
      <!-- <li class=" nav-item ">
          <a href="?v=register" class="btn btn-theme-primary">Register</a>
        </li>
        <li class=" nav-item ml-1">
          <a href="?v=login" class="btn btn-danger">Login</a>
        </li> -->

      </ul>
    </div>
  </div>
</nav>
