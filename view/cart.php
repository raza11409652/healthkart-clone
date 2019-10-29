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
    function getProduct($id , $connect){
      $query = "Select * from product where product_id ='{$id}'" ;
      $res = mysqli_query($connect , $query ) ;
      $data = mysqli_fetch_array($res) ;
      return $data;
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
               <th>Quantity</th>
              <th>Bill</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=1 ;
          $total = 0;
          while ($data = mysqli_fetch_array($res) ) {
            // code...
            // var_dump($data);
            $products = getProduct($data['cart_product'] , $connection) ;
            $price = $products['product_price'];
            $offerPrice = 0;
            $discount = $products['product_discount'];
            if($discount>0){
                $discountVal = intval($price * $discount/100 )  ;
                $offerPrice = $price - $discountVal;
            }else{
                $offerPrice = $price  ;
            }
            $Bill = $offerPrice * $data['cart_qty']  ;
            $total +=$Bill;
            echo "
              <tr>
                <td>{$i}</td>
                <td>{$products['product_name']}</td>
                <td> Rs
                <span class='offer-price'>{$offerPrice}</span>
                </td>
                <td><a class='cart-plus btn-info text-white'
                onclick='plusCart({$data['cart_id']})'
                > <i class='fa fa-plus'></i>
                 </a>{$data['cart_qty']}
                 <a class='cart-minus text-white btn-danger'
                  onclick='removeCart({$data['cart_id']})'>
                 <i class='fa fa-minus '></i> </a></td>
                <td>{$Bill }</td>
              </tr>
            ";
            $i++;
          }
           ?>
           <tr>
             <th colspan="4">Total Bill</th>
             <th>Rs <?php echo $total ?></th>
           </tr>
        </tbody>
      </table>

    </div>
</section>
<?php require_once "includes/footer.php"; ?>
