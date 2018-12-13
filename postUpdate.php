<?php
include 'DB/db_connect.php';
include 'checkUser.php';
if(!$isLogin){
    return header('location:login.php');
}

$userId = $_SESSION['userId'];

/* -----Update draft----- */
if (isset($_POST['updateDraft'])) {
    $postId = $_POST['postId'];
    $postTitle = $_POST['postTitle'];
    $postBody = $_POST['postBody'];
    $postCategory = $_POST['postCategory'];
    $postImage = $_POST['postImage'];

    /*update image if exist*/
    if(!$_FILES['postImage']['error'] > 0 ) {

        $extension = pathinfo($_FILES['postImage']['name'], PATHINFO_EXTENSION);
        $featureImage = uniqid() . '.' . $extension;
        $filePath = 'images/'.$featureImage;

        if ($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif") {
            $_SESSION['status'] = 'only jpg png jpeg & gif allowed';
            $_SESSION['statusType'] = '3';
            return header('location:postEditForm.php?draft='.$userId.'&postId ='.$postId);
        }

        if (!move_uploaded_file($_FILES["postImage"]["tmp_name"], $filePath)) {
            $_SESSION['status'] = 'Image not uploaded try again';
            $_SESSION['statusType'] = '3';
            return header('location:postEditForm.php?draft='.$userId.'&postId ='.$postId);
        }
    }else{
        $featureImage = $postImage;
    }

    $result = $conn->query("update posts set title = '$postTitle', body = '$postBody', categories = '$postCategory', feature_image = '$featureImage' where id = '$postId' and status = 1 ");

    if ($result){
        return header('location:postSingle.php?draft='.$userId.'&postId='.$postId);
    }else{
        return header('location:postEditForm.php?draft='.$userId.'&postId='.$postId);
    }

}

/* -----publish draft----- */
elseif (isset($_POST['publishDraft'])){
        $postId = $_POST['postId'];
        $publishPost = $conn->query("update posts set status = 0 where id = '$postId' and user_id = '$userId' ");
        if($publishPost){
            return header('location:myPosts.php');
        }else{
            $_SESSION['status'] = 'something wrong please try again';
            $_SESSION['statusType'] = 3;
            return header('location:postEditForm.php?draft='.$userId.'&postId='.$postId);
        }
}



/* -----update published post----- */
elseif (isset($_POST['postUpdate'])) {


        $postId = $_POST['postId'];
        $postTitle = $_POST['postTitle'];
        $postBody = $_POST['postBody'];
        $postCategory = $_POST['postCategory'];
        $postImage = $_POST['postImage'];

        /*update image if exist*/
        if(!$_FILES['postImage']['error'] > 0 ) {

            $extension = pathinfo($_FILES['postImage']['name'], PATHINFO_EXTENSION);
            $featureImage = uniqid() . '.' . $extension;
            $filePath = 'images/'.$featureImage;

            if ($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif") {
                $_SESSION['status'] = 'only jpg png jpeg & gif allowed';
                $_SESSION['statusType'] = '3';
                return header('location:postEditForm.php?postId ='.$postId);
            }

            if (!move_uploaded_file($_FILES["postImage"]["tmp_name"], $filePath)) {
                $_SESSION['status'] = 'Image not uploaded try again';
                $_SESSION['statusType'] = '3';
                return header('location:postEditForm.php?postId ='.$postId);
            }
        }else{
            $featureImage = $postImage;
        }


    $result = $conn->query("update posts set title = '$postTitle', body = '$postBody', categories = '$postCategory', feature_image = '$featureImage' where id = '$postId' and status = 0 ");

    if ($result){
        return header('location:postSingle.php?postId='.$postId);
    }else{
        return header('location:postEditForm.php?postId='.$postId);
    }

}




else{
    return header('location:myPost.php');
}