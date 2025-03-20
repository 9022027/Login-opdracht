<?php
//made by Farai
require_once "classes/user.php";

if (isset($_POST["login-btn"])) {
    $user = new User();
    $user->username = $_POST["username"];
    $password = $_POST["password"];

    if ($user->loginUser($password)) {
        echo "<script>alert('Login succesvol!'); window.location = 'index.php';</script>";
    } else {
        echo "<script>alert('Ongeldige gebruikersnaam of wachtwoord');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<body>
    <h3>Inloggen</h3>
    <form method="POST">
        <label>Gebruikersnaam:</label>
        <input type="text" name="username" required>
        <br>
        <label>Wachtwoord:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit" name="login-btn">Login</button>
    </form>
    <a href="register_form.php">Registreer hier</a>
</body>
</html>
