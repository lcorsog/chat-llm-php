<?php
require_once("helpers/db.php");
require_once("dao/RulesDAO.php");
require_once("dao/UserDAO.php");
require_once("globals.php");
require_once("models/Rules.php");
require_once("models/Message.php");

// Verificar se a sessão está ativa
// session_start();

$message = new Message($BASE_URL);
$auth = new UserDAO($conn, $BASE_URL);

// Pega os dados do usuario
$userData = $auth->verifyToken();

$rulesDao = new RulesDAO($conn, $BASE_URL);



//Verificar se o post é rules
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $rules = $_POST['rules'];
    $ruleName = $_POST['ruleName'];


    $rule = new Rules();
    if (!empty($rules) && !empty($ruleName)) {
        $rule->rules = $rules;
        $rule->ruleName = $ruleName;
        $rule->user_id = $userData->id;
        $rulesDao->create($rule);
    } else {
        $message->setMessage("Faltam informações", "error", "back");
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type'] === 'edit') {
    $rules = $_POST['rules'];
    $ruleName = $_POST['ruleName'];



    $rule = new Rules();
    if (!empty($rules) && !empty($ruleName)) {

        $rule->rules = $rules;
        $rule->ruleName = $ruleName;
        $rule->user_id = $userData->id;
        $rulesDao->update($rule);
    } else {
        $message->setMessage("Faltam informações", "error", "back");
    }
}
