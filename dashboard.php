<?php
include 'checkUser.php';
if (!$isLogin){
    return header('location:login.php');
}else{

    return header('location:myPosts.php');

}


