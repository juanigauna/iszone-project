<?php
if ($n['logged_in'] == true) {
    $n['user'] = user(get_username($id));
} else {
	header("location: ".$n['site_url']."/welcome");
}
$n['page_title'] = "Crear evento - ".$n['site_title'];
$n['page_name'] = "new-event";
$n['page_description'] = "";
$n['page_content'] = "events/new-event";