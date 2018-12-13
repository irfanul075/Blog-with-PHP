<?php
include 'layout/top.php';
if($isLogin){
    header('location:dashboard.php');
}
?>
<div style="margin-top: 10%"></div>
<div class="container">
    <!-- Material form register -->
    <div class="card ">

        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Sign up</strong>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">


            <form id="checkPass" action="registerLogin.php" method="post" class="text-center needs-validation" style="color: #757575;" novalidate>
                <!-- Name -->
                <div class="md-form mt-4">
                    <input type="text" name="username" id="name" class="form-control" required>
                    <label for="name">Full Name</label>
                    <div class="invalid-feedback">
                        Please choose a username.
                    </div>
                </div>

                <!-- E-mail -->
                <div class="md-form mt-4">
                    <input type="email" name="email" id="email" class="is-valid form-control" required>
                    <label for="email">Email Address</label>
                    <div class="invalid-feedback">
                        Please choose a email.
                    </div>
                </div>

                <!-- Password -->
                <div class="md-form">
                    <input type="password" name="password" id="password" class="form-control" minlength="5" required>
                    <label for="password">Password</label>
                    <div class="invalid-feedback">
                        Please choose a password.
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="md-form">
                    <input type="password" minlength="5" id="confirmPassword" class="form-control" required>
                    <label for="confirmPassword">Confirm Password</label>
                    <div class="invalid-feedback">
                        password not matched.
                    </div>
                </div>
                <div class="md-form">
                    <div class="g-recaptcha" data-theme="dark" data-sitekey="6LczbXIUAAAAAGuSDhu6X2ThurEqWkwd_xv_wNWK"></div>
                    <?php
                    if (isset($_SESSION['captcha']) && $_SESSION['captcha'] == false){
                        echo '<small id="gcaptcha" class="float-left text-danger mb-2">Invalid Captcha</small>';
                    }
                    ?>
                </div>
                <button class="btn btn-outline-info btn-block btn-rounded my-4 waves-effect z-depth-0" type="submit" name="registerButton">Sign up</button>
                <div class="d-flex justify-content-around">
                    <div>
                        <!-- Register -->
                        <p>Already a member?
                            <a href="login.php"> Login</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Material form register -->
</div>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {

                var matchPass = false;

                var t = document.getElementById('checkPass');
                t.addEventListener('keyup', function (event) {
                    var a = document.getElementById('password');
                    var b = document.getElementById('confirmPassword');
                    if(a.value !== b.value){
                        matchPass = false;
                        b.classList.remove("valid", "is-valid");
                        b.classList.add("is-invalid", "invalid");
                    } else {
                        matchPass = true;
                        b.classList.remove("invalid","is-invalid");
                        b.classList.add("is-valid","valid");
                    }
                });
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }else if(!matchPass){
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

    </script>
<?php
unset($_SESSION['captcha']);
include "layout/bottom.php"
?>