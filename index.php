<?php
session_start();
$page = isset($_GET["page"]) ? $_GET["page"] : 'posts';

require_once __DIR__ . "/class/DB.php";
require_once __DIR__ . "/class/User.php";
$pdo = new DB();
?>

<?php include __DIR__ . "/components/header.php" ?>

<main class="container mt-5" style="min-height: 80vh;">
    <div class="row">
        <div class="col-12">
            <?php include __DIR__ . "/pages/" . $page . '.php' ?>
        </div>
    </div>
</main>

<?php include __DIR__ . "/components/footer.php" ?>

