<?php

include "../includes/db.php";
include "includes/header.php";
include "includes/nav.php";
include "functions.php";

?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Старница управления категориями
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>
                        <a href="">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Blank Page
                    </li>
                </ol>
            </div>
            <div class="col-md-6">
                <?php


                if(isset($_GET['delete'])) {
                    $post_id = $_GET['delete'];

                    $delete_sql = "DELETE FROM posts WHERE id = $post_id LIMIT 1";
                    $del_result = mysqli_query($connection, $delete_sql);
                    if(!$del_result) {
                        echo "Запрос не удался";
                    } else {
                        echo "Категория удалена";
                    }
                }


                ?>
                <a href="posts.php?create" class="btn btn-success">Создать пост</a>
                <?php

                if(isset($_GET['create'])) {?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="text" name="title" class="form-control" value="Title">
                        <input type="text" name="author" class="form-control" value="Author">
                        <textarea name="content" class="form-control" id="" cols="30" rows="10"></textarea>
                        <input type="file" class="form-control" name="img">
                        <input type="number" name="category_id" class="form-control">
                        <input type="submit" name="store" value="Создать">
                    </form>

                    <?
                }
                if(isset($_POST['store'])) {
                    $id          = htmlspecialchars($_POST['id']);
                    $title       = htmlspecialchars($_POST['title']);
                    $author      = htmlspecialchars($_POST['author']);
                    $content     = htmlspecialchars($_POST['content']);
                    $img         = $_FILES['img']['name'];
                    $category_id = htmlspecialchars($_POST['category_id']);


                    $sql_create = "INSERT INTO posts(title,author,created_at,content,image,cat_id) VALUES ('{$title}', '{$author}', now(), '{$content}', '{$img}', '{$category_id}')";
                    $create_result = mysqli_query($connection, $sql_create);
                    confirmQuery($create_result);

                }

                if(isset($_GET['update'])) {
                    $cat_id = $_GET['update'];
                    $sql_one_post = "SELECT * FROM posts WHERE id = $cat_id";
                    $result_one_post = mysqli_query($connection, $sql_one_post);
                    confirmQuery($result_one_post);
                    foreach ($result_one_post as $post): ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" class="form-control" value="<?=$post['id']?>">
                            <input type="text" name="title" class="form-control" value="<?=$post['title']?>">
                            <input type="text" name="author" class="form-control" value="<?=$post['author']?>">
                            <textarea name="content" class="form-control" id="" cols="30" rows="10"> <?=$post['content']?></textarea>
                            <input type="file" class="form-control" name="img">
                            <input type="number" name="category_id" class="form-control">
                            <input type="submit" class="btn btn-success" name="saveUpdate" value="Сохранить">
                        </form>

                        <?php
                    endforeach;

                }
                if(isset($_POST['saveUpdate'])) {
                    $id          = htmlspecialchars($_POST['id']);
                    $title       = htmlspecialchars($_POST['title']);
                    $author      = htmlspecialchars($_POST['author']);
                    $content     = htmlspecialchars($_POST['author']);
                    $img         = $_FILES['img']['name'];
                    $category_id = htmlspecialchars($_POST['category_id']);

                    $update_sqlCre = "UPDATE posts SET id ='{$id }',title =' {$title}', author = '{$author}', content ='{$content}', image = '{$img}', cat_id = '{$category_id}'  WHERE id = $id";
                    $upd_result_create = mysqli_query($connection, $update_sqlCre);
                    confirmQuery($upd_result_create);
                    var_dump($update_sqlCre);

                }

                ?>
            </div>
            <div class="col-md-6">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Название</th>
                        <th>Автор</th>
                        <th>Дата</th>
                        <th>Контент</th>
                        <th>Фото</th>
                        <th>id категории</th>
                        <th>Управления</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $sql = "SELECT * FROM posts";
                    $result = mysqli_query($connection, $sql);
                    confirmQuery($result);
                    foreach ($result as $post) :

                        ?>

                        <tr>
                            <td><?=$post['id']?></td>
                            <td><?=$post['title']?></td>
                            <td><?=$post['author']?></td>
                            <td><?=$post['created_at']?></td>
                            <td><?=$post['content']?></td>
                            <td><?=$post['image']?></td>
                            <td><?=$post['cat_id']?></td>
                            <td>
                                <a href="posts.php?update=<?=$post['id']?>" class="btn btn-primary">Редактировать</a>
                                <a
                                    href="posts.php?delete=<?=$post['id']?>"
                                    class="btn btn-danger"
                                    onclick="return confirm('Вы уверены?')"
                                >Удалить</a>
                            </td>
                        </tr>

                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php

include "includes/footer.php";
?>
