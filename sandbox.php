<?php include_once("templates/header.php")
?>



<div class="flex flex-col items-center justify-center h-screen">
    <div class="w-full max-w-lg">
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