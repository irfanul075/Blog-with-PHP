<?php

include 'DB/db_connect.php';
include 'layout/admin_top.php';


if ($isLogin == true && $isAdmin == true){
    $userId = $_SESSION['userId'];
}else{
    return header('location:login.php');
}

$q = "select * from posts where status = 0 ";
$result = $conn->query($q); ?>
<table id="postTable" class="table table-responsive-sm">
    <thead>
    <tr>
        <th>Title</th>
        <th>Category</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if($result){

    if ($result->num_rows > 0){
        while ($post = $result->fetch_object()){ ?>
            <tr>
                <td><?php echo $post->title; ?></td>
                <td><?php echo $post->categories; ?></td>
                <td><?php $date=date_create($post->created_at);
                    echo date_format($date,"d F Y"); ?></td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <a href="postSingle.php?postId=<?php echo $post->id; ?>" class="btn btn-primary"><i class="fa fa-2x fa-eye"></i></a>
                        <?php if ($post->user_id == $userId) { ?>
                        <a href="postEditForm.php?postId=<?php echo $post->id; ?>" class="btn btn-secondary"><i class="fa fa-2x fa-edit"></i></a>
                        <?php } ?>
                        <a href="postDelete.php?postId=<?php echo $post->id; ?>" class="btn btn-danger delete-post"><i class="fa fa-2x fa-trash"></i></a>
                    </div>
                </td>
            </tr>
            <?php
        }
    } ?>
    </tbody>
</table>
<?php
}else{
    echo "you did not published any post";
}
?>





<script type="text/javascript" src="resources/js/addons/datatables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#postTable').DataTable();

        $(".delete-post").click(function () {

            if (confirm("Do You Really Want to Delete This Post ?")){
                return true;
            }else {
                return false;
            }
        });

    } );
</script>
<?php
include 'layout/admin_bottom.php';
?>
