<?php
    require_once "includes/header.php";
    require_once "includes/nav.php";
    $loggedInEmail = null;
    $err = null;
    $total = 0;
    if(isset($_SESSION) && !empty($_SESSION['loggedIn'])
    && !empty($_SESSION['userLoggedIn'])){
      $loggedInEmail=$_SESSION['userLoggedIn'] ;
      $err=false ;
    }else{
      $err = true ;
    }
    function getUserId($email , $connect){
      $query = "select user_id from user where user_email='{$email}'";
      $res = mysqli_query($connect , $query);
      $data = mysqli_fetch_array($res);
      return $data['user_id'];
    }
    function getProduct($id , $connect){
      $query = "Select * from product where product_id ='{$id}'" ;
      $res = mysqli_query($connect , $query ) ;
      $data = mysqli_fetch_array($res) ;
      return $data;
    }
    $userId = getUserId($loggedInEmail , $connection);
    function getDeliveryStatus($id , $connect) {
      $query = "select * from delivery_status where delivery_status_id='{$id}'" ;
      $res = mysqli_query($connect , $query) ;
      $data = mysqli_fetch_array($res) ;
      return $data['delivery_status_val'];
    }
    function getProperty($id , $connect){
      $query = "select * from product where product_id='{$id}' ";
      $res = mysqli_query($connect , $query) ;
      $data = mysqli_fetch_array($res) ;
      return $data['product_name'];
    }

?>
<section class="login-wrapper">
  <div class="container">
    <?php if($err==true){
        ?>
        <div class="alert alert-danger">
            You are not logged In
              <a href="?v=login&callback=?v=orders"  class="btn btn-danger">Login Now </a>
        </div>
        <?php
    } else{
      ?>
      <div class="card">
          <div class="card-header bg-primary text-white">
              Your Orders
          </div>
          <div class="card-body">
              <?php
                $query = "select * from orders where orders_user='{$userId}'" ;
                $res = mysqli_query($connection , $query) ;
                while($data= mysqli_fetch_array($res)) {
                  $orderId = $data['orders_id'] ;
                  ?>
                  <div class="card">
                    <div class="card-header bg-success text-white">
                        <?php echo $data['orders_uid'] ?>
                        <span class="float-right"><?php echo "{$data['orders_date']}"; ?></span>
                    </div>
                    <div class="card-body">
                        <span class="offer"><?php echo getDeliveryStatus($data['orders_delivery_status'] , $connection) ?></span>
                        <?php
                          $q = "select * from order_detail where order_detail_ref='{$orderId}'" ;
                          $r = mysqli_query($connection , $q) ;
                          $i=1 ;
                          while($d = mysqli_fetch_array($r)) {
                            // var_dump($d);
                            ?>
                            <table class="table">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Product name</th>
                                  <th>Quantity</th>  <th>Price</th>
                                  <th>Bill</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>
                                    <?php echo $i; ?>
                                  </td>
                                  <td>
                                    <?php echo getProperty($d['order_detail_product'] , $connection) ?>
                                  </td>
                                  <td>
                                    <?php echo $d['order_detail_qty'] ?>
                                  </td>
                                  <td><?php echo $d['order_detail_price'] ?></td>
                                  <td><?php echo $d['order_detail_qty'] * $d['order_detail_price'] ?></td>
                                </tr>
                              </tbody>
                            </table>
                            <?php
                            $i++;
                          }
                         ?>
                    </div>
                  </div>
                  <?php
                }
               ?>
          </div>
      </div>
      <?php
    }?>
  </div>

</section>
<?php require_once "includes/footer.php"; ?>
