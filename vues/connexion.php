<?php
//Appel des fichier des 2 classes
require_once "backend/Utilisateurs.php";
require_once "backend/Administration.php";
//Instance de la classe Admin
$adminClasse = new Administration();
//Instance de la classe Utilisateurs
$userClasse = new Utilisateurs();

?>
<h3 class="text-danger">Vous êtes : </h3>
<div class="text-center" id="btn-parent">
    <a class="btn btn-outline-secondary" id="toggle-admin">Administateur</a>
    <a class="btn btn-outline-info" id="toggle-user">Client</a>
</div>


<div id="form-admin">
    <?php
    //Si on est connecter en tant qu'administrateur
    if(isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true){
        //On redirige vers la page vues/administration.php
        header("administration");
    }else{
        //Sinon on affiche le formulaire
        ?>
        <h2 class="mt-2 text-center text-warning">CONNEXION A VOTRE ESPACE ADMINISTRATION</h2>

        <form method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="email_admin" class="form-control" id="exampleInputEmail1" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password_admin" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe">
            </div>
            <!--Ce bouton est recup via son attribut name et methode post $_POST['btn_valid_admin']-->
            <button name="btn_valid_admin" type="submit" class="btn btn-primary">Connexion</button>

        </form>

        <?php
        //Au clic on appel la methode de connexion de la classe Administrateur
        if(isset($_POST['btn_valid_admin'])){
            $adminClasse->connexionAdministration();
        }
    }
    ?>
</div>

<div id="form-user">
    <?php
    //Sin on est connecter en tant qu'utilisateur = on redirige vers la page d'accueil
    if(isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true){
        header("Location: accueil");
    }else{
        //Sinon on affiche le formulaire USER
        ?>
        <h1 class="text-center text-secondary">CONNEXION A VOTRE ESPACE CLIENT</h1>

        <form method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="email_user" class="form-control" id="exampleInputEmail1" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password_user" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe">
            </div>
            <!--Ce bouton est recup via son attribut name et methode post $_POST['btn_valid_user']-->
            <button name="btn_valid_user" type="submit" class="btn btn-secondary">CONNEXION</button>

        </form>

        <?php
        //Au clic on appel la methode de connexion de la classe Utilisateur->connexionUtilisateurs()
        if(isset($_POST['btn_valid_user'])){

            $userClasse->connexionUtilisateur();
        }

    }
    ?>
</div>

<script>
    //Acces au DOM et on stock les elements grace leurs id

    //les 2 bouttons

    let btnAdminForm = document.getElementById("toggle-admin");
    let btnUserForm = document.getElementById("toggle-user");

    //recyup les 2 formulaires
    let formAdmin = document.getElementById("form-admin");
    let userForm = document.getElementById("form-user");

    //Declencher un evenement au clic
    btnAdminForm.addEventListener("click", () => {
        formAdmin.classList.toggle("show");
    });

    btnUserForm.addEventListener("click", () => {
        userForm.classList.toggle("show");
    });

</script>

