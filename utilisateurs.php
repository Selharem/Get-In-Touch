<?php
  session_start();
//$bdd = new PDO('mysql:host=127.0.0.1;dbname=youtube', 'root', '');
include('bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD
 
  if (!isset($_SESSION['id'])){
    header('Location: Inscription.php');
    exit;
  }
  
    // On récupère tous les utilisateurs sauf l'utilisateur en cours
    $afficher_profil = $bdd->prepare("SELECT * FROM utilisateur WHERE id <> ?");
    $afficher_profil->execute(array($_SESSION['id']));
    $afficher_profil = $afficher_profil->fetchAll(); // fetchAll() permet de récupérer plusieurs enregistrements


 
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <!--<base href="/" />-->
    <?php require_once('menu.php') ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    
    <title>Utilisateurs du site</title>
  </head>
  <body>      


            <div class="row">
                <div class="container">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="cdr-ims">
                                <h2>Utilisateurs</h2>
                                <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>pseudo</th>
                                        <th>Voir le profil</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // Foreach agit comme une boucle mais celle-ci s'arrête de façon intelligente. 
                                        // Elle s'arrête avec le nombre de lignes qu'il y a dans la variable $afficher_profil
                                        // La variable $afficher_profil est comme un tableau contenant plusieurs valeurs
                                        // pour lire chacune des valeurs distinctement on va mettre un pointeur que l'on appellera ici $ap
                                        foreach($afficher_profil as $ap){
                                    ?>
                                </tbody>
                                      <tr>          
                                        <td><?= $ap['pseudo'] ?></td>
                                        <td><a href="voir_profil.php?id=<?= $ap['id'] ?>">Aller au profil</a></td>
                                      </tr>
                                    <?php
                                    }
                                ?>
                            </table>
                        </div>
                </div>
            </div>
        </div>
  </body>
</html>
