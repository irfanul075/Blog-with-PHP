<?php session_start();
/*check login for view*/
if( isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true ){
    $isLogin = true;
    if(isset($_SESSION['isAdmin']) &&$_SESSION['isAdmin'] == true){
        $isAdmin = true;
    }else{
        $isAdmin = false;
    }
}
else{
    $isLogin =false;
}