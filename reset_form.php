<?php
include 'layout/top.php';

if (!isset($_GET['resetToken']) && empty($_GET['resetToken']) && empty($_GET['resetEmail'])){
    return header('location:password_reset.php');
}else{
    $resetToken = $_GET['resetToken'];
    $resetEmail = $_GET['resetEmail'];
}

?>


    <div class="container">
        <div style="margin-top: 20%"></div>
        <div class="card">

            <h5 class="card-header info-color white-text text-center py-4">
                <strong>Password Reset Form</strong>
            </h5>


            <div class="card-body px-lg-5 pt-0">

                <!-- Form -->
                <form id="checkPass" action="registerLogin.php" method="post" class="text-center needs-validation" style="color: #757575;" novalidate>
                    <input type="hidden" name="resetToken" value="<?php echo $resetToken; ?>">
                    <input type="hidden" name="resetEmail" value="<?php echo $resetEmail; ?>">
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

                    <button class="btn btn-outline-info btn-block btn-rounded my-4 waves-effect z-depth-0" type="submit" name="passResetButton">Change Password</button>
                </form>
                <!-- Form -->

            </div>

        </div>
        <!-- Material form login -->
    </div>
<script>

    (function() {
        'use strict';
        window.addEventListener('load', function() {

            var matchPass = false;

            var p = document.getElementById('checkPass');
            p.addEventListener('keyup', function (event) {
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
                console.log('first'+matchPass);
            });
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
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
<?php include 'layout/bottom.php'; ?>
