<?php
require_once '../controller/Connection.php';
require_once '../controller/Common.php';
session_start();
$response=array("error"=>false);
  class OtpVerify{
    private $connect ;
    public function __construct(){
      $conn = new Connection();
      $this->connect = $conn->getConnect();
      #  var_dump($this->connect);
    }
    function isEmailExist($email){
      $query = "select * from user where user_email='{$email}'" ;
      $res = mysqli_query ($this->connect , $query);
      $count = mysqli_num_rows($res);
      if($count==1) return true;
      return false;
    }
    function getUserId($email){
      $query = "select user_id from user where user_email='{$email}'";
      $res = mysqli_query($this->connect , $query);
      $data = mysqli_fetch_array($res);
      return $data['user_id'];
    }
    function validateToken($id , $token){
      $query = "select * from user_token where user_token_val='{$token}'
      && user_token_ref='{$id}'" ;
      $res = mysqli_query($this->connect , $query );
      $count = mysqli_num_rows($res);
      if($count==1) return true;
      return false;
    }
    function deleteToken($id){
      $query = "Delete from user_token where user_token_ref='{$id}'" ;
      $res = mysqli_query($this->connect ,$query );
      if($res) return true ;
      return false;
    }
    function updateStatus($id){
      $query = "Update user set user_status='1' where user_id='{$id}'";
      $res = mysqli_query($this->connect ,$query );
      if($res) return true ;
      return false;
    }
  }
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // var_dump($_POST) ;
    $email = $_POST['email'];
    $otp = $_POST['otp'];
    $obj = new OtpVerify();
    if(empty($email) || empty($otp)){
      $response['error'] = true ;
      $response['msg'] = "Inavlid Request";
      echo json_encode($response);
      return;
    }else{
      $userId =$obj->getUserId($email);
      if($obj->validateToken($userId , $otp)){
        $obj->deleteToken($userId);
        $obj->updateStatus($userId);
        $response['error'] = false ;
        $response['msg'] = "success ";
        $_SESSION['loggedIn']= true ;
        $_SESSION['userLoggedIn'] = $email;
        echo json_encode($response) ;
        return;
      }else{
        $response['error'] = true  ;
        $response['msg'] = "Verification failed";
        echo json_encode($response);
        return;
      }
    }
  }else{

  }
 ?>
