<?php
require_once '../controller/Connection.php';
require_once '../controller/Common.php';
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

}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
/*
array(6) { ["userLoggedIn"]=> string(25)
 "hackdroidbykhan@gmail.com" ["name"]=>
  string(6) "Khalid" ["email"]=> string(25)
   "hackdroidbykhan@gmail.com" ["mobile"]=>
    string(10) "9835555982" ["pincode"]=>
string(6) "144411" ["address"]=> string(3) "sjf" }
*/
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
