<?php
function actual_page($link) {
    global $con, $n, $id;
    mysqli_query($con, "UPDATE users SET actual_page = '$link' WHERE id = '$id'");
}
function ckeck_username($username, $id) {
    global $con;
    $q = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
    if ($q->num_rows == 1 && $username == get_username($id)) {
        return true;
    } elseif ($q->num_rows == 1 && $username != get_username($id)) {
        return false;
    } elseif ($q->num_rows == 0) {
        return true;
    }
}
function check_user($username) {
    global $con;
    $query = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
    if ($query->num_rows == 1) {
        return 1;
    } elseif ($query->num_rows == 0) {
        return 0;
    }
}
function check_email($email) {
    global $con;
    $query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'");
    if ($query->num_rows == 1) {
        return 1;
    } elseif ($query->num_rows == 0) {
        return 0;
    }
}
function check_follow($follower_id) {
    global $con, $id;
    $q = mysqli_query($con, "SELECT * FROM followers WHERE user_id = '$id' AND follower_id = '$follower_id'");
    if ($q->num_rows == 1) {
        return true;
    } elseif ($q->num_rows == 0) {
        return false;
    }
}
function check_friend($user_id, $to_id) {
    global $con;
    $q = mysqli_query($con, "SELECT * FROM followers WHERE follower_id = '$user_id' AND user_id = '$to_id'");
    if ($q->num_rows == 1) {
        return true;
    } elseif ($q->num_rows == 0) {
        return false;
    }
}
function check_like_post($user_id, $post_id) {
    global $con;
    $q = mysqli_query($con, "SELECT * FROM likes WHERE user_id = '$user_id' AND post_id = '$post_id'");
    if ($q->num_rows == 1) {
        return true;
    } elseif ($q->num_rows == 0) {
        return false;
    }
}
function check_location($city, $region, $country) {
    global $con;
    $q = mysqli_query($con, "SELECT * FROM locations WHERE city = '$city' AND region = '$region' AND country = '$country'");
    if ($q->num_rows == 1) {
        return true;
    } elseif ($q->num_rows == 0) {
        return false;
    }
}
function username($username) {
	global $con;
	$username = $con->escape_string(trim($username));
	if ($username && strlen($username) >= 4 && preg_match('/^[\w]+$/', $username) && !strpos($username, " ")) {
		return $username;
	} elseif (!$username) {
		return '';
	}  elseif (strlen($username) < 4) {
        return 1;
    } elseif (strpos($username, " ")) {
        return 2;
    } elseif (!preg_match('/^[\w]+$/', $username)) {
		return 3;
	} 
}
function email($email) {
	global $con;
	$email = $con->escape_string(trim($email));
	$check = preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])+[@]+([a-zA-Z0-9_-])+[.]+([a-zA-Z]+)+$/", $email);
	if ($email && $check && !strpos($email, " ")) {
		return $email;
	} elseif (!$email) {
		return '';
	} elseif (strpos($email, " ")) {
		return 1;
	} elseif (!$check) {
		return 2;
	}
}
function password($password) {
	global $con;
	$password = $con->escape_string(trim($password));
	$password = password_hash($password, PASSWORD_BCRYPT);
	if ($password) {
		return $password;
	} elseif (!$password) {
		return '';
	}
}
function fetch_array($q='') {
    global $con;
    $db = mysqli_query($con, $q);
    $array = mysqli_fetch_array($db);
    return $array;
}
function compare_passwords($username, $password) {
	global $con;
	$db = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
	$n['user'] = mysqli_fetch_array($db);
	if (password_verify($password, $n['user']['pass'])) {
		return 1;
	} else {
		return 0;
	}
}
function user($username) {
    global $con, $n;
    $db = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
    $n['user'] = mysqli_fetch_array($db);
    return $n['user'];
}
function account($username) {
    global $con, $n;
    $db = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
    $n['profile'] = mysqli_fetch_array($db);
    return $n['profile'];
}
function get_user_id($username) {
    global $con;
    $db = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
    $n['user'] = mysqli_fetch_array($db);
    return $n['user']['id'];
}
function get_username($user_id) {
    global $con;
    $db = mysqli_query($con, "SELECT * FROM users WHERE id = '$user_id'");
    $n['user'] = mysqli_fetch_array($db);
    return $n['user']['username'];
}
function cdate($date) {
    $check = explode('-', $date);
    if (checkdate($check[2], $check[0], $check[1])) {
        return true;
    } else {
        return false;
    }
}
function ctime($time) {
    $pattern = "/^([0-1][0-9]|[2][0-3])[\:]([0-5][0-9])$/";
    if(preg_match($pattern, $time)) {
        return true;
    } else {
        return false;
    }
}
function clocation($location) {
    $pattern = "/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/g";
}
function cprice($its_free, $price) {
    if ($its_free == 0 && $price > 0) {
        return true;
    } elseif ($its_free == 0 && $price == 0) {
        return false;
    } elseif ($its_free == 1) {
        return true;
    }
}
function ext($e='') {
    if ($e == 'image/jpeg') {
        return ".jpeg";
    } elseif ($e == "image/png") {
        return ".png";
    } elseif ($e == "image/gif") {
        return ".gif";
    } elseif ($e == "video/mp4") {
        return ".mp4";
    } else {
        return false;
    }
}
function upload_file($type, $source, $dest) {
    $ext = ext($type);
    if (is_uploaded_file($source)) {
        $name = md5(rand(0, 1000).'ncjimanml').$ext;
        $d = "../uploads/".$dest."/".$name;
        copy($source, $d);
        return "uploads/".$dest."/".$name;
    } elseif (!is_uploaded_file($source)) {
        return '';
    } elseif ($ext == false) {
        return false;
    }
    return $uploaded;
}
function time_elapsed($ptime) {
    $etime = time() - $ptime;
    if ($etime < 1) {
        return 'Ahora';
    }
    $a        = array(
        365 * 24 * 60 * 60 => 'año',
        30 * 24 * 60 * 60 => 'mes',
        24 * 60 * 60 => 'día',
        60 * 60 => 'hora',
        60 => 'minuto',
        1 => 'segundo'
    );
    $a_plural = array(
        'año' => 'años',
        'mes' => 'meses',
        'día' => 'días',
        'hora' => 'horas',
        'minuto' => 'minutos',
        'segundo' => 'segundos'
    );
    foreach ($a as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            $time_ago = "Hace ".$r." ".($r > 1 ? $a_plural[$str] : $str);
            return $time_ago;
        }
    }
}
function timeElapsed($time) {
    $etime = time() - $time;
    return $etime;
}
function cday($day) {
    if ($day >= 1) {
        return true;
    } elseif ($day > 31) {
        return false;
    } elseif ($day == 0) {
        return false;
    }
}
function cmonth($month) {
    if ($month == 1) {
        return 'Enero.';
    } elseif ($month == 2) {
        return 'Febrero';
    } elseif ($month == 3) {
        return 'Marzo';
    } elseif ($month == 4) {
        return 'Abril';
    } elseif ($month == 5) {
        return 'Mayo';
    } elseif ($month == 6) {
        return 'Junio';
    } elseif ($month == 7) {
        return 'Julio';
    } elseif ($month == 8) {
        return 'Agosto';
    } elseif ($month == 9) {
        return 'Septiembre';
    } elseif ($month == 10) {
        return 'Octubre';
    } elseif ($month == 11) {
        return 'Noviembre';
    } elseif ($month == 12) {
        return 'Diciembre';
    } else {
        return false;
    }
}
function get_month($month) {
    if ($month == 1) {
        return 'Enero.';
    } elseif ($month == 2) {
        return 'Febrero';
    } elseif ($month == 3) {
        return 'Marzo';
    } elseif ($month == 4) {
        return 'Abril';
    } elseif ($month == 5) {
        return 'Mayo';
    } elseif ($month == 6) {
        return 'Junio';
    } elseif ($month == 7) {
        return 'Julio';
    } elseif ($month == 8) {
        return 'Agosto';
    } elseif ($month == 9) {
        return 'Septiembre';
    } elseif ($month == 10) {
        return 'Octubre';
    } elseif ($month == 11) {
        return 'Noviembre';
    } elseif ($month == 12) {
        return 'Diciembre';
    } else {
        return false;
    }
}
function get_profile_pic($id) {
    global $con, $n;
    $n['user'] = fetch_array("SELECT * FROM users WHERE id = '$id'");
    return $n['site_url'].'/'.$n['user']['profile_pic'];
}
function get_location($user_id) {
    global $con;
    $n['user'] = fetch_array("SELECT * FROM users WHERE id = '$user_id'");
    return $n['user']['city'].', '.$n['user']['region'].', '.$n['user']['country'].'.';
}
function get_location_id($city, $region, $country) {
    global $con;
    $q = mysqli_query($con, "SELECT * FROM locations WHERE city = '$city' AND region = '$region' AND country = '$country'");
    $n['location'] = mysqli_fetch_array($q);
    if ($q->num_rows == 1) {
        return $n['location']['id'];
    } elseif ($q->num_rows == 0) {
        return 0;
    }
}
function get_location_name($location_id) {
    global $con;
    $q = mysqli_query($con, "SELECT * FROM locations WHERE id = '$location_id'");
    $n['location'] = mysqli_fetch_array($q);
    return $n['location']['city'].', '.$n['location']['region'].', '.$n['location']['country'].'.';
}
function check_events_for_location() {
    global $con, $id;
    $n['user'] = user(get_username($id));
    $location = $n['user']['location'];
    $q = mysqli_query($con, "SELECT * FROM events WHERE location = '$location'");
    if ($q->num_rows > 0) {
        return true;
    } elseif ($q->num_rows == 0) {
        return false;
    }
}
function check_user_verified($user_id) {
    global $con;
    $n['user'] = fetch_array("SELECT * FROM users WHERE id = '$user_id'");
    if ($n['user']['verified'] == 1) {
        return true;
    } else {
        return false;
    }
}
function total_followers($id) {
    global $con;
    $q = mysqli_query($con, "SELECT * FROM followers WHERE follower_id = '$id'");
    $num = mysqli_num_rows($q);
    return $num;
}
function total_followed($id) {
    global $con;
    $q = mysqli_query($con, "SELECT * FROM followers WHERE user_id = '$id'");
    $num = mysqli_num_rows($q);
    return $num;
}
function total_notifications($id) {
    global $con;
    $q = mysqli_query($con, "SELECT * FROM notifications WHERE to_id = '$id' AND seen = '0'");
    $num = mysqli_num_rows($q);
    if ($num > 9) {
        $num = "+9";
    } elseif ($num == 0) {
        $num = "";
    }
    return $num;
}
function total_likes_post($post_id) {
    global $con;
    $q = mysqli_query($con, "SELECT * FROM likes WHERE post_id = '$post_id'");
    $num = mysqli_num_rows($q);
    return $num;
}
function total_comments_event($event_id) {
    global $con;
    $q = mysqli_query($con, "SELECT * FROM comments WHERE event_id = '$event_id'");
    $num = mysqli_num_rows($q);
    return $num;
}
function last_location($user_id) {
    global $con, $n;
    $city = $n['user_city'];
    $region = $n['user_regionName'];
    $country = $n['user_countryName'];
    $time = time();
    $q = mysqli_query($con, "SELECT * FROM user_locations WHERE user_id = '$user_id' AND city = '$city' AND region = '$region' AND country = '$country'");
    if ($q->num_rows == 1) {
        mysqli_query($con, "UPDATE user_locations SET last_mod = '$time' WHERE user_id = '$user_id' AND city = '$city' AND region = '$region' AND country = '$country'");
    } elseif ($q->num_rows == 0 && $city && $region && $country) {
        mysqli_query($con, "INSERT INTO user_locations (user_id, city, region, country, time) VALUE ('$user_id', '$city', '$region', '$country', '$time')");
    }
    $lq = mysqli_query($con, "SELECT * FROM locations WHERE city = '$city' AND region = '$region' AND country = '$country'");
    if ($lq->num_rows == 0 && $city && $region && $country) {
        $time = time();
        mysqli_query($con, "INSERT INTO locations (city, region, country, population, time) VALUES ('$city', '$region', '$country', '1', '$time')");
    } elseif ($lq->num_rows == 1) {
        $qc = mysqli_query($con, "SELECT * FROM users WHERE city = '$city' AND region = '$region' AND country = '$country'");
        $population = $qc->num_rows;
        $location = fetch_array("SELECT * FROM locations WHERE city = '$city' AND region = '$region' AND country = '$country'");
        if ($population > $location['population']) {
            mysqli_query($con, "UPDATE locations SET population = '$population' WHERE city = '$city' AND region = '$region' AND country = '$country'");
        }
    }


}
function last_seen($id) {
    global $con;
    $time = time();
    mysqli_query($con, "UPDATE users SET last_seen = '$time' WHERE id = '$id'");
}
function new_notification($user_id, $to_id, $ref_id, $e_id, $type) {
    global $con;
    $time = time();
    if (!$ref_id) {
        $ref_id = 0;
    }
    if ($user_id != $to_id && $type == 1) {
        // Notificación para comentarios en los perfiles
        mysqli_query($con, "INSERT INTO notifications (user_id, to_id, ref_id, account_id, type, time) VALUES ('$user_id', '$to_id', '$ref_id', '$e_id', '$type', '$time')");
    } elseif ($user_id != $to_id && $type == 2) {
        // Notificación de seguimiento
        mysqli_query($con, "INSERT INTO notifications (user_id, to_id, account_id, type, time) VALUES ('$user_id', '$to_id', '$e_id', '$type', '$time')");
    } elseif ($user_id != $to_id && $type == 3) {
        // Notificación de likes en publicaciones
        mysqli_query($con, "INSERT INTO notifications (user_id, to_id, ref_id, type, time) VALUES ('$user_id', '$to_id', '$ref_id', '$type', '$time')");
    } elseif ($user_id != $to_id && $type == 4) {
        // Notificación para comentarios en las publicaciones
        mysqli_query($con, "INSERT INTO notifications (user_id, to_id, ref_id, post_id, type, time) VALUES ('$user_id', '$to_id', '$ref_id', '$e_id', '$type', '$time')");
    } elseif ($user_id != $to_id && $type == 5) {
        // Notficiación para respuestas a comentarios
        mysqli_query($con, "INSERT INTO notifications (user_id, to_id, ref_id, comment_id, type, time) VALUES ('$user_id', '$to_id', '$ref_id', '$e_id', '$type', '$time')");
    }
}
function CountUsersOnline() {
    global $con;
    $time = time() - 5; 
    $q = mysqli_query($con, "SELECT * FROM users WHERE last_seen > $time");
    return $q->num_rows;
}
function text($text) {
    global $n, $id;
    $text = htmlspecialchars($text);
    $text = preg_replace('/\n/', '<br>', $text);
    return $text;
}