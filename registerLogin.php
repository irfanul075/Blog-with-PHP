<?php
include 'checkUser.php';
require 'DB/db_connect.php';

/* ---------------User Registration--------------- */
if (isset($_POST['registerButton'])) {

    /*validate reCaptcha*/
    $secretKey = "6LczbXIUAAAAAFLh_WVCHf9Otd4PUfao-ISawNMG";
    $responseKey = $_POST['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
    $response = json_decode(file_get_contents($url));
    if(!$response->success){
        $_SESSION['captcha'] = false;
        return header('location:register.php');
    }
    /* End validate reCaptcha*/

    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $activation_code = md5(mt_rand(0, 100));

    $stmt = $conn->prepare("insert into users(name, email, password,activation_code) values (?,?,?,?)");
    $stmt->bind_param("ssss", $name, $email, $password, $activation_code);

    if ($stmt->execute()) {

        /* ------------ Sent Confirmation Email To User ------------ */
        $url = 'http://localhost/fieldworkProject/verify.php?email=' . $email . '&acc_code=' . $activation_code;
        $messageBody = "
        <div>
            <h2>Hello <strong>$name</strong></h2>
            <p style='color: red;margin-bottom: 30px'>
                please click below button to active your account
            </p>
            <div><a style='background-color:black; color:white; padding:20px; text-align:center; text-decoration:none' href='$url'>
                Confirm Email</a>
            </div>
        </div>";

        /*send message using php mailer*/
        require 'sendMail.php';
        $mail->addAddress($email);
        $mail->Subject = "Account Confirmation";
        $mail->Body = $messageBody;
        $response = $mail->send();
         if($response){
             $_SESSION['status']='Please confirm your email to active your account';
             $_SESSION['statusType']=1; //1->success
             header('location:login.php');
         }else{
             $_SESSION['status']='Incorrect information Try Again';
             $_SESSION['statusType']=3; //3->error
             header('location:register.php');
         }
        /* ------------ End Sent Confirmation Email To User ------------ */
    } else {
        header('location:register.php');//with error
    }
}
/*End User Registration*/



/* ---------------User Login--------------- */
elseif (isset($_POST['loginButton'])){

    if (!isset($_POST['email']) && empty($_POST['email']) || !isset($_POST['password']) && empty($_POST['password'])){

        header('location:login.php');
    }
    else{

        $email = $_POST['email'];
        $password = $_POST['password'];
        $stmt = $conn->prepare("select * from users where email = ?");
        $stmt->bind_param('s',$email);
        if ($stmt->execute()){
            $result = $stmt->get_result();
            if ($result->num_rows > 0){

                $user = $result->fetch_object();
                if ($user->active === 0){
                    $_SESSION['status']='Please confirm your email to active your account';
                    $_SESSION['statusType']=2; //3->error
                    header('location:login.php'); //user not active his account
                }
                else{
                    /*check password*/
                    if (password_verify($password,$user->password)){
                        $_SESSION['isLogin'] = true;
                        $_SESSION['username'] = $user->name;
                        $_SESSION['email'] = $user->email;
                        $_SESSION['userId'] = $user->id;
                        if ($user->user_type === 1){
                            $_SESSION['isAdmin'] = true;
                        }
                        header('location:dashboard.php'); //password match
                    }
                    else{
                        $_SESSION['status']='Wrong Email or Password Please Try Again';
                        $_SESSION['statusType']=3; //3->error
                        header('location:login.php'); // password not match
                    }
                }
            }
            else{
                $_SESSION['status']='User Not Found';
                $_SESSION['statusType']=3; //3->error
                header('location:login.php');//number of row 0
            }
        }
        else{
            $_SESSION['status']='Please Try Again';
            $_SESSION['statusType']=3; //3->error
            header('location:login.php'); //query execute error
        }
    }
}
/*End User Login*/



/* ---------------Password Reset--------------- */
elseif (isset($_POST['resetButton'])){

        $resetEmail = $_POST['email'];
        $result = $conn->query("select email from users where email = '$resetEmail' and active=1");
        if ($result->num_rows > 0){
            $resetToken = md5(mt_rand(0, 100));
            $resetResult = $conn->query("insert into password_resets(email,reset_token) values('$resetEmail','$resetToken')");
            if ($resetResult){

                $resetUrl = 'http://localhost/fieldworkProject/verify.php?email=' . $resetEmail. '&reset_token=' . $resetToken;

                $emailBody = "
                <h3>Click Below Button to reset your account</h3>
                <div><a style='background-color:black; color:white; padding:20px; text-align:center; text-decoration:none' href='$resetUrl'>
                Reset Password</a></div>
                ";

                /*send message using php mailer*/
                require 'sendMail.php';
                $mail->addAddress($resetEmail);
                $mail->Subject = "Password Reset";
                $mail->Body = $emailBody;
                $response = $mail->send();

                if ($response){
                    $_SESSION['status']='A password reset link send to your email';
                    $_SESSION['statusType']=4;
                    header('location:password_reset.php');
                }else{
                    $_SESSION['status']='Please Try Again';
                    $_SESSION['statusType']=3; //3->error
                    header('location:password_reset.php');
                }
            }
            else{
                header('location:password_reset.php');
            }
        }
        else{
            $_SESSION['status']='Email Not Found or Not Confirm';
            $_SESSION['statusType']=3; //3->error
            header('location:password_reset.php');
        }
}
/*End Password Reset*/


/* ---------------Reset Password and clear reset token--------------- */
elseif (isset($_POST['passResetButton'])){
        $currentToken = $_POST['resetToken'];
        $currentEmail = $_POST['resetEmail'];
        $newPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $resetResult = $conn->query("select email from password_resets where reset_token = $currentToken and email = $currentEmail");

        if ($resetResult->num_rows > 0){
            $r = $conn->query("update users set password ='$newPassword' where email = $currentEmail ");
            if($r){
                $conn->query("delete from password_resets where email= $currentEmail ");
                $_SESSION['status']='you have successfully reset your password';
                $_SESSION['statusType']=1;
                header('location:login.php');
            }
        }
        else{
            return header('location:password_reset.php');
        }
}
/*Reset Password and clear reset token*/



/*Change Password by logged in user*/
elseif (isset($_POST['changePassButton'])){

    if ($isLogin == false){
        return header('location:login.php');
    }

    $currentUserEmail = $_SESSION['email'];
    $result = $conn->query("select password from users where email = '$currentUserEmail' ");
    if($result->num_rows > 0){
        $currentPassword = $result->fetch_object()->password;
        $checkPass = password_verify($_POST['oldPassword'],$currentPassword);
        if ($checkPass){
            $newPassword = password_hash($_POST['newPassword'],PASSWORD_BCRYPT);
            $stmt = $conn->prepare("update users set password = ? where email = '$currentUserEmail' ");
            $stmt->bind_param('s',$newPassword);
            if ($stmt->execute()){
                session_unset();
                $_SESSION['status']='you have successfully change your password';
                $_SESSION['statusType']=1;
                return header('location:login.php');
            }
        }
        else{
            $_SESSION['status']='wrong password';
            $_SESSION['statusType']=3;
            return header('location:changePassword.php');
        }
    }
    else{
        return header('location:login.php');
    }
}
/*End Change Password by logged in user*/



/*logout*/
elseif(isset($_POST['logoutButton'])){

    if ($isLogin == false){
        return header('location:login.php');
    }
        session_unset();
        session_destroy();
        header('location:login.php');
}
/*end Logout*/


else {
    return header('location:login.php');
}

