<?php
//made by Farai
require_once "classes/user.php";

if (isset($_POST["register-btn"])) {
    $user = new User();
    $user->username = $_POST["username"];
    $user->email = $_POST["email"];
    $user->setPassword($_POST["password"]);

    $errors = $user->registerUser();

    if (empty($errors)) {
        echo "<script>alert('Registratie succesvol!'); window.location = 'login_form.php';</script>";
    } else {
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<body>
    <h3>Registreren</h3>
    <form method="POST">
        <label>Gebruikersnaam:</label>
        <input type="text" name="username" required>
        <br>
        <label>Email:</label>
        <input type="email" name="email" required>
        <br>
        <label>Wachtwoord:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit" name="register-btn">Registreer</button>
    </form>
    <a href="index.php">Terug</a>
</body>
</html>
