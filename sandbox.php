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



<div class="flex flex-col h-screen p-4">
    <!-- Chat messages container -->
    <div class="flex-1 overflow-y-auto mb-4 bg-gray-50 border rounded-lg p-4">
        <?php if ($_SESSION['message'] != ""): ?>
            <!-- User message -->
            <div class="flex justify-end mb-4">
                <div class="bg-blue-500 text-white rounded-lg py-2 px-4 max-w-[70%]">
                    <p class="text-sm"><?= htmlspecialchars($message) ?></p>
                </div>
            </div>
            <!-- LLM response -->
            <div class="flex justify-start mb-4">
                <div class="bg-gray-200 rounded-lg py-2 px-4 max-w-[70%]">
                    <p class="text-sm text-gray-800"><?= htmlspecialchars($llmMessage) ?></p>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Message input form -->
    <div class="bg-white rounded-lg shadow-md">
        <form action="message_process.php" method="POST" class="flex gap-2 p-2">
            <input
                type="text"
                name="message"
                placeholder="Type your message..."
                class="flex-1 p-2 text-gray-800 bg-gray-50 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none"
                required>
            <button
                type="submit"
                class="px-6 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-200">
                Send
            </button>
        </form>
    </div>
</div>