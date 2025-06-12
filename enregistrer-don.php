<?php
// connexion a la base de donne
$conn= new mysqli("localhost","root","","dons");

// verifie la connexion
if($conn-> connect_error){
    die("Connexion  échouée:". $connect_error);
}
// créer les variables et les initialisées à vide
$prenomnom = $email = $adresse = $description = $telephone = $typedon = $soutiens= "";


// Récupération des données du formulaire
$prenomnom= htmlspecialchars(strip_tags(trim($_POST['prenomnom'])));
$adresse= htmlspecialchars(strip_tags(trim($_POST['adresse'])));
$telephone= htmlspecialchars(strip_tags(trim($_POST['telephone'])));
$email= htmlspecialchars(strip_tags(trim($_POST['email'])));
$typedon= htmlspecialchars(strip_tags(trim($_POST['typedon'])));
$soutiens= htmlspecialchars(strip_tags(trim($_POST['soutiens'])));
$description= htmlspecialchars(strip_tags(trim($_POST['description'])));

// requete sql insertion
$sql= "INSERT INTO donations (prenomnom,adresse,telephone,email,typedon,description,soutiens)
      VALUES ('$prenomnom' ,'$adresse', '$telephone','$email','$typedon', '$soutiens', '$description' )";

if($conn->query($sql)=== TRUE){
    echo " Merci pour votre don ";
}else{
    echo"Erreur : ". $sql . "<br/>" . $conn->error;
}

$conn->close();

?>