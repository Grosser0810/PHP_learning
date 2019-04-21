

<?php

    if(isset($_POST['submit'])) {
        $files = $_FILES['file'];
        $header = $_POST['header'];
        $content = $_POST['content'];
        $author = $_POST['author'];

        $tmp_name = $files['tmp_name'];
        $photo = $files['name'];


        if(!file_exists('img')) {
            mkdir('img', 0777);
        }
        move_uploaded_file($tmp_name,'img/' . $photo);
        }

$articles = file('articles.txt');
foreach ($articles as $article) {

    $line ='img/' . $photo . ':' . $header . ':' . $content . ':' . $author .  ':' . date("d M Y") . PHP_EOL;
    $line =file_put_contents('articles.txt',$line,FILE_APPEND);
    $image = explode(':',$photo)[0];
    break;
}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <div class="container">
    <div class="form-group" >
        <label for="">Example file</label>
        <input type="file" class="form-control-file" id="" name="file">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">News headline</label>
        <input type="text" class="form-control" id="" name="header">
    </div>
    <div class="form-group">
        <label for="">News content</label>
        <textarea class="form-control" id="" rows="3" name="content"></textarea>
    </div>
    <div class="form-group">
        <label for="1">Author's name</label>
        <input type="text" class="form-control" id="" name="author">
    </div>
        <input name="submit" type="submit" class="btn btn-primary btn-lg btn-block" value="сохранить">
    </div>
</form>

</body>
</html>
