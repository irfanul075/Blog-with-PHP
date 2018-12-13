<?php
session_start();
require 'DB/db_connect.php';

/*Verify Email Address & active account*/
if (isset($_GET['acc_code']) && !empty($_GET['acc_code'])) {

    $activation_code = $_GET['acc_code'];
    $email = $_GET['email'];
    $stmt = $conn->prepare('select id,active from users where activation_code = ? and email = ?');
    $stmt->bind_param('ss',$activation_code,$email);

     if($stmt->execute()){
        $result = $stmt->get_result();

        if($result->num_rows > 0){
             $user = $result->fetch_object();
             $status = $user->active;

             if ($status === 0){
                 $r = $conn->query("update users set active = 1 where id ='$user->id'");
                 $_SESSION['status']='Your Account activated Please Login';
                 $_SESSION['statusType']=1;  //1->success
                 return header('location:login.php');

             }else{

                 $_SESSION['status']='Email Already Confirm Please Login';
                 $_SESSION['statusType']=4;  //4->info
                 return header('location:login.php');//already confirm email
             }

         }else{
             $_SESSION['status']='email not found please try again';
             $_SESSION['statusType']=2;  //2->warning
             return header('location:register.php');
         }

     }else{
         $_SESSION['status']='Something Wrong Try Again';
         $_SESSION['statusType']=3; //3->error
         return header('location:register.php');
     }

}



/*Verify Reset Token Send Via Email and Show Password Reset Form*/
elseif (isset($_GET['reset_token']) && !empty($_GET['reset_token'])){
    $resetToken = $_GET['reset_token'];
    $resetEmail = $_GET['email'];

    $stmt = $conn->prepare("select * from password_resets where reset_token = ? and email = ?");
    $stmt->bind_param('ss',$resetToken,$resetEmail);
    if ($stmt->execute()){
        $userResult = $stmt->get_result();
        if ($userResult->num_rows > 0){
            return header("location:reset_form.php?resetToken='$resetToken'&resetEmail='$resetEmail'");
        }
        else{
            $_SESSION['status']='Invalid Password Reset Link';
            $_SESSION['statusType']=3; //3->error
            return header('location:password_reset.php');
        }
    }
    else{
        return header('location:password_reset.php');
    }
}

else {
    $_SESSION['status']='Something Wrong Try Again';
    $_SESSION['statusType']=3; //3->error
    return header('location:login.php');
}