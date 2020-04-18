<?php
if ($n['logged_in'] == true) {
	$n['user'] = user(get_username($id));
} else {
    header("location: ".$n['site_url']."/welcome");
}
$n['page_title'] = "Inicio - ".$n['site_title'];
$n['page_name'] = "home";
$n['page_description'] = "¡Bienvenido a ".$n['site_title']." comparte y enterate de eventos cerca de tí.";
$n['page_content'] = "home/content";