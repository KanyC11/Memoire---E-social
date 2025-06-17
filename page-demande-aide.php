<?php
session_start();
if (!isset($_SESSION['Email'])) {
    // Redirection de l'utilisateur vers la page de connexion si il n'est pas connecté
    header("Location: connexion.php");
    exit();
}
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="demande-aide.css">
    <link rel="icon" type="image/jpg" href="images/favicon_Plan de travail 1.jpg">
    <script src="message-envoi.js" defer></script>
    <title>Page demande d'aide</title>
</head>

<body>
    <nav class="entete">
        <img src="images/don-du-coeur.jpg" alt="" class="logo">
        <a href="index.html" class="menu">Accueil</a>
        <a href="page-a-propos.html" class="menu">A propos de nous</a>
        <a href="page-nos-projets.html" class="menu">Nos projets</a>
        <a href="page-de-don.html" class="menu">Faire un don</a>
        <a href="page-demamde-aide.html" class="menu">Demande d'aide</a>
        <a href="page-connexion.html" class="menu">Connexion</a>
    </nav>



<div class="demande">
    
    <div class="aide1">
        <img src="images/demande.jpg" alt="don" >
<div class="dernier">Ensemble nous semons des graines  d’espoir,<br> de solidarité et de compassion. <br>
    Vos demandes seront traitées avec  amour <br> et dans les régles <br> de la confidentialité. 
    Vous n’ étes pas  seule<br> nous sommes là pour <br> vous tendre la main  et vous redonner le sourir <br>
       &lt; &lt; un don, un sourire >>
</div>

 </div>

    <div class="aide2">
<form action="" method="POST">

<label for="nom_prenom" class="required">Nom & Prénom</label>
<input type="text" name="nom_prenom" placeholder="Nom complet" required> <br>

<label for="Adresse" class="required">Adresse</label> <br>
<input type="text" name="adresse" placeholder="Adresse" required><br>
<label for="telephone" class="required">Numéro de téléphone</label><br>
<input type="text" name="telephone" placeholder="Téléphone" required> <br>
<label for="mail" class="required">Email</label> <br>
<input type="email" name="mail" placeholder="Mail" required><br>
<label for="demande" class="required">Type de demande</label><br> 
<select name="les_demandes" required> 
    <option value="" disabled selected >Veillez sélectionner votre demande </option>
    <option value="Don de sang">Don de sang</option>
    <option value="nourriture">Nourriture</option>
    <option value="argent">Argent</option>
    <option value="materiel">Matériel</option>
    <option value="vetement">Vêtement</option>
    <option value="autres">Autres</option>
    </select>
    <label for="descriptions" class="required">Description</label><br>
    <textarea name="descriptions"  id="" cols="30" rows="10" placeholder="Tapez ici..." required></textarea><br/>
    <input type="submit" value="Envoyer" class="donner">
    <div id="merciMessage">
  Merci pour votre demande de don. Nous vous reviendrons ultérieurement.
    </div>
</form>
    </div>
</div>


<footer>

        <div class="row foot" style="background-color: #ff7f00;height: 200px;">
            <div class="col">
                <img src="images/don-du-coeur.jpg" alt="" class="logo-footer">
                <p class="texte-footer">Notre equipe s’engage à vous apporter leurs plus grand soutien chaque demande
                    sera traitée avec attention, confidentialité et humanité.</p>
            </div>
            <div class="col">
                <h4>LIENS UTILES</h4>
                <ul>
                    <li><a href="index.html" class="footer-menu">Accueil</a></li>
                    <li><a href="page-a-propos.html" class="footer-menu">A propos de nous</a></li>
                    <li><a href="page-nos-projets.html" class="footer-menu">Nos projets</a></li>
                    <li><a href="page-de-don.html" class="footer-menu">Faire un don</a></li>
                    <li><a href="page-demamde-aide.html" class="footer-menu">Demande d'aide</a></li>
                    <li><a href="page-connexion.html" class="footer-menu">Connexion</a></li>
                </ul>

            </div>
            <div class="col">
                <h4>CONTACTS</h4>
                <p class="p-footer">+221 33 900 00 00</p>
                <p class="p-footer">donducoeur@gmail.com</p>
                <h4>Suivez nous sur</h4>
                <img src="images/icone-sociaux_Plan de travail 1.jpg" alt="">
            </div> 
        </div>
        <div class="footer-bottom" style="background-color: #ff7f00;">
            <div class="col text-center">
                <p class="text-center">© 2025 Don du Coeur. Tous droits réservés.</p>
            </div>
    </footer>
    
</body>

</html>