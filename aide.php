<?php
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
    echo " Merci pour votre demande de don ";
}else{
    echo"Erreur : ". $sql . "<br/>" . $conn->error;
}

$conn->close();

?>