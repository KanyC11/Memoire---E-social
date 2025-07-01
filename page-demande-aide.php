<?php
session_start();
// if (!isset($_SESSION['Email'])) {
//     // Redirection de l'utilisateur vers la page de connexion si il n'est pas connecté
//     header("Location: connexion.php");
//     exit();
// }
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // connexion a la base de donne
$conn= new mysqli("localhost","root","","dons");
// verifie la connexion
if($conn-> connect_error){
    die("Connexion  échouée:". $connect_error);
}
// créer les variables et les initialisées à vide
$nom_prenom = $email = $adresse = $descriptions = $telephone = $demandes = "";
// Récupération des données du formulaire
$nom_prenom=htmlspecialchars( $_POST['nom_prenom']);
$adresse=htmlspecialchars( $_POST['adresse']);
$telephone= htmlspecialchars($_POST['telephone']);
$email=htmlspecialchars( $_POST['mail']);
$demandes= htmlspecialchars($_POST['les_demandes']);
$descriptions=htmlspecialchars( $_POST['descriptions']);
// requete sql insertion
$sql= "INSERT INTO aides (nom_prenom,adresse,telephone,mail,les_demandes,descriptions)
      VALUES ('$nom_prenom' ,'$adresse', '$telephone','$email','$demandes','$descriptions' )";

if($conn->query($sql)=== TRUE){
    echo "";
}else{
    echo"Erreur : ". $sql . "<br/>" . $conn->error;
}
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/jpg" href="images/favicon_Plan de travail 1.jpg">
    <title>À propos de nous - Don du Cœur</title>
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
            <a href="page-connexion.html" class="menu">Connexion</a>
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
            <form action="" method="POST">

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
                        <li><a href="page-demande-aide.html" class="footer-menu text-white text-decoration-none">Demande
                                d'aide</a></li>
                        <li><a href="page-connexion.html"
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
        const form = document.querySelector("form");
        const merciMessage = document.getElementById("merciMessage");

        form.addEventListener("submit", function (event) {
            event.preventDefault(); // Empêche l'envoi du formulaire temporairement

            // Afficher le message de remerciement
            merciMessage.style.display = "block";

            // Masquer le message après 5 secondes
            setTimeout(() => {
                merciMessage.style.display = "none";
                form.submit(); // Soumettre le formulaire après 7s
            }, 7000);
        });
    </script>

</body>

</html>