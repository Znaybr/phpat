<?php

$in_post=array_key_exists("register", $_POST); // Savoir si le formulaire est en soumission/reception

$prenom_ok = false;
$prenom_message = ""; //message de feedback en cas de champ erronné, affiché si non vide
if (array_key_exists("prenom", $_POST)) {
    $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_STRING );
    $prenom_ok = (1 === preg_match("/^[A-Za-z0-9]{2,}$/", $prenom));  // 1 siginifie que la condition est vraie et vérifiée
    if(!$prenom_ok){ // si prenom est non valide
        $prenom_message="Le prénom doit contenir au moins deux lettres";
    }
/*    var_dump($prenom);
    var_dump($prenom_ok);
    var_dump($prenom_message);*/
}

$nom_ok = false;
if (array_key_exists("nom", $_POST)) {
    $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_STRING );
    $nom_ok = (1 === preg_match("/^[A-Za-z0-9]{2,}$/", $nom));  // 1 siginifie que la condition est vraie et vérifiée
/*    var_dump($nom);
    var_dump($nom_ok);*/
}

$courriel_ok = false;
if (array_key_exists("courriel", $_POST)) {
    $courriel = filter_input(INPUT_POST, "courriel", FILTER_SANITIZE_EMAIL );
    $courriel = filter_var($courriel, FILTER_VALIDATE_EMAIL);
    $courriel_ok = (false !== $courriel);
    // PAS DE PREGMATCH puisque les filtres font déjà la selection
/*    var_dump($courriel);
    var_dump($courriel_ok);*/
}

$pseudo_ok = false;
if (array_key_exists("pseudo", $_POST)) {
    $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_STRING );
    $pseudo_ok = (1 === preg_match("/^[A-Za-z0-9]{4,}$/", $pseudo));  // 1 siginifie que la condition est vraie et vérifiée
/*    var_dump($pseudo);
    var_dump($pseudo_ok);*/
}

$mdp_ok = false;
if (array_key_exists("mdp", $_POST)) {
    $mdp = filter_input(INPUT_POST, "mdp", FILTER_SANITIZE_STRING );
    $mdp_ok = (1 === preg_match("/^[A-Za-z0-9%&!*?]{8,}$/", $mdp));  // 1 siginifie que la condition est vraie et vérifiée
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
        <li><label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom"
                   class="<?php echo $in_post && ! $prenom_ok ? 'erreur' : ''; ?>"
                   value="<?php echo array_key_exists('prenom', $_POST) ? $_POST['prenom']: ''?>"</li>
        <li><label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="<?php echo array_key_exists('nom', $_POST) ? $_POST['nom']: ''?>"</li>
        <li><label for="courriel">Courriel</label>
            <input type="text" id="courriel" name="courriel" value="<?php echo array_key_exists('courriel', $_POST) ? $_POST['courriel']: ''?>"</li>
        <li><label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" value="<?php echo array_key_exists('pseudo', $_POST) ? $_POST['pseudo']: ''?>"</li>
        <li><label for="mdp">Mot de passe</label>
            <input type="password" id="mdp" name="mdp" value="<?php echo array_key_exists('mdp', $_POST) ? $_POST['mdp']: ''?>"></li>

        <li><input id="envoyer" type="submit" value="Valider" name="register"></li>
    </ul>
</form>