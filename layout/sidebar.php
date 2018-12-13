
<?php
$category = $conn->query("select name from categories");
$recentPosts = $conn->query("select id,title,body from posts where status = 0 limit 5 ");
if ($recentPosts){
    $recentPosts = $recentPosts->fetch_all();
}

?>
<div class="col-md-4">

    <!-- Search Widget -->
    <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
            <form class="form-inline md-form mr-auto mb-4" method="post" action="index.php">
                <input class="form-control mr-sm-2" type="text" name="searchTerm" placeholder="Search Post" aria-label="Search">
                <button class="btn btn-deep-purple btn-sm my-0" name="searchPost" type="submit"><i class="fa fa-search mr-2" aria-hidden="true"></i>Search</button>
            </form>
        </div>
    </div>

    <!-- Categories Widget -->
    <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
            <div class="row">
                <?php if ($category){
                    $allCats = $category->fetch_all();
                    foreach ($allCats as $cat){ ?>
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a href="index.php?catName=<?php echo $cat[0]; ?> "><?php echo $cat[0] ?></a>
                                </li>
                            </ul>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
    <!-- Side Widget -->
    <div class="card my-4">
        <h5 class="card-header">Recent Post</h5>
        <div class="card-body p-0">
            <div class="list-group p-0 m-0">
                <?php foreach ($recentPosts as $postTitle){ ?>
                <a href="postSingle.php?postId=<?php echo "$postTitle[0]"; ?>" class="text-secondary font-weight-bold list-group-item list-group-item-action">
                    <?php echo $postTitle[1]; ?>
                    <p class="text-dark font-weight-normal"> <?php $body =  htmlspecialchars_decode($postTitle[2]);
                        $body = strip_tags($body);
                        echo substr($body,0,80);
                        ?></p>
                </a>
                <?php } ?>
            </div>
        </div>
    </div>

</div>