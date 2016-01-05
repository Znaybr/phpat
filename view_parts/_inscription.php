<?php

$in_post=array_key_exists("register", $_POST); // Savoir si le formulaire est en soumission/reception

$message_erreur="";

$prenom_ok = false;
$prenom_message = ""; //message de feedback en cas de champ erronné, affiché si non vide
if (array_key_exists("prenom", $_POST)) {
    $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_STRING );
    $prenom_ok = (1 === preg_match("/^[A-Za-z0-9]{2,}$/", $prenom));  // 1 siginifie que la condition est vraie et vérifiée
    if(!$prenom_ok){ // si prenom est non valide
        $prenom_message=" *";
        $message_erreur=" Merci de corriger les champs comportants un *.";
    }
/*    var_dump($prenom);
    var_dump($prenom_ok);
    var_dump($prenom_message);*/
}

$nom_ok = false;
$nom_message = ""; //message de feedback en cas de champ erronné, affiché si non vide
if (array_key_exists("nom", $_POST)) {
    $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_STRING );
    $nom_ok = (1 === preg_match("/^[A-Za-z0-9]{2,}$/", $nom));  // 1 siginifie que la condition est vraie et vérifiée
    if(!$nom_ok){ // si nom est non valide
        $nom_message=" *";
        $message_erreur=" Merci de corriger les champs comportants un *.";
    }
    /*    var_dump($nom);
        var_dump($nom_ok);*/
}

$courriel_ok = false;
$courriel_message = ""; //message de feedback en cas de champ erronné, affiché si non vide
if (array_key_exists("courriel", $_POST)) {
    $courriel = filter_input(INPUT_POST, "courriel", FILTER_SANITIZE_EMAIL );
    $courriel = filter_var($courriel, FILTER_VALIDATE_EMAIL);
    $courriel_ok = (false !== $courriel);
    if(!$courriel_ok) { // si nom est non valide
        $courriel_message = " *";
        $message_erreur=" Merci de corriger les champs comportants un *.";
    }
    // PAS DE PREGMATCH puisque les filtres font déjà la selection
/*    var_dump($courriel);
    var_dump($courriel_ok);*/
}

$pseudo_ok = false;
$pseudo_message="";
if (array_key_exists("pseudo", $_POST)) {
    $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_STRING );
    $pseudo_ok = (1 === preg_match("/^[A-Za-z0-9]{4,}$/", $pseudo));  // 1 siginifie que la condition est vraie et vérifiée
    if(!$pseudo_ok){ // si nom est non valide
        $pseudo_message=" *";
        $message_erreur=" Merci de corriger les champs comportants un *.";
    }
    /*    var_dump($pseudo);
        var_dump($pseudo_ok);*/
}

$mdp_ok = false;
$mdp_message="";
if (array_key_exists("mdp", $_POST)) {
    $mdp = filter_input(INPUT_POST, "mdp", FILTER_SANITIZE_STRING );
    $mdp_ok = (1 === preg_match("/^[A-Za-z0-9%&!*?]{8,}$/", $mdp));  // 1 siginifie que la condition est vraie et vérifiée
    if(!$mdp_ok){ // si nom est non valide
        $mdp_message=" *";
        $message_erreur=" Merci de corriger les champs comportants un *.";
    }
    /*    var_dump($mdp);
        var_dump($mdp_ok);*/
}

if ($nom_ok && $prenom_ok && $courriel_ok && $pseudo_ok && $mdp_ok){
    header("Location: index.php");
    exit;
    //on enregistre les données et s'en va sur une autres page
}

?>

<form id="inscription" action="inscription.php" method="post">
    <ul>
        <li><label for="prenom">Prénom <span><?php echo $prenom_message ?></span></label>
            <input type="text" id="prenom" name="prenom"
                   class="<?php echo $in_post && ! $prenom_ok ? 'erreur' : ''; ?>"
                   value="<?php echo array_key_exists('prenom', $_POST) ? $_POST['prenom']: ''?>"
        </li>
        <li><label for="nom">Nom <span><?php echo $nom_message ?></span></label>
            <input type="text" id="nom" name="nom"
                   class="<?php echo $in_post && ! $nom_ok ? 'erreur' : ''; ?>"
                   value="<?php echo array_key_exists('nom', $_POST) ? $_POST['nom']: ''?>"</li>

        <li><label for="courriel">Courriel <span><?php echo $courriel_message ?></span></label>
            <input type="text" id="courriel" name="courriel"
                   class="<?php echo $in_post && ! $courriel_ok ? 'erreur' : ''; ?>"
                   value="<?php echo array_key_exists('courriel', $_POST) ? $_POST['courriel']: ''?>"</li>

        <li><label for="pseudo">Pseudo <span><?php echo $pseudo_message ?></span></label>
            <input type="text" id="pseudo" name="pseudo"
                   class="<?php echo $in_post && ! $pseudo_ok ? 'erreur' : ''; ?>"
                   value="<?php echo array_key_exists('pseudo', $_POST) ? $_POST['pseudo']: ''?>"</li>

        <li><label for="mdp">Mot de passe<span><?php echo $mdp_message ?></span></label>
            <input type="password" id="mdp" name="mdp"
                   class="<?php echo $in_post && ! $mdp_ok ? 'erreur' : ''; ?>"
                   value="<?php echo array_key_exists('mdp', $_POST) ? $_POST['mdp']: ''?>"></li>

        <li><input type="submit" value="Valider" id="register" name="register"></li>
    </ul>
    <span> <?php echo $message_erreur ?> </span>
</form>