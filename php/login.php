
<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Email'];
    $motdepasse = $_POST['Motdepasse'];

    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE Email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($motdepasse, $user['Motdepasse'])) {
        echo "Connexion réussie";
    } else {
        echo "Email ou mot de passe incorrect";
    }
}
?>
