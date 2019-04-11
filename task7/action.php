<?php
//3.1 Создать форму с текстовым полем и кнопкой submit. Поль-
//зователь должен вводить в текстовое поле название логина, пароля и e-mail адреса.
//При нажатии на кнопку submit, должно происходить следующие дей-
//ствия:
//- название логина, пароля и e-mail адреса из формы должно записываться в файл
//users.txt;
//- проверка валидации на стороне сервера на обязательность;
//- логин должен быть не менне 3 символов и не более 30 символов;
//- логин должен быть уникальным *;

$login =strip_tags($_POST['login']);
$email = strip_tags($_POST['email']);
$password = md5(strip_tags($_POST['password']));
$submit = $_POST['submit'];

if(isset($submit)){
    if($login=='' || $email=='' || $password==''){
        echo "All fields are required";
        echo md5('admin');
    }elseif (strlen($login) <3 || strlen($login) >30){
        echo "Login must be not less than 3 letters and not more than 30 letters";
    }else{
        $users = file('users.txt');
        foreach ($users as $user){
            $user = explode(':',$user)[0];
            if($user == $login){
                echo "A user with this login is already registered";
                break;
            }else{
                $line = $login . ':' . $email . ':' . $password . PHP_EOL;
                $line = file_put_contents('users.txt',$line,FILE_APPEND);
                echo "You are registered";
                break;
            }
        }
    }
}
