<?php
session_start();
 
//$bdd = new PDO('mysql:host=127.0.0.1;dbname=youtube', 'root', '');
include('bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD
 
if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>
<html>
   <head>
  <!--<base href="/" />-->
  <title>Profil</title>
  <link rel="stylesheet" href="css/bootstrap.min.css"/>

      <meta charset="utf-8">
   </head>
   <body>
      <?php require_once('menu.php');?>
      <div align="center">
         <h2>Profil de <?php echo $userinfo['pseudo']; ?></h2>
         <br /><br />
         Pseudo = <?php echo $userinfo['pseudo']; ?>
         <br />
         Mail = <?php echo $userinfo['mail']; ?>
         <br />
         <?php
         if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {?>
            <br />
            <a href="deconnexion.php">Se déconnecter</a>
            <a href="utilisateurs.php">Rechercher</a>
            <?php
            }
         ?>
      </div>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
      <script src=" js/bootstrap.min.js"></script>
   </body>
</html>
<?php   
}
?>