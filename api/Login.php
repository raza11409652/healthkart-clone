<?php
  require_once '../controller/Connection.php';
  require_once '../controller/Common.php';
  session_start();
  $response=array("error"=>false);
  class Login{
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
    function getUser($email){
      $query = "select * from user where user_email='{$email}' && user_status='1'" ;
      $res = mysqli_query ($this->connect , $query );
      $data = mysqli_fetch_array($res) ;
      return $data;
    }
    function verifyPassword($hash , $password){
      if($password == $hash){
        return true;
      }
      return false;
    }
  }
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // var_dump($_POST);
    $obj = new Login();
$callBackUrl = null;
    @$email = $_POST['userEmail'] ;
    $password = $_POST['userPassword'] ;
    $callBackUrl = $_POST['callback'];
    if(!validEmail($email)){
      $response['error'] = true ;
      $response['msg'] = "Not valid Email";
      echo json_encode($response);
      return;
    }else if(empty($password)){
      $response['error'] = true ;
      $response['msg'] = "Password is required";
      echo json_encode($response);
      return;
    }else{
      $password = md5($password);
      // $password = password_hash($password , PASSWORD_BCRYPT , $options);
      // echo $password;
      if($obj->isUserExist($email)){
        $user = $obj ->getUser($email);
        // var_dump($user);
        $hashPassword = $user['user_password'] ;
        //var_dump($hashPassword);
        $t = $obj->verifyPassword($hashPassword , $password);
        // var_dump($t);
        if($t){
          $response['error'] = false ;
          $response['msg'] = "success";
          $_SESSION['loggedIn']= true ;
          $response['callBackUrl'] = $callBackUrl ;
          $_SESSION['userLoggedIn'] = $email;
          echo json_encode($response) ;
          return;
        }else{
          $response['error'] = true ;
          $response['msg'] = "Auth failed" ;
          $response['errorcode'] = 908 ; //Password incorrect
          echo json_encode($response) ;
          return;
        }
      }else{
        $response['error'] = true ;
        $response['msg'] = "Auth failed" ;
        $response['errorcode'] = 909 ; //Email doen't exsit
        echo json_encode($response) ;
        return;
      }
    }
  }else{

  }
 ?>
