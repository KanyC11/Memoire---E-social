<?php
// verification pour reccuperer les valeurs saisi par l'utilisateur
if(isset($_POST['Envoyer'])){
    if(isset($_POST['nom-prenom']) AND isset($_POST['adresse']) AND isset($_POST['telephone']) AND isset($_POST['mail']) AND isset($_POST['les-demandes']) AND isset($_POST['Description']))
    {
      if(!empty($_POST['nom-prenom']) AND !empty($_POST['adresse']) AND !empty($_POST['telephone']) AND !empty($_POST['mail']) AND !empty($_POST['les-demandes']) AND !empty($_POST['Description']))
    {
        //recuperation des données du formulaire
      $nom_prenom = htmlspecialchars($_POST['nom-prenom']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $email = htmlspecialchars($_POST['mail']);
    $type_demande = htmlspecialchars($_POST['les-demandes']);
    $description = htmlspecialchars($_POST['Description']);  
    }  
    }
}


?> 