<?php
require_once("models/User.php");
require_once("models/Message.php");

class UserDAO implements UserDAOInterface
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


    public function buildUser($data)
    {
        $user = new User();

        $user->id = $data['id'];
        $user->name = $data['name'];
        $user->lastName = $data['lastName'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->token = $data['token'];
        return $user;
    }
    public function create(User $user, $authUser = false)
    {
        $stmt = $this->conn->prepare("INSERT INTO users (name, lastName, email, password, token) VALUES (:name, :lastName, :email, :password, :token)");
        $stmt->bindParam(":name", $user->name);
        $stmt->bindParam(":lastName", $user->lastName);
        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":password", $user->password);
        $stmt->bindParam(":token", $user->token);

        $stmt->execute();
        $this->message->setMessage("usuário criado com sucesso", "success", "register.php");

        if ($authUser) {
            $this->setTokenToSession($user->token);
        }
    }
    public function update(User $user, $redirect = true)
    {
        $stmt = $this->conn->prepare("UPDATE users SET name = :name, lastName = :lastName, email = :email, password = :password, token = :token WHERE id = :id");

        $stmt->bindParam(":name", $user->name);
        $stmt->bindParam(":lastName", $user->lastName);
        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":password", $user->password);
        $stmt->bindParam(":token", $user->token);
        $stmt->bindParam(":id", $user->id);

        $stmt->execute();

        if ($redirect) {
            $this->message->setMessage("usuário atualizado com sucesso", "success", "register.php");
        }
    }
    public function verifyToken($protected = true)
    {
        if (!empty($_SESSION['token'])) {
            // Pega o token da sessão e verifica se é válido
            $token = $_SESSION["token"];
            $user = $this->findByToken($token);


            if ($user) {
                return $user;
            } else if ($protected) {
                $this->message->setMessage("Usuário invalido", "error", "register.php");
            }
        } else if ($protected) {
            $this->message->setMessage("Usuário inválido", "error", "register.php");
        }
    }
    public function setTokenToSession($token, $redirect = true)
    {
        $_SESSION["token"] = $token;
        if ($redirect) {
            $this->message->setMessage("Usuário autenticado", "success", "index.php");
        }
    }
    public function authenticateUser($email, $password)
    {

        $user = $this->findByEmail($email);
        if ($user) {
            if (password_verify($password, $user->password)) {
                $token = $user->generateToken();
                $this->setTokenToSession($token, false);

                //Atualizar o token da sessão
                $user->token = $token;
                $this->update($user, false);
                return true;
            }
        }
    }
    public function findByEmail($email)
    {
        if ($email != "") {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");
            $stmt->bindParam(":token", $token);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetch();
                $user = $this->buildUser($data);
                return $user;
            } else {
                return false;
            }
        }
    }
    public function findById($id) {}
    public function findByToken($token)
    {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");
        $stmt->bindParam(":token", $token);
        $stmt->execute();


        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch();
            $user = $this->buildUser($data);
            return $user;
        } else {
            return false;
        }
    }
    public function changePassword(User $user) {}
    public function destroyToken()
    {
        $_SESSION['token'] = "";

        //Redireciona o usuário para home
        $this->message->setMessage("Sessão encerrada com sucesso", "success", "index.php");
    }
}
