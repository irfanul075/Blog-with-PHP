<?php
include 'checkUser.php';
if($isAdmin==false){
    header('location:login.php');
}
include 'DB/db_connect.php';

if (isset($_POST['addCat'])){
    $catName =  $_POST['categoryName'];
    $catSlug =  $_POST['categorySlug'];

    $checkCat = $conn->query('select slug from categories');
    if ($checkCat->num_rows > 0){
        while($cat = $checkCat->fetch_object()){
            if ($cat->slug === $catSlug){
                $_SESSION['status'] = 'category already added';
                $_SESSION['statusType'] = 2;
                return header('location:categories.php');
            }
        }
    }
        $stmt = $conn->prepare("insert into categories(name, slug) values (?,?)");
        $stmt->bind_param("ss",$catName,$catSlug);
        if ($stmt->execute()){
            return header('location:categories.php');
        }else{
            $_SESSION['status'] = 'category Not added please try again';
            $_SESSION['statusType'] = 3;
            return header('location:categories.php');
        }
}else{
    return header('location:categories.php');
}