<?php
// DB host
$n['db_host'] = "localhost";
// DB user
$n['db_user'] = "root";
// DB password
$n['db_pass'] = "";
// DB name
$n['db_name'] = "evzo";

// DB connection
$con = new mysqli($n['db_host'], $n['db_user'], $n['db_pass'], $n['db_name']) or die($con->error);

// Site Title
$n['site_title'] = "isZone";

// Site URL
$n['site_url'] = "http://localhost/iz";