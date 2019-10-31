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

}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $email = $_POST['userEmail'];
  $obj = new Forget() ;


}else{

}
 ?>
