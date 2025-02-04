<?php

session_start();

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = $_POST['message'];
    $_SESSION['message'] = $message;
    header('Location: sandbox.php'); // Rediceciona para o index.php
}


// Responde a mensagem com LLM e envia para o index.php
function callGroqApi($message)
{
    $apiKey = "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";
    $apiUrl = "https://api.groq.com/openai/v1/chat/completions";



    // Dados para enviar para a API
    $data = [
        "model" => "llama-3.3-70b-versatile",
        "messages" => [
            [
                "role" => "user",
                "content" => $message
            ],
            [
                "role" => "system",
                "content" => "Você trabalha em uma empresa de rastreamento veicular, e precisa responder a perguntas sobre o histórico de um veículo. Você deve responder em português. Se você não sabe uma resposta, responda que você não sabe. Se você não tem informações suficientes, responda que você não tem informações suficientes. Você pode usar apenas informações fornecidas. Não faça perguntas que não estejam relacionadas ao histórico do veículo. 
                A empresa é focada no rastreamento de motos e carros, não fazemos rastreamento de caminhões e bicicletas. Nosso plano custa R$29,90 por mês, e somente aceitamos pagamento no cartão. Você deve apenas responder o que foi perguntado, não fique falando informações a mais. Na apresentação, fale brevemente da empresa, e nada mais
                Caso a pessoa peça a segunda via do boleto, envie para ela o link https://www.groq.com/boletos-veiculos-e-motos
                Caso o cliente tenha interesse em comprar o serviço, envia para ele o link https://comprar.groq.com?
                // Mensagem de boas vindas (usar mensagem sempre que indicar que uma conversa foi iniciado sem contexto específico já definido): Seja bem vindo a tracfy, somos a melhor do sul. Meu nome é luis, como posso te ajudar hj?
                caso o cliente queira conversar com um atendente, coloque uma flag nele e mande uma mensagem para 43984162447. Se o cliente o cpf obtenha via.
                ## Se  for 123:
                    ola mistrello
                ## Se for 321:
                    ola luis
                "
            ]
        ],
    ];
    // Configuração da requisição cURL
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer " . $apiKey
    ]);

    // Executa a requisição
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Verifica se houve erro na requisição
    if ($httpCode !== 200) {
        return "Erro ao conectar à API: " . curl_error($ch);
    }

    curl_close($ch);

    // Decodifica a resposta JSON
    $responseData = json_decode($response, true);

    // Retorna a resposta da IA
    return $responseData['choices'][0]['message']['content'] ?? "Não foi possível obter uma resposta.";
}
