<?php
include_once("templates/header.php");
require_once("dao/RulesDAO.php");
require_once("dao/UserDAO.php");
require_once("models/Message.php");


$rule = new Rules();
$ruleDao = new RulesDAO($conn, $BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);

// Verificar o token do usuário
$userData = $userDao->verifyToken();

$rules = $ruleDao->getRulesByUserId($userData->id);

$message = new Message($BASE_URL);
?>

<div class="h-screen bg-gray-100 dark:bg-gray-900 p-4">
    <h2 class="text-2xl font-bold mb-4 p-4 text-gray-800 dark:text-gray-100">Regras</h2>
    <form action="rules_process.php" method="POST">
        <input type="hidden" name="type" value="<?php if ($rules) echo "edit";
                                                else echo "create"; ?>">
        <input class="w-full h-full p-4 border-2 border-gray-300 focus:outline-none focus:border-blue-500 rounded-lg" placeholder="Nome da regra..." name="ruleName" value="<?php echo $rules->ruleName; ?>">
        <textarea name="rules" id="rules" class="w-full h-full p-4 border-2 border-gray-300 focus:outline-none focus:border-blue-500 rounded-lg" rows="10" placeholder="Escreva as regras..."><?php echo $rules->rules; ?></textarea>
        <button type="submit" class="bg-blue-500 text-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Salvar</button>
    </form>
</div>


<?php include_once("templates/footer.php") ?>