<?php
require_once '../controller/Connection.php';
require_once '../controller/Common.php';
session_start();
$response=array("error"=>false);
class Register{
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
  function startRegistration($email , $name , $mobile , $password){
    $query = "Insert into user (user_email , user_name , user_phone , user_password)
    values('{$email}' , '{$name}' , '{$mobile}' , '{$password}')";
    $res = mysqli_query($this->connect , $query);
    // echo "{$query}";
    if($res) return true;
    return false;
  }
  function getUserId($email , $mobile){
    $query = "select user_id from user where user_email='{$email}' &&
     user_phone='{$mobile}'";
    $res = mysqli_query($this->connect , $query);
    $data = mysqli_fetch_array($res);
    return $data['user_id'];
  }
  function generateOTP(){
    return mt_rand(10000 , 99999);
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
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  // var_dump($_POST);
  @$name = $_POST['name'];
  @$email = $_POST['email'];
  @$mobile = $_POST['mobile'];
  @$password = $_POST['password'];
  $obj= new Register();
  $options = [
    'cost' => 12,
  ];
  if(empty($name) || empty($email) || empty($mobile) || empty($password)){
    $response['error']=true ;
    $response['msg']="Please fill all required input";
    echo json_encode($response);
    return;
  }else if(!validName($name)){
    //registeration start
    $response['error']=true ;
    $response['msg']="Invalid Name Format";
    echo json_encode($response);
    return;
  }else if(!validEmail($email)){
    $response['error']=true ;
    $response['msg']="Invalid E-mail format";
    echo json_encode($response);
    return;
  }else if(!validMobile($mobile)){
    $response['error']=true ;
    $response['msg']="Only Indian Mobile number is required";
    echo json_encode($response);
    return;
  }else if(strlen($password) <8){
    $response['error']=true ;
    $response['msg']="Password should be atleast of 8 character";
    echo json_encode($response);
    return;
  }else{
    //start Registration process session_start
    if($obj->isEmailExist($email)){
      $response['error']=true ;
      $response['msg']="Email is alredy used ";
      echo json_encode($response);
      return;
    }else {
        $hashPassword= md5($password);
        //echo $hashPassword;

        if($obj->startRegistration($email , $name , $mobile , $hashPassword)){
          $userId = $obj->getUserId($email , $mobile);
          // echo $userId;
          $otp = $obj->generateOTP();
          $obj->insertToken($userId , $otp);
          $response['error'] = false ;
          $response['msg'] = "OTP has been send to {$email}";
          $response['hash'] = md5($email);
          $response['email'] = $email;
          echo json_encode($response);
          return;
        }else{
          //data base error
        } //
    }
  }
}else{

}
?>
