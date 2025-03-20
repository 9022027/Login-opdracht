<?php
//made by Farai
require_once "classes/user.php";
$user = new User();

if (isset($_GET["logout"])) {
    $user->logout();
}
?>

<!DOCTYPE html>
<html lang="nl">
<body>
    <h3>Welkom op de Homepagina</h3>

    <?php if ($user->isLoggedIn()): ?>
        <p>Je bent ingelogd als: <?= $_SESSION["user"] ?></p>
        <a href="?logout=true">Uitloggen</a>
    <?php else: ?>
        <p>Je bent niet ingelogd.</p>
        <a href="login_form.php">Inloggen</a>
        <a href="register_form.php">Registreren</a>
    <?php endif; ?>
</body>
</html>
