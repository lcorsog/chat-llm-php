<?php
include_once("templates/header.php");
require_once("models/User.php");
require_once("dao/RulesDAO.php");

$user = new User($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);

// Coletar os dados do usuário
$userData = $userDao->verifyToken();


$rulesDao = new RulesDAO($conn, $BASE_URL);
$rules = $rulesDao->getRulesByUserId($userData->id);

if (empty($rules) && $userData) {
    $rulesDao->defineDefaultRules($userData->id);
}



?>

<div class="min-h-screen bg-gray-50 flex flex-col items-center py-12">
    <?php if ($userData) : ?>
        <h1 class="text-4xl font-bold mb-8 text-gray-800">Meus Agentes</h1>
        <div class="w-2/3 max-w-4xl mb-6">
            <button class="bg-blue-600 text-white hover:bg-blue-700 transition-colors duration-200 font-semibold rounded-lg text-sm px-6 py-3 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Adicionar novo agente
            </button>
        </div>
        <div class="w-2/3 max-w-4xl bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Nome</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-gray-700">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <?php if ($rules->ruleName) : ?>
                                <p class="text-gray-700 font-medium"><?= $rules->ruleName ?></p>
                            <?php else : ?>
                                <p class="text-gray-500 italic">Defina seu primeiro agente</p>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-sm font-medium bg-green-100 text-green-700 rounded-full">
                                Ativo
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-3">
                                <a href="<?= $BASE_URL ?>rules.php" class="text-blue-600 hover:text-blue-800 font-medium">Editar</a>
                                <a href="<?= $BASE_URL ?>whats.php" class="text-yellow-600 hover:text-yellow-800 font-medium">Conectar</a>
                                <a href="<?= $BASE_URL ?>kill.php" class="text-red-600 hover:text-red-800 font-medium">Desconectar</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="text-center p-8 bg-white rounded-lg shadow-md">
            <h1 class="text-2xl font-semibold text-gray-700 mb-4">Faça o login para ver seus agentes</h1>
            <a href="<?= $BASE_URL ?>register.php" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors duration-200">
                Fazer Login
            </a>
        </div>
    <?php endif; ?>
</div>

<?php
include_once("templates/footer.php")
?>