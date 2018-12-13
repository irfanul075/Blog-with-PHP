<?php
include 'layout/admin_top.php';
include 'DB/db_connect.php';

$result = $conn->query("select name from categories");

?>


<div class="mt-5"></div>

<form method="post" action="postStore.php" enctype="multipart/form-data">
     <input type="text" class="form-control mb-4" name="postTitle" placeholder="Post Title Here" required>
     <textarea class="form-control rounded-0" id="mytextarea" name="postBody" rows="3"></textarea>

    <select name="postCategory" class="mdb-select md-form dropdown-ins" searchable="Search here..">
        <option value="" disabled selected>Choose category</option>
        <option value="other">Others</option>
        <?php if ($result){
                while ($cat = $result->fetch_object()){ ?>
                    <option value="<?php echo $cat->name; ?>"><?php echo $cat->name; ?></option>
                <?php }
        } ?>
    </select>
    <div class="custom-file mt-3 col-sm-4">
        <input type="file" name="postImage" class="custom-file-input">
        <label class="custom-file-label">Upload featured image (750x300)</label>
    </div>
    <div>
        <button class="btn btn-primary btn-sm mt-3" name="pubPost">publish</button>
        <button class="btn btn-primary btn-sm mt-3" name="draftPost">Draft</button>
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
            menubar: "edit",
            plugins: 'preview fullscreen link codesample table hr anchor insertdatetime lists textcolor wordcount colorpicker paste textpattern help',
            toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat | paste',

           /* content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css']*/
        });
    </script>
    <!--End TinyMCE Setting-->

<?php include 'layout/admin_bottom.php' ?>