<?php
    require_once "includes/header.php";
    require_once "includes/nav.php";
    $loggedInEmail = null;
    if(isset($_SESSION) && !empty($_SESSION['loggedIn'])
    && !empty($_SESSION['userLoggedIn'])){
      $loggedInEmail=$_SESSION['userLoggedIn'] ;
    }
    function getUserId($email , $connect){
      $query = "select user_id from user where user_email='{$email}'";
      $res = mysqli_query($connect , $query);
      $data = mysqli_fetch_array($res);
      return $data['user_id'];
    }
    $userId = getUserId($loggedInEmail , $connection);
    $query = "Select * from cart where cart_user='{$userId}'";
    $res = mysqli_query($connection , $query);

?>
<section class="login-wrapper">
    <div class="container">
      <table class="table">
        <thead>
          <tr>
              <th>#</th>
              <th>Product</th>
               <th>Price</th>
              <th>Action</th>
              <th>Bill</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($data = mysqli_fetch_array($res)) {
            // code...
            var_dump($data);
          }
           ?>
        </tbody>
      </table>

    </div>
</section>
<?php require_once "includes/footer.php"; ?>
