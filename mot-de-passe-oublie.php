<?php
$message = "";
$messageClass = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = trim($_POST['identifiant']);
    $conn = new mysqli("localhost", "root", "", "dons");

    if ($conn->connect_error) {
        $message = "❌ Erreur de connexion à la base de données.";
        $messageClass = "alert-danger";
    } else {
        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $stmt = $conn->prepare("SELECT id, email FROM utilisateurs WHERE email = ?");
        } else {
            $stmt = $conn->prepare("SELECT id, email FROM utilisateurs WHERE telephone = ?");
        }
        $stmt->bind_param("s", $input);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $temp_pass = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 10);
            $hash = password_hash($temp_pass, PASSWORD_DEFAULT);

            $update = $conn->prepare("UPDATE utilisateurs SET mot_de_passe = ? WHERE id = ?");
            $update->bind_param("si", $hash, $user['id']);
            if ($update->execute()) {
                $message = "✅ Un nouveau mot de passe temporaire a été généré : <b>$temp_pass</b><br>Connectez-vous et changez-le rapidement.";
                $messageClass = "alert-success";
            } else {
                $message = "❌ Erreur lors de la mise à jour du mot de passe.";
                $messageClass = "alert-danger";
            }
            $update->close();
        } else {
            $message = "❌ Aucun utilisateur trouvé avec cet identifiant.";
            $messageClass = "alert-danger";
        }
        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mot de passe oublié</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/a_propos.css">
    <link rel="stylesheet" href="css/auth.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/jpg" href="images/favicon_Plan de travail 1.jpg">
</head>

<body>
    <div class="auth-container">
        <div class="auth-wrapper">
            <!-- Partie gauche avec image -->
            <div class="auth-image">
                <div class="image-overlay">
                    <h2>Un petit geste, un grand impact</h2>
                    <p>Rejoignez notre communauté solidaire et participez à des actions qui changent des vies.</p>
                </div>
            </div>

            <!-- Partie droite avec formulaire -->
            <div class="auth-form">
                <div class="form-container">
                    <div class="text-center mb-4">
                        <img src="images/don-du-coeur.jpg" alt="Logo Don du Cœur" class="form-logo">
                        <h1 class="form-title">Mot de passe oublié</h1>
                        <p class="form-subtitle">Entrez votre email ou téléphone pour recevoir un nouveau mot de passe</p>
                    </div>

                    <?php if ($message): ?>
                        <div class="alert <?= $messageClass ?>">
                            <?= $message ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="identifiant" class="form-label">
                                <i class="fas fa-user"></i>
                                Email ou numéro de téléphone
                            </label>
                            <input type="text" class="form-control" id="identifiant" name="identifiant" required>
                        </div>

                        <button type="submit" class="btn-auth btn-primary mt-3">
                            <i class="fas fa-key"></i>
                            Générer un nouveau mot de passe
                        </button>
                    </form>

                    <div class="auth-links mt-3">
                        <a href="connexion.php" class="btn-auth btn-secondary">
                            <i class="fas fa-sign-in-alt"></i>
                            Retour à la connexion
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <footer class="bg-orange text-white py-5">
        <div class="container">
            <div class="row g-4"  style="margin-left: 3.2rem;" >
                <div class="col-lg-4 col-md-6 col-12 text-center text-md-start">
                    <img src="images/don-du-coeur.jpeg" alt="Logo Don du Cœur" class="logo-footer mb-3">
                    <p class="texte-footer">
                        Notre équipe s'engage à vous apporter leur plus grand soutien. Chaque demande
                        sera traitée avec attention, confidentialité et humanité.
                    </p>
                </div>

                <div class="col-lg-4 col-md-6 col-12 text-center text-md-start">
                    <h4 class="fw-bold mb-3" style="font-size: 2rem;">Liens utiles</h4>
                   <ul class="list-unstyled">
                        <li><a href="index.html" class="footer-menu text-white text-decoration-none">Accueil</a></li>
                        <li><a href="page_a_propos.html" class="footer-menu text-white text-decoration-none">À propos de nous</a></li>
                        <li><a href="Nosprojets.html" class="footer-menu text-white text-decoration-none">Nos projets</a></li>
                        <li><a href="page_de_don.php" class="footer-menu text-white text-decoration-none">Faire un don</a></li>
                        <li><a href="page_demande_aide.php" class="footer-menu text-white text-decoration-none">Demande d'aide</a></li>
                        <li><a href="connexion.php" class="footer-menu text-white text-decoration-none">Connexion</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12 col-12 text-center text-md-start">
                    <h4 class="fw-bold mb-3" style="font-size: 2rem;">Contacts</h4>
                    <p class="mb-1">📞 +221 33 900 00 00</p>
                    <p class="mb-3">📧 donducoeur@gmail.com</p>
                    <h5>Suivez-nous sur</h5>
                    <div class="socials d-flex justify-content-center justify-content-md-start gap-3 mt-2">
                        <a href="#" class="text-white fs-5"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white fs-5"><i class="fab fa-x-twitter"></i></a>
                        <a href="#" class="text-white fs-5"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white fs-5"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
         <div class="col text-center">
                <p class="text-center">© 2025 Don du Coeur. Tous droits réservés.</p>
            </div>
    </footer>  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
