<?php
$category = new Category();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category->insert_one('categories', $_POST);
    header('Location: ?page=admin');
}
?>

<form method="post">
  <div class="mb-3">
    <label for="category" class="form-label">Email address</label>
    <input name="name" type="text" class="form-control" id="category" aria-describedby="emailHelp">
  </div>
  <button type="submit" class="btn btn-success">Add</button>
</form>