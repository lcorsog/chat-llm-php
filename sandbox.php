<?php
include_once("templates/header.php");
include_once("message_process.php");
require_once("dao/RulesDAO.php");
require_once("dao/UserDAO.php");
require_once("globals.php");

$user = new User($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);

//Coletar dados do usuário
$userData = $userDao->verifyToken();

$rulesDao = new RulesDAO($conn, $BASE_URL);
$rules = $rulesDao->getRulesByUserId($userData->id);
$rule = $rules->rules;


$message = $_SESSION['message'] ?? "";

$llmMessage = callGroqApi($message, $rule);
?>



<div class="items-center justify-center h-screen">
    <div class="w-full max-w-lg items-center justify-center">
        <form action="message_process.php" method="POST">
            <div class="flex flex-col items-center justify-center">
                <input type="text" name="message" placeholder="Enter your message here..." class="w-full p-2 text-center text-lg text-gray-800 bg-white rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:outline-none">
                <button type="submit" class="mt-4 w-full p-2 text-center text-lg text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none">Send</button>
            </div>
        </form>
    </div>
    <div>
        <div class="flex flex-col items-center justify-center bg-gray-100 rounded-lg shadow-lg mt-4">
            <div id="user-message" class="flex flex-col items-center justify-center" class="w-full max-w-lg bg-gray-100 rounded-lg shadow-lg mt-4">
                <p class="text-center text-lg text-gray-800 font-bold"><?= htmlspecialchars($message) ?></p>
            </div>
            <div id="llm-message" class="flex flex-col mr-auto">
                <?php if ($_SESSION['message'] != ""): ?>
                    <p class="text-center text-lg text-gray-800"><?= htmlspecialchars($llmMessage) ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<!-- TESTANDO UM NOVO LAYOUT -->
<!-- <div class=" rounded-lg h-screen items-center justify-center m-10">
    <div class="bg-gray-100 h-3/6 rounded-lg shadow-lg">

    </div>
    <div class=" h-12 flex">
        <input type="text" name="message" placeholder="Enter your message here..." class="w-5/6 p-2 text-lg text-gray-800 bg-white rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:outline-none items-center justify-center">
        <button class="w-1/6 bg-blue-200 font-bold text-lg text-white rounded-lg hover:bg-blue-300 focus:outline-none items-center justify-center">Enviar</button>
    </div>

</div> -->