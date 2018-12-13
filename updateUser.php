<?php
include 'DB/db_connect.php';
include 'checkUser.php';
if(!$isLogin){
    return header('location:login.php');
}
$userId = $_SESSION['userId'];
/*  -----update user Profile image-----  */
if (isset($_POST['updateProImage'])){

    /*update image if exist*/
    if(!$_FILES['profileImage']['error'] > 0 ) {

        $extension = pathinfo($_FILES['profileImage']['name'], PATHINFO_EXTENSION);
        $profileImage = uniqid() . '.' . $extension;
        $filePath = 'images/profile/'.$profileImage;

        if ($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif") {
            $_SESSION['status'] = 'only jpg png jpeg & gif allowed';
            $_SESSION['statusType'] = '3';
            return header('location:updateProfile.php');
        }

        if (!move_uploaded_file($_FILES["profileImage"]["tmp_name"], $filePath)) {
            $_SESSION['status'] = 'Image not uploaded try again';
            $_SESSION['statusType'] = '3';
            //return header('location:updateProfile.php');
        }

        $result = $conn->query("update users set image = '$profileImage' where id = '$userId' ");
        if ($result){
            return header('location:updateProfile.php');

        } else{
            $_SESSION['status'] = 'Something Wrong image not Update';
            $_SESSION['statusType'] = 3;
            return header('location:updateProfile.php');
         }

    }else{
        $_SESSION['status'] = 'Please select image';
        $_SESSION['statusType'] = 2;
        return header('location:updateProfile.php');
    }
}
/*  -----update user Profile image-----  */


elseif (isset($_POST['updateProfileInfo'])){
        $userName = $_POST['userName'];
        $updateName = $conn->query("update users set name = '$userName' where id = '$userId' ");
        if ($updateName){
            return header('location:updateProfile.php');
        }else{
            $_SESSION['status'] = 'Name Not Update Something Wrong';
            $_SESSION['statusType'] = 3;
            return header('location:updateProfile.php');
        }
}

else{
    $_SESSION['status'] = 'Something Wrong Please Try Again';
    $_SESSION['statusType'] = 3;
    return header('location:updateProfile.php');
}

