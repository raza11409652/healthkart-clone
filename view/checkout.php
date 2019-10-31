<?php
    require_once "includes/header.php";
    require_once "includes/nav.php";
    $loggedInEmail = null;
    $err = null;
    $total = 0;
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
    $cartCount = mysqli_num_rows($res);
    if($cartCount>0){
      $err=false ;
    }else{
      $err =true ;
    }

?>
<section class="login-wrapper">
    <div class="container">
      <?php
        if($err==false){
          ?>
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
            Billing   Address
            </div>
            <div class="card-body">
            <form id="checkOutForm" method="post">
              <input type="text" name="userLoggedIn" hidden value="<?php echo $loggedInEmail ?>">
                <div class="row">
                      <div class="col-lg-6">
                        <input required type="text" name="name" placeholder="Name" class="form-control"  value="">
                      </div>
                      <div class="col-lg-6">
                        <input required  type="email" name="email" placeholder="Email" class="form-control"  value="<?php echo $loggedInEmail ?>">
                      </div>
                </div>
                <div class="row mt-4">
                      <div class="col-lg-6">
                        <input required type="text" name="mobile" placeholder="Mobile Number" class="form-control"  value="">
                      </div>
                      <div class="col-lg-6">
                        <input required type="text" class="form-control" pattern="[1-9][0-9]{5}" name="pincode" placeholder="PINCODE" value="">
                      </div>
                </div>
                <div class="row mt-4">
                  <div class="col-lg-12">
                    <textarea required name="address" placeholder="Your Address" class="form-control " rows="8" cols="80"></textarea>

                  </div>
                </div>
              <div class="row mt-3">
                <div class="col-lg-8">
                  <select class="form-control" name="">
                    <option value="1">Cash On delivery (COD)</option>
                    <option value="2">Pay Online (Debit card ,Credit card)</option>
                  </select>
                </div>
                <div class="col-lg-4">
                  <button type="submit" name="button" class="btn btn-info btn-block">Place Order</button>
                </div>
              </div>
            </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4 bg-white">
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
                <td>{$data['cart_qty']}
              </td>
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
</div>
          <?php
        }
       ?>
    </div>

</section>
<?php require_once "includes/footer.php"; ?>
