<?php
include 'DB/db_connect.php';
include 'layout/top.php';

$notFound = false;
/*$result = $conn->query("select posts.*, users.name from posts inner join users on posts.user_id = users.id where posts.status = 0 order by posts.created_at DESC ");*/

if (isset($_GET['catName'])){
    $catName = $_GET['catName'];
    $result = $conn->query("select posts.*, users.name from posts inner join users on posts.user_id = users.id where posts.status = 0 and posts.categories = '$catName' order by posts.created_at DESC ");
}

elseif (isset($_POST['searchPost'])){
        $searchTerm = $_POST['searchTerm'];
        $result = $conn->query("select posts.*, users.name from posts inner join users on posts.user_id = users.id where posts.status = 0 and posts.title Like '%$searchTerm%' or posts.body like '%$searchTerm%' order by posts.created_at DESC ");
}

/*Apply pagination*/
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 6;
        $offset = ($pageno-1) * $no_of_records_per_page;

    $total_pages_sql = "SELECT COUNT(*) FROM posts";
    $result = mysqli_query($conn,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    $result = $conn->query("select posts.*, users.name from posts inner join users on posts.user_id = users.id where posts.status = 0 order by posts.created_at DESC LIMIT $offset, $no_of_records_per_page");

?>


<!-- Page Content -->
<div class="container">

    <div class="row mt-5">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <div class="mt-5"></div>
            <!--<h1 class="my-4">Page Heading
                <small>Secondary Text</small>
            </h1>-->

            <?php
            if ($result->num_rows > 0){
            while ($post = $result->fetch_object()){
            ?>
                <!-- Blog Post -->
                <div class="card mb-4">
                    <?php if($post->feature_image == null){ ?>
                        <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
                    <?php }
                    else{ ?>
                        <img class="card-img-top" src="images/<?php echo $post->feature_image; ?>" alt="Card image cap">
                    <?php } ?>
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $post->title; ?></h2>
                        <p class="card-text">
                            <?php $body =  htmlspecialchars_decode($post->body);
                            $body = strip_tags($body);
                            echo substr($body,0,200);
                            ?>
                        </p>

                        <a href="postSingle.php?postId=<?php echo $post->id; ?>" class="btn btn-sm btn-primary">Read More</a>

                    </div>
                    <div class="card-footer text-muted">
                        <div class="row">
                        <div class="col-sm-8">
                            Posted on <?php
                            $date=date_create($post->created_at);
                            echo date_format($date,"d F Y"); ?>
                            <span> by</span><a class="font-weight-bold text-capitalize" href="userProfile.php?profileId=<?php echo $post->user_id ?>"> <?php echo $post->name; ?></a>
                        </div>
                        <div class="col-sm-4"><a href="index.php?catName=<?php echo $post->categories; ?>"><span class="py-2 px-2 badge badge-pill indigo"><?php echo $post->categories; ?></span></a></div>
                        </div>
                     </div>
                </div>
            <?php
            }
            }else{
                $notFound = true;
            echo "<p class='text-center p-2 bg-default'>No Post Found</p>";
            } ?>


            <?php if (!$notFound){ ?>
            <nav aria-label="Page navigation" class="grey lighten-3">
            <ul class="pagination pg-blue justify-content-center font-weight-bold">
                <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
                <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
                </li>
                <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                </li>
                <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
            </ul>
            </nav>
            <?php } ?>

        </div>

        <!-- Sidebar Widgets Column -->
        <?php include 'layout/sidebar.php'; ?>
        <!-- Sidebar Widgets Column End -->

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<?php
include 'layout/footer.php';
include 'layout/bottom.php';
?>
