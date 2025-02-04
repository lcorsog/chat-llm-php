<?php

session_start();
class Message
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function setMessage($msg, $type, $redirect = "index.php")
    {
        $_SESSION["msg"] = $msg;
        $_SESSION["type"] = $type;

        if ($redirect != "back") {
            header("Location: $this->url$redirect");
        } else {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    public function getMessage()
    {
        if (isset($_SESSION["msg"])) {
            return $_SESSION["msg"];
        } else {
            return "";
        }
    }

    public function clearMessage()
    {
        unset($_SESSION["msg"]);
        unset($_SESSION["type"]);
    }
}
