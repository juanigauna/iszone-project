<?php
if ($n['logged_in'] == true) {
	$n['user'] = user(get_username($id));
}
if ($_GET['u_acc'] && check_user($_GET['u_acc']) == 1) {
	$n['account'] = account($_GET['u_acc']);
} else {
	if ($n['logged_in'] == true) {
		header("location: ".$n['site_url']."/account/".$id);
	} else {
		header("location: ".$n['site_url']."/welcome");
	}
}
$n['page_title'] = $_GET['u_acc']." - ".$n['site_title'];
$n['page_name'] = "recommended";
$n['page_description'] = $n['account']['username'];
$n['page_content'] = "account/content";