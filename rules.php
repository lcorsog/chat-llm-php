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

<div class="min-h-screen bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 p-8">
    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
        <h2 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100 border-b pb-4">Regras</h2>

        <form action="rules_process.php" method="POST" class="space-y-6">
            <input type="hidden" name="type" value="<?php if ($rules) echo "edit";
                                                    else echo "create"; ?>">

            <div class="space-y-2">
                <label for="ruleName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome da Regra</label>
                <input
                    id="ruleName"
                    class="w-full p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    placeholder="Nome da regra..."
                    name="ruleName"
                    value="<?php echo $rules->ruleName; ?>">
            </div>

            <div class="space-y-2">
                <label for="rules" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descrição das Regras</label>
                <textarea
                    name="rules"
                    id="rules"
                    class="w-full p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    rows="10"
                    placeholder="Escreva as regras..."><?php echo $rules->rules; ?></textarea>
            </div>

            <button
                type="submit"
                class="w-full sm:w-auto px-6 py-3 bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 text-white font-medium rounded-lg text-sm transition-colors duration-200 ease-in-out dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                Salvar
            </button>
        </form>
    </div>
</div>


<?php include_once("templates/footer.php") ?>