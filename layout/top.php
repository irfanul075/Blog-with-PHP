<?php
include 'checkUser.php';
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

</head>
<body>

<?php
if(isset($_SESSION['status']) && $_SESSION['statusType']){
echo "<div class='statusMsg d-none'>".$_SESSION['status']."</div>";
echo "<div class='statusType d-none'>".$_SESSION['statusType']."</div>";
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand " href="index.php">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="contact.php"><i class="fa fa-comments-o" aria-hidden="true"></i>Support</a>
                </li>

                <?php if($isLogin == true){ ?>
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
                <?php } else{ ?>

                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Login</a>
                    </li>

                <?php } ?>


            </ul>
        </div>
    </div>
</nav>
