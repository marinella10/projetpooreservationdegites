
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <img class="logo-gite" src="image/logogite.jpg" alt="logo gite" title="Gite"/>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Inscription</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                </li>
            </ul>
            <!--POUR AFFICHER UN BONJOUR PERSONNALISE SELON LA PERSONNE CONNECTEE (dans la NAVBAR)-->

            <?php
            if (isset($_SESSION["utilisateur_connecte"]) && ($_SESSION["utilisateur_connecte"] === true)){
                ?>
                <li id="bonjourConnecte">
                    <a class="nav-link text-warning">Bonjour <?= $_SESSION["prenom_utilisateur"]?></a>
                </li>
                <?php
            }elseif (isset($_SESSION["administrateur_connecte"]) && ($_SESSION["administrateur_connecte"] === true)){
                ?>
                <li>
                    <a href="administration" class="nav-link text-danger">ADMINISTRATION</a>
                </li>
                <li id="bonjourConnecte">
                    <a class="nav-link text-danger">Bonjour <?= $_SESSION["prenom_administrateur"]?></a>
                </li>
                <?php
            }
            ?>

            <!--POUR LE BOUTON DECONNEXION QUI APPARAIT SI UN UTILISATEUR ou UN ADMIN EST CONNECTE-->

            <?php
            if (isset($_SESSION["utilisateur_connecte"]) && ($_SESSION["utilisateur_connecte"] === true) ||
                isset($_SESSION["administrateur_connecte"]) && ($_SESSION["administrateur_connecte"] === true)){
                ?>
                <form action="deconnexion" method="POST">
                    <button type="submit" name="btn-deconnexion" id="btn-deconnexion" class="btn btn-sm btn-outline-light mb-2">Déconnexion</button>
                </form>
                <?php
            }else{
                ?>
                <a href="connexion" id="btn-connexion" class="btn btn-sm btn-outline-light mb-2">Connexion</a>
                <?php
            }
            ?>

            <!--POUR LE BOUTON DECONNEXION QUI APPARAIT SI UN UTILISATEUR ou UN ADMIN EST CONNECTE-->
            <?php
            if (isset($_SESSION["utilisateur_connecte"]) && ($_SESSION["utilisateur_connecte"] === true) ||
                isset($_SESSION["administrateur_connecte"]) && ($_SESSION["administrateur_connecte"] === true)){
                ?>
                <form action="deconnexion" method="POST">
                    <button type="submit" name="btn-deconnexion" id="btn-deconnexion" class="btn btn-sm btn-outline-light mb-2">Déconnexion</button>
                </form>
                <?php
            }else{
                ?>
                <a href="connexion" id="btn-connexion" class="btn btn-sm btn-outline-light mb-2">Connexion</a>
                <?php
            }
            ?>

            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>

                <a href="inscription" class="btn btn-warning mx-3">Inscription</a>
                <a href="connexion" class="btn btn-primary mx-3">Connexion</a>
            </form>
        </div>
    </div>
</nav>


