<?php
$message= null;
if($_SERVER["REQUEST_METHOD"] == "POST"){

// Récupération des données du formulaire
$prenomnom= htmlspecialchars(strip_tags(trim($_POST['prenomnom'])));
$adresse= htmlspecialchars(strip_tags(trim($_POST['adresse'])));
$telephone= htmlspecialchars(strip_tags(trim($_POST['telephone'])));
$email= htmlspecialchars(strip_tags(trim($_POST['email'])));
$typedon= htmlspecialchars(strip_tags(trim($_POST['typedon'])));
$soutiens= htmlspecialchars(strip_tags(trim($_POST['soutiens'])));
$description= htmlspecialchars(strip_tags(trim($_POST['description'])));

    // Vérification que tous les champs sont remplis
    if (
        empty($prenomnom) || empty($adresse) || empty($telephone) || empty($email) ||
        $typedon === "-" || $soutiens === "-" || empty($description)
    ) {
        $message = "❌ Veuillez remplir tous les champs du formulaire.";
    } else {
        // Connexion à la base de données
        $conn = new mysqli("localhost", "root", "", "dons");

        if ($conn->connect_error) {
            die("Connexion échouée: " . $conn->connect_error);
        }
// requete sql insertion
$stmt= $conn->prepare("INSERT INTO donations (prenomnom,adresse,telephone,email,typedon,description,soutiens)
      VALUES (?,?,?,?,?,?,?)");
//  "sssssss" signifie : 7 chaînes (string)
$stmt-> bind_param("sssssss",$prenomnom,$adresse,$telephone,$email,$typedon,$soutiens,$description);
if($stmt->execute()){
    $message = "🎉 Votre don a bien été reçu, merci infiniment !";
}else{
    $message = "Une erreur est survenue";
}
$stmt->close();
$conn->close();
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="page-don.css">
    <link rel="icon" type="image/jpg" href="images/favicon_Plan de travail 1.jpg">
    <title>Page de don</title>
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
    <h1 class="titre"> Faites un don</h1>
    <p class="don">Votre générosité change des vies. Faites un don aujourd'hui.</p>
    <p class="don">Un petit geste, un grand impact.</p>
    <div class="row formul">
        <div class="col formulai">
            <form action="" method="POST">
                <label for="prenomnom">Prénom et nom </label> <br>
                <input type="text" id="prenomnom" name="prenomnom" placeholder="Prenom et nom"><br>
                <label for="adresse">Adresse</label><br>
                <input type="text" name="adresse" id="adresse" placeholder="Adresse"><br>
                <label for="telephone">Téléphone</label><br>
                <input type="text" id="telephone" name="telephone" placeholder="Telephone"><br>
                <label for="mail">Email</label><br>
                <input type="email" id="email" name="email" placeholder="Email"><br>
                <label for="soutiens"> Je soutiens ce projet</label><br>
                <select name="soutiens" id="soutiens">
                    <option value="-">Selectionner un projet</option>
                    <option value="1">Paiement ordonnance</option>
                    <option value="2">collecte de vêtements pour les daaras</option>
                    <option value="3">Collecte de denrés alimentaires</option>
                    <option value="4">Construction d’une espace de jeux </option>
                    <option value="5">Consultation gratuit</option>
                    <option value="6">Organisation d'ateliers de sensibilisation à la santé</option>
                </select><br>
                <label for="typedon">Type de don</label><br>
                <select name="typedon" id="typedon">
                    <option value="-"> Veuillez choisir le type de don</option>
                    <option value="01"> Vêtements</option>
                    <option value="02"> Nourritures</option>
                    <option value="03"> Argents</option>
                    <option value="04"> Matériels</option>
                    <option value="05"> Autre</option>
                </select><br>
                <label for="description"> Description du don</label><br>
                <textarea name="description" id="description" rows="4" placeholder="Décrivez votre don..."></textarea>
            
        </div>
        <div class="col coul">
            <img src="images/don6.jpg" alt="" class="doncoeur">
            <p class="texteimg">Chaque don compte. Grâce à votre générosité, nous pouvons soutenir des causes sociales importantes, aider les plus démunis, financer des projets éducatifs, sanitaires et environnementaux. Ensemble, nous construisons un monde plus solidaire.</p>

        </div>
    </div>
    <div class="btn">
        <button type="submit" class="bouton">Envoyer</button>
    </div>
    </form>
    <?php if (!is_null($message)): ?>
<div id="message" class="alert alert-info text-center">
    <?php echo $message; ?>
</div>
<?php endif; ?>

    <div class="row">
        <div class="col">
            <p style="margin-left: 30px;">Pour faire un don en espèces, veuillez remplir le formulaire puis scanner l’un des QR codes.</p>
            <img src="images/wave_Plan de travail 1.jpg" alt="">
        </div>
        <div class="col"></div>

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