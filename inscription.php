<?php
// Initialisation de la variable message
$message = "";
$messageClass = ""; // pour la classe Bootstrap (alert-success ou alert-danger)

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Nettoyage
    $prenom = htmlspecialchars(strip_tags(trim($_POST['prenom'])));
    $nom = htmlspecialchars(strip_tags(trim($_POST['nom'])));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $telephone = htmlspecialchars(strip_tags(trim($_POST['telephone'])));
    $passwords = trim($_POST['passwords']);

    if (empty($prenom) || empty($nom) || empty($email) || empty($telephone) || empty($passwords)) {
        $message = "❌ Veuillez remplir tous les champs du formulaire.";
        $messageClass = "alert-danger";
    } else {
        $conn = new mysqli("localhost", "root", "", "dons");

        if ($conn->connect_error) {
            $message = "❌ Connexion échouée : " . $conn->connect_error;
            $messageClass = "alert-danger";
        } else {
            $check = $conn->prepare("SELECT id FROM utilisateurs WHERE email = ?");
            $check->bind_param("s", $email);
            $check->execute();
            $check->store_result();

            if ($check->num_rows > 0) {
                $message = "❌ Cet email est déjà utilisé.";
                $messageClass = "alert-danger";
                $check->close();
                $conn->close();
            } else {
                $check->close();
                $mot_de_passe_hash = password_hash($passwords, PASSWORD_DEFAULT);

                $stmt = $conn->prepare("INSERT INTO utilisateurs (prenom, nom, email, telephone, mot_de_passe) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $prenom, $nom, $email, $telephone, $mot_de_passe_hash);

                if ($stmt->execute()) {
                    $message = "✅ Inscription réussie ! Vous pouvez maintenant vous connecter.";
                    $messageClass = "alert-success";
                    // Redirection automatique après 3 secondes
                     header("Refresh: 3; URL=connexion.php");
                    // Optionnel : vider les variables pour vider le formulaire
                    $prenom = $nom = $email = $telephone = "";
                } else {
                    $message = "❌ Erreur lors de l'inscription : " . $stmt->error;
                    $messageClass = "alert-danger";
                }
                $stmt->close();
                $conn->close();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/a_propos.css">
     <link rel="stylesheet" href="css/auth.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/jpg" href="images/favicon_Plan de travail 1.jpg">
    <title>À propos de nous - Don du Cœur</title>
</head>

<body>
    
<!-- contenu -->
   <div class="auth-container">
        <div class="auth-wrapper">
            <!-- gauche - Image -->
            <div class="auth-image">
                <div class="image-overlay">
                    <h2>Créez un grand impact</h2>
                    <p>Inscrivez-vous pour rejoindre notre communauté et participer à des actions solidaires qui changent des vies.</p>
                </div>
            </div>

            <!-- droite - Form -->
            <div class="auth-form">
                <div class="form-container">
                    <div class="text-center mb-4">
                        <img src="images/don-du-coeur.jpg" alt="Logo Don du Cœur" class="form-logo">
                        <h1 class="form-title">Rejoignez Don du Cœur</h1>
                        <p class="form-subtitle">Créez votre compte pour commencer à faire la différence</p>
                    </div>
<!-- Affichage du message -->
                    <?php if ($message): ?>
                        <div class="alert <?= $messageClass ?>">
                            <?= $message ?>
                        </div>
                    <?php endif; ?>
                    <form id="registerForm" action="" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prenom" class="form-label">
                                        <i class="fas fa-user"></i>
                                        Prénom
                                    </label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nom" class="form-label">
                                        <i class="fas fa-user"></i>
                                        Nom
                                    </label>
                                    <input type="text" class="form-control" id="nom" name="nom" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i>
                                Adresse email
                            </label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label for="telephone" class="form-label">
                                <i class="fas fa-phone"></i>
                                Téléphone
                            </label>
                            <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="+221 XX XXX XX XX">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock"></i>
                                Mot de passe
                            </label>
                            <div class="password-input">
                                <input type="password" class="form-control" id="password" name="passwords" required>
                                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="password-strength">
                                <div class="strength-bar">
                                    <div class="strength-fill"></div>
                                </div>
                                <small class="strength-text">Utilisez au moins 8 caractères avec des lettres et des chiffres</small>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>

 
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="terms" name="terms" >
                            <label class="form-check-label" for="terms">
                                J'accepte les <a href="#" class="text-primary">conditions d'utilisation</a> et la <a href="#" class="text-primary">politique de confidentialité</a>
                            </label>
                            <div class="invalid-feedback"></div>
                        </div>

                    

                        <button type="submit" class="btn-auth btn-primary">
                            <i class="fas fa-user-plus"></i>
                            Créer mon compte
                        </button>

                        <div class="auth-divider">
                            <span>ou</span>
                        </div>

                        <div class="auth-links">
                            <p>Vous avez déjà un compte ?</p>
                            <a href="connexion.php" class="btn-auth btn-secondary">
                                <i class="fas fa-sign-in-alt"></i>
                                Se connecter
                            </a>
                        </div>
                    </form>
                    <div class="alert alert-danger" id="errorAlert" style="display: none;">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span id="errorMessage"></span>
                    </div>

                    <div class="alert alert-success" id="successAlert" style="display: none;">
                        <i class="fas fa-check-circle"></i>
                        <span id="successMessage"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Footer -->
    <footer class="bg-orange text-white py-5">
        <div class="container">
            <div class="row g-4">
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
                        <li><a href="page-nos-projets.html" class="footer-menu text-white text-decoration-none">Nos projets</a></li>
                        <li><a href="page-de-don.html" class="footer-menu text-white text-decoration-none">Faire un don</a></li>
                        <li><a href="page-demande-aide.html" class="footer-menu text-white text-decoration-none">Demande d'aide</a></li>
                        <li><a href="page-connexion.html" class="footer-menu text-white text-decoration-none">Connexion</a></li>
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
    </footer>  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
      
    </body>
    </html>