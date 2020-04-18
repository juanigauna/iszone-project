<?php
if ($n['logged_in'] == true) {
    header("location: ".$n['site_url']."/recommended");
}
$n['page_title'] = "Crear cuenta - ".$n['site_title'];
$n['page_name'] = "new-account";
$n['page_description'] = "¡Crea una cuenta en".$n['site_title']." para compartir y enterarte de eventos cerca de tí.";
$n['page_content'] = "new-account/content";