<?php
// $data = $pdo->query("SELECT * FROM posts");

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $data = $pdo->query("SELECT * FROM posts WHERE category_id=$category_id");
} else {
    $data = $pdo->query("SELECT * FROM posts");
}
?>
<?php if (isset($_GET['category_id']) && $_GET['category_id'] != '') : ?>
    <a href="?page=posts">Annulla filtro</a>
<?php endif; ?>
<div class="row g-3">
    <?php if (count($data) > 0) { ?>
        <?php foreach ($data as $post) { ?>
            <div class="col-12">
                <div class="card">
                    <img src="
            <?php $imgPath = $post['image'] ? $post['image'] : 'imgs\noimg.jpg';
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
    <?php } else { ?>
        <h5 class="text-center pt-5">Nessun Post trovato!</h5>
    <?php } ?>
</div>