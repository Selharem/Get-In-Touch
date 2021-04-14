<?php
  session_start();
  //$bdd = new PDO('mysql:host=127.0.0.1;dbname=youtube', 'root', '');
  include('../bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD

 // Fichier PHP contenant la connexion à votre BDD
  
  $req = $bdd->query("SELECT * FROM forum ORDER BY ordre");
  $req = $req->fetchAll();

?>

<html lang="en">
<head>
  <!--<base href="/" />-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Forum</title>
</head>
  <body>
  <?php require_once('../menu.php');?>
    <div class="row">
      <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="cdr-ims">
            <h1 align="center">FORUM</h1>


            <!--<div class="table-responsive">-->
            <?php foreach($req as $r){  ?>  
              <div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title"><?= $r['titre'] ?></h5>
                  <p class="card-text">Participer a une discussion autour de la Categorie <?= $r['id']?> </p>
                  <a href="sujet.php/<?= $r['id'] ?>">Participer!</a>
                </div>
              </div>
            <?php }?>



              
            <!--</div>-->
          </div>
        </div>
      </div>
    </div>
  </body>
</html>