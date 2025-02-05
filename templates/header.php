<?php
require_once("globals.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("helpers/db.php");

$message = new Message($BASE_URL);

$flashMessage = $message->getMessage();

if ($flashMessage != "") {
    $message->clearMessage();
}


$userDao = new UserDAO($conn, $BASE_URL);
$userData = $userDao->verifyToken(false);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chat-llm-php</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">

</head>

<body>
    <header>
        <nav class="flex bg-blue-500 text-white p-4">
            <div>
                <div class="flex flex-row items-center">
                    <h1 class="text-3xl font-bold">Groq</h1>
                </div>
            </div>
            <div class="flex flex-row items-center ml-auto space-x-4">
                <?php if ($userData): ?>
                    <a href="<?= $BASE_URL ?>index.php" class="text-white hover:text-gray-200">Home</a>
                    <a href="<?= $BASE_URL ?>sandbox.php" class="text-white hover:text-gray-200">Sandbox</a>
                    <a href="<?= $BASE_URL ?>profile.php" class="text-white hover:text-gray-200"><?= $userData->name ?></a>
                <?php else: ?>
                    <a href="<?= $BASE_URL ?>index.php" class="text-white hover:text-gray-200">Home</a>
                    <a href="<?= $BASE_URL ?>register.php" class="text-white hover:text-gray-200">Cadastrar</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <?php if ($flashMessage != "" && $flashMessage[1] == "error"): ?>
        <div class="bg-red-500 text-white p-4 mb-4">
            <p class="text-center text-lg"><?= $flashMessage[0] ?></p>
        </div>
    <?php elseif ($flashMessage != "" && $flashMessage[1] == "success"): ?>
        <div class="bg-green-500 text-white p-4 mb-4">
            <p class="text-center text-lg"><?= $flashMessage[0] ?></p>
        </div>
    <?php endif; ?>