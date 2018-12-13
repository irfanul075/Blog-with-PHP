<?php include'layout/top.php';
if($isLogin){
    header('location:dashboard.php');
}
?>


<div class="container">
    <div style="margin-top:20%"></div>
    <!-- Material form login -->
    <div class="card col-sm-8" style="margin:auto">

        <h5 class="card-header info-color white-text text-center py-3 mb-4">
            <strong>Sign in</strong>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">

            <!-- Form -->
            <form class="text-center" style="color: #757575;" action="registerLogin.php" method="post">

                <!-- Email -->
                <div class="md-form">
                    <input type="email" id="loginEmail" name="email" class="form-control" required>
                    <label for="loginEmail">E-mail</label>
                </div>

                <!-- Password -->
                <div class="md-form">
                    <input type="password" id="loginPassword" name="password" class="form-control" required>
                    <label for="loginPassword">Password</label>
                </div>

                <!-- Sign in button -->
                <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="loginButton">Login</button>
                <div class="d-flex justify-content-around">
                    <div>
                        <!-- Register -->
                        <p>Not a member?
                            <a href="register.php">Register</a>
                        </p>
                    </div>
                    <div>
                        <!-- Forgot password -->
                        <a href="password_reset.php">Forgot password?</a>
                    </div>
                </div>
            </form>
            <!-- Form -->

        </div>

    </div>
    <!-- Material form login -->
</div>

<?php include 'layout/bottom.php'?>
