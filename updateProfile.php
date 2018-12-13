<?php
include 'layout/top.php';
include 'DB/db_connect.php';
if(!$isLogin){
    return header('location:login.php');
}
$userId = $_SESSION['userId'];
$result = $conn->query("select * from users where id = '$userId' ");
if ($result){
    $user = $result->fetch_object();
}
else{
    $_SESSION['status'] = 'Something Error';
    $_SESSION['statusType'] = 3;
    return header('location:index.php');
}
?>

<div class="container">
<!-- Card -->
<div class="card testimonial-card mb-5 mt-5">

    <!-- Background color -->
    <div class="card-up indigo lighten-1"></div>

    <!-- Avatar -->
    <div class="avatar mx-auto white">
        <?php if($user->image == null){ ?>
            <img src="images/profile/tempProfileImage.png" class="rounded-circle" alt="avatar">
       <?php } else{ ?>
            <img src="images/profile/<?php echo $user->image; ?>" class="rounded-circle" alt="avatar">
        <?php } ?>
    </div>

    <a data-toggle="modal" data-target="#updateImage" class="btn-floating btn-action ml-auto mr-5 pink"><i class="fa fa-upload m-auto"></i></a>
    <!-- Content -->
    <div class="card-body">
        <!-- Name -->
        <h4 class="card-title"><?php echo $user->name; ?></h4>
        <hr>

        <!-- update form -->
        <form class="text-center border border-light p-5" method="post" action="updateUser.php">

            <p class="h4 mb-4">Profile</p>

            <!-- name -->
            <input type="text" class="form-control mb-4" name="userName" value="<?php echo $user->name; ?>" required>

            <!-- email -->
            <input disabled type="text" class="form-control mb-4" value="<?php echo $user->email; ?>">

            <!-- Update button -->
            <button class="btn btn-info btn-block my-4" name="updateProfileInfo" type="submit">Update Profile</button>

        </form>

    </div>
</div>
<!-- Card -->

    <?php include 'changePassword.php'; ?>


    <div style="margin-bottom: 2%"></div>


    <!-- Modal used for update profile-->
    <div class="modal fade" id="updateImage" tabindex="-1" role="dialog" aria-labelledby="updateImage" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <form class="md-form" action="updateUser.php" method="post" enctype="multipart/form-data">
                        <div class="file-field">
                            <div class="z-depth-1-half mb-4">
                                <img src="images/profile/tempProfileImage.png" class="img-fluid" alt="example placeholder">
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="btn btn-mdb-color btn-rounded float-left">
                                    <span class="word-wrap" id="callForm">Choose file</span>
                                    <input id="userFile" type="file" name="profileImage">
                                </div>
                                <button class="btn btn-mdb-color btn-rounded" name="updateProImage">Update Image</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->

</div>
    <script>
        $(document).ready(function() {
           //show profile image name when update button click
            $("#userFile").change(function(e){
                var imageName = e.target.files[0].name;
                var a = $("#callForm").text(imageName);
            });

        });
    </script>
<?php
include 'layout/footer.php';
include 'layout/bottom.php';