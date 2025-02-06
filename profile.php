<?php include_once("templates/header.php") ?>

<div class="h-screen bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-900 p-8">
    <div class="max-w-md mx-auto bg-white dark:bg-gray-700 rounded-xl shadow-lg p-8">
        <div class="text-center">
            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Perfil do Usuário</h2>
            <div class="mb-6">
                <div class="w-24 h-24 mx-auto bg-gray-300 dark:bg-gray-600 rounded-full mb-4">
                    <!-- Placeholder para foto de perfil -->
                    <svg class="w-full h-full text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                </div>
            </div>
            <div class="space-y-4">
                <a href="<?= $BASE_URL ?>logout.php"
                    class="inline-block w-full bg-red-500 text-white hover:bg-red-600 transition-colors duration-200 font-medium rounded-lg px-5 py-2.5 text-center">
                    Sair da Conta
                </a>
            </div>
        </div>
    </div>
</div>


<?php include_once("templates/footer.php") ?>