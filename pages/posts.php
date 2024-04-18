<?php
$data = $pdo->query("SELECT * FROM posts");
?>

<div class="row">
    <?php foreach($data as $post){ ?>
    <div class="col-12">
        <div class="card">
            <img src="
            <?php $imgPath = $post['image'] ? 'imgs\noimg.jpg' : 'imgs\noimg.jpg';
            echo $imgPath;
             ?>
             " class="card-img-top" alt="..." style="height: 200px; object-fit: contain;">
            <div class="card-body">
                <h5 class="card-title"><?= $post['title'] ?></h5>
                <p class="card-text"><?= $post['content'] ?></p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    <?php } ?>
</div>