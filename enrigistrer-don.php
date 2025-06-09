<?php
// connexion a la base de donne
$conn= new mysqli("localhost","root"."","don-projet");

// verifie la connexion
if($conn-> connect_error){
    die("Connexion  échouée:". $connect_error);
}
// créer les variables et les initialisées à vide
$prenomnom = $email = $adresse = $description = $telephone = $typedon = $soutiens= "";


// Récupération des données du formulaire
$prenomnom= $_POST['prenomnom'];
$adresse= $_POST['adresse'];
$telephone= $_POST['telephone'];
$email= $_POST['email'];
$typedon= $_POST['typedon'];
$soutiens= $_POST['soutiens'];
$description= $_POST['description'];

// requete sql insertion
$sql= "INSERT INTO dons (prenomnom,adresse,telephone,email,typedon,description,soutiens)
      VALUES ('$prenomnom' ,'$adresse', '$telephone','$email','$typedon', '$soutiens', '$description' )";

if($conn->query($sql)=== TRUE){
    echo " Merci pour votre don ";
}else{
    echo"Erreur : ". $sql . "<br/>" . $conn->error;
}

$conn->close();

?>