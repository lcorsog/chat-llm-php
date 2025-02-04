<?php
require_once("helpers/db.php");
require_once("dao/RulesDAO.php");
require_once("dao/UserDAO.php");
require_once("globals.php");

// Verificar se a sessão está ativa
session_start();

$message = new Message($BASE_URL);
$auth = new UserDAO($conn, $BASE_URL);

$rulesDao = new RulesDAO($conn, $BASE_URL);

//Verificar se o post é rules
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rules'])) {
    $rules = $_POST['rules'];
    $ruleName = $_POST['ruleName'];

    $rule = new Rules();
    $rule->rules = $rules;
    $rule->ruleName = $ruleName;

    print_r($rule);


    $rulesDao->create($rule, $ruleName);
}
