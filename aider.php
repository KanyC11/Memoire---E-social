<?php

// $conn= new mysqli("localhost","root","","don");

// // verification pour recuperer les valeurs saisi par l'utilisateur
// if(isset($_POST['envoyer'])){
//     if(isset($_POST['nom_prenom']) AND isset($_POST['adresse']) AND isset($_POST['telephone']) AND isset($_POST['mail']) AND isset($_POST['les-demandes']) AND isset($_POST['descriptions']))
//     {
//       if(!empty($_POST['nom_prenom']) AND !empty($_POST['adresse']) AND !empty($_POST['telephone']) AND !empty($_POST['mail']) AND !empty($_POST['les-demandes']) AND !empty($_POST['descriptions']))
//     {
    
//         //recuperation des données du formulaire
//       $nom_prenom = htmlspecialchars($_POST['nom_prenom']);
//     $adresse = htmlspecialchars($_POST['adresse']);
//     $telephone = htmlspecialchars($_POST['telephone']);
//     $email = htmlspecialchars($_POST['mail']);
//     $type_demande = htmlspecialchars($_POST['les_demandes']);
//     $description = htmlspecialchars($_POST['descriptions']); 

//     //connexion a la base de donnée
            
//             $sql= "INSERT INTO demande (nom_prenom,adresse,telephone,mail,les_demandes,descriptions)
//       VALUES ('$nom_prenom' ,'$adresse', '$telephone','$email','$type_demande','$description' )";

// if($conn->query($sql)=== TRUE){
//     echo " Merci pour votre don ";
// }else{
//     echo"Erreur : ". $sql . "<br/>" . $conn->error;
// }

// $conn->close();




//     }
      
//     }

// }


// ?> 