
<?php
require 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Email'];

    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE Email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        echo "Lien de réinitialisation envoyé (exemple)";
    } else {
        echo "Email non trouvé";
    }
}
?>
