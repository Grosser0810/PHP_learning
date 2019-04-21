
<?php

if(isset($_POST['submit'])) {
    //$files = $_FILES['file'];
    $files = $_FILES['file'];
    $file = $_FILES['file']['name'];
    $name = strip_tags($_POST['name']);
    $email =strip_tags($_POST['email']) ;
    $login = strip_tags($_POST['login']);
    $submit = strip_tags($_POST['submit']);
    $textArea =strip_tags($_POST['textArea']) ;

    $tmp_name = $files['tmp_name'];
    $avatar = $files['name'];

    if(!file_exists('img')) {
        mkdir('img', 0777);
    }

    if (move_uploaded_file($tmp_name, 'img/' . $avatar)) {
        echo 'файл загружен';
    }
    $users = file('users.txt');
    foreach ($users as $user) {
        $line = $avatar . ':' . $name . ':' . $email . ':' . $login . ':' . $textArea . PHP_EOL;
        $line = file_put_contents('users.txt',$line,FILE_APPEND);
        $image = explode(':',$user)[0];
        break;
    }

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
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <label for="">Загрузите вашу фотографию</label>
    <input type="file" name="file"><br>
    <label for="">Введите ваше Имя</label>
    <input type="text" name="name"><br>
    <label for="">Введите вашу почту</label>
    <input type="email" name="email"><br>
    <label for="">Введите ваш логин</label>
    <input type="text" name="login"><br>
    <label for="">Введите ваш номер телефона +375</label>
    <input type="text" maxlength="9" name="phone"><br>
    О себе:<br>
    <textarea name="textArea" id="" cols="30" rows="10" ></textarea><br>
    <input type="submit" name="submit" value="Сохранить">



</form>
</body>
</html>












