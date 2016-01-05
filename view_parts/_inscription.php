<?php
$nom_ok = false;
if (array_key_exists("nom", $_POST)) {
    $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_MAGIC_QUOTES );
    $nom = filter_var($nom, FILTER_SANITIZE_STRING);
    $nom_ok = (1 === preg_match("/^[A-Za-z0-9]{4,}$/", $nom));  // 1 siginifie que la condition est vraie et vérifiée
    var_dump($nom);
    var_dump($nom_ok);
}

$prenom_ok = false;
if (array_key_exists("prenom", $_POST)) {
    $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_MAGIC_QUOTES );
    $prenom = filter_var($prenom, FILTER_SANITIZE_STRING);
    $prenom_ok = (1 === preg_match("/^[A-Za-z0-9]{4,}$/", $prenom));  // 1 siginifie que la condition est vraie et vérifiée
    var_dump($prenom);
    var_dump($prenom_ok);
}

$courriel_ok = false;
if (array_key_exists("courriel", $_POST)) {
    $courriel = filter_input(INPUT_POST, "courriel", FILTER_SANITIZE_MAGIC_QUOTES );
    $courriel = filter_var($courriel, FILTER_VALIDATE_EMAIL);
    $courriel_ok = (1 === preg_match("/^[a-z0-9]{4,}$/", $courriel));  // 1 siginifie que la condition est vraie et vérifiée
    var_dump($courriel);
    var_dump($courriel_ok);
}

$pseudo_ok = false;
if (array_key_exists("pseudo", $_POST)) {
    $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_MAGIC_QUOTES );
    $pseudo = filter_var($pseudo, FILTER_SANITIZE_EMAIL);
    $pseudo_ok = (1 === preg_match("/^[A-Za-z0-9]{4,}$/", $pseudo));  // 1 siginifie que la condition est vraie et vérifiée
    var_dump($pseudo);
    var_dump($pseudo_ok);
}

$mdp_ok = false;
if (array_key_exists("mdp", $_POST)) {
    $mdp = filter_input(INPUT_POST, "mdp", FILTER_SANITIZE_MAGIC_QUOTES );
    $mdp = filter_var($mdp, FILTER_SANITIZE_STRING);
    $mdp_ok = (1 === preg_match("/^[A-Za-z0-9%&!*?]{8,}$/", $mdp));  // 1 siginifie que la condition est vraie et vérifiée
    var_dump($mdp);
    var_dump($mdp_ok);
}

if ($nom_ok && $prenom_ok && $courriel_ok && $pseudo_ok && $mdp_ok){
    header("Location: php_donnees_OK.php");
    //on enregistre les données et s'en va sur une autres page
}

?>

<form id="inscription" action="#" method="post">
    <ul>
        <li><label for="nom">Nom</label><input type="text" id="nom" name="nom"></li>
        <li><label for="prenom">Prénom</label><input type="text" id="prenom" name="prenom"></li>
        <li><label for="courriel">Courriel</label><input type="text" id="courriel" name="courriel"></li>
        <li><label for="pseudo">Pseudo</label><input type="text" id="pseudo" name="pseudo"></li>
        <li><label for="mdp">Mot de passe</label><input type="password" id="mdp" name="mdp"></li>
        <li><input id="envoyer" type="submit" value="Valider"></li>
    </ul>
</form>