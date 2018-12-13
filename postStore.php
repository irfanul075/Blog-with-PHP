<?php include 'DB/db_connect.php';
include 'checkUser.php';
if(!$isLogin){
    return header('location:login.php');
}

if(isset($_POST['pubPost'])){

if(!$_FILES['postImage']['error'] > 0 ) {

    $extension = pathinfo($_FILES['postImage']['name'], PATHINFO_EXTENSION);
    $featureImage = uniqid() . '.' . $extension;
    $filePath = 'images/'.$featureImage;

    if ($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif") {
        $_SESSION['status'] = 'only jpg png jpeg & gif allowed';
        $_SESSION['statusType'] = '3';
        return header('location:postCreate.php');
    }

    if (!move_uploaded_file($_FILES["postImage"]["tmp_name"], $filePath)) {
        $_SESSION['status'] = 'Image not uploaded try again';
        $_SESSION['statusType'] = '3';
        return header('location:postCreate.php');
    }
}else{
    $featureImage = null;
}

    $postBody = htmlspecialchars($_POST['postBody']);
    $postTitle = $_POST['postTitle'];
    $postCategory = $_POST['postCategory'];
    $userId = $_SESSION['userId'];
    $q = "insert into posts (title,body,feature_image,categories,user_id) values ('$postTitle', '$postBody', '$featureImage', '$postCategory', '$userId')";
    $result = $conn->query($q);
    if ($result){
        return header('location:index.php');
    }else{
        return header('location:postCreate.php');
    }
}




/*save post as draft*/
elseif(isset($_POST['draftPost'])){

    if(!$_FILES['postImage']['error'] > 0 ) {

        $extension = pathinfo($_FILES['postImage']['name'], PATHINFO_EXTENSION);
        $featureImage = uniqid() . '.' . $extension;
        $filePath = 'images/'.$featureImage;

        if ($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif") {
            $_SESSION['status'] = 'only jpg png jpeg & gif allowed';
            $_SESSION['statusType'] = '3';
            return header('location:postCreate.php');
        }

        if (!move_uploaded_file($_FILES["postImage"]["tmp_name"], $filePath)) {
            $_SESSION['status'] = 'Image not uploaded try again';
            $_SESSION['statusType'] = '3';
            return header('location:postCreate.php');
        }
    }else{
        $featureImage = null;
    }

    $postBody = htmlspecialchars($_POST['postBody']);
    $postTitle = $_POST['postTitle'];
    $postCategory = $_POST['postCategory'];
    $userId = $_SESSION['userId'];
    $q = "insert into posts (title,body,feature_image,categories,user_id,status) values ('$postTitle', '$postBody', '$featureImage', '$postCategory', '$userId', 1 )";
    $result = $conn->query($q);
    if ($result){
        return header('location:postsDraft.php');
    }else{
        $_SESSION['status'] = 'Something Wrong Please Try Again ';
        $_SESSION['statusType'] = '3';
        return header('location:postCreate.php');
    }
}



else{
    $_SESSION['status'] = 'Something Wrong Please Try Again ';
    $_SESSION['statusType'] = '3';
    return header('location:postCreate.php');
}