<?php
require 'config.php';

class User {

    public $id;
    public $username;
    public $email;

    public static function findById($id) {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $user = new User();
            $user->id = $data['id'];
            $user->username = $data['username'];
            $user->email = $data['email'];
            return $user;
        }

        return null;
    }
}
