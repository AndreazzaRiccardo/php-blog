<?php
$errMsg = '';
if (isset($_POST['login'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    $user = new User();
    $result = $user->login($username, $password);

    if ($result) {
        header('Location: ?page=admin');
    } else {
        $errMsg = 'Nome utente o password errati';
    }
}
?>

<div class="row justify-content-center">
    <div class="col-12 col-md-6">
        <h2>Login</h2>
        <form class="mt-3" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input name="username" id="username" type="text" class="form-control">
            </div>
            <div class="form-group my-3">
                <label for="password">Password</label>
                <input name="password" id="password" type="password" class="form-control">
            </div>

            <div style="min-height: 70px;">
                <?php if ($errMsg != '') { ?>
                    <div class="alert alert-danger m-0">
                        <?= $errMsg ?>
                    </div>
                <?php } ?>
            </div>

            <button class="btn btn-dark mt-1" name="login" type="submit">Login</button>
        </form>
    </div>

</div>