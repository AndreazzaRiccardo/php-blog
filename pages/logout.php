<?php

unset($_SESSION['user']);
header('Location: ?page=posts');
exit;