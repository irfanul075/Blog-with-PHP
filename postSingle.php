<?php
include 'DB/db_connect.php';
include 'layout/top.php';


//Only owner see the draft post//
if(isset($_GET['draft']) && isset($_GET['postId'])) {
    if(!$isLogin == true){
        return header('location:login.php');
    }
    $userId = $_SESSION['userId'];
    if ($userId != $_GET['draft']){
        $_SESSION['status'] ="you don't have access to this post";
        $_SESSION['statusType'] = 2;
        return header('location:postsDraft.php');
    }
    $postId = $_GET['postId'];
    $result = $conn->query("select posts.*, users.name from posts inner join users on posts.user_id = users.id where posts.id = $postId and posts.status = 1 ");

    if ($result->num_rows > 0) {
        $post = $result->fetch_object();
    } else {
        $_SESSION['status'] = 'Incorrect Post Draft Id';
        $_SESSION['statusType'] = 3; //3->error
        return header('location:postsDraft.php');
    }
}

/*everyone see the published post*/
elseif(isset($_GET['postId'])){
    $hasComments = false;
    $userId = $_SESSION['userId'];
    $postId = $_GET['postId'];
    $result = $conn->query("select posts.*, users.name from posts inner join users on posts.user_id = users.id where posts.id = $postId and posts.status = 0 ");

    if ($result->num_rows > 0){
        $post = $result->fetch_object();
    }else{
        $_SESSION['status']='Incorrect Post Id';
        $_SESSION['statusType']=3; //3->error
        return header('location:index.php');
    }

    $commentAll = $conn->query("select comments.*, users.name, users.image from comments inner join users on comments.user_id = users.id where comments.post_id = '$postId' order by comments.created_at DESC ");
    if ($commentAll == true && $commentAll->num_rows > 0){
            $hasComments = true;
    }
}
else{
    return header('location:index.php');
}
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row mt-5">

            <!-- Post Content Column -->
            <div class="col-lg-8">

                <!-- Title -->
                <h1 class="mt-4"><?php echo $post->title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by
                    <span class="text-capitalize"><a href="userProfile.php?profileId=<?php echo $post->user_id; ?>"><?php echo $post->name; ?></a></span>
                </p>

                <hr>

                <!-- Date/Time -->
                <p>Posted on <?php
                    $date=date_create($post->created_at);
                    echo date_format($date,"d F Y"); ?></p>


                <!-- Preview Image -->
                <?php if($post->feature_image == null){ ?>
                    <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
                <?php }
                else{ ?>
                    <img class="card-img-top" src="images/<?php echo $post->feature_image; ?>" alt="Card image cap">
                <?php } ?>



                <!-- Post Content -->
                <div class="mt-3" style="overflow-wrap: break-word"><?php echo htmlspecialchars_decode($post->body); ?></div>
                <hr>
                <!-- Comments Form -->
                <div class="card my-4 z-depth-0 border">
                    <?php if ($isLogin){ ?>
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        <form method="post" action="comment.php">
                            <div class="form-group">
                                <input type="hidden" name="commenterId" value="<?php echo $userId; ?>">
                                <input type="hidden" name="postId" value="<?php echo $post->id; ?>">
                                <textarea name="commentBody" class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="comment">Submit</button>
                        </form>
                    </div>
                    <?php } else {
                        echo "<p class='text-center bg-light text-danger p-3'>please login to comment on post</p>";
                        } ?>
                </div>


                <!-- Post Comments -->
                <div class="card card-body mb-5 z-depth-0 border border-bottom-0">
                <?php if ($hasComments){
                        while($comment = $commentAll->fetch_object()){ ?>

                            <div class="media border border-default border-top-0 border-left-0 border-right-0 p-3">
                                <?php if($comment->image == null){ ?>
                                    <img class="d-flex mr-3 rounded-circle" src="images/profile/tempProfileImage.png" alt="image">
                                <?php } else{ ?>
                                    <img class="d-flex mr-3 rounded-circle" src="images/profile/<?php echo $comment->image; ?>" width="40" alt="image">
                                <?php } ?>
                                <div class="media-body">
                                    <h5 class="mt-0"><a href="userProfile.php?profileId=<?php echo $comment->user_id ?>"><?php echo $comment->name; ?></a></h5>
                                    <?php echo substr($comment->body,0,100); ?>
                                </div>
                            </div>
                <?php } } else{
                        echo "<p class='text-center text-danger p-2'>post has no comment</p>";
                    } ?>
                </div>
            </div>




            <!-- Sidebar Widgets Column -->
            <?php include 'layout/sidebar.php'; ?>
            <!-- Sidebar Widgets Column End-->
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

<?php
    include 'layout/footer.php';
    include 'layout/bottom.php';
?>