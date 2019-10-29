<?php
  require_once '../controller/Connection.php';
  session_start();
  $response=array("error"=>false);
  class AddCart{
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
    function getProductType($id){
      $query = "select  * from product_type where  product_type_id='{$id}'";
      $res = mysqli_query($this->connect , $query);
      $data = mysqli_fetch_array($res);
      return $data;
    }
    function getProduct($productId){
      $query = "select * from product where product_id={$productId}";
      $res= mysqli_query($this->connect , $query);
      $count = mysqli_num_rows($res);
      if($count>0){
          $data  = mysqli_fetch_array($res);
          return $data;
      }else{
        return null;
      }
    }
    function isProductInCart($productId , $userId){
      $query = "select * from cart where cart_product='{$productId}' &&
       cart_user='{$userId}'" ;
       $res = mysqli_query($this->connect , $query);
       $count = mysqli_num_rows($res) ;
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
        $qty = $qty + 1 ;
        $query   = "Update cart set cart_qty='{$qty}'
         where cart_user='{$userId}' &&  cart_product='{$productId}'";
      }else{
        $query = "Insert into cart (cart_product , cart_user , cart_qty)
        values('{$productId}','{$userId}','1')";
      }
      //echo $query;
      $res = mysqli_query($this->connect , $query) ;
      if($res) return true;
      return false;
    }
    function getUserId($email){
      $query = "select user_id from user where user_email='{$email}'";
      $res = mysqli_query($this->connect , $query);
      $data = mysqli_fetch_array($res);
      return $data['user_id'];
    }
  }
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $obj = new AddCart();
  $productId = $_POST['product'];
  $product = $obj->getProduct($productId);
  if($product==null){
    return;
  }
  $productType = $product['product_type'];
  $type = $obj->getProductType($productType);
  $typeId = $type['product_type_id'];
  //var_dump($type);
  //var_dump($product);
  if($obj->validateLogin()){
    $loggedInEmail = $_SESSION['userLoggedIn'] ;
    $userId = $obj->getUserId($loggedInEmail);
  //;
  if(  $obj->createCart($productId , $userId)){
    $response['error'] = false ;
    $response['msg'] = "Product has been added to cart";
    echo json_encode($response);
    return;
  }
  }else{
    $callBackUrl = null ;
    $callBackUrl = "?v=product";
    $response['error']  = true ;
    $response['errorCode'] = 101 ;// User is not logged in
    $response['msg'] = "Log in session is required to add cart"  ;
    $response['callBackUrl'] = $callBackUrl;
    echo json_encode($response);
    return;
  }
}else{

}
?>
