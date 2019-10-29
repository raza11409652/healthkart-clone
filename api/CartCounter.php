<?php
  require_once '../controller/Connection.php';
  session_start();
  $response=array("error"=>false);
  class CartCounter{
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
    function getUserId($email){
      $query = "select user_id from user where user_email='{$email}'";
      $res = mysqli_query($this->connect , $query);
      $data = mysqli_fetch_array($res);
      return $data['user_id'];
    }
    function cartCount($userId){
      $query = "select * from cart where cart_user='{$userId}'";
      $res = mysqli_query($this->connect , $query) ;
      $count = mysqli_num_rows($res);
      return $count;
    }
  }
if($_SERVER['REQUEST_METHOD'] == 'GET'){
  $obj =  new CartCounter();
  if($obj->validateLogin()){
    $loggedInEmail = $_SESSION['userLoggedIn'] ;
    $userId = $obj->getUserId($loggedInEmail);
    $response['error'] = false ;
    $response['count'] = $obj->cartCount($userId);
    echo json_encode($response);
  }
}
?>
