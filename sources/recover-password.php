<?php
if ($n['logged_in'] == true) {
    header("location: ".$n['site_url']."/recommended");
}
$n['page_title'] = "Recuperar contraseña - ".$n['site_title'];
$n['page_name'] = "recover-password";
$n['page_description'] = "No te quedes sin acceso a tu cuenta de ".$n['site_title']." recupera aquí tu contraseña.";
$n['page_content'] = "recover-password/content";