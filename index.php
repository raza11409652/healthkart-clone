<?php
    session_start();
    function isExist($path){
        if(file_exists($path)){
            require_once $path;
        }else{
            require_once "view/error.php";
        }
    }
    $path = null ; 
    if(isset($_REQUEST['v'])){
        $path = "view/{$_REQUEST['v']}.php"; 
    }else{
        $path = "view/home.php";
    }
    isExist($path);
?>
