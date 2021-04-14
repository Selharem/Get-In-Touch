<?php
  session_start();
 //$bdd = new PDO('mysql:host=127.0.0.1;dbname=youtube', 'root', '');
 include('../bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD
  
  //$get_id = (int) trim(htmlentities($_GET['id']));
  $get_id_topic = substr($_SERVER['REQUEST_URI'],-1); 

  $get_id_forum = substr($_SERVER['REQUEST_URI'],-3);
  $get_id_forum = $get_id_forum[0]; 
   /**if(empty($get_id)){ // On vérifie qu'on a bien un id sinon on redirige vers la page forum
    header('Location: /forum');
    exit;
  }*/

  $req = $bdd->prepare("SELECT t.*,U.pseudo FROM topic T LEFT JOIN utilisateur U On U.id = T.id_user WHERE t.id = ? AND t.id_forum = ?  ORDER BY t.date_creation DESC");
  //$req = $bdd->prepare("SELECT *, DATE_FORMAT(t.date_creation, 'Le %d/%m/%Y à %H\h%i') as date_c, FROM topic WHERE id_forum = ? ORDER BY date_creation DESC");

  $req->execute(array($get_id_topic,$get_id_forum));
  $req = $req->fetchAll();
  //$reqmail->execute(array($mail));

  $req_commentaire = $bdd->prepare("SELECT TC.*, TC.date_creation ,U.pseudo FROM topic_commentaire TC LEFT JOIN utilisateur U ON U.id = TC.id_user WHERE id_topic = ? ORDER BY date_creation DESC");
  $req_commentaire->execute(array($get_id_topic));
  $req_commentaire = $req_commentaire->fetchAll();
   

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
  <title> Topic  </title>
</head>
  <body>
  <?php require_once('../menu.php');?>
    <div class="row">
      <div class="container">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="cdr-ims">
            <h1 style="text-align: center">TOPIC : <?= $req[0]['titre'] ?></h1>  
            <div style="background: white; box-shadow: 0 5px 15px rgba(0, 0, 0, .15); padding: 5px 10px; border-radius: 10px">
                  <h3>Contenu</h3>
                  <div style="border-top: 2px solid #eee; padding: 10px 0"><?=$req[0]['contenu'] ?></div>
                  <div style="color: #CCC; font-size: 10px; text-align: right"  >
                      <?=$req[0]['date_creation']?>
                      Par
                      <?=$req[0]['pseudo'] ?>
                  </div>
                </div>

                  <div style="background: white; box-shadow: 0 5px 15px rgba(0, 0, 0, .15); padding: 5px 10px; border-radius: 10px; margin-top: 20px">
                        <h3>Commentaire</h3>            
                      <!--<div class="table-responsive">-->
                    <table class="table table-striped">
                          <?php foreach($req_commentaire as $rc){  ?>  
                      <tbody>
                        <tr>
                          <td><?= "De " . $rc['pseudo'] ?></td>
                          <td><?= $rc['text'] ?></td>
                          <td><?= $rc['date_creation'] ?></td>                    
                        </tr>   
                        <?php } ?>
                      </tbody>
                    </table>
                  <!--</div>-->
                </div>
              





          </div>
        </div>
      </div>
    </div>
  </body>
</html>