<?php

require_once("dao/RulesDAO.php");
require_once("dao/UserDAO.php");
require_once("globals.php");



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = $_POST['message'];
    $_SESSION['message'] = $message;
    header('Location: sandbox.php'); // Rediceciona para o index.php
}



// Responde a mensagem com LLM e envia para o index.php
function callGroqApi($message, $rule)
{
    $config = parse_ini_file(__DIR__ . '/.env');
    $key = $config['API_KEY'];

    $apiKey = $key;
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
                "content" => $rule
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
