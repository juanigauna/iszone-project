<?php
include_once "app/init.php";
if (isset($_GET['link'])) {
    $link = $_GET['link'];
    if ($n['logged_in'] == true) {
        actual_page($link);
        last_location($id);
    }
} else {
    $link = 'welcome';
}
switch ($link) {
    case 'welcome':
        include "sources/welcome.php";
        break;
    case 'new-account':
        include "sources/new-account.php";
        break;
    case 'edit-account':
        include "sources/edit-account.php";
        break;
    case 'notifications':
        include 'sources/notifications.php';
        break;
    case 'recover-password':
        include "sources/recover-password.php";
        break;
    case 'home':
        include "sources/home.php";
        break;
    case 'home':
        include "sources/home.php";
        break;
    case 'post':
        include "sources/post.php";
        break;
    case 'all-events':
        include "sources/all-events";
        break;
    case 'people':
        include "sources/people.php";
        break;
    case 'terms-and-conditions':
        include "sources/terms-and-conditions.php";
        break;
    case 'new-event':
        include 'sources/new-event.php';
        break;
    case 'account':
        include 'sources/account.php';
        break;
}
include "app/layout/container.php";