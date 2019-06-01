<?php
session_start();
    $sql = "SELECT * FROM categories LIMIT 3";
    $result = mysqli_query($connection, $sql);
    if(!$result) {
        echo "Запрос не удался";
    }
    if(isset($_GET['logout'])){
        session_destroy();

    }


include "login.php";

?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Start Bootstrap</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php

                    foreach ($result as $category) :

                ?>
                <li class="category-<?= $category['code']?>">
                    <a href="category.php?category=<?= $category['id']?>">
                        <?= htmlspecialchars(ucfirst($category['name']))?>
                    </a>
                </li>

                <?php

                    endforeach;

                ?>
            </ul>
            <?php


                if ($_SESSION['login']== 'admin'){?>
            <div class="col-md-4 col-md-push-6">
                <p style="color: #ffffff">Добро пожалувать, Администратор</p>
                <a href="../admin/index.php" style="color: #fff" class="btn btn-primary">Page administration</a>
                <form action="">
                    <input type="submit" name="logout" value="Log out">
                </form>


            </div>
              <?php  }else{

                ?>

                <div class="col-md-4 col-md-push-6">
                    <form action="" method="post">
                        <label for="login" style="color: #ffffff">Login</label>
                        <input type="text" name="login"><br>
                        <label for="password" style="color: #ffffff">Password</label>
                        <input type="password" name="password">
                        <input type="submit" name="submit" value="Log In">
                    </form>
                </div>

                <?php
            }
            ?>


        </div>


    </div>

</nav>