<?php
require_once "_defines.php";
require_once "data/_main_data.php";
$site_data[PAGE_ID] = "Inscription";
require_once "view_parts/_page_base.php"; // référence au fichier de référence page_base = HEAD en HTML
?>

<div id="main">
    <form id="inscription" action="#" method="post">
        <ul>
            <li><label for="nom">Nom</label><input type="text" id="nom" name="nom"></li>
            <li><label for="prenom">Prénom</label><input type="text" id="prenom" name="prenom"></li>
            <li><label for="courriel">Courriel</label><input type="text" id="courriel" name="courriel"></li>
            <li><label for="pseudo">Pseudo</label><input type="text" id="pseudo" name="pseudo"></li>
            <li><label for="mdp">Mot de passe</label><input type="password" id="mdp" name="mdp"></li>
        </ul>
    </form>
</div>

<?php
require_once "view_parts/_page_bottom.php";
?>