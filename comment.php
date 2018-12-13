<?php
include 'checkUser.php';
include 'DB/db_connect.php';
if (!$isLogin){
    return header('location:login.php');
}
if (isset($_POST['comment'])){

    $postId = (int)$_POST['postId'];
    $commenterId = (int)$_POST['commenterId'];
    $commentBody = $_POST['commentBody'];
    $stmt = $conn->prepare("insert into comments(body, user_id, post_id) values (?,?,?)");
    $stmt->bind_param("sii",$commentBody,$commenterId,$postId);
    if ($stmt->execute()){
        return header('location:postSingle.php?postId='.$postId);
    }else{
        $_SESSION['status'] = 'comment Not post please try again';
        $_SESSION['statusType'] = 3;
        return header('location:postSingle.php?postId='.$postId);
    }
}


/*delete comment by admin*/
elseif(isset($_GET['commentId'])){
    if ($isAdmin == true){
        $commentId = $_GET['commentId'];
        $result = $conn->query("delete from comments where id = '$commentId' ");
        if ($result){
            return header('location:allComments.php');
        }else{
            $_SESSION['status'] = "comment no deleted please try again";
            $_SESSION['statusType'] = 2;
            return header('location:allComments.php');
        }
    }else{
        return header('location:index.php');
    }
}


else{
    return header('location:index.php');
}


