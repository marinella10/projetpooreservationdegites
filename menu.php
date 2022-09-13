
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container-fluid">
        <a href="accueil">
        <img class="logo-gite" src="image/logogite.jpg" alt="logo gite" title="Gite"/>
        </a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!--POUR AFFICHER UN BONJOUR PERSONNALISE SELON LA PERSONNE CONNECTEE (dans la NAVBAR)-->

                <li class="nav-item">
                    <?php
                    //On demarre la session

                    //si on est connecter en tant qu'utilisateur = on retourne la page d'accueil + on affiche l'email de l'utilisateur
                    if(isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true){
                        ?>

                        <h4 class="text-danger mt-1"><b style="color: #2c4f56;font-size: 14px">Vous êtes connectez en tant que :</b> <?= $_SESSION['email_utilisateur'] ?></h4>
                        <?php
                        //Sinon si on est connecter en tant qu'adminsitrateur = on affiche un onglet administation + email de l'administrateur dans la navbar
                    }elseif(isset($_SESSION['connecter']) && $_SESSION['connecter'] === true){
                        ?>
                        <div class="d-flex">
                            <a class="nav-link" href="administration">ADMINISTRATION</a>
                            <h4 class="text-danger mt-1">
                                <b style="color: #2c4f56;font-size: 14px">Vous êtes connectez en tant que  :</b> <?= $_SESSION['email_admin']  ?>
                            </h4>
                        </div>
                        <?php
                    }else{
                        ?>
                        <a class="nav-link" href="#"></a>
                        <?php
                    }
                    ?>
                </li>
                </ul>

            <!--POUR LE BOUTON DECONNEXION QUI APPARAIT SI UN UTILISATEUR ou UN ADMIN EST CONNECTE-->

            <form class="d-flex">


                <a href="inscription" class="btn btn-outline-danger mx-3">Inscription</a>
                <?php
                if (isset($_SESSION['connecter_user']) && ($_SESSION['connecter_user'] === true) ||
                    isset($_SESSION['connecter']) && ($_SESSION['connecter'] === true)){
                    ?>
                    <a class="nav-link btn btn-danger" href="deconnexion">DECONNEXION</a>
                    <?php
                }else{
                    ?>
                    <a href="connexion" id="btn-connexion" class="btn btn-outline-success mx-3">Connexion</a>
                    <?php
                }
                ?>

            </form>

    </div>
</nav>



