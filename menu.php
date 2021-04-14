<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="f_forum/forum.php">Forum</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php
                      if(!isset($_SESSION['id'])){
                      // ... 
                   }else{
                   ?>

                    <?php
                   }
                ?>
            </ul>
            <ul class="navbar-nav ml-md-auto">
                <?php
                   if(!isset($_SESSION['id'])){
                   ?>
                        <li class="nav-item">
                            <a class="nav-link" href="inscription.php">Inscription</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="connexion.php">Connexion</a>
                        </li>
                    <?php
                      }else{
                   ?>
                        <li class="nav-item">
                            <a class="nav-link" href="deconnexion.php">Déconnexion</a>
                        </li>
                    <?php
                   }
                ?>
            </ul>
        </div>
    </nav>