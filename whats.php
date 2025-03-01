<?php
include_once("templates/header.php");
require_once("dao/UserDAO.php");

// Verifica se o usuário está logado
$userDao = new UserDAO($conn, $BASE_URL);
$userData = $userDao->verifyToken(true);
?>

<div class="container mt-5 h-screen content-center items-center justify-center">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <h2 class="font-bold">WhatsApp QR Code</h2>
            <div id="qrcode-container" class="mt-4 bg-white p-4 rounded-lg shadow-lg inline-block">
                <img id="qrcode" src="" alt="QR Code" style="display: none;">
                <p id="loading">Iniciando sessão...</p>
            </div>
            <p class="mt-3 font-bold">Escaneie o QR Code com seu WhatsApp para conectar</p>
            <div id="connection-status" class="mt-3 text-muted"></div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js" integrity="sha512-pUhApVQtLbnpLtJn6DuzDD5o2xtmLJnJ7oBoMsBnzOkVkpqofGLGPaBJ6ayD2zQe3lCgCibhJBi4cj5wAxwVKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    const userId = "<?= $userData->id ?>";
    const qrcodeImg = document.getElementById('qrcode');
    const loading = document.getElementById('loading');
    const status = document.getElementById('connection-status');

    // Inicia a sessão
    async function initSession() {
        try {
            const response = await fetch("http://localhost:3000/session", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    userId
                })
            });

            if (response.ok) {
                checkQRCode();
                monitorStatus();
            } else {
                throw new Error('Falha ao iniciar sessão');
            }
        } catch (error) {
            status.textContent = "Erro ao iniciar sessão";
            console.error("Erro:", error);
        }
    }


    // Verifica o QR code
    async function checkQRCode() {
        try {
            const response = await fetch(`http://localhost:3000/qr/${userId}`);
            const data = await response.json();

            if (data.success && data.qrCode) { // Note que é qrCode, não qrcode
                // Simply set the image source to the data URL
                qrcodeImg.src = data.qrCode;
                qrcodeImg.style.display = 'block';
                loading.style.display = 'none';
                status.textContent = 'QR Code carregado! Escaneie com seu WhatsApp';
            }
        } catch (error) {
            console.error("Erro ao obter QR Code:", error);
            status.textContent = "Erro ao obter QR Code";
        }
    }

    async function monitorStatus() {
        try {
            const response = await fetch(`http://localhost:3000/status/${userId}`)
            const data = await response.json();

            if (data.success) {
                status.textContent = `Status: ${data.status}`;

                if (data.status === 'connected') {
                    qrcodeImg.style.display = 'none';
                    loading.textContent = 'Conectado!';
                    loading.style.display = 'block';
                }
            }
        } catch (error) {
            console.error('Erro ao verificar status:', error);
        }
    }

    // iniciar a sessão
    initSession();


    //confere o qrcode a cada 3 segundos
    setInterval(() => {
        checkQRCode();
        monitorStatus();
    }, 5000);
</script>

<?php include_once("templates/footer.php");
?>