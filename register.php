<?php include_once("templates/header.php") ?>

<div class="h-screen bg-gray-100 dark:bg-gray-900 p-4 flex items-center justify-center">
    <div class="p-6 bg-white shadow-md rounded-lg items-center justify-center w-1/3 h-fit mr-2">
        <h2>Já tem uma conta?</h2>
        <form action="register_process.php" method="POST" class="p-2">
            <input type="hidden" name="type" value="login">
            <input class="w-full h-full p-4 mb-4 border-2 border-gray-300 focus:outline-none focus:border-blue-500 rounded-lg" placeholder="E-mail" name="email">
            <input class="w-full h-full p-4 mb-4 border-2 border-gray-300 focus:outline-none focus:border-blue-500 rounded-lg" placeholder="Senha" name="password">
            <button type="submit" class="bg-blue-500 text-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Entrar</button>
        </form>
    </div>
    <div class="p-6 bg-white shadow-md rounded-lg items-center justify-center w-1/3 h-fit ">
        <h2>Criar conta</h2>
        <form action="register_process.php" method="POST" class="p-2">
            <input type="hidden" name="type" value="register">
            <input required class="w-full h-full p-4 mb-4 border-2 border-gray-300 focus:outline-none focus:border-blue-500 rounded-lg" placeholder="Nome" name="name">
            <input required class="w-full h-full p-4 mb-4 border-2 border-gray-300 focus:outline-none focus:border-blue-500 rounded-lg" placeholder="Sobrenome" name="surname">
            <input required class="w-full h-full p-4 mb-4 border-2 border-gray-300 focus:outline-none focus:border-blue-500 rounded-lg" placeholder="E-mail" name="email">
            <input required class="w-full h-full p-4 mb-4 border-2 border-gray-300 focus:outline-none focus:border-blue-500 rounded-lg" placeholder="Senha" name="password">
            <input required class="w-full h-full p-4 mb-4 border-2 border-gray-300 focus:outline-none focus:border-blue-500 rounded-lg" placeholder="Confirme sua senha" name="confirmPassword">
            <button type="submit" class="bg-blue-500 text-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Criar conta</button>
        </form>

    </div>
</div>
</div>


<?php include_once("templates/footer.php") ?>