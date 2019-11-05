<?php
require_once '../controller/Connection.php';
session_start();
$response=array("error"=>false);
class Reset{
  private $connect ;
  public function __construct(){
    $conn = new Connection();
    $this->connect = $conn->getConnect();
  #  var_dump($this->connect);
  }
  function updatePassword($password , $userId){
    $query = "Update user set user_password='{$password}' where user_id='{$userId}'" ;
    $res = mysqli_query($this->connect , $query) ;
    if($res) return true;
    return false;
  }
  function deleteToken($userId){
    $query="Delete from user_token where user_token_ref='{$userId}'" ;
    $res = mysqli_query($this->connect , $query) ;
    if($res) return true;
    return false;
  }
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  #var_dump($_POST) ;
  $user = $_POST['user'] ;
  $password = $_POST['password'] ;
  $confPassword = $_POST['confPassword'] ;
  if($password != $confPassword){
    $response['error'] = true ;
    $response['msg'] = "Password Missmatch"  ;
    echo json_encode($response);
    return;
  }else{
    $obj = new Reset();
    $password = md5($password);
    if($obj->updatePassword($password , $user)){
      $response['error'] = false ;
      $response['msg'] = "Password updated. Login Now " ;
      echo json_encode($response);
      return;
     }
  }

}else{

}

 ?>
