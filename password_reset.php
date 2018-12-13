<?php
include 'layout/top.php';

?>


<div class="container">
    <div style="margin-top: 10%"></div>
    <!-- Material form login -->
    <div class="card">

        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Reset Password</strong>
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
                <!-- Sign in button -->
                <button class="btn btn-outline-info btn-block btn-rounded my-4 waves-effect z-depth-0" type="submit" name="resetButton">Reset</button>

            </form>
            <!-- Form -->

        </div>

    </div>
    <!-- Material form login -->
</div>

<?php include 'layout/bottom.php'; ?>
