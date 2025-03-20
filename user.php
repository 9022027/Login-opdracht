<?php
//made by Farai
require_once "config.php"; 
class User {
    public $username;
    public $email;
    private $password;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT); // Hash het wachtwoord
    }

    public function registerUser() {
        $errors = [];

        if (empty($this->username) || empty($this->password)) {
            array_push($errors, "Gebruikersnaam en wachtwoord zijn verplicht.");
            return $errors;
        }

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            array_push($errors, "Gebruikersnaam bestaat al.");
        } else {
            $stmt = $this->conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);

            if ($stmt->execute()) {
                return [];
            } else {
                array_push($errors, "Er is iets misgegaan bij het registreren.");
            }
        }
        return $errors;
    }

    public function loginUser($password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password"])) {
            session_start();
            $_SESSION["user"] = $user["username"];
            return true;
        } else {
            return false;
        }
    }

    public function isLoggedIn() {
        session_start();
        return isset($_SESSION["user"]);
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php");
    }
}
?>
