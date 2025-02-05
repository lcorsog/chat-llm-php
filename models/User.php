<?php

class User
{
    public $id;
    public $name;
    public $lastName;
    public $email;
    public $password;
    public $token;

    public function generateToken()
    {
        $token = bin2hex(random_bytes(50));
        return $token;
    }

    public function generatePassword($password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        return $password;
    }
}

interface UserDAOInterface
{
    public function buildUser($data);
    public function create(User $user, $authUser = false);
    public function update(User $user, $redirect = true);
    public function verifyToken($protected = false);
    public function setTokenToSession($token, $redirect = true);
    public function authenticateUser($email, $password);
    public function findByEmail($email);
    public function findById($id);
    public function findByToken($token);
    public function changePassword(User $user);
    public function destroyToken();
}
