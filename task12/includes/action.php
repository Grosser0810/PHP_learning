<?php
include "header.php";
include 'db.php';
include "nav.php";


$search = $_POST['search'];
$button = $_POST['button'];



if(isset($button)){

    $sql_search = "SELECT * FROM posts WHERE title LIKE '%{$search}%'";
    $search_q = mysqli_query($connection,$sql_search);
    $count= mysqli_num_rows($search_q);

    if($count == 0){
        echo "<h3>Nothing</h3>";
    }else{
        foreach ($search_q as $title){

            echo "<h3><a href=\"../post.php?post_id={$post['id']}\">{$title['title']}</a></h3>";

        }
    }

}


include "footer.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/blog-home.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
