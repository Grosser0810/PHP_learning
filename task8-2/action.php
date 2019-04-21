<?php

$header = $_GET['header'];
$image = $_FILES['image']['name'];
$author = $_GET['author'];
$text = $_GET['textArea'];
$submit = $_GET['submit'];










//$article = fopen("article/{$header}.txt",w);
//
//
//$dir = "article/";
//
//if (is_dir($dir)){
//    if ($dh = opendir($dir)){
//        while (($file = readdir($dh)) !== false){
//            echo "<a href=article/$file>{$file}</a><br>";
//        }
//        closedir($dh);
//    }
//}
//if("<a href=article/$file>{$file}</a><br>" !==false){
//    echo file_get_contents($file);
//}