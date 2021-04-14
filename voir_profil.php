<?php
  session_start();
//$bdd = new PDO('mysql:host=127.0.0.1;dbname=youtube', 'root', '');
include('bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD
 
  if (!isset($_SESSION['id'])){
    header('Location: Inscription.php'); 
    exit;
  }
  
  // Récupèration de l'id passer en argument dans l'URL
  $id = (int) $_GET['id'];
  // On récupère les informations de l'utilisateur grâce à son ID
    $afficher_profil = $bdd->prepare("SELECT * FROM utilisateur  WHERE id = ?");
    $afficher_profil->execute(array($id));
    $afficher_profil = $afficher_profil->fetch();


  //$afficher_profil = $afficher_profil->fetchAll();



  
  if(!isset($afficher_profil['id'])){
    header('Location: Inscription.php');
    exit;
  }
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
      <!--<base href="/" />-->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/bootstrap.min.css"/>
      <title>Mon profil</title>
    </head>
  <body align="center">
  <?php require_once ('menu.php') ; ?>
    <h2>Voici le profil de <?= $afficher_profil['pseudo'] ?></h2><div>Quelques informations sur lui : </div>          
    <ul>                
      <li>Votre id est : <?= $afficher_profil['id'] ?></li>                              
      <li>Votre mail est : <?= $afficher_profil['mail'] ?></li>       
      <!--was date de creation of the count-->                       
    </ul>  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src=" js/bootstrap.min.js"></script>                                                                                                    
  </body>                                                                                                  
</html>