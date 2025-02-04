<?php include_once("templates/header.php") ?>

<div class="h-screen bg-gray-100 dark:bg-gray-900 p-4 flex items-center justify-center">
    <button class="bg-red-500 text-white hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-blue-800">Sair</button>
    <a href="<?= $BASE_URL ?>logout.php" class="text-blue-500 hover:text-blue-700">sair</a>
</div>


<?php include_once("templates/footer.php") ?>