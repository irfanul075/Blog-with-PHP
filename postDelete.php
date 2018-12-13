<?php
include 'DB/db_connect.php';
include 'checkUser.php';

if($isLogin == false){
    return header('location:login.php');
}


/* ----delete draft post---- */
if(isset($_GET['draft']) && isset($_GET['postId'])){
    $postId = $_GET['postId'];
    $userId = $_SESSION['userId'];
    if ($userId != $_GET['draft']){
        $_SESSION['status'] ="you don't have access to this post";
        $_SESSION['statusType'] = 2;
        return header('location:postsDraft.php');
    }
    $result = $conn->query("delete from posts where id = '$postId' and user_id = '$userId' and status = 1 ");

    if ($result){
        return header('location:postsDraft.php');
    }else{
        $_SESSION['status'] = 'Post not found';
        $_SESSION['statusType'] = '3';
        return header('location:postsDraft.php');
    }
}



/* ----delete publish post---- */
elseif(isset($_GET['postId'])){
    $postId = $_GET['postId'];
    $userId = $_SESSION['userId'];
    if ($isAdmin){
        $result = $conn->query("delete from posts where id = '$postId' and status = 0 ");
        if ($result){
            return header('location:postsAll.php');
        }else{
            $_SESSION['status'] = 'Post not found';
            $_SESSION['statusType'] = '3';
            return header('location:postsAll.php');
        }
    }else{
        $result = $conn->query("delete from posts where id = '$postId' and user_id = '$userId' and status = 0 ");
        if ($result){
            return header('location:myPosts.php');
        }else{
            $_SESSION['status'] = 'Post not found';
            $_SESSION['statusType'] = '3';
            return header('location:myPosts.php');
        }
    }


}


else{
    $_SESSION['status'] = 'something Wrong';
    $_SESSION['statusType'] = '3';
    return header('location:myPosts.php');
}

