<?php
include 'checkUser.php';
include 'DB/db_connect.php';


if(isset($_GET['userId'])){
    $userId = $_GET['userId'];
    if ($isLogin == true && $isAdmin == true){
        $result = $conn->query("delete from users where id = '$userId'");
        if ($result){
            $deleteUserPost = $conn->query("delete from posts where user_id = '$userId'");
            return header('location:allUsers.php');
        }else{
            $_SESSION['status'] = 'Post not found';
            $_SESSION['statusType'] = '3';
            return header('location:allUsers.php');
        }
    }else{
        return header('location:login.php');
    }

}else{
    return header('location:login.php');
}
