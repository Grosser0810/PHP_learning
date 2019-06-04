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


<?
include "db.php";

//1. Выберите из таблицы workers записи с id равным 3, 5, 6, 10.


/*$sql= "SELECT * FROM workers WHERE id IN(3,5,6,10)";
$result = mysqli_query($connection,$sql);

foreach ($result as $worker){

        echo $worker['login'] . "<br>";
    }*/
//----------------------------------------------------------------------------------------------------------------------



//2. Выберите из таблицы workers записи с id равным 3, 5, 6, 10 и логином, равным 'eee', 'zzz' или 'ggg'.


/*$sql= "SELECT * FROM workers WHERE id IN(3,5,6,10) AND login IN('eee', 'zzz', 'ggg')";
$result = mysqli_query($connection,$sql);

foreach ($result as $worker) {

    echo $worker['login'] . "<br>";
}*/

//----------------------------------------------------------------------------------------------------------------------



//3. Выберите из таблицы workers записи c зарплатой от 500 до 1500.


/*$sql= "SELECT * FROM workers WHERE salary BETWEEN 500 AND 1500 ";
$result = mysqli_query($connection,$sql);

foreach ($result as $worker) {

    echo $worker['login'] . "<br>";
}*/

//----------------------------------------------------------------------------------------------------------------------



//4. Найдите в таблице workers минимальный возраст.

// Не понимаю почему не выводит на экран пробовал 2 запроса:
/*$sql= "SELECT * FROM workers WHERE age=(SELECT MIN(age) FROM workers)"; // SELECT MIN(age) FROM workers;
$result = mysqli_query($connection,$sql);
var_dump($result);


var_dump($sqlRows);

foreach ($result as $worker) {

    echo $worker['login'] . "<br>";
}*/

//----------------------------------------------------------------------------------------------------------------------



//5. Даны две таблицы: таблица category с полями id и name и таблица page с полями id, name и category_id.
// Достаньте одним запросом все страницы вместе с их категориями


/*$sql= "SELECT *FROM category LEFT JOIN page ON category.id = category_id";
$result = mysqli_query($connection,$sql);

foreach ($result as $one){
    echo 'Category: ' . $one['name'] . ' Page: ' . $one['pagename'] . '<br>';
}
*/


//----------------------------------------------------------------------------------------------------------------------



//6. Даны 3 таблицы: таблица category с полями id и name, таблица sub_category с полями id и name и таблица page с полями
// id, name и sub_category_id. Достаньте одним запросом все страницы вместе с их подкатегориями и категориями.


/*$sql = "SELECT * FROM category LEFT JOIN page ON category.id = category_id LEFT JOIN sub_category ON category.id = sub_category.id";

$result = mysqli_query($connection,$sql);

foreach ($result as $one){
    echo 'Category: ' . $one['name'] . ' Page: ' . $one['pagename'] . ' SUB-Category: ' . $one['subname'] .  '<br>';
}*/


//----------------------------------------------------------------------------------------------------------------------


//7. Выберите из таблицы workers все записи, у которых дата больше текущей


/*$sql= "SELECT * FROM workers WHERE date < CURRENT_DATE()"; // или "SELECT * FROM workers WHERE date > CURRENT_DATE()"
$result = mysqli_query($connection,$sql);

foreach ($result as $worker){

    echo $worker['login'] . "<br>";

}*/


//----------------------------------------------------------------------------------------------------------------------



//8. Найдите самые маленькие зарплаты по группам возрастов (для каждого возраста свою минимальную зарплату)

// не понимаю что у меня с минимумами не отрабатывают

/*$sql1= "SELECT MIN(salary) FROM workers WHERE age BETWEEN 20 AND 25 ";
$result1 = mysqli_query($connection,$sql1);

$sql2= "SELECT MIN(salary) FROM workers WHERE age BETWEEN 26 AND 35 ";
$result2 = mysqli_query($connection,$sql2);

$sql3= "SELECT MIN(salary) FROM workers WHERE age BETWEEN 36 AND 45 ";
$result3 = mysqli_query($connection,$sql3);

echo "<p>от 20 до 25 лет</p>";

foreach ($result1 as $worker1) {

    echo $worker1['login'] . "<br>";
}

echo "<p>от 25 до 35 лет</p>";

foreach ($result2 as $worker2) {

    echo $worker2['login'] . "<br>";
}

echo "<p>от 35 до 45 лет</p>";

foreach ($result3 as $worker3) {

    echo $worker3['login'] . "<br>";
}*/

?>




</body>
</html>
