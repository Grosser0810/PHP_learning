<?php

$sql = "SELECT * FROM categories LIMIT 3";
$result = mysqli_query($connection, $sql);
if(!$result) {
    echo "Запрос не удался";
}

?>


<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <div class="input-group">
            <form action="includes/action.php" method="post">
            <input type="text" class="form-control" name="search">
            <span class="input-group-btn">
                <input class="btn btn-default" type="submit" name="button">
                        <!--<button class="btn btn-default" type="button" name="button">-->
                    <span class="glyphicon glyphicon-search"></span>
                       <!-- </button>-->
                        </span>
            </form>

        </div>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">

            <?php
            foreach ($result as $category) :

            ?>
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <li><a href="#"><?= $category['name']?></a>
                    </li>

                </ul>
            </div>
          <?php endforeach;?>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>