<?php
include 'DB/db_connect.php';
include 'checkUser.php';

if (!$isLogin){
    return header('location:login.php');
}

$isDraft = false;
$catResult = $conn->query("select name from categories");
/* ----update draft post---- */
if (isset($_GET['draft']) && isset($_GET['postId'])) {
    $postId = $_GET['postId'];
    $userId = $_SESSION['userId'];


    if ($userId != $_GET['draft']){
        $_SESSION['status'] ="You are not allowed to edit this post";
        $_SESSION['statusType'] = 2;
        return header('location:postsDraft.php');
    }else{
        $isDraft = true;
        $result = $conn->query("select * from posts where id = '$postId' and user_id = '$userId' and status = 1 ");
        if ($result){
            $post = $result->fetch_object();
        }else{
            $_SESSION['status'] = 'Draft posts not update';
            $_SESSION['statusType'] = 3;
            return header('location:postsDraft.php');
        }
    }
}


/* ----update published post---- */
elseif (isset($_GET['postId'])) {

    $postId = $_GET['postId'];
    $userId = $_SESSION['userId'];
    $checkOwner = $conn->query("select user_id from posts where id = $postId ");
    $r = $checkOwner->fetch_object();

    //check user has right to edit this post or not
    if ((int)$r->user_id !== $userId){
        $_SESSION['status'] = 'You are not allowed to edit this post';
        $_SESSION['statusType'] = 3;
        return header('location:myPosts.php');

    }else{
        $isDraft = false;
        $result = $conn->query("select * from posts where id = '$postId' and status = 0");
        $post = $result->fetch_object();
    }
}

else{
    return header('location:myPosts.php');
}
session_abort();
?>

<?php include 'layout/admin_top.php'; ?>
<div class="mt-5"></div>

<form method="post" action="postUpdate.php" enctype="multipart/form-data">

    <input type="hidden" name="postId" value="<?php echo $postId; ?>">

    <input type="text" class="form-control mb-4" name="postTitle" value="<?php echo $post->title; ?>" required>

    <textarea class="form-control rounded-0" id="mytextarea" name="postBody" rows="3"><?php echo $post->body; ?></textarea>

    <select name="postCategory" class="mdb-select md-form md-form dropdown-secondary" searchable="Search here..">
        <option value="" disabled selected>Choose Category</option>
        <option value="Others">Others</option>
        <?php
        if ($catResult){
            while ($cat = $catResult->fetch_object()){
                if ($cat->name == $post->categories){ ?>
                    <option value="<?php echo $cat->name; ?>" selected>
                        <?php echo $cat->name; ?>
                    </option>
                <?php }else{ ?>
                    <option value="<?php echo $cat->name; ?>" >
                        <?php echo $cat->name; ?>
                    </option>
                <?php }
            }
        } ?>
    </select>
    <!--if image not update by user-->
    <input type="hidden" name="postImage" value="<?php echo $post->feature_image; ?>">

    <div class="custom-file mt-3 col-sm-4">
        <input type="file" name="postImage" class="custom-file-input" accept=".png, .jpg, .jpeg .gif">
        <label class="custom-file-label">Update featured image (750x300)</label>
    </div>

    <div>
        <?php
        if($isDraft){
            echo "<button class='btn btn-primary btn-sm mt-3' name='updateDraft'>Update Draft</button>";
            echo "<button class='btn btn-primary btn-sm mt-3' name='publishDraft'>Publish</button>";
        }else{
            echo "<button class='btn btn-primary btn-sm mt-3' name='postUpdate'>Update</button>";
        }
        ?>

    </div>

</form>



<!--Tiny MCE Setting-->
<script>
    $(document).ready(function() {
        $('.mdb-select').material_select();
    });
    tinymce.init({
        selector: '#mytextarea',
        branding: false,
        height: 400,
        plugins: 'preview fullscreen link codesample table hr anchor insertdatetime lists textcolor wordcount colorpicker paste textpattern help',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat | paste',

        /* content_css: [
             '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
             '//www.tinymce.com/css/codepen.min.css']*/
    });
</script>
<!--End TinyMCE Setting-->


<?php include 'layout/admin_bottom.php';?>

