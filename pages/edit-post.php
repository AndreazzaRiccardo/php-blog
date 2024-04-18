<?php
if (!isset($_SESSION['user'])) {
    header('Location: ?page=posts');
}

$category = new Category();
$categories = $category->query("SELECT * FROM categories");

$post = new Post();
$id = htmlspecialchars($_GET['id']);
$result = $post->query("SELECT * FROM posts WHERE id=$id");
$edit_post = $result[0];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post->update_one('posts', $id, $_POST);
    header('Location: ?page=admin');
}
?>

<form method="post">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input value="<?= $edit_post['title']; ?>" name="title" type="text" class="form-control" id="title">
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea name="content" class="form-control" id="content" rows="3"><?= $edit_post['content']; ?></textarea>
    </div>

    <select name="category_id" class="form-select" aria-label="Default select example">
        <option selected>Choose one...</option>
        <?php foreach ($categories as $category) : ?>
            <option  <?= ($edit_post['category_id'] == $category['id']) ? 'selected' : ''; ?> value="<?= $category['id']; ?>"><?= $category['name'] ?></option>
        <?php endforeach; ?>
    </select>

    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input name="image" type="text" class="form-control" id="title">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>