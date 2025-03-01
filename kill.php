<?php
include_once("templates/header.php");
require_once("dao/UserDAO.php");

$userDao = new UserDAO($conn, $BASE_URL);
$userData = $userDao->verifyToken(true);

?>

<div id="disconnectContainer" style="display: none;" class="container mx-auto max-w-2xl mt-20 p-8 bg-white rounded-lg shadow-lg">
    <h3 class="text-2xl text-gray-800 mb-6 text-center">Você tem certeza que deseja desconectar?</h3>
    <div class="flex justify-center">
        <button id="disconnectBtn" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-300">
            Desconectar
        </button>
    </div>
</div>

<div id="noSessionMessage" style="display: none;" class="container mx-auto max-w-2xl mt-20 p-8 bg-white rounded-lg shadow-lg">
    <h3 class="text-2xl text-gray-800 mb-6 text-center">Nenhuma sessão ativa encontrada</h3>
</div>

<script>
    const userId = <?= $userData->id ?>;
    const disconnectContainer = document.getElementById("disconnectContainer");
    const noSessionMessage = document.getElementById("noSessionMessage");


    // Verifica se a sessão do usuário está ativa
    checkSession();


    // Verifica a sessão ao carregar a pagina
    async function checkSession() {
        try {
            const response = await fetch(`http://localhost:3000/status/${userId}`);
            const data = await response.json();

            if (data.success) {
                disconnectContainer.style.display = "block";
                noSessionMessage.style.display = "none";
            } else {
                disconnectContainer.style.display = "none";
                noSessionMessage.style.display = "block";
            }
        } catch (error) {
            console.error("Erro ao verificar status da sessão:", error);
            noSessionMessage.style.display = "block";
        }
    }



    // Encerra a sessão do whatsapp

    document.getElementById("disconnectBtn").addEventListener("onclick", async () => {
        try {
            const response = await fetch("http://localhost:3000/kill", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    userId
                })
            })

            if (response.ok) {
                alert("Sessão encerrada com sucesso");
                window.location.href = "index.php";
            }
        } catch (error) {
            console.error("Erro ao encerrar sessão:", error);
            alert("Erro ao encerrar sessão");
        }
    });

    // Verifica se a sessão do usuário está ativa
</script>




<?php include_once("templates/footer.php"); ?>