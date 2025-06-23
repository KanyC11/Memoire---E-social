
<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomComplet = $_POST['nomComplet'];
    $email = $_POST['Email'];
    $motdepasse = password_hash($_POST['Motdepasse'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO utilisateurs (nomComplet, Email, Motdepasse) VALUES (?, ?, ?)");
    if ($stmt->execute([$nomComplet, $email, $motdepasse])) {
        echo "Inscription réussie";
    } else {
        echo "Erreur lors de l'inscription";
    }
}
?>
