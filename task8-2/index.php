
<!--Создайте страницу создания новостей, новость должна иметь следующие поля,

-картинка,
-название новости,
-краткий текст.
-дата создания,
-имя автора,

Вывести список, по клику на ссылку одну статью целиком-->





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

<div class="container">
    <a href="create.php" class="btn btn-primary btn-lg btn-block" style="color: #">Создать статью</a>
<div class="card mb-3 my-5">

    <?php
    $articles = file('articles.txt');
    foreach ($articles as $article) : ?>

    <img src="<?=explode(':',$article)[0]?>" class="card-img-top" alt="picture">

    <div class="card-body">
        <h5 class="card-title"><?=explode(':',$article)[1]?></h5>
        <p class="card-text"><?=explode(':',$article)[2]?></p>
        <p class="card-text"><small class="text-muted"><?=explode(':',$article )[3] ?></small></p>
        <p class="card-text"><small class="text-muted"><?=explode(':',$article)[4]?></small></p>
    </div>
</div>

    <?php continue; endforeach;?>

</div>
</body>
</html>