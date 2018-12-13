<?php

include 'DB/db_connect.php';
include 'layout/admin_top.php';


if ($isLogin == true && $isAdmin == true){
    $userId = $_SESSION['userId'];
}else{
    return header('location:login.php');
}

$result = $conn->query("select comments.*, users.name, posts.title from ((comments inner join posts on comments.post_id = posts.id)inner join users on comments.user_id = users.id) order by comments.created_at DESC");

?>
<table id="postTable" class="table table-responsive-sm">
    <thead>
    <tr>
        <th>Commenter</th>
        <th>Comment</th>
        <th>Commented Post</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
<?php
if($result){
if ($result->num_rows > 0){
    while ($data = $result->fetch_object()){ ?>
            <tr>
                <td><a href="userProfile.php?profileId=<?php echo $data->user_id; ?>"><?php echo $data->name; ?></a></td>
                <td><?php echo $data->body; ?></td>
                <td><?php echo $data->title; ?></td>
                <td><?php $date=date_create($data->created_at);
                    echo date_format($date,"d F Y"); ?></td>
                <td>
                    <div class="btn-group btn-group-sm">
                    <a href="postSingle.php?postId=<?php echo $data->post_id; ?>" class="btn btn-primary"><i class="fa fa-2x fa-eye"></i></a>
                    <a href="comment.php?commentId=<?php echo $data->id; ?>" class="btn btn-danger delete-comment"><i class="fa fa-2x fa-trash"></i></a>
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
    echo "no comment found";
}
?>





<script type="text/javascript" src="resources/js/addons/datatables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#postTable').DataTable();

        $(".delete-comment").click(function () {

            if (confirm("Do You Really Want to Delete This Comment ?")){
                return true;
            }else {
                return false;
            }
        });

    });
</script>
<?php
include 'layout/admin_bottom.php';
?>
