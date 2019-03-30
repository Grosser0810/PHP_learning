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
<?php

//1. Задание 1 (Самостоятельная работа)
//Создать переменную с произвольным текстом (длиной >10символов). Провести проверку: если длина
//строки больше 10 символов, обрезать строку до 10 символов. С помощью функции заменить все символы
//"a-g" на пустоту.

//$word = 'Hi my name Gleb and I working in austrian telecom group';
//$letters = ['a','b','c','d','e','f','g'];
//echo str_replace($letters," ",$word);
//--------------------------------------------------------------------------


//2. Задание 2 (Самостоятельная работа)
//
//Задание:
//Взять Html разметку:
//" <div class="refnamediv">
//<h1>htmlspecialchars</h1>
//<p> (PHP 4, PHP 5, PHP 7)</p><p class="refpurpose"><span class="refname">htmlspecialchars</span> —
//<span class="dc-title">Любой текст</span></p>
//</div>";
//Удалить все html теги. Вывести количество символом после фильтрации.

/*$test = "<div class='refnamediv'>
<h1>htmlspecialchars</h1>
<p> (PHP 4, PHP 5, PHP 7)</p><p class='refpurpose'><span class='refname'>htmlspecialchars</span> —
<span class='dc-title'>Любой текст</span></p>
</div>";
$stripTags = strip_tags($test);
echo strlen($stripTags);*/
//------------------------------------------------------------------------------------

// 3. Найти и заменить в строке "http://example.com/user/username" user на author; Вывести результат на экран
/*$string  = "http://example.com/user/username";
$word = "author";
echo str_replace('user','author',$string,);*/
//----------------------------------------------------------------------------------------

//4. Отсортировать массивам [1,22,45,3,23,45,6,76,55,4] по возврстанию;
/*$arr =[1,22,45,3,23,45,6,76,55,4];
sort($arr);
foreach ($arr as $num){
    echo "{$num}<br>";
} ;*/
//-----------------------------------------------------------------------------------------
//5. Преобразовать строку "Find me and say Hello Mike!" в массив;
/*$string = "Find me and say Hello Mike!";
$arr = explode(" ",$string);
print_r($arr);*/
//------------------------------------------------------------------------------------------

//6. Посчитать, сколько букв "a" встречается в строке "Find me and say Hello Mike!"
/*$string = "Find me and say Hello Mike!";
$letter = "a";
echo substr_count($string,$letter);*/
//-----------------------------------------------------------------------------------------

// 7. Дан урл "http://example.com/name=Mike&lastname=Jackson&age=25", необходимо разбить и вытащить параметры и вывести на экран.

/*$string = "http://example.com/name=Mike&lastname=Jackson&age=25";
var_dump(parse_url($string)) ;*/


?>

</body>
</html>