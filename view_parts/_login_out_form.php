<?php
    // Réception des données du formulaire de login/logout
$username = null;
$password = null;
if(array_key_exists('dologin', $_POST)
    && array_key_exists('username', $_POST)
    && array_key_exists('password', $_POST)){
        require_once ("db/_user.php");
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    if(user_authenticate($username, $password)){
        do_login($username);
    }else{} //TODO BLALA

    }elseif(array_key_exists('dologout', $_POST)){
        do_logout(); // On le deconnect
        header('location' . HOME_PAGE);
}



?>

<?php if(!check_login()) { ?>
    <!--Si l'utilisateur n'est pas connecté-->
    <form id="login" name="login" method="post">
        <label for="login">Pseudo : </label>
        <input type="text" name="username" id="username" value=""/>
        <label for="password">Password : </label>
        <input type="password" name="password" id="password"/>
        <input type="submit" name="dologin" id="dologin" value="Entrer"/>
    </form>
<?php } else { ?>
    <!--Si l'utilisateur est connecté-->
    <form id="logout" name="logout" method="post">
    <input type="submit" name="dologout" id="dologout" value="Quitter"/>
    </form>
<?php } ?>