<?php
include 'layout/top.php';
include 'DB/db_connect.php';

if(isset($_GET['profileId'])){
    $havePost = true;
    $userId = $_GET['profileId'];

    $user = $conn->query("select name, email, image from users where active = 1 and id = '$userId' ");
    $post = $conn->query("select * from posts where status = 0 and user_id = '$userId' ");

    if ($post){
        if (!$post->num_rows > 0){
            $havePost = false;
        }
    }else{
        $havePost = false;
    }

    if ($user){
        $userData = $user->fetch_object();
    }else{
        return header('location:index.php');
    }
}else{
    return header('location:updateProfile.php');
}


?>

    <div class="container">

        <div class="card testimonial-card mb-5 mt-5">

            <!-- Background color -->
            <div class="card-up indigo lighten-1"></div>

            <!-- Avatar -->
            <div class="avatar mx-auto white">
                <?php if($userData->image == null){ ?>
                    <img src="images/profile/tempProfileImage.png" class="rounded-circle" alt="avatar">
                <?php } else{ ?>
                    <img src="images/profile/<?php echo $userData->image; ?>" class="rounded-circle" alt="avatar">
                <?php } ?>
            </div>

            <div class="card-body">
                <h4 class="card-title"><?php echo $userData->name; ?></h4>
                <p class="card-text"><i class="fa fa-send mr-2" aria-hidden="true"></i><?php echo $userData->email; ?></p>
                <hr>
            </div>
        </div>


        <!--User Posts-->

        <section class=" card card-body text-center my-5">

            <h4 class="h1-responsive"><?php echo $userData->name; ?>'s Posts <hr></h4>

            <!-- Grid row -->
            <div class="row">
                <?php if ($havePost == true){
                    while($userPost = $post->fetch_object()){ ?>


                <!-- Grid column -->
                <div class="col-lg-4 col-sm-6 mb-lg-0 my-5">

                    <!-- Featured image -->
                    <div class="view overlay rounded z-depth-2 mb-4">
                        <img class="img-fluid" src="images/<?php echo $userPost->feature_image; ?>" alt="Sample image">
                        <a>
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>

                    <!-- Category -->
                    <a href="index.php?catName=<?php echo $userPost->categories; ?>" class="pink-text"><h6 class="font-weight-bold mb-3"><i class="fa fa-map pr-2"></i><?php echo $userPost->categories; ?></h6></a>
                    <!-- Post title -->
                    <h4 class="font-weight-bold mb-3"><strong><?php echo $userPost->title; ?></strong></h4>
                    <!-- Excerpt -->
                    <p class="dark-grey-text">
                        <?php $body =  htmlspecialchars_decode($userPost->body);
                        $body = strip_tags($body);
                        echo substr($body,0,80  );
                        ?>
                    </p>
                    <!-- Read more button -->
                    <a href="postSingle.php?postId=<?php echo $userPost->id; ?>" class="btn btn-pink btn-rounded btn-md">Read more</a>

                </div>
                <!-- Grid column -->

                <?php } }else{ ?>
                    <p class="text-danger font-weight-bold" style="margin-bottom:20%">User Not Published Any Post</p>;
                <?php } ?>
            </div>
            <!-- Grid row -->

        </section>









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