<?php
$city = $n['user']['city'];
$region = $n['user']['region'];
$country = $n['user']['country'];
$q = mysqli_query($con, "SELECT * FROM events WHERE city = '$city' AND region = '$region' AND country = '$country'");
if ($q->num_rows > 0) {
?>
    <div class="p-fixed img-event" style="background-image: url('<?php echo $n['site_url']."/".$n['event']['img'] ?>');">
        <div class="d-flex p-t-3 p-l-3 p-r-3 p-b-3" style="background: #0009">
            <div class="pp _45 m-r-5" style="background: url('<?php echo get_profile_pic($n['event']['user_id']) ?>');"></div>
            <div class="p-relative d-grid">
                <a class="m-b-1" href="<?php echo $n['site_url'].'/account/'.get_username($n['event']['user_id']) ?>">
                    <span class="white-color" style="padding: 2px 15px; border-radius: 90px"><?php echo get_username($n['event']['user_id']) ?></span>
                </a>
                <p>
                    <span class="white-color" style="padding: 2px 15px; border-radius: 90px; font-size: 15px">
                        <?php echo time_elapsed($n['event']['time']) ?>
                    </span>
                </p>
            </div>
            <div class="p-absolute" style="right: 10px">
                <?php if ($n['logged_in'] == true && $id == $n['event']['user_id']) { ?>
                    <span onclick="menu_event(<?php echo $n['post']['id'] ?>);" class="m-r-3 white-color"><i class="fas fa-ellipsis-h"></i></span>
                <?php } ?>
                <span class="white-color" onclick="see_events();"><i class="fas fa-window-close"></i></span>
            </div>
            <?php if ($n['logged_in'] == true && $id == $n['event']['user_id']) { ?>
                <div id="menu_event_<?php echo $n['post']['id'] ?>" class="hidden">
                    <div class="p-absolute d-grid p-t-3 p-l-3 p-r-3 p-b-3" style="background: #222; border: 1px solid #111; right: 25px; top: 20px; border-radius: 5px">
                        <a onclick="delete_event(<?php echo $n['event']['id'] ?>);" id="d-btn" style="color: #e74c3c; font-size: 12px"><i class="fas fa-trash"></i> Borrar</a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div id="back" class="p-absolute" style="left: 5px; top: 50%">
            <span id="b-btn" class="white-color" onclick="back_event(<?php echo $n['event']['id']; ?>);" style="background: #0009; padding: 15px 15px; border-radius: 5px; font-size: 18px"><i class="fas fa-chevron-left"></i></span>
        </div>
        <div id="next" class="p-absolute" style="right: 5px; top: 50%">
            <span id="n-btn" class="white-color" onclick="next_event(<?php echo $n['event']['id']; ?>);" style="background: #0009; padding: 15px 15px; border-radius: 5px; font-size: 18px"><i class="fas fa-chevron-right"></i></span>
        </div>
        <div class="p-absolute" style="bottom: 10px; left: 0px; width: 100%">
            <div class="px-2 py-2" style="background: #0009">
                <div id="na-de" class="show">
                    <h2 class="m-b-4 white-color"><?php echo $n['event']['name'] ?></h2>
                    <p class="white-color"><?php echo text($n['event']['description']) ?></p>
                </div>
                <div id="info" class="hidden">
                    <p class="m-b-4 white-color"><i class="fas fa-clock"></i> <?php echo $n['event']['timeh'] ?></p>
                    <p class="m-b-4 white-color"><i class="fas fa-calendar-day"></i> <?php echo $n['event']['date'] ?></p>
                    <p class="m-b-4 white-color"><i class="fas fa-map-marked-alt"></i> <?php echo $n['event']['city'].', '.$n['event']['region'].', '.$n['event']['country'].'.' ?></p>
                    <p class="m-b-4 white-color"><i class="fas fa-map-signs"></i> <?php echo $n['event']['address'] ?></p>
                    <?php if ($n['event']['its_free'] == 1) { ?>
                        <p class="m-b-4 white-color"><i class="fas fa-dollar-sign"></i> ¡Gratis!</p>
                    <?php } elseif ($n['event']['its_free'] == 0) { ?>
                        <p class="m-b-4 white-color"><i class="fas fa-dollar-sign"></i> <?php echo $n['event']['price'] ?></p>
                    <?php } ?>
                    <div class="d-flex">
                        <?php if (check_like_event($id, $n['event']['id']) == false) { ?>
                            <input type="number" id="tln" value="<?php echo total_likes_event($n['event']['id']) ?>" hidden>
                            <button id="like_event_<?php echo $n['event']['id'] ?>" onclick="like(<?php echo $n['event']['id'] ?>);" class="btn-1 m-r-1">
                                <i class="fas fa-heart"></i> <span id="tl_<?php echo $n['event']['id'] ?>"><?php echo total_likes_event($n['event']['id']) ?></span>
                            </button>
                        <?php } elseif (check_like_event($id, $n['event']['id']) == true) { ?>
                            <input type="number" id="tln" value="<?php echo total_likes_event($n['event']['id']) ?>" hidden>
                            <button id="like_event_<?php echo $n['event']['id'] ?>" onclick="like(<?php echo $n['event']['id'] ?>);" class="btn-1 m-r-1 liked">
                                <i class="fas fa-heart"></i> <span id="tl_<?php echo $n['event']['id'] ?>"><?php echo total_likes_event($n['event']['id']) ?></span>
                            </button>
                        <?php } ?>
                        <button id="interested_event_<?php echo $n['event']['id'] ?>" onclick="interested(<?php echo $n['event']['id'] ?>);" class="btn-1 m-r-1">Me interesa</button>
                        <button id="assist_event_<?php echo $n['event']['id'] ?>" onclick="assist(<?php echo $n['event']['id'] ?>);" class="btn-1">Asistiré</button>
                    </div>
                </div>
            </div>
            <p class="px-1 pc-1" style="background: #0009;text-align: center;">
                <span id="btn_info" class="white-color" onclick="info();" style="padding: 15px 15px; border-radius: 90px;"><i class="fas fa-chevron-up"></i> Más</span>
            </p>
        </div>
    </div>
<?php } elseif ($q->num_rows == 0) { ?>
    <div class="p-fixed img-event" style="background-image: url('<?php echo $n['site_url']."/".$n['event']['img'] ?>');">
        <div class="d-flex p-t-3 p-l-3 p-r-3 p-b-3" style="background: #0009">
            <div class="pp _45 m-r-5" style="background: url('<?php echo $n['site_url'].'/uploads/pp/default-11.png' ?>');"></div>
            <div class="p-relative d-grid">
                <a class="m-b-1" href="#user">
                    <span class="white-color" style="padding: 2px 15px; border-radius: 90px"><?php echo $n['site_title'] ?></span>
                </a>
                <p>
                    <span class="white-color" style="padding: 2px 15px; border-radius: 90px; font-size: 15px">
                    El comienzo de los tiempos
                    </span>
                </p>
            </div>
            <div class="p-absolute" style="right: 10px">
                <span onclick="see_events();"><i style="color: #fff;" class="fas fa-window-close"></i></span>
            </div>
        </div>
        <div class="p-absolute text-center" style="top: 50%; left: 0px; width: 100%">
            <p class="m-b-5 text-bold white-color">Al parecer no hay eventos...</p>
            <a href="<?php echo $n['site_url'] ?>/event/new"><h2 class="white-color"><i class="fas fa-plus"></i> Crear evento</h2></a>
        </div>
    </div>
<?php } ?>