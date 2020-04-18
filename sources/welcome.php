<?php
if ($n['logged_in'] == true) {
    header("location: ".$n['site_url']."/home");
}
$n['page_title'] = "Bienvenido a ".$n['site_title'];
$n['page_name'] = "welcome";
$n['page_description'] = "¡Bienvenido a ".$n['site_title']." comparte y enterate de eventos cerca de tí.";
$n['page_content'] = "welcome/content";