<?php
require_once '../controller/Connection.php';
require_once '../controller/Common.php';
require_once '../controller/msgSender.php';
session_start();
$response=array("error"=>false);
class Checkout{
  private $connect ;
  public function __construct(){
    $conn = new Connection();
    $this->connect = $conn->getConnect();
  #  var_dump($this->connect);
  }
  function getUserId($email){
    $query = "select user_id from user where user_email='{$email}'";
    $res = mysqli_query($this->connect , $query);
    $data = mysqli_fetch_array($res);
    return $data['user_id'];
  }
  function validateLogin(){
    if(isset($_SESSION) && !empty($_SESSION['loggedIn'])
    && !empty($_SESSION['userLoggedIn'])){
      return true;
    }
    return false ;
  }
  function getAddressId(){
    $query = "Select max(user_address_id) as MAX_ID from user_address";
    $res = mysqli_query($this->connect , $query);
    $data= mysqli_fetch_array($res);
    return $data['MAX_ID'] +1;
  }
  function insertAddress($id , $name , $mobile , $pincode  ,
   $email , $address , $userId){
    $query = "Insert into  user_address (user_address_id ,
     user_address_name , user_address_pin ,
     user_address_val , user_address_email ,
      user_address_mobile , user_address_ref)values
      ('{$id}','{$name}','{$pincode}' , '{$address}',
      '{$email}' , '{$mobile}' , '{$userId}')";
      // echo $query;
      $res = mysqli_query($this->connect, $query);
      if($res) return true;
      return false;
  }
  function productPrice($id) {
    $query = "Select * from product where product_id='{$id}'" ;
    // echo $query;
    $res = mysqli_query($this->connect , $query) ;
    $data = mysqli_fetch_array($res) ;
    $discount = $data['product_discount'] ;
    $price  = $data['product_price'] ;
    $temp  =$price- intval($price * $discount/100 )  ;
    return $temp  ;
  }
  // function createOrder()
  function totalValue($userId){
    $total = 0 ;
    $query = "select * from cart where cart_user='{$userId}'";
    $res = mysqli_query($this->connect , $query) ;
    while($data = mysqli_fetch_array($res)){
      $qty = $data['cart_qty'] ;
      $product = $data['cart_product']  ;
      $productprice = $this->productPrice($product);
      $total = $total + ($productprice * $qty) ;
    }
    return $total ;
  }
  function getMaxIDOrder(){
    $query = "select max(orders_id) as max_id from orders" ;
    // echo $query;
    $res = mysqli_query($this->connect ,$query) ;
    $data = mysqli_fetch_array($res) ;
    return $data['max_id'] + 1;
  }
  function genearteUid($id){
    return "GK{$id}";
  }
  function createOrder($id , $total , $address , $user , $status  ){
    $uid = $this->genearteUid($id);
    $query = "Insert into orders (orders_id , orders_uid
    ,orders_value , orders_address , orders_user , orders_status) values
    ('{$id}' , '{$uid}','{$total}' , '{$address}' , '{$user}' , '{$status}')";
    // echo $query;
    $res = mysqli_query($this->connect , $query)  ;
    if($res) return true;
    return false;
  }
  function insertTransaction($orderId , $mode){
    $query = "Insert into transaction (transaction_mode , transaction_ref) values('{$mode}' , '$orderId')" ;
    $res  = mysqli_query($this->connect , $query ) ;
    if($res) return true;
    return false;
  }
  function insertDetail($orderId , $qty , $price ,$product){
    $query = "insert into order_detail(order_detail_product ,
     order_detail_price ,
    order_detail_qty , order_detail_ref)values
    ('{$product}','{$price}','{$qty}','{$orderId}')";
    $res = mysqli_query($this->connect  , $query) ;
    if($res) return true;
    return false;
  }
  function makeEmpty($userId){
    $query = "Delete from cart where cart_user='{$userId}'" ;
    $res = mysqli_query($this->connect , $query) ;
    if($res) return true;
    return false;
  }
  function emptyCart($orderId , $userId){
    $query = "Select * from cart where cart_user='{$userId}'" ;
    $res = mysqli_query($this->connect ,$query) ;
    while($data = mysqli_fetch_array($res)) {
      $productId = $data['cart_product'] ;
      $price = $this->productPrice($productId) ;
      $qty = $data['cart_qty'];
      $this->insertDetail($orderId , $qty , $price , $productId) ;
    }
    $this->makeEmpty($userId);
    return true;
  }

}
if($_SERVER['REQUEST_METHOD'] == 'POST'){

$obj = new Checkout();
  if($obj->validateLogin()){
    $loggedInEmail = $_SESSION['userLoggedIn'] ;
    $userId = $obj->getUserId($loggedInEmail);
    // TODO: Address
    $name = $_POST['name']  ;
    $email = $_POST['email'] ;
    $pin = $_POST['pincode']  ;
    $mobile = $_POST ['mobile'] ;
    $address =$_POST['address'] ;
    $name = pureText($name) ;
    $email = pureText($email) ;
    $pin = pureText($pin) ;
    $address = pureText($address);
    $paymentType=$_POST['payment'];
    if(empty($name) || empty($email) || empty($mobile) ||
     empty($address) || empty($pin)){
       $response['error'] = true ;
       $response['msg'] = "Required feild is empty";
       echo json_encode($response);
       return;
     }else if(validMobile($mobile) == false){
       $response['error'] = true ;
       $response['msg'] = "only Indian mobile number is allowed";
       echo json_encode($response);
       return;
     }else{
       //fetchMAX_ID
       $addressMaxId = $obj->getAddressId();
       // var_dump($addressMaxId);
       //1 insert address
       $obj->insertAddress($addressMaxId , $name , $mobile ,
       $pin  ,$email , $address , $userId) ;
       // create order
       /*Order */
       //Total value calculate
       $totalBill = $obj->totalValue($userId);
       // var_dump($totalBill);
       $orderMaxID=$obj->getMaxIDOrder();
       $status = 0;
       $mode = null;
       if($paymentType == 1){
         $status = 1;
         $mode ="COD (Cash on delivery)"  ;
       }else{
         $status = 0;
       }
       $r = $obj->createOrder($orderMaxID , $totalBill , $addressMaxId , $userId , $status);
       $obj->insertTransaction($orderMaxID , $mode);
       if($r==true){
         $msg = "Your Order has been placed Total Bill Rs {$totalBill}" ;
        $r =  sendTextMsg($mobile , $msg);
        // var_dump($r);
         //copy cart and empty cart_qty
         $obj->emptyCart($orderMaxID , $userId);
         $response['error'] = false ;
         $response['orderId'] = $orderMaxID ;
         $response['msg'] = "Your order has been placed order number {$orderMaxID}" ;
         $response['url'] = null ;
         echo json_encode($response);
       }else{

       }

     }
  }else{
    $response ['error'] = true ;
    $response [ 'msg'] = "Not valid Session" ;
    echo json_encode($response);
    return;
  }
}else{

}
 ?>
