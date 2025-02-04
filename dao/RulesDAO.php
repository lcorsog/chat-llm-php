<?php
require_once("models/Rules.php");
require_once("models/Message.php");
require_once("models/User.php");


class RulesDAO implements RulesDAOInterface
{

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url)
    {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildRules($data) {}
    // TODO: Implementar $authUser para verificar se o usuário é o dono do agente
    public function create(Rules $rules, $ruleName)
    {
        $stmt = $this->conn->prepare("INSERT INTO rules (rules, ruleName) VALUES (:rules, :ruleName)");
        $stmt->bindParam(':rules', $rules->rules);
        $stmt->bindParam(':ruleName', $ruleName);

        $stmt->execute();

        // Verificar se o insert foi bem sucedido
        $this->message->setMessage("regras adicionadas", "success", "index.php");
    }
    public function update(Rules $rules, $redirect = true) {}
}
