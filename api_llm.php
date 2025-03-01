llm.php
<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once("dao/RulesDAO.php");
require_once("dao/UserDAO.php");
require_once("globals.php");
require_once("message_process.php");
require_once("helpers/db.php");

$userDao = new UserDAO($conn, $BASE_URL);
$userData = $userDao->verifyToken();

$rulesDao = new RulesDAO($conn, $BASE_URL);
$rulesData = $rulesDao->getRulesByUserId($userData->id);


ob_clean();

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data['message'])) {
    $defaultRule = $rulesData->rules;

    // Passa o histórico para a função callGroqApi
    $response = callGroqApi($data['message'], $defaultRule, $data['history'] ?? []);

    while (ob_get_level()) ob_end_clean();

    echo json_encode(['response' => $response], JSON_UNESCAPED_UNICODE);
    exit;
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Message not provided']);
    exit;
}
