<?php

$in_post=array_key_exists("register", $_POST); // Savoir si le formulaire est en soumission/reception
//$in_post = ('POST' == $_SERVER['REQUEST_METHOD']); // Definie la reception en POST

$prenom_ok = false;
$warning_prenom = ""; //message de feedback en cas de champ erronné
$prenom_message = ""; //message de feedback en cas de champ erronné, affiché si non vide
if (array_key_exists("prenom", $_POST)) {
    $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_STRING );
    $prenom_ok = (1 === preg_match("/^[A-Za-z0-9]{2,}$/", $prenom));  // 1 siginifie que la condition est vraie et vérifiée
    if(!$prenom_ok){ // si prenom est non valide
        $warning_prenom=" !";
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
        $warning_nom=" !";
        $nom_message="Votre nom doit comporter au moins deux lettres";
    }
    /*    var_dump($nom);
        var_dump($nom_ok);*/
}

$genre_ok = array_key_exists("genre", $_POST);
$warning_genre = ""; //message de feedback en cas de champ erronné
$genre_message = ""; //message de feedback en cas de champ erronné, affiché si non vide
    if(!$genre_ok) { // si nom est non valide
        $warning_genre = " !";
        $genre_message = "Merci de préciser ce champs";
    }
    /*    var_dump($nom);
        var_dump($nom_ok);*/

$courriel_ok = false;
$warning_courriel = ""; //message de feedback en cas de champ erronné
$courriel_message = ""; //message de feedback en cas de champ erronné, affiché si non vide
if (array_key_exists("courriel", $_POST)) {
    $courriel = filter_input(INPUT_POST, "courriel", FILTER_SANITIZE_EMAIL );
    $courriel = filter_var($courriel, FILTER_VALIDATE_EMAIL);
    $courriel_ok = (false !== $courriel);
    if(!$courriel_ok) { // si nom est non valide
        $warning_courriel=" !";
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
    $pseudo_ok = (1 === preg_match("/^[A-Za-z0-9]{2,}$/", $pseudo));  // 1 siginifie que la condition est vraie et vérifiée
    if(!$pseudo_ok){ // si nom est non valide
        $warning_pseudo=" !";
        $pseudo_message="Votre pseudo doit comporter au moins quatres lettres";
    } else {
        // Est ce que le pseudo est disponible
        require_once "db/_user.php";
        $pseudo_ok = !username_exists($pseudo);
        if (username_exists($pseudo)){
            echo "Le pseudo" . $pseudo . "est déjà utilisé";
        };
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
        $warning_mdp=" !";
        $mdp_message="Votre mot de passe doit comporter au moins 8 caractères";
    }
    /*    var_dump($mdp);
        var_dump($mdp_ok);*/
}

if ($nom_ok && $prenom_ok && $courriel_ok && $pseudo_ok && $mdp_ok && $genre){
    require_once "db/_user.php";
    $user_info = user_add($nom, $prenom, $genre, $courriel, $pseudo, $mdp);
    header("Location: index.php");
    exit;
    //on enregistre les données et s'en va sur une autres page
}


?>

<form id="inscription" action="inscription.php" method="post">
    <ul>
<!--        PRENOM-->
        <li><label for="prenom">Prénom <span><?php echo $warning_prenom ?></span></label>
            <input type="text" id="prenom" name="prenom"
                   class="<?php echo $in_post && ! $prenom_ok ? 'erreur' : ''; ?>"
                   value="<?php echo array_key_exists('prenom', $_POST) ? $_POST['prenom']: ''?>"/>
        </li>
        <?php if ($in_post && ! $prenom_ok){
            echo "<p>$prenom_message</p>";
        }  ?>

<!--        NOM-->
        <li><label for="nom">Nom <span><?php echo $warning_nom ?></span></label>
            <input type="text" id="nom" name="nom"
                   class="<?php echo $in_post && ! $nom_ok ? 'erreur' : ''; ?>"
                   value="<?php echo array_key_exists('nom', $_POST) ? $_POST['nom']: ''?>"/>
        </li>
        <?php if ($in_post && ! $nom_ok){
            echo "<p>$nom_message</p>";
        }  ?>

<!--        SEXE-->
        <li id="sexe">
            <label>Sexe : <span><?php echo $warning_genre ?></span></label>
            <div id="genre">
            <label id="h" for="genre_homme">H</label>
                <input type="radio" id="genre_homme" name="genre" value="genre_homme"
                    <?php echo (array_key_exists('genre', $_POST) && ($_POST['genre'] == "genre_homme")) ? 'checked="checked"' : ''?>/>
            <label id="f" for="genre_femme">F</label>
                <input type="radio" id="genre_femme" name="genre" value="genre_femme"
                    <?php echo (array_key_exists('genre', $_POST) && ($_POST['genre'] == "genre_femme")) ? 'checked="checked"' : ''?>/>
            </div>
        </li>
        <?php if ($in_post && ! $genre_ok){
            echo "<p>$genre_message</p>";
        }  ?>

<!--        COURRIEL-->
        <li><label for="courriel">Courriel <span><?php echo $warning_courriel ?></span></label>
            <input type="text" id="courriel" name="courriel"
                   class="<?php echo $in_post && ! $courriel_ok ? 'erreur' : ''; ?>"
                   value="<?php echo array_key_exists('courriel', $_POST) ? $_POST['courriel']: ''?>"/>
        </li>
        <?php if ($in_post && ! $courriel_ok){
            echo "<p>$courriel_message</p>";
        }  ?>

<!--        PSEUDO-->
        <li><label for="pseudo">Pseudo <span><?php echo $warning_pseudo ?></span></label>
            <input type="text" id="pseudo" name="pseudo"
                   class="<?php echo $in_post && ! $pseudo_ok ? 'erreur' : ''; ?>"
                   value="<?php echo array_key_exists('pseudo', $_POST) ? $_POST['pseudo']: ''?>"/>
        </li>
        <?php if ($in_post && ! $pseudo_ok){
            echo "<p>$pseudo_message</p>";
        }  ?>

<!--        MOT DE PASSE-->
        <li><label for="mdp">Mot de passe<span><?php echo $warning_mdp ?></span></label>
            <input type="password" id="mdp" name="mdp"
                   class="<?php echo $in_post && ! $mdp_ok ? 'erreur' : ''; ?>"
                   value="<?php echo array_key_exists('mdp', $_POST) ? $_POST['mdp']: ''?>"/>
        </li>
        <?php if ($in_post && ! $mdp_ok){
            echo "<p>$mdp_message</p>";
        }  ?>

        <li><input type="submit" value="Valider" id="register" name="register"></li>
    </ul>
    <?php if($in_post){ echo "<p>Merci de corriger les champs comportants un *.</p>"; } ?>
</form>