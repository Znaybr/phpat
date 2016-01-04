<?php

$menu_data = array(
    "Accueil" => "index.php",
    "Chat" => "dashboard.php",
    "Inscription" => "inscription.php",
    "Contact" => "contact.php",
);

?>
<ul id="menu">
<!--redondance balise <li> sur l'ensemble du tableau ci-dessus-->
  <?php
    foreach ($menu_data as $onglet => $lien){
      echo "<li><a href=\"$lien\"> $onglet </a></li>";
    }
  ?>
</ul>