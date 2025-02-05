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

    public function buildRules($data)
    {
        $rule = new Rules();
        $rule->id = $data['id'];
        $rule->rules = $data['rules'];
        $rule->ruleName = $data['ruleName'];
        $rule->user_id = $data['user_id'];
        return $rule;
    }

    public function getRulesByUserId($user_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM rules WHERE user_id = :user_id");
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch();
            $rule = $this->buildRules($data);
            return $rule;
        }
    }

    // TODO: Implementar $authUser para verificar se o usuário é o dono do agente
    public function create(Rules $rules)
    {
        $stmt = $this->conn->prepare("INSERT INTO rules (id, rules, ruleName, user_id) VALUES (:id, :rules, :ruleName, :user_id)");
        $stmt->bindParam(':id', $rules->id);
        $stmt->bindParam(':rules', $rules->rules);
        $stmt->bindParam(':ruleName', $rules->ruleName);
        $stmt->bindParam(':user_id', $rules->user_id);

        $stmt->execute();

        // Verificar se o insert foi bem sucedido
        $this->message->setMessage("regras adicionadas", "success", "index.php");
    }
    public function update(Rules $rules)
    {
        $stmt = $this->conn->prepare("UPDATE rules SET rules = :rules, ruleName = :ruleName WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $rules->user_id);
        $stmt->bindParam(':rules', $rules->rules);
        $stmt->bindParam(':ruleName', $rules->ruleName);
        $stmt->execute();

        $this->message->setMessage("regras atualizadas", "success", "index.php");
    }
}
