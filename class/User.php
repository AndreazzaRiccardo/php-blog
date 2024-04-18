<?php

class User extends DB {
    public function __construct()
    {
        parent::__construct();
    }

    public function login($username, $password) {
        $result = $this->query("
        SELECT *
        FROM users
        WHERE username = '$username'
        AND password = MD5('$password');
        ");

        if(count($result) > 0) {
            $user = (object)$result[0];
            $user = (object)[
                'id' => $user->id,
                'username' => $user->username
            ];

            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }
}