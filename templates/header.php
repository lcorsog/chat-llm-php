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

<body class="<?= $userData ? 'flex' : '' ?>">
    <?php if ($userData): ?>
        <!-- Side Navigation for logged-in users -->
        <nav class="bg-blue-600 text-white w-64 min-h-screen p-4 flex flex-col">
            <div class="mb-8">
                <h1 class="text-3xl font-bold">Groq</h1>
            </div>
            <div class="flex flex-col space-y-4">
                <a href="<?= $BASE_URL ?>index.php" class="flex items-center p-2 rounded hover:bg-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Home
                </a>
                <a href="<?= $BASE_URL ?>sandbox.php" class="flex items-center p-2 rounded hover:bg-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Sandbox
                </a>
                <a href="<?= $BASE_URL ?>profile.php" class="flex items-center p-2 rounded hover:bg-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <?= $userData->name ?>
                </a>
            </div>
        </nav>
    <?php else: ?>
        <!-- Top Navigation for non-logged-in users -->
        <nav class="flex bg-blue-500 text-white p-4">
            <div>
                <div class="flex flex-row items-center">
                    <h1 class="text-3xl font-bold">Groq</h1>
                </div>
            </div>
            <div class="flex flex-row items-center ml-auto space-x-4">
                <a href="<?= $BASE_URL ?>index.php" class="text-white hover:text-gray-200">Home</a>
                <a href="<?= $BASE_URL ?>register.php" class="text-white hover:text-gray-200">Cadastrar</a>
            </div>
        </nav>
    <?php endif; ?>

    <main class="flex-1 p-4">
        <?php if ($flashMessage != "" && $flashMessage[1] == "error"): ?>
            <div class="bg-red-500 text-white p-4 mb-4">
                <p class="text-center text-lg"><?= $flashMessage[0] ?></p>
            </div>
        <?php elseif ($flashMessage != "" && $flashMessage[1] == "success"): ?>
            <div class="bg-green-500 text-white p-4 mb-4">
                <p class="text-center text-lg"><?= $flashMessage[0] ?></p>
            </div>
        <?php endif; ?>