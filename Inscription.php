<?php
//$bdd = new PDO('mysql:host=127.0.0.1;dbname=youtube', 'root', '');
include('bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD
 
if(isset($_POST['forminscription'])) {
   $pseudo = htmlspecialchars($_POST['pseudo']);
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
   $mdp = sha1($_POST['mdp']);
   $mdp2 = sha1($_POST['mdp2']);
   if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
      $pseudolength = strlen($pseudo);
      if($pseudolength <= 255) {
         if($mail == $mail2) {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $bdd->prepare("SELECT * FROM utilisateur WHERE mail = ?");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0) {
                  if($mdp == $mdp2) {
                     $insertmbr = $bdd->prepare("INSERT INTO utilisateur(pseudo, mail, motdepasse) VALUES(?, ?, ?)");
                     $insertmbr->execute(array($pseudo, $mail, $mdp));
                     $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses mail ne correspondent pas !";
         }
      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>


<html>
   <head>
  <!--<base href="/" />-->
  <title>Accueil</title>
  <link rel="stylesheet" href="css/bootstrap.min.css"/>
      <meta charset="utf-8">
   </head>
   <body>

      <?php require_once ('menu.php') ; ?>

         
      <div align="center">
      <div class="container">
      <div class="row">   
      <div class="col-0 col-sm-0 col-md-2 col-lg-3"></div>
      <div class="col-12 col-sm-12 col-md-8 col-lg-6">
         <h2>Inscription</h2>
         <form method="POST" action="">
            <form>   
               <div class="form-group">
                     <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" />
               </div>
               <div class="form-group">
                  <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />
               </div>
               <div class="form-group">
                     <input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" />
               </div>
               <div class="form-group">
                  <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
               </div>
               <div class="form-group">
                  <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
               </div>
                  <input type="submit" class="btn btn-primary" name="forminscription" value="Je m'inscris" />
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