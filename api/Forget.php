<?php
require_once '../controller/Connection.php';
require_once '../controller/Common.php';
session_start();
$response=array("error"=>false);
class Forget{
  private $connect ;
  public function __construct(){
    $conn = new Connection();
    $this->connect = $conn->getConnect();
    #  var_dump($this->connect);
  }
  function isUserExist($email){
    $query = "select * from user where user_email='{$email}'" ;
    $res = mysqli_query($this->connect , $query) ;
    $count = mysqli_num_rows($res) ;
    if($count==1) return true ;
    return false ;
  }
  function generatetoken(){
    return md5(mt_rand(10000 , 99999));
  }
  function isTokenExist($id){
    $query = "select * from user_token where user_token_ref='{$id}'" ;
    $res = mysqli_query($this->connect , $query);
    $count = mysqli_num_rows($res);
    if($count>0) return true;
    return false;
  }
  function insertToken($id , $token){
    $query = null ;
    if($this->isTokenExist($id)){
      $query = "Update user_token set user_token_val='{$token}' where user_token_ref='{$id}'";
      // $res = mysqli_query($this->connect , $q)
    }else{
      $query = "Insert into user_token (user_token_val , user_token_ref) values('{$token}' ,'{$id}')";
    }
    $res = mysqli_query($this->connect  , $query);
    if($res) return true ;
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
  $email = $_POST['userEmail'];
  $obj = new Forget() ;
// var_dump($email);
    if(validEmail($email)){
      $userId =$obj->getUserId($email) ;
      $token = $obj->generatetoken() ;
       if($obj->insertToken($userId , $token)){
         $response['error']  = false ;
         $response['msg'] = "Please check your email" ;
         echo json_encode($response) ;
         return;
       }
     }else{
      $response['error'] = true ;
      $response['msg'] = "Not valid email" ;
      echo json_encode($response) ;
      return;
     }

}else{

}
 ?>
