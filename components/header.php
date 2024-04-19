<?php
$category = new Category();
$categories = $category->query("SELECT * FROM categories");

$current_page = $_SERVER['REQUEST_URI'];
if ((strpos($current_page, '/php-blog/?page=admin')) === 0 || (strpos($current_page, '/php-blog/?page=posts')) === 0) {
    $disabled = '';
} else {
    $disabled = 'disabled';
}

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog-PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
</head>

<body>
    <header class="p-2 bg-dark text-white">
        <nav class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-between">
                <a href="?page=posts" class="d-flex align-items-center me-5 mb-2 mb-lg-0 text-warning fw-bolder fs-4 text-decoration-none">
                    PHP-Blog
                </a>

                <div class="d-flex flex-wrap justify-content-center">

                    <form class="form-category" method="get" action="">
                        <select <?= $disabled ?> name="category_id" class="form-select form-category" aria-label="Default select example">
                            <option value="" selected>Choose one...</option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['id']; ?>"><?= $category['name'] ?></option>
                            <?php endforeach; ?>
                        </select>       
                        </form>
                    <div class="text-end">
                        <?php if (!isset($_SESSION['user'])) { ?>
                            <a class="btn dropdown-toggle text-light text-truncate" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Area Riservata
                            </a>
                            <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item text-light" href="?page=login">Login</a></li>
                                <li>
                                    <hr class="dropdown-divider border-light">
                                </li>
                                <li><a class="dropdown-item text-light" href="">Sign-up</a></li>
                            </ul>
                        <?php } ?>

                        <?php if (isset($_SESSION['user'])) { ?>
                            <a class="btn dropdown-toggle text-light text-truncate fs-6" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $_SESSION['user']->username ?>
                            </a>
                            <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item text-light" href="?page=admin">Dashboard</a></li>
                                <li>
                                <li><a class="dropdown-item text-light" href="?page=logout">Logout</a></li>
                                <li>
                            </ul>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </nav>
    </header>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelector('.form-category').addEventListener('change', () => {
                document.querySelector('.form-category').submit();
            })
        })
    </script>