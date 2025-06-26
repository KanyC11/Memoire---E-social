<?php
session_start();

$message = "";
$messageClass = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (!$email || empty($password)) {
        $message = "❌ Veuillez remplir tous les champs correctement.";
        $messageClass = "alert-danger";
    } else {
        $conn = new mysqli("localhost", "root", "", "dons");
        if ($conn->connect_error) {
            $message = "❌ Erreur de connexion à la base de données.";
            $messageClass = "alert-danger";
        } else {
            $stmt = $conn->prepare("SELECT id, mot_de_passe FROM utilisateurs WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['mot_de_passe'])) {
                    // Connexion réussie
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_email'] = $email;
                    $message = "✅ Connexion réussie. Bienvenue !";
                    $messageClass = "alert-success";

                    //  rediriger vers une page accueil
                    header("Location: index.html");
                     exit;
                } else {
                    $message = "❌ Mot de passe incorrect.";
                    $messageClass = "alert-danger";
                }
            } else {
                $message = "❌ Aucun compte trouvé avec cet email.";
                $messageClass = "alert-danger";
            }
            $stmt->close();
            $conn->close();
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
   <!-- Main Content -->
    <div class="auth-container">
        <div class="auth-wrapper">
            <!-- Left Side - Image -->
            <div class="auth-image">
                <div class="image-overlay">
                    <h2>Un petit geste, un grand impact</h2>
                    <p>Rejoignez notre communauté solidaire et participez à des actions qui changent des vies.</p>
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="auth-form">
                <div class="form-container">
                    <div class="text-center mb-4">
                        <img src="images/don-du-coeur.jpg" alt="Logo Don du Cœur" class="form-logo">
                        <h1 class="form-title">Bienvenue sur Don du Cœur</h1>
                        <p class="form-subtitle">Connectez-vous pour accéder à votre compte</p>
                    </div>
<?php if ($message): ?>
    <div class="alert <?= $messageClass ?>">
        <?= $message ?>
    </div>
<?php endif; ?>
                    <form id="loginForm" action="" method="POST">
                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i>
                                Adresse email
                            </label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock"></i>
                                Mot de passe
                            </label>
                            <div class="password-input">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-options">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    Se souvenir de moi
                                </label>
                            </div>
                            
                        </div>

                        <button type="submit" class="btn-auth btn-primary">
                            <i class="fas fa-sign-in-alt"></i>
                            Se connecter
                        </button>

                        <div class="auth-divider">
                            <span>ou</span>
                        </div>

                        <div class="auth-links">
                            <p>Vous n'avez pas de compte ?</p>
                            <a href="inscription.php" class="btn-auth btn-secondary">
                                <i class="fas fa-user-plus"></i>
                                Créer un compte
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