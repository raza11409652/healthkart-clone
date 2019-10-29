<?php
require_once '../controller/Connection.php';
session_start();
$response=array("error"=>false);
class CartUpdate{
  private $connect ;
  public function __construct(){
    $conn = new Connection();
    $this->connect = $conn->getConnect();
  #  var_dump($this->connect);
  }
  function validateLogin(){
    if(isset($_SESSION) && !empty($_SESSION['loggedIn'])
    && !empty($_SESSION['userLoggedIn'])){
      return true;
    }
    return false ;
  }
  function isProductInCart($productId , $userId){
    $query = "select * from cart where cart_product='{$productId}' &&
     cart_user='{$userId}'" ;
     //echo $query;
     $res = mysqli_query($this->connect , $query);
     $count = mysqli_num_rows($res) ;
     // echo $count;
     if($count>0) return true;
     return false ;
  }
  function productInCartQty($productId , $userId){
    $query = "select * from cart where cart_product='{$productId}' &&
     cart_user='{$userId}'" ;
     $res = mysqli_query($this->connect , $query);
     $data = mysqli_fetch_array($res) ;
    // var_dump($data);
     return $data['cart_qty'];
  }
  function createCart($productId , $userId){
    $query = null ;
    if($this->isProductInCart($productId , $userId)){
      $qty = $this->productInCartQty($productId , $userId) ;
    //  echo $qty;
      // $qty = $qty + 1 ;
      // $query   = "Update cart set cart_qty='{$qty}'
      //  where cart_user='{$userId}' &&  cart_product='{$productId}'";
      if($qty>1){
        $qty = $qty - 1;
        $query = "Update cart set cart_qty='{$qty}' where
        cart_user='{$userId}' && cart_product='{$productId}'" ;

      }else {
        // code...
        $query = "Delete from cart where cart_user='{$userId}'
        && cart_product='{$productId}'" ;
      }
      //echo $query;
      $res = mysqli_query($this->connect , $query);
      if($res) return true;
      return false;
    }else{
      echo "Pata nhi";
    }
    //echo $query;
    // $res = mysqli_query($this->connect , $query) ;
    // if($res) return true;
    // return false;
  }
  function getUserId($email){
    $query = "select user_id from user where user_email='{$email}'";
    $res = mysqli_query($this->connect , $query);
    $data = mysqli_fetch_array($res);
    return $data['user_id'];
  }
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$obj = new CartUpdate();
$productId = $_POST['id'];
  if($obj->validateLogin()){
    $loggedInEmail = $_SESSION['userLoggedIn'] ;
    $userId = $obj->getUserId($loggedInEmail);
  //  echo $userId;
    if($obj->createCart($productId , $userId)){
      $response['error'] = false ;
      $response['msg'] = "Cart updated";
      echo json_encode($response) ;
      return;
    }
  }
}else{

}

 ?>
