<?php
include "db.php";

$login    = $_POST['login'];
$password = md5($_POST['password']);
$submit   = $_POST['submit'];

$sqlUsers  = "SELECT * FROM users WHERE login='{$login}' and password = '{$password}'";
$sqlResult = mysqli_query($connection,$sqlUsers);
$count     = mysqli_num_rows($sqlResult);
if ($count == 1){
    $_SESSION['login']= $login;
    var_dump($_SESSION['login']);

}
