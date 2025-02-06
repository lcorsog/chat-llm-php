<?php include_once("templates/header.php") ?>

<div class="min-h-screen bg-gradient-to-r from-blue-100 to-purple-100 dark:from-gray-800 dark:to-gray-900 p-8 flex items-center justify-center">
    <div class="flex gap-8 w-full max-w-5xl">
        <!-- Login Form -->
        <div class="p-8 bg-white dark:bg-gray-800 shadow-2xl rounded-2xl flex-1 transform hover:scale-105 transition-transform duration-300">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Já tem uma conta?</h2>
            <form action="register_process.php" method="POST" class="space-y-4">
                <input type="hidden" name="type" value="login">
                <input class="w-full p-4 bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 focus:outline-none focus:border-blue-500 rounded-lg transition-colors" placeholder="E-mail" name="email">
                <input type="password" class="w-full p-4 bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 focus:outline-none focus:border-blue-500 rounded-lg transition-colors" placeholder="Senha" name="password">
                <button type="submit" class="w-full bg-blue-500 text-white py-4 rounded-lg font-semibold hover:bg-blue-600 transform hover:scale-105 transition-all duration-300">Entrar</button>
            </form>
        </div>

        <!-- Register Form -->
        <div class="p-8 bg-white dark:bg-gray-800 shadow-2xl rounded-2xl flex-1 transform hover:scale-105 transition-transform duration-300">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Criar conta</h2>
            <form action="register_process.php" method="POST" class="space-y-4">
                <input type="hidden" name="type" value="register">
                <input required class="w-full p-4 bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 focus:outline-none focus:border-blue-500 rounded-lg transition-colors" placeholder="Nome" name="name">
                <input required class="w-full p-4 bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 focus:outline-none focus:border-blue-500 rounded-lg transition-colors" placeholder="Sobrenome" name="surname">
                <input required class="w-full p-4 bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 focus:outline-none focus:border-blue-500 rounded-lg transition-colors" placeholder="E-mail" name="email">
                <input required type="password" class="w-full p-4 bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 focus:outline-none focus:border-blue-500 rounded-lg transition-colors" placeholder="Senha" name="password">
                <input required type="password" class="w-full p-4 bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 focus:outline-none focus:border-blue-500 rounded-lg transition-colors" placeholder="Confirme sua senha" name="confirmPassword">
                <button type="submit" class="w-full bg-blue-500 text-white py-4 rounded-lg font-semibold hover:bg-blue-600 transform hover:scale-105 transition-all duration-300">Criar conta</button>
            </form>
        </div>
    </div>
</div>



<?php include_once("templates/footer.php") ?>