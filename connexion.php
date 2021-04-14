<?php
session_start();
 
//$bdd = new PDO('mysql:host=127.0.0.1;dbname=youtube', 'root', '');
include('bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD

if(isset($_POST['formconnexion'])) {
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = sha1($_POST['mdpconnect']);
   if(!empty($mailconnect) AND !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM utilisateur WHERE mail = ? AND motdepasse = ?");
      $requser->execute(array($mailconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['pseudo'] = $userinfo['pseudo'];
         $_SESSION['mail'] = $userinfo['mail'];
         header("Location: profil.php?id=".$_SESSION['id']);
      } else {
         $erreur = "Mauvais mail ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
<html>
   <head>
  <title>Connexion</title>
      <meta charset="utf-8">
   </head>
   <body>

   <link rel="stylesheet" href="css/bootstrap.min.css"/>
      <meta charset="utf-8">
   </head>
   <body>
         <?php require_once('menu.php') ?>


<!--<div align="center">-->
   <div class="container">
      <div class="row">   
           <div class="col-0 col-sm-0 col-md-2 col-lg-3"></div>
           <div class="col-12 col-sm-12 col-md-8 col-lg-6">
            <h2>Connexion</h2>
            <form method="POST" action="">
               <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input class="form-control" id="exampleInputEmail1" type="email" name="mailconnect" placeholder="Mail" />
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input class="form-control" id="exampleInputPassword1" type="password" name="mdpconnect" placeholder="Mot de passe" />
               </div>
                  <br /><br />
               
               <input type="submit" class="btn btn-primary" name="formconnexion" value="Se connecter !" />
            </form>
            <?php
            if(isset($erreur)) {
               echo '<font color="red">'.$erreur."</font>";
            }
            ?>
         </div>
      </div>
   </div>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
      <script src=" js/bootstrap.min.js"></script>
   </body>
</html>