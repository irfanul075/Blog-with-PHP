<?php
include 'checkUser.php';
if ($isLogin == true && $isAdmin == true){
    $userId = $_SESSION['userId'];
}else{
    return header('location:login.php');
}
session_abort();
include 'DB/db_connect.php';
include 'layout/admin_top.php';

$allUsers = "select * from users where user_type = 0 ";
$result = $conn->query($allUsers); ?>
    <table id="postTable" class="table table-responsive-sm">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Last Update</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if($result){
        if ($result->num_rows > 0){
            while ($singleUser = $result->fetch_object()){ ?>
                <tr>
                    <td><?php echo $singleUser->name; ?></td>
                    <td><?php echo $singleUser->email; ?></td>
                    <td>
                        <?php
                        if ($singleUser->active == 1){
                            echo "Active";
                        }else{
                           echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='User Not Confirm His Email'>Pending</span>";
                        }
                        ?>
                    </td>
                    <td><?php $date=date_create($singleUser->created_at);
                        echo date_format($date,"d F Y"); ?></td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="userProfile.php?userId=<?php echo $singleUser->id; ?>" class="btn btn-primary"><i class="fa fa-2x fa-eye"></i></a>
                            <a href="userDelete.php?userId=<?php echo $singleUser->id; ?>" class="btn btn-danger delete-user"><i class="fa fa-2x fa-trash"></i></a>
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

            $('#postTable').DataTable(); //initialize DataTable JS plugin
            $('[data-toggle="tooltip"]').tooltip(); //initialize the tooltip used in table column

            $(".delete-user").click(function () {

                if (confirm("Do You Really Want to Delete This Account ?")){
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