<?php
require_once "_defines.php";
require_once "data/_main_data.php";
require_once "db/_talkmsg_data.php";
$site_data[PAGE_ID] = "Chat";
$site_data[PAGE_IS_PUBLIC] = false;
require_once "common/_start.php";
require_once "view_parts/_page_base.php"; // référence au fichier de référence page_base = HEAD en HTML

/**
 * Gestion des likes
 */
if (array_key_exists(LIKE_ID, $_GET)){
    // il y a un parametre like_id dans l'url
    // l'utilisateur aime le message numero $_GET[LIKE_ID]
    $msg_id = $_GET[LIKE_ID];
//    var_dump($msg_id);
    // Stocker les données dans une variable de session a la clé LIKE_ID
    // On vérifie que l'élément est présent en session
    // s'il est présent on créé l'élément
    if(!array_key_exists(SESS_LIKES, $_SESSION)){
        $_SESSION[SESS_LIKES] = array();
    }
    $does_like = array_key_exists($msg_id, $_SESSION[SESS_LIKES]);
    if ($does_like){
        unset($_SESSION[SESS_LIKES][$msg_id]);
    } else {
        $_SESSION[SESS_LIKES][$msg_id] = true;
    }

    // On redirige vers la même page sans query string
    header('Location: dashboard.php');
    exit;
}


?>

<div id="main">
    <ul id="chat">
        <?php foreach ($talk_msg_data as $msg_id => $tmsg) { ?>
            <li class="tmsg_cont" style="background-color: <?php echo $tmsg['tmsg_color'] ?> ">
            <div class="tmsg_head">
                <span class="tmsg_time"> <?php echo $tmsg["tmsg_time"] ?> </span>
                <span id="user_pseudo" class="tmsg_username"> <?php echo $tmsg["tmsg_user"] ?> </span>
                <?php $he_likes_msg = array_key_exists(SESS_LIKES, $_SESSION) && array_key_exists($msg_id, $_SESSION[SESS_LIKES]); ?>
                <a
                    href="?<?php echo LIKE_ID . '=' . $msg_id?>"
                    class="<?php echo $he_likes_msg ? "like_msg" : ''?>"
                    ><?php echo $he_likes_msg ? 'unlike' : 'like'; ?> </a>
            </div>
            <p class="tmsg_body"> <?php echo $tmsg["tmsg_body"] ?> </p>
            </li>
        <?php } ?>
    </ul>
</div>

<?php
require_once "view_parts/_page_bottom.php";
?>