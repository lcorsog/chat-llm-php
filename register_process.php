<?php
require_once("globals.php");
require_once("helpers/db.php");
require_once("models/Message.php");
require_once("models/User.php");
require_once("dao/UserDAO.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);

$type = filter_input(INPUT_POST, "type");

if ($type == "login") {
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");

    $user = $userDao->authenticateUser($email, $password);
    $message->setMessage("login efetuado com sucesso", "success", "index.php");
} else if ($type == "register") {
    $name = filter_input(INPUT_POST, "name");
    $surname = filter_input(INPUT_POST, "surname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmPassword = filter_input(INPUT_POST, "confirmPassword");

    if ($userDao->findByEmail($email) === true) {
        $message->setMessage("Usuário já cadastrado", "error", "back");
    } else {
        if ($password != $confirmPassword) {
            $message->setMessage("As senhas não coincidem", "error", "back");
        } else {
            $user = new User();

            //Gerando um token de autenticação
            $userToken = $user->generateToken();
            $finalPassword = $user->generatePassword($password);

            //Criação do usuário
            $user->name = $name;
            $user->lastName = $surname;
            $user->email = $email;
            $user->password = $finalPassword;
            $user->token = $userToken;

            $auth = true;
            $userDao->create($user, $auth);
        }
    }
}
