<?php
  session_start();
 //$bdd = new PDO('mysql:host=127.0.0.1;dbname=youtube', 'root', '');
 include('../bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD
  
  //$get_id = (int) trim(htmlentities($_GET['id']));
  $get_id = substr($_SERVER['REQUEST_URI'],-1); 
   /**if(empty($get_id)){ // On vérifie qu'on a bien un id sinon on redirige vers la page forum
    header('Location: /forum');
    exit;
  }*/

  $req = $bdd->prepare("SELECT t.*,U.pseudo FROM topic T LEFT JOIN utilisateur U On U.id = T.id_user WHERE t.id_forum = ?  ORDER BY t.date_creation DESC");
  //$req = $bdd->prepare("SELECT *, DATE_FORMAT(t.date_creation, 'Le %d/%m/%Y à %H\h%i') as date_c, FROM topic WHERE id_forum = ? ORDER BY date_creation DESC");

  $req->execute(array($get_id));
  $req = $req->fetchAll();

  //$reqmail->execute(array($mail));

 

?>

<html lang="en">
<head>
  <?php require_once('../menu.php');?>
  <!--<base href="/" />-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Sujet  </title>
</head>
  <body>
    <div class="row">
      <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="cdr-ims">
          <h1 align="center">SUJET</h1>
            <!--<div class="table-responsive">-->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Titre</th>
                    <th>Date</th> 
                    <th>Par</th>
                  </tr>
                </thead>
                  <?php foreach($req as $r){  ?>  
                <tbody>
                  <tr>
                    <td><a href="../topic.php/<?= $get_id?>/<?= $r['id']?>"><?= $r['titre'] ?></a></td>
                    <td><?= $r['date_creation'] ?></td>
                    <td><?= $r['pseudo'] ?></td>
                  </tr>
                  <?php } ?>                                      
                </tbody>
              </table>
            <!--</div>-->
          </div>
        </div>
      </div>
    </div>
  </body>
</html>