<?php
include_once("templates/header.php")
?>

<div class="h-screen flex flex-col items-center">

    <h1 class="text-3x1 font-bold w-1/2 text-center">Agentes</h1>
    <div class="flex w-1/2">
        <button href="<?= $BASE_URL ?>create.php" class="bg-blue-500 text-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Adicionar agente</button>
    </div>
    <table class="table-auto border-collapse border border-gray-300 shadow-lg items-center justify-center content-center text-center w-1/2 ">
        <thead class="text-l font-bold p-2">
            <tr>
                <td>Nome</td>
                <td>Status</td>
                <td>Preview</td>
                <td>Ações</td>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Groq</td>
                <td>Sim</td>
                <td>Seja um vendedor de produtos...</td>
                <td class="grid">
                    <a href="<?= $BASE_URL ?>rules.php?" class="text-blue-500 hover:text-blue-700">Editar regras</a>
                    <a href="#" class="text-blue-500 hover:text-blue-700">Desconectar</a>
                    <a href="#" class="text-blue-500 hover:text-blue-700">Excluir</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php
include_once("templates/footer.php")
?>