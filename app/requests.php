<?php
include "init.php";
$f = '';
if (isset($_GET['f'])) {
    $f = $_GET['f'];
}

$o = '';
if (isset($_GET['o'])) {
    $o = $_GET['o'];
}

if ($f == 'new-account' && $n['logged_in'] == false) {
    $username = username($_POST['username']);
    $email = email($_POST['email']);
    $pass = $_POST['password'];
    $gender = 0;
    if ($_POST['gender'] == 1) {
        $gender = 1;
    }
    $accept = 0;
    if (isset($_POST['terms'])) {
        $accept = 1;
    }
    $ip = $_SERVER['REMOTE_ADDR'];
    $city = $n['user_city'];
    $region = $n['user_regionName'];
    $country = $n['user_countryName'];
	$deny_u = $username != 1 && $username != 2 && $username != 3;
    $deny_e = $email != 1 && $email != 2;
    $hash = md5(time().$username);
    if ($deny_u && $deny_e && $pass && check_user($username) == 0 && check_email($email) == 0 && $accept == 1) {
        $password = password($pass);
        mysqli_query($con, "INSERT INTO users (username, email, pass, profile_pic, city, region, country, gender, ip, hash) VALUES ('$username', '$email', '$password', 'uploads/pp/default.png', '$city', '$region', '$country', '$gender', '$ip', '$hash')");
        echo "Cuenta creada.";
    } elseif (!$username) {
        echo "Escribe un usuario";
    } elseif (!$email) {
        echo "Escribe un e-mail";
    } elseif (!$pass) {
        echo "Escribe una contraseña";
    } elseif ($accept == 0) {
        echo "Debes aceptar los términos y condiciones.";
    } elseif ($username == 1) {
        echo "Tu usuario debe tener más de 4 caracteres.";
    } elseif ($username == 2) {
        echo "Tu usuario no debe contener espacios.";
    } elseif ($username == 3) {
        echo "Tu usuario contiene caracteres inválidos.";
    } elseif ($email == 1) {
        echo "Tu e-mail no debe contener espacios.";
    } elseif ($email == 2) {
        echo "Tu e-mail contiene caracteres inválidos.";
    } elseif (check_user($username) == 1) {
        echo "Ese usuario está siendo usado.";
    } elseif (check_email($email) == 1) {
        echo "Ese e-mail está siendo usado.";
    }
}
if ($f == 'login' && $n['logged_in'] == false) {
    $username = $_POST['username'];
    $password = $_POST['pass'];
    $data['status'] = 204;
    if ($username && $password && check_user($username) == 1 && compare_passwords($username, $password) == 1) {
        $n['user'] = fetch_array("SELECT * FROM users WHERE username = '$username'");
        $_SESSION['id'] = $n['user']['id'];
        $user_id = $n['user']['id'];
        $data['status'] = 200;
    }
    echo json_encode($data);
}
if ($f == 'people_you_may_know' && $n['logged_in'] == true) {
    $n['user'] = user(get_username($id));
    $city = $n['user']['city'];
    $region = $n['user']['region'];
    $country = $n['user']['country'];
    $query = mysqli_query($con, "SELECT * FROM users WHERE city = '$city' AND region = '$region' AND country = '$country' ORDER BY RAND()");
    while ($q=mysqli_fetch_array($query)) {
        include "layout/recommended/people_you_may_know.php";
    }
}
if ($f == 'get_users') {
    $query = mysqli_query($con, "SELECT follower_id FROM followers WHERE user_id = '$id'");
    $emptyarray = array();
    while($row = mysqli_fetch_row($query)){
        array_push($emptyarray, $row[0]);
    }
    $ids = implode(", ", $emptyarray).', '.$id;
    echo $ids;
}
if ($f == 'load_posts' && $n['logged_in']) {
    $query = mysqli_query($con, "SELECT follower_id FROM followers WHERE user_id = '$id'");
    $emptyarray = array();
    while($row = mysqli_fetch_row($query)){
        array_push($emptyarray, $row[0]);
    }
    $ids = implode(", ", $emptyarray);
    if (!$ids) {
        $ids = 0;
    }
    $q = mysqli_query($con, "SELECT * FROM posts WHERE user_id in($ids, $id) AND deleted = '0' ORDER BY id DESC");
    $num = 0;
    if ($q->num_rows > 0) {
        while ($n['post'] = mysqli_fetch_array($q)) {
            $num++;
            include 'layout/posts/content.php';
            if ($num%5 == 0) {
                echo '<div class="m-b-4"><p class="normal-color text-bold">Anuncio</p></div>';
            }
        } 
    } elseif ($q->num_rows == 0) {
        echo '<p class="text-bold normal color">No hay publicaciones</p>';
    }
}
if ($f == 'load_posts_profile') {
    $user_id = $_GET['user_id'];
    $q = mysqli_query($con, "SELECT * FROM posts WHERE user_id = '$user_id' AND secret = '0' AND deleted = '0' ORDER BY id DESC");
    while ($n['post'] = mysqli_fetch_array($q)) {
        include 'layout/posts/content.php';
    }
}
if ($f == 'new-post') {
    $n['user'] = user(get_username($id));
    $text = $con->escape_string(trim($_POST['text']));
    $time = time();
    $location_post = 0;
    $is_secret = 0;
    if ($_POST['secret_post'] == 1) {
        $is_secret = 1;
    }
    if ($is_secret == 0 && $_POST['location_post'] == 1) {
        $location_post = get_location_id($n['user']['city'], $n['user']['region'], $n['user']['country']);
    }
    $data['status'] = 204;
    $files = false;
    $img = "";
    $url = array();
    if (!empty($_FILES['img']['name'])) {
        foreach ($_FILES['img']['name'] as $key => $name) {
            if ($_FILES['img']['tmp_name'][$key]) {
                $files = true;
            }
            $url[] = upload_file($_FILES['img']['type'][$key], $_FILES['img']['tmp_name'][$key], 'files');
            $img = implode(", ", $url);
        }
    }
    if ($text || $files == true) {
        mysqli_query($con, "INSERT INTO posts (user_id, text, img, location_id, secret, time) VALUES ('$id', '$text', '$img', '$location_post', '$is_secret', '$time')");
        $data['status'] = 200;
    }
    echo json_encode($data);
}
if ($f == 'delete' && $n['logged_in'] == true && $_GET['e_id'] && is_numeric($_GET['e_id'])) {
    $e_id = $_GET['e_id'];
    $data['status'] = 204;
    if ($o == "post") {
        $q = mysqli_query($con, "SELECT * FROM posts WHERE id = '$e_id' AND user_id = '$id'");
        if ($q->num_rows == 1) {
            mysqli_query($con, "UPDATE posts SET deleted = '1'WHERE id = '$e_id' AND user_id = '$id'");
            $data['status'] = 200;
        }
    } elseif ($o == "comment") {
        $q = mysqli_query($con, "SELECT * FROM comments WHERE id = '$e_id' AND user_id = '$id'");
        if ($q->num_rows == 1) {
            mysqli_query($con, "DELETE FROM comments WHERE id = '$e_id' AND user_id = '$id'");
            $data['status'] = 200;
        }
    } elseif ($o == "reply") {
        $q = mysqli_query($con, "SELECT * FROM replies WHERE id = '$e_id' AND user_id = '$id'");
        if ($q->num_rows == 1) {
            mysqli_query($con, "DELETE FROM replies WHERE id = '$e_id' AND user_id = '$id'");
            $data['status'] = 200;
        }
    }
    echo json_encode($data);
}
if ($f == 'data' && $n['logged_in'] == true) {
    last_seen($id);
    $n['user'] = user(get_username($id));
    $query = mysqli_query($con, "SELECT follower_id FROM followers WHERE user_id = '$id'");
    $emptyarray = array();
    $emptyarray[] = $id;
    while($row = mysqli_fetch_row($query)){
        $emptyarray[] .= $row[0];
    }
    $ids = implode(", ", $emptyarray);
    $time = time() - 3;
    $n['post'] = fetch_array("SELECT * FROM posts WHERE user_id in($ids) ORDER BY id DESC");
    $n['notification'] = fetch_array("SELECT * FROM notifications WHERE to_id = '$id' AND seen = '0' ORDER BY id DESC");
    $data['actual_page'] = $n['user']['actual_page'];
    $data['new_post'] = false;
    $data['new_notification'] = false;
    $data['last_not'] = "";
    if ($n['user']['actual_page'] == 'home' && $time < $n['post']['time']) {
        $qp = mysqli_query($con, "SELECT * FROM posts WHERE time > $time ORDER BY id DESC");
        $np = array();
        while ($p=mysqli_fetch_array($qp)) {
            $np[] = $p['id'];
        }
        $data['np'] = $np;    
        $data['new_post'] = true;
    }
    if ($time < $n['notification']['time']) {
        $qn = mysqli_query($con, "SELECT * FROM notifications WHERE time > $time ORDER BY id DESC");
        $nn = array();
        while ($n=mysqli_fetch_array($qn)) {
            $nn[] = $n['id'];
        }
        $data['nn'] = $nn;  
        $data['total_nots'] = total_notifications($id);
        $data['new_notification'] = true;
    }
    echo json_encode($data);
}
if ($f == 'comments_real_time' && $n['logged_in'] == true) {
    $post_id = $_GET['post_id'];
    $n['comment'] = fetch_array("SELECT * FROM comments WHERE post_id = '$post_id' ORDER BY id DESC");
    $data['new_comment'] = false;
    $time = time() - 3;
    if ($time < $n['comment']['time']) {
        $comment_id = array();
        $qm = mysqli_query($con, "SELECT * FROM comments WHERE time > $time AND post_id = '$post_id' ORDER BY id DESC");
        while ($c=mysqli_fetch_array($qm)) {
            $comment_id[] = $c['id'];
        }
        $data['comment_id'] = $comment_id;
        $data['new_comment'] = true;
    }
    echo json_encode($data);
}
if ($f == 'new_comment' && $n['logged_in'] == true) {
    if ($o == 'account') {
        $text = $con->escape_string(trim($_POST['text']));
        $account_id = $_POST['account_id'];
        $time = time();
        if ($text && $account_id) {
            mysqli_query($con, "INSERT INTO comments (text, user_id, account_id, time) VALUES ('$text', '$id', '$account_id', '$time')");
            $n['comment'] = fetch_array("SELECT * FROM comments WHERE user_id = '$id' AND time = '$time'");
            $comment_id = $n['comment']['id'];
            new_notification($id, $account_id, $comment_id, $account_id, 1);
            include 'layout/comments/content.php';
        }
    } elseif ($o == 'post') {
        $text = $con->escape_string(trim($_POST['text']));
        $post_id = $_GET['post_id'];
        $to_id = $_GET['to_id'];
        $time = time();
        if ($text && $post_id && $to_id) {
            mysqli_query($con, "INSERT INTO comments (text, user_id, post_id, time) VALUES ('$text', '$id', '$post_id', '$time')");
            $n['comment'] = fetch_array("SELECT * FROM comments WHERE user_id = '$id' AND post_id = '$post_id' AND time = '$time'");
            $comment_id = $n['comment']['id'];
            new_notification($id, $to_id, $comment_id, $post_id, 4);
            include 'layout/comments/content.php';
        }
    }
}
if ($f == 'new_reply' && $n['logged_in'] == true) {
    $text = $con->escape_string(trim($_POST['text']));
    $comment_id = $_GET['comment_id'];
    $to_id = $_GET['to_id'];
    $time = time();
    if ($text && $comment_id && $to_id) {
        mysqli_query($con, "INSERT INTO replies (text, user_id, comment_id, time) VALUES ('$text', '$id', '$comment_id', '$time')");
        $n['reply'] = fetch_array("SELECT * FROM replies WHERE user_id = '$id' AND comment_id = '$comment_id' AND time = '$time'");
        $reply_id = $n['reply']['id'];
        new_notification($id, $to_id, $reply_id, $comment_id, 5);
        include 'layout/replies/content.php';
    }
}
if ($f == 'load_comments') {
    if ($o == 'account') {
        $account_id = $_GET['account_id'];
        if ($account_id) {
            $q = mysqli_query($con, "SELECT * FROM comments WHERE account_id = '$account_id'");
            $row = $q->num_rows;
            while ($n['comment'] = mysqli_fetch_array($q)) {
                include 'layout/comments/content.php';
            }
        }
    } elseif ($o == 'post') {
        $post_id = $_GET['post_id'];
        if ($post_id) {
            $q = mysqli_query($con, "SELECT * FROM comments WHERE post_id = '$post_id' ORDER BY id DESC");
            while ($n['comment'] = mysqli_fetch_array($q)) {
                include 'layout/comments/content.php';
            }
        }
    }
}
if ($f == 'load_replies') {
    $comment_id = $_GET['comment_id'];
    if ($comment_id) {
        $q = mysqli_query($con, "SELECT * FROM replies WHERE comment_id = '$comment_id' ORDER BY id DESC");
        while ($n['reply'] = mysqli_fetch_array($q)) {
            include 'layout/replies/content.php';
        }
    }
}
if ($f == 'follow' && $n['logged_in'] == true) {
    $follower_id = $_GET['follower_id'];
    $time = time();
    $q = mysqli_query($con, "SELECT * FROM followers WHERE user_id = '$id' AND follower_id = '$follower_id'");
    if ($q->num_rows == 0 && check_user(get_username($follower_id)) == 1) {
        mysqli_query($con, "INSERT INTO followers (user_id, follower_id, time) VALUES ('$id', '$follower_id', '$time')");
        new_notification($id, $follower_id, 0, $followers, 2);
    } elseif ($q->num_rows == 1 && check_user(get_username($follower_id)) == 1) {
        mysqli_query($con, "DELETE FROM followers WHERE user_id = '$id' AND follower_id = '$follower_id'");
    }
}
if ($f == 'change_pic' && $n['logged_in'] == true) {
    if ($_FILES['picture']['name']) {
        $picture = upload_file($_FILES['picture']['type'], $_FILES['picture']['tmp_name'], 'pp');
        mysqli_query($con, "UPDATE users SET profile_pic = '$picture' WHERE id = '$id'");   
    }
}
if ($f == 'logout') {
    session_unset();
    session_destroy();
}
// Acá se repiten el los códigos porque todavía no encontré una forma óptima para simplificarlo
if ($f == 'like_post' && $n['logged_in'] == true && $_GET['post_id']) {
    $post_id = $_GET['post_id'];
    $to_id = $_GET['to_id'];
    $time = time();
    if (check_like($id, $post_id, "post") == false) {
        mysqli_query($con, "INSERT INTO likes (user_id, post_id, time) VALUES ('$id', '$post_id', '$time')");
        $n['like'] = fetch_array("SELECT * FROM likes WHERE user_id = '$id' AND post_id = '$post_id'");
        $post_id = $n['like']['post_id'];
        new_notification($id, $to_id, $post_id, 0, 3);
    } elseif (check_like($id, $post_id, "post") == true) {
        mysqli_query($con, "DELETE FROM likes WHERE user_id = '$id' AND post_id = '$post_id'");
    }
}
if ($f == 'like_comment' && $n['logged_in'] == true && $_GET['comment_id']) {
    $comment_id = $_GET['comment_id'];
    $to_id = $_GET['to_id'];
    $time = time();
    if (check_like($id, $comment_id, "comment") == false) {
        mysqli_query($con, "INSERT INTO likes (user_id, comment_id, time) VALUES ('$id', '$comment_id', '$time')");
        $n['like'] = fetch_array("SELECT * FROM likes WHERE user_id = '$id' AND comment_id = '$comment_id'");
        $comment_id = $n['like']['comment_id'];
        new_notification($id, $to_id, $comment_id, 0, 3);
    } elseif (check_like($id, $comment_id, "comment") == true) {
        mysqli_query($con, "DELETE FROM likes WHERE user_id = '$id' AND comment_id = '$comment_id'");
    }
}
if ($f == 'like_reply' && $n['logged_in'] == true && $_GET['reply_id']) {
    $reply_id = $_GET['reply_id'];
    $to_id = $_GET['to_id'];
    $time = time();
    if (check_like($id, $reply_id, "reply") == false) {
        mysqli_query($con, "INSERT INTO likes (user_id, reply_id, time) VALUES ('$id', '$reply_id', '$time')");
        $n['like'] = fetch_array("SELECT * FROM likes WHERE user_id = '$id' AND reply_id = '$reply_id'");
        $reply_id = $n['like']['reply_id'];
        new_notification($id, $to_id, $reply_id, 0, 3);
    } elseif (check_like($id, $reply_id, "reply") == true) {
        mysqli_query($con, "DELETE FROM likes WHERE user_id = '$id' AND reply_id = '$reply_id'");
    }
}
if ($f == 'update_location' && $n['logged_in'] == true) {
    $city = $n['user_city'];
    $region = $n['user_regionName'];
    $country = $n['user_countryName'];
    if ($city && $region && $country) {
        mysqli_query($con, "UPDATE users SET city = '$city', region = '$region', country = '$country' WHERE id = '$id'");
    }
}
if ($f == 'load_locations') {
    $q = mysqli_query($con, "SELECT * FROM user_locations WHERE user_id = '$id' ORDER BY last_mod DESC");
    while ($n['location'] = mysqli_fetch_array($q)) {
        $n['location']['complete'] = $n['location']['city'].' '.$n['location']['region'].' '.$n['location']['country'];
        include 'layout/modals/list-locations.php';
    }
}
if ($f == 'updateLocation' && $n['logged_in'] == true) {
    $location_id = $_GET['location_id'];
    $n['location'] = fetch_array("SELECT * FROM user_locations WHERE id = '$location_id'");
    $city = $n['location']['city'];
    $region = $n['location']['region'];
    $country = $n['location']['country'];
    if (check_location($n['location']['city'], $n['location']['region'], $n['location']['country']) == true) {
        mysqli_query($con, "UPDATE users SET city = '$city', region = '$region', country = '$country' WHERE id = '$id'");
    }
}
if ($f == 'update_user_location' && $n['logged_in'] == true) {
    $city = $con->escape_string(trim($_POST['city']));
    $region = $con->escape_string(trim($_POST['region']));
    $country = $con->escape_string(trim($_POST['country']));
    $data['status'] = 204;
    if ($city && $region && $country && check_location($city, $region, $country) == true) {
        mysqli_query($con, "UPDATE users SET city = '$city', region = '$region', country = '$country' WHERE id = '$id'");
        $data['status'] = 200;
    } else if ($city && $region && $country && check_location($city, $region, $country) == false) {
        mysqli_query($con, "UPDATE users SET city = '$city', region = '$region', country = '$country' WHERE id = '$id'");
        mysqli_query($con, "INSERT INTO locations (city, region, country, population, time) VALUES ('$city', '$region', '$country', '1', '$time')");
        $data['status'] = 200;
    }
    echo json_encode($data);
}
if ($f == 'register_locations' && $n['logged_in'] == true) {
    $q = mysqli_query($con, "SELECT * FROM users");
    while ($user=mysqli_fetch_array($q)) {
        $city = $user['city'];
        $region = $user['region'];
        $country = $user['country'];
        $ql = mysqli_query($con, "SELECT * FROM locations WHERE city = '$city' AND region = '$region' AND country = '$country'");
        if ($ql->num_rows == 0 && check_location($city, $region, $country) == true) {
            $time = time();
            mysqli_query($con, "INSERT INTO locations (city, region, country, population, time) VALUES ('$city', '$region', '$country', '1', '$time')");
            echo "Nueva ubicación registrada.";
        } elseif ($ql->num_rows == 1) {
            $qc = mysqli_query($con, "SELECT * FROM users WHERE city = '$city' AND region = '$region' AND country = '$country'");
            $population = $qc->num_rows;
            $location = fetch_array("SELECT * FROM locations WHERE city = '$city' AND region = '$region' AND country = '$country'");
            if ($population > $location['population']) {
                mysqli_query($con, "UPDATE locations SET population = '$population' WHERE city = '$city' AND region = '$region' AND country = '$country'");
                echo "Ésta ubicación tiene ".$population." pobladores.";
            }
        }
    }
}
if ($f == 'search_location' && $n['logged_in'] == true) {
    $city = trim($_GET['city']);
    $region = trim($_GET['region']);
    $country = trim($_GET['country']);
    $q = mysqli_query($con, "SELECT * FROM locations WHERE city LIKE '%$city%' AND region LIKE '%$region%' AND country LIKE '%$country%' ORDER BY population DESC");
    if ($q->num_rows > 0) {
        if ($city || $region || $country) {
            echo "<p class='m-b-3'><span class='text-bold'>".$q->num_rows."</span> resultados a tu búsqueda.</p>";
            while ($n['location'] = mysqli_fetch_array($q)) {
                include 'layout/locations/result.php';
            }
        }
    } elseif ($q->num_rows == 0) {
        if ($city && $region && $country) {
            echo "<a class='text-bold' href='#new_location' style='font-size: 13px'>Agregar ésta ubicación a la base de datos.</a>";
        } else {
            echo "<p class='text-bold' style='font-size: 13px'>Si tu ubicación no está, completa todos los campos y regístrala.</p>";
        }
    }
}
if ($f == 'load_nots') {
    $q = mysqli_query($con, "SELECT * FROM notifications WHERE to_id = '$id' ORDER BY id DESC");
    if ($q->num_rows > 0) {
        while ($n['notification'] = mysqli_fetch_array($q)) {
            include 'layout/notifications/notification.php';
        }
    } else {
        echo "<p class='text-bold'>No tienes notificaciones.</p>";
    }
}
if ($f == 'get_last_nots') {
    $not_id = $_GET['not_id'];
    $n['notification'] = fetch_array("SELECT * FROM notifications WHERE id = '$not_id'");
    include 'layout/notifications/notification.php';
}
if ($f == 'get_last_comments') {
    $comment_id = $_GET['comment_id'];
    $n['comment'] = fetch_array("SELECT * FROM comments WHERE id = '$comment_id'");
    if ($n['comment']['user_id'] != $id) {
        include 'layout/comments/content.php';
    }
}
if ($f == 'get_last_posts') {
    $post_id = $_GET['post_id'];
    $n['post'] = fetch_array("SELECT * FROM posts WHERE id = '$post_id'");
    include 'layout/posts/content.php';
}
if ($f == 'read_all' && $n['logged_in'] == true) {
    $nots_unread = array();
    $qn = mysqli_query($con, "SELECT * FROM notifications WHERE to_id = '$id'");
    while ($n=mysqli_fetch_array($qn)) {
        $nots_unread[] = $n['id']; 
    }
    $data['not_id'] = $nots_unread;
    mysqli_query($con, "UPDATE notifications SET seen = '1' WHERE to_id = '$id'");
    $data['status'] = true;
    echo json_encode($data); 
}
if ($f == 'data_user') {
    $n['user'] = user(get_username($id));
    $data['id'] = $n['user']['id'];
    $data['username'] = $n['user']['username'];
    echo json_encode($data);
}
if ($f == 'edit-account') {
    $n['user'] = user(get_username($id));
    $bio = $con->escape_string(trim($_POST['bio']));
    $username = username($_POST['username']);
    $email = email($_POST['email']);
    $city = $con->escape_string(trim($_POST['city']));
    $region = $con->escape_string(trim($_POST['region']));
    $country = $con->escape_string(trim($_POST['country']));
    $deny_u = $username && ckeck_username($username, $id) == true && $username != 1 && $username != 2 && $username != 3;
    $deny_e = $email && $email != 1 && $email != 2;
    $gender = 0;
    if ($_POST['gender'] == 1) {
        $gender = 1;
    }
    $data['status'] = 204;
    $data['message'] = "";
    if ($deny_u && $deny_e) {
        mysqli_query($con, "UPDATE users SET username = '$username', email = '$email', biography = '$bio', city = '$city', region = '$region', country = '$country', gender = '$gender' WHERE id = '$id'");
        $data['status'] = 200;
        $data['message'] = "Datos editados";
    }
    echo json_encode($data);
}