<?php
include 'checkUser.php';

if (!$isLogin){
        return header('location:login.php');
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Tech Blog</title>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

        <!-- Bootstrap core CSS -->
        <link href="resources/css/bootstrap.min.css" rel="stylesheet">

        <!-- Material Design Bootstrap -->
        <link href="resources/css/mdb.min.css" rel="stylesheet">
        <!--only for data tables-->
        <link href="resources/css/addons/datatables.css" rel="stylesheet">
        <link href="resources/css/style.css" rel="stylesheet">
        <script type="text/javascript" src="resources/js/jquery-3.3.1.min.js"></script>
        <!--<script type="text/javascript" src="../resources/tinymce/jquery.tinymce.min.js"></script>-->
        <script type="text/javascript" src="resources/tinymce/tinymce.min.js"></script>
        <!--TinyMCE script-->

    </head>
    <body class="fixed-sn black-skin">

<?php
if(isset($_SESSION['status']) && $_SESSION['statusType']){
    echo "<div class='statusMsg d-none'>".$_SESSION['status']."</div>";
    echo "<div class='statusType d-none'>".$_SESSION['statusType']."</div>";
}
?>

<!--Double navigation-->
<header>
    <!-- Sidebar navigation -->
    <div id="slide-out" class="side-nav sn-bg-4 fixed">
        <ul class="custom-scrollbar">
            <!-- Logo -->
            <li>
                <div class="logo-wrapper waves-light">
                    <a href="dashboard.php" class="mt-2 text-center text-white">
                        <?php if ( isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==true){
                            echo 'Admin Dashboard';
                        }else{
                            echo 'User Dashboard';
                        } ?>
                    </a>
                </div>
            </li>
            <!--/. Logo -->

            <!-- Side navigation links -->
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a href="index.php" class="waves-effect"><i class="fa fa-mail-forward" aria-hidden="true"></i>Go to Site</a>
                    </li>
                    <?php
                    if ($isAdmin){
                        echo"<li>
                             <a href='postsAll.php' class='waves-effect'><i class='fa fa-clone'></i>All Posts</a>
                            </li>
                            <li>
                             <a href='allUsers.php' class='waves-effect'><i class='fa fa-users'></i>All Users</a>
                            </li>
                            <li>
                             <a href='categories.php' class='waves-effect'><i class='fa fa-cubes'></i>Categories</a>
                            </li>
                            <li>
                             <a href='allComments.php' class='waves-effect'><i class='fa fa-comments'></i>Comments</a>
                            </li>";
                    } ?>

                    <li>
                        <a href="myPosts.php" class="waves-effect"><i class="fa fa-clone"></i>My Posts</a>
                    </li>
                    <li>
                        <a href="postCreate.php" class="waves-effect"><i class="fa fa-edit"></i>Add New</a>
                    </li>
                    <li>
                        <a href="postsDraft.php" class="waves-effect"><i class="fa fa-save"></i>Draft</a>
                    </li>
                    <li>
                        <a href="updateProfile.php" class="waves-effect"><i class="fa fa-gear"></i>My Profile</a>
                    </li>
                </ul>
            </li>
            <!--/. Side navigation links -->
        </ul>
        <div class="sidenav-bg mask-strong"></div>
    </div>
    <!--/. Sidebar navigation -->
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
        <!-- SideNav slide-out button -->
        <div class="float-left">
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
        </div>
        <!-- Breadcrumb-->
        <div class="breadcrumb-dn mr-auto">
            <p></p>
        </div>

        <ul class="nav navbar-nav nav-flex-icons ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>
                    <?php echo $_SESSION['username']; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="updateProfile.php"><i class="fa fa-gear"></i> Settings</a>
                    <form action="registerLogin.php" method="post">
                        <button name="logoutButton" class="dropdown-item" ><i class="fa fa-sign-out"></i> Logout</button>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.Navbar -->
</header>
<!--/.Double navigation-->
<!--dashboard body-->
<main>
    <div class="container-fluid mt-5">