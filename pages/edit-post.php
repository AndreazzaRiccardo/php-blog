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


// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $post->update_one('posts', $id, $_POST);
//     header('Location: ?page=admin');
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if ($_FILES['image']['name'] != '') {
        // Controlla se è stata caricata un'immagine
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Percorso di destinazione per l'immagine caricata
            $uploadDir = __DIR__ . '\\../imgs/';
            // Genera un nome univoco per l'immagine
            $uniqueID = uniqid();
            $uploadFile = $uploadDir . $uniqueID . '_' . basename($_FILES['image']['name']);

            // Elimina la vecchia immagine
            if ($edit_post['image']) {
                unlink(__DIR__ . "\\..\\" . $edit_post['image']);
            }
            
            // Sposta il file temporaneo nel percorso di destinazione
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                // Aggiungi il percorso dell'immagine ai dati del form
                $_POST['image'] = 'imgs/' . $uniqueID . '_' . basename($_FILES['image']['name']);
                // Chiamata alla funzione create del ProductManager
            }
        }
    }
    $_POST['user_id'] = $_SESSION['user']->id;
    $post->update_one('posts', $id, $_POST);
    header('Location: ?page=admin');
}
?>

<form method="post" enctype="multipart/form-data">
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
        <input name="image" type="file" class="form-control" id="title">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>