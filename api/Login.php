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
  }
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // var_dump($_POST);
    $obj = new Login();
    @$email = $_POST['userEmail'] ;
    @$password = $_POST['userPassword'] ;
    @  $callBackUrl = $_POST['callback'];
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
      //start login attampt
    }
  }else{

  }
 ?>
