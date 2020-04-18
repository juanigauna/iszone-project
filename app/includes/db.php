<?php
// DB host
$n['db_host'] = "db_host";
// DB user
$n['db_user'] = "db_user";
// DB password
$n['db_pass'] = "db_password";
// DB name
$n['db_name'] = "db_name";

// DB connection
$con = new mysqli($n['db_host'], $n['db_user'], $n['db_pass'], $n['db_name']) or die($con->error);

// Site Title
$n['site_title'] = "isZone";

// Site URL
$n['site_url'] = "site url";