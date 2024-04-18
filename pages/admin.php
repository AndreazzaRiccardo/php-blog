<?php
    if(!isset($_SESSION['user'])){
        header('Location: ?page=posts');
    }
?>

<h1>Dashboard Admin</h1>

