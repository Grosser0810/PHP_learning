<?php



//2.1 Создать форму, в которую пользователь вносит информацию (например логин),
//полученные данные вывести на экран. Сделать проверку на пустоту. Сделать проверку на длину логина не менее 3 символов.



//$login =strip_tags($_GET['login']);
//
//if(empty($login)){
//    echo "Please Enter Login";
//
//}elseif(mb_strlen($login) < 3) {
//    echo "Login must contain more than 3 letters";
//}
//else{
//    echo "{$login}";
//};

//----------------------------------------------------------------------------------------------------------------------------------------------------------

//Создать форму с текстовым полем и кнопкой submit. Поль-
//зователь должен вводить в текстовое поле название логина, пароля и e-mail адреса.
//При нажатии на кнопку submit, должно происходить следующие дей-
//ствия:
//- название логина, пароля и e-mail адреса из формы должно выводится на экран;
//- проверка валидации на стороне сервера;
//- логин должен быть не менее 3 символов и не более 30 символов;

/*$login = strip_tags($_GET['login']);
$password = strip_tags($_GET['password']);
$email = strip_tags($_GET['email']);

if(empty($login) || empty($password) || empty($email)){
    echo "All fields are required";
}elseif (strlen($login) < 3){
    echo "Login must contain more than 3 letters";
}elseif (strlen($login) > 30){
    echo "Login must be less than 30 letters";
}
else{
    echo "<h3>Your Login - {$login}</h3><h3>Your Password - {$password}</h3><h3>Your Email - {$email}</h3>";
}*/







