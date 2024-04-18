<?php
if (!isset($_SESSION['user'])) {
    header('Location: ?page=posts');
}

$post = new Post();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post->delete_one('posts', $_POST['id']);
}

$data = $pdo->query("SELECT * FROM posts");
?>


<div class="d-flex justify-content-between align-items-center">
    <h1>Dashboard Admin</h1>
    <a class="btn btn-success" href="?page=create-post">Add new Post</a>
</div>
<a class="btn btn-success" href="?page=create-category">Add new Category</a>


<div class="row g-3">
    <?php foreach ($data as $post) { ?>
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
                    <div class="d-flex gap-3">
                        <a href="?page=edit-post&id=<?php echo $post['id'] ?>" class="btn btn-warning">Modifica</a>
                        <form action="" method="post">
                            <input type="hidden" value="<?php echo $post['id'] ?>" name="id">
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>