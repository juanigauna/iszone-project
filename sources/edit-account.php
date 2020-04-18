<?php
if ($n['logged_in'] == true) {
    $n['user'] = user(get_username($id));
} else {
	header("location: ".$n['site_url']."/welcome");
}
$n['page_title'] = "Editar cuenta - ".$n['site_title'];
$n['page_name'] = "edit-account";
$n['page_description'] = "";
$n['page_content'] = "account/edit-account";