<?php
include 'checkUser.php';
include 'DB/db_connect.php';

if($isAdmin==false){
    header('location:login.php');
}
session_abort();
include 'layout/admin_top.php';
$result = $conn->query("select * from categories");
?>

<div class="container-fluid">

    <!--add category form-->
    <div class="card card-body pl-5">
        <form action="categoriesStore.php" method="post">
            <div class="form-row">

                <div class="col-sm-5">
                    <div class="md-form">
                        <input type="text" id="catname" name="categoryName" class="form-control" placeholder="Category name" required>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="md-form">
                        <input type="text" id="slug" name="categorySlug" class="form-control" placeholder="slug" readonly>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="md-form">
                        <button class="ml-5 btn btn-deep-purple btn-sm" name="addCat">Add Categories</button>
                    </div>
                </div>

            </div>
        </form>
    </div>


    <!--show all Categories-->
    <div class="mt-5 card card-body">
    <table id="catTable" class="table table-sm table-responsive-sm">
        <thead>
        <tr>
            <th>Category Name</th>
            <th>Slug</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if($result){
        if ($result->num_rows > 0){
            while ($categories = $result->fetch_object()){ ?>
                <tr>
                    <td><?php echo $categories->name; ?></td>
                    <td><?php echo $categories->slug; ?></td>
                    <td>
                    <div class="btn-group btn-group-sm">
                    <a href="categories.php?catId=<?php echo $categories->id; ?>" class="btn btn-danger delete-cat"><i class="fa fa-trash"></i></a>
                    </div>
                    </td>
                </tr> <?php } } } ?>
        </tbody>
    </table>
    </div>
</div>

    <script type="text/javascript" src="resources/js/addons/datatables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#catTable').DataTable();

            $(".delete-cat").click(function () {

                if (confirm("Do You Really Want to Delete This Category ?")){
                    return true;
                }else {
                    return false;
                }
            });

        });


        /*slug generator*/
        $("#catname").on("keyup mouseleave submit",function () {
            var str = $("#catname").val();
            var slug= string_to_slug(str);
            $("#slug").val(slug);
        });

        /*making slug for clean category url*/
        function string_to_slug(str) {
            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
            var to   = "aaaaeeeeiiiioooouuuunc------";
            for (var i=0, l=from.length ; i<l ; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }
            str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                .replace(/\s+/g, '-') // collapse whitespace and replace by -
                .replace(/-+/g, '-'); // collapse dashes
            return str;
        }

    </script>


<?php
include 'layout/admin_bottom.php';