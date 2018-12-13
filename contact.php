<?php
include "layout/top.php";


$error = false;
/*Server side validation*/
    if(isset( $_POST['name']) && isset( $_POST['email']) && isset( $_POST['message']) && isset( $_POST['subject'])){

        /*validate reCaptcha*/
        $secretKey = "6LczbXIUAAAAAFLh_WVCHf9Otd4PUfao-ISawNMG";
        $responseKey = $_POST['g-recaptcha-response'];
        $userIP = $_SERVER['REMOTE_ADDR'];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
        $response = json_decode(file_get_contents($url));
        if(!$response->success){
            $_SESSION['captcha'] = false;
            return header('location:contact.php');
        }
        /* End validate reCaptcha*/

        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $subject = $_POST['subject'];
        if ($name === ''){
            $error = true;
        }
        if ($email === ''){
            $error = true;
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error = true;
            }
        }
        if ($subject === ''){
            $error = true;
        }
        if ($message === ''){
            $error = true;
        }

        if ($error){
            $_SESSION['status'] = 'invalid input';
            $_SESSION['statusType'] = 2;
            return header('location:contact.php');
        }


        require 'sendMail.php';
        $mail->addAddress("irfanul075@gmail.com");
        $mail->addReplyTo($email);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $response = $mail->send();
        if ($response){
            $_SESSION['status'] = 'Thanks For Contact Us';
            $_SESSION['statusType'] = 1;
            return header('location:contact.php');
        }else{
            $_SESSION['status'] = 'Something Wrong Please Try Again';
            $_SESSION['statusType'] = 3;
            return header('location:contact.php');
        }
    }
?>



<div style="margin-top: 5%"></div>
<div class="container">
    <section class="card card-body px-5 mb-5 section">

        <!--Section heading-->
        <h2 class="h1-responsive font-weight-bold text-center">Contact us</h2>
        <!--Section description-->
        <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
            matter of hours to help you.</p>

        <div class="row">
            <div class="col-md-9 mb-md-0 mb-5">
                <form id="contact-form" name="contact-form" action="contact.php" method="POST">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <input type="text" id="name" name="name" class="form-control">
                                <label for="name" class="">Your name</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="md-form mb-0">
                                <input type="text" id="email" name="email" class="form-control">
                                <label for="email" class="">Your email</label>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form mb-0">
                                <input type="text" id="subject" name="subject" class="form-control">
                                <label for="subject" class="">Subject</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="md-form">
                                <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                <label for="message">Your message</label>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form">
                                <div class="g-recaptcha" data-theme="dark" data-sitekey="6LczbXIUAAAAAGuSDhu6X2ThurEqWkwd_xv_wNWK"></div>
                                <?php
                                if (isset($_SESSION['captcha']) && $_SESSION['captcha'] == false){
                                    echo '<small id="gcaptcha" class="float-left text-danger mb-2">Invalid Captcha</small>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </form>
                <!--submit button-->
                <div class="text-center text-md-left">
                    <a class="btn btn-primary" onclick="validateForm()">Send</a>
                </div>
                <div id="status"></div>
            </div>


            <div class="col-md-3 text-center">
                <ul class="list-unstyled mb-0">
                    <li><i class="fa fa-map-marker fa-2x"></i>
                        <p>Chittagong, Bangladesh</p>
                    </li>

                    <li><i class="fa fa-phone mt-4 fa-2x"></i>
                        <p>880-1800000000</p>
                    </li>

                    <li><i class="fa fa-envelope mt-4 fa-2x"></i>
                        <p>irfanul075@gmail.com</p>
                    </li>
                </ul>
            </div>

        </div>
    </section>
</div>



    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        function validateForm() {
            var name =  document.getElementById('name').value;
            if (name == "") {
                document.getElementById('status').innerHTML = "Name cannot be empty";
                return false;
            }
            var email =  document.getElementById('email').value;
            if (email == "") {
                document.getElementById('status').innerHTML = "Email cannot be empty";
                return false;
            } else {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if(!re.test(email)){
                    document.getElementById('status').innerHTML = "Email format invalid";
                    return false;
                }
            }
            var subject =  document.getElementById('subject').value;
            if (subject == "") {
                document.getElementById('status').innerHTML = "Subject cannot be empty";
                return false;
            }
            var message =  document.getElementById('message').value;
            if (message == "") {
                document.getElementById('status').innerHTML = "Message cannot be empty";
                return false;
            }
            document.getElementById('status').innerHTML = "Sending...";
            document.getElementById('contact-form').submit();

        }
    </script>
<?php
unset($_SESSION['captcha']);
include "layout/footer.php";
include "layout/bottom.php";
?>