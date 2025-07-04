<?php
session_start();
session_regenerate_id(true);

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_SESSION['Email'])) {
        echo "<script>
                alert('Vous devez être connecté pour faire une demande.');
                window.location.href = 'connexion.php';
              </script>";
        exit();
    }

    $conn = new mysqli("localhost", "root", "", "dons");

    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    $nom_prenom = htmlspecialchars(trim($_POST['nom_prenom']));
    $adresse = htmlspecialchars(trim($_POST['adresse']));
    $telephone = htmlspecialchars(trim($_POST['telephone']));
    $email = htmlspecialchars(trim($_POST['mail']));
    $demandes = htmlspecialchars(trim($_POST['les_demandes']));
    $descriptions = htmlspecialchars(trim($_POST['descriptions']));

    $stmt = $conn->prepare("INSERT INTO aides (nom_prenom, adresse, telephone, mail, les_demandes, descriptions) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nom_prenom, $adresse, $telephone, $email, $demandes, $descriptions);

    if ($stmt->execute()) {
        $success = true;
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="demande-aide.css">
    <link rel="stylesheet" href="a_propos.css">
    <link rel="stylesheet" href="auth.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/jpg" href="images/favicon_Plan de travail 1.jpg">
    <title>Demande d'aide</title>
</head>

<body>
    <nav class="entete">
        <img src="images/don-du-coeur.jpg" alt="Logo Don du Cœur" class="logo">

        <!-- Bouton hamburger -->
        <button class="menu-toggle" onclick="toggleMenu()" aria-label="Menu">☰</button>

        <!-- Menu principal -->
        <div class="menu-items" id="menu">
            <a href="index.html" class="menu">Accueil</a>
            <a href="page_a_propos.html" class="menu">À propos de nous</a>
            <a href="Nosprojets.html" class="menu">Nos projets</a>
            <a href="page_de_don.html" class="menu">Faire un don</a>
            <a href="page_demande_aide.html" class="menu">Demande d'aide</a>
            <a href="connexion.php" class="menu">Connexion</a>
            <a href="inscription.php" class="menu"></a>
        
        </div>
    </nav>

    <!-- contenu -->
    <div class="row" style="margin-top: 2rem; ">
        <div class="col">
            <div class="banners2">
                <div class="overlas">
                    <div class="contents">
                        <p>
                            Ensemble nous semons des graines d’espoir,<br> de solidarité et de compassion. <br>
                            Vos demandes seront traitées avec amour <br> et dans les régles <br> de la confidentialité.
                            Vous n’ étes pas seule<br> nous sommes là pour <br> vous tendre la main et vous redonner le
                            sourir <br>
                             un don, un sourire  </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col aide2">
            <h3 style="color: white;text-align: center;margin-top: 2rem;font-style: italic;">Demande de don</h3>
            <form id="formulaire" action="" method="POST" onsubmit="return verifierConnexion();">

                <label for="nom_prenom" class="required">Nom & Prénom</label>
                <input type="text" name="nom_prenom" placeholder="Nom complet" required>

                <label for="Adresse" class="required">Adresse</label>
                <input type="text" name="adresse" placeholder="Adresse" required>
                <label for="telephone" class="required">Numéro de téléphone</label>
                <input type="text" name="telephone" placeholder="Téléphone" required>
                <label for="mail" class="required">Email</label>
                <input type="email" name="mail" placeholder="Mail" required>
                <label for="demande" class="required">Type de demande</label>
                <select name="les_demandes" required>
                    <option value="" disabled selected>Sélectionner votre demande </option>
                    <option value="Don de sang">Don de sang</option>
                    <option value="nourriture">Nourriture</option>
                    <option value="argent">Argent</option>
                    <option value="materiel">Matériel</option>
                    <option value="vetement">Vêtement</option>
                    <option value="autres">Autres</option>
                </select><br>
                <label for="descriptions" class="required">Description</label>
                <textarea name="descriptions" id="" cols="30" rows="3" placeholder="Tapez ici..."
                    required></textarea>
                <input type="submit" value="Envoyer" class="donner">

            </form>
        </div>
    </div>
  <div id="merciMessage"  class="alert alert-info text-center " style="margin-top: 3rem;">
  Merci pour votre demande de don. Nous vous reviendrons ultérieurement.
    </div>
<br><br><br>
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
                        <li><a href="page_a_propos.html" class="footer-menu text-white text-decoration-none">À propos de
                                nous</a></li>
                        <li><a href="page-nos-projets.html" class="footer-menu text-white text-decoration-none">Nos
                                projets</a></li>
                        <li><a href="page-de-don.html" class="footer-menu text-white text-decoration-none">Faire un
                                don</a></li>
                        <li><a href="page-demande-aide.php" class="footer-menu text-white text-decoration-none">Demande
                                d'aide</a></li>
                        <li><a href="connexion.php"
                                class="footer-menu text-white text-decoration-none">Connexion</a></li>
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
    <script>
        function toggleMenu() {
            const menu = document.getElementById("menu");
            menu.classList.toggle("active");
        }

        // Fermer le menu mobile quand on clique sur un lien
        document.querySelectorAll('.menu').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById("menu").classList.remove("active");
            });
        });

        // Fermer le menu mobile quand on clique en dehors
        document.addEventListener('click', (e) => {
            const menu = document.getElementById("menu");
            const toggle = document.querySelector(".menu-toggle");

            if (!menu.contains(e.target) && !toggle.contains(e.target)) {
                menu.classList.remove("active");
            }
        });
    </script>
    <script>
function verifierConnexion() {
    var estConnecte = <?php echo isset($_SESSION['Email']) ? 'true' : 'false'; ?>;

    if (!estConnecte) {
        alert("Vous devez être connecté pour faire une demande.");
        window.location.href = "connexion.php";
        return false; // Empêche l'envoi
    }
    return true; // Autorise l'envoi
}
</script>
   <script>
const form = document.querySelector("form");
const merciMessage = document.getElementById("merciMessage");

// Simuler la session PHP dans JS
var estConnecte = <?php echo isset($_SESSION['Email']) ? 'true' : 'false'; ?>;

form.addEventListener("submit", function (event) {
    if (!estConnecte) {
        alert("Vous devez être connecté pour faire une demande.");
        window.location.href = "connexion.php";
        event.preventDefault(); // Bloque l'envoi
        return;
    }

    event.preventDefault(); // Bloque l'envoi temporairement

    // Afficher le message de remerciement seulement si connecté
    merciMessage.style.display = "block";

    setTimeout(() => {
        merciMessage.style.display = "none";
        form.submit(); // Soumettre le formulaire après 5s
    }, 5000);
});
</script>

</body>

</html>