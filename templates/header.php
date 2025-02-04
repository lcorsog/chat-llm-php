<?php
include_once("message_process.php");
include_once("globals.php");

$message = $_SESSION['message'] ?? "";

$llmMessage = callGroqApi($message);
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
    <nav class="flex bg-blue-500 text-white mb-4 p-4">
        <div>
            <div class="flex flex-row items-center">
                <h1 class="text-3xl font-bold">Groq</h1>
            </div>
        </div>
        <div class="flex flex-row items-center ml-auto space-x-4">
            <a href="<?= $BASE_URL ?>index.php" class="text-white hover:text-gray-200">Home</a>
            <a href="<?= $BASE_URL ?>sandbox.php" class="text-white hover:text-gray-200">Sandbox</a>
            <a href="<?= $BASE_URL ?>login.php" class="text-white hover:text-gray-200">Login</a>
        </div>
    </nav>