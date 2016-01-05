<?php

$in_post=array_key_exists("register", $_POST); // Savoir si le formulaire est en soumission/reception


$prenom_ok = false;
$warning_prenom = ""; //message de feedback en cas de champ erronné
$prenom_message = ""; //message de feedback en cas de champ erronné, affiché si non vide
if (array_key_exists("prenom", $_POST)) {
    $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_STRING );
    $prenom_ok = (1 === preg_match("/^[A-Za-z0-9]{2,}$/", $prenom));  // 1 siginifie que la condition est vraie et vérifiée
    if(!$prenom_ok){ // si prenom est non valide
        $warning_prenom=" *";
        $prenom_message="Votre prénom doit comporter au moins deux lettres";
    }
/*    var_dump($prenom);
    var_dump($prenom_ok);
    var_dump($prenom_message);*/
}

$nom_ok = false;
$warning_nom = ""; //message de feedback en cas de champ erronné
$nom_message = ""; //message de feedback en cas de champ erronné, affiché si non vide
if (array_key_exists("nom", $_POST)) {
    $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_STRING );
    $nom_ok = (1 === preg_match("/^[A-Za-z0-9]{2,}$/", $nom));  // 1 siginifie que la condition est vraie et vérifiée
    if(!$nom_ok){ // si nom est non valide
        $warning_nom=" *";
        $nom_message="Votre nom doit comporter au moins deux lettres";

    }
    /*    var_dump($nom);
        var_dump($nom_ok);*/
}

$courriel_ok = false;
$warning_courriel = ""; //message de feedback en cas de champ erronné
$courriel_message = ""; //message de feedback en cas de champ erronné, affiché si non vide
if (array_key_exists("courriel", $_POST)) {
    $courriel = filter_input(INPUT_POST, "courriel", FILTER_SANITIZE_EMAIL );
    $courriel = filter_var($courriel, FILTER_VALIDATE_EMAIL);
    $courriel_ok = (false !== $courriel);
    if(!$courriel_ok) { // si nom est non valide
        $warning_courriel=" *";
        $courriel_message="Ce champs doit comporter une adresse mail valide";

    }
    // PAS DE PREGMATCH puisque les filtres font déjà la selection
/*    var_dump($courriel);
    var_dump($courriel_ok);*/
}

$pseudo_ok = false;
$pseudo_message="";
$warning_pseudo = ""; //message de feedback en cas de champ erronné
if (array_key_exists("pseudo", $_POST)) {
    $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_STRING );
    $pseudo_ok = (1 === preg_match("/^[A-Za-z0-9]{4,}$/", $pseudo));  // 1 siginifie que la condition est vraie et vérifiée
    if(!$pseudo_ok){ // si nom est non valide
        $warning_pseudo=" *";
        $pseudo_message="Votre pseudo doit comporter au moins quatres lettres";
    }
    /*    var_dump($pseudo);
        var_dump($pseudo_ok);*/
}

$mdp_ok = false;
$mdp_message="";
$warning_mdp = ""; //message de feedback en cas de champ erronné
if (array_key_exists("mdp", $_POST)) {
    $mdp = filter_input(INPUT_POST, "mdp", FILTER_SANITIZE_STRING );
    $mdp_ok = (1 === preg_match("/^[A-Za-z0-9%&!*?]{8,}$/", $mdp));  // 1 siginifie que la condition est vraie et vérifiée
    if(!$mdp_ok){ // si nom est non valide
        $warning_mdp=" *";
        $mdp_message="Votre mot de passe doit comporter au moins 8 caractères";
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
        <li><label for="prenom">Prénom <span><?php echo $warning_prenom ?></span></label>
            <input type="text" id="prenom" name="prenom"
                   class="<?php echo $in_post && ! $prenom_ok ? 'erreur' : ''; ?>"
                   value="<?php echo array_key_exists('prenom', $_POST) ? $_POST['prenom']: ''?>"/>
        </li>
        <span><?php echo $prenom_message ?></span>

        <li><label for="nom">Nom <span><?php echo $warning_nom ?></span></label>
            <input type="text" id="nom" name="nom"
                   class="<?php echo $in_post && ! $nom_ok ? 'erreur' : ''; ?>"
                   value="<?php echo array_key_exists('nom', $_POST) ? $_POST['nom']: ''?>"/>
        </li>
        <span><?php echo $nom_message ?></span>

        <li><label for="courriel">Courriel <span><?php echo $warning_courriel ?></span></label>
            <input type="text" id="courriel" name="courriel"
                   class="<?php echo $in_post && ! $courriel_ok ? 'erreur' : ''; ?>"
                   value="<?php echo array_key_exists('courriel', $_POST) ? $_POST['courriel']: ''?>"/>
        </li>
        <span><?php echo $courriel_message ?></span>

        <li><label for="pseudo">Pseudo <span><?php echo $warning_pseudo ?></span></label>
            <input type="text" id="pseudo" name="pseudo"
                   class="<?php echo $in_post && ! $pseudo_ok ? 'erreur' : ''; ?>"
                   value="<?php echo array_key_exists('pseudo', $_POST) ? $_POST['pseudo']: ''?>"/>
        </li>
        <span><?php echo $pseudo_message ?></span>

        <li><label for="mdp">Mot de passe<span><?php echo $warning_mdp ?></span></label>
            <input type="password" id="mdp" name="mdp"
                   class="<?php echo $in_post && ! $mdp_ok ? 'erreur' : ''; ?>"
                   value="<?php echo array_key_exists('mdp', $_POST) ? $_POST['mdp']: ''?>"/>
        </li>
        <span><?php echo $mdp_message ?></span>

        <li><input type="submit" value="Valider" id="register" name="register"></li>
    </ul>
    <?php if($in_post){ echo "<p>Merci de corriger les champs comportants un *.</p>"; } ?>
</form>