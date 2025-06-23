<!-- <?php
// index.php - Page d'accueil simple

session_start();

// Exemple : vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

// Traitement du formulaire ici
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ...vérification des identifiants...
    // Si connexion réussie :
    $_SESSION['user_id'] = $user_id;
    header('Location: login.html');
    exit();
}
?>
 -->
