<?php
if (!$isLogin){
    header('location:login.php');
}
?>

        <div class="card ">

            <h5 class="card-header info-color white-text text-center py-3 indigo lighten-1">
                <strong>Update Password</strong>
            </h5>

            <!--Card content-->
            <div class="card-body px-lg-5 pt-0">


                <form id="checkPass" action="registerLogin.php" method="post" class="text-center needs-validation" style="color: #757575;" novalidate>

                    <!-- Old Password -->
                    <div class="md-form mt-4">
                        <input type="password" name="oldPassword" id="oldPassword" class="is-valid form-control" required>
                        <label for="oldPassword">Current Password</label>
                        <div class="invalid-feedback">
                            Please choose Current Password.
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="md-form">
                        <input type="password" name="newPassword" id="password" class="form-control" minlength="5" required>
                        <label for="password">New Password</label>
                        <div class="invalid-feedback">
                            Please choose New password.
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="md-form">
                        <input type="password" minlength="5" id="confirmPassword" class="form-control" required>
                        <label for="confirmPassword">Confirm New Password</label>
                        <div class="invalid-feedback">
                            password not matched.
                        </div>
                    </div>

                    <button class="btn btn-outline-info btn-block btn-rounded my-4 waves-effect z-depth-0" type="submit" name="changePassButton">Update Password</button>
                </form>
            </div>
        </div>
        <!-- Material form register -->
    </div>

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {

                var matchPass = false;

                var v = document.getElementById('checkPass');
                v.addEventListener('keyup', function (event) {
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
