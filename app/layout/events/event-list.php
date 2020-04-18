<div class="m-b-4">
    <div id="event_<?php echo $n['event']['id'] ?>" class="d-grid px-3 py-2" onclick="more_info_ev(<?php echo $n['event']['id'] ?>);" style="background: #f1f1f1; border: 1px solid #f1f1f1;">
        <div class="d-flex">
            <div class="pp _45 m-r-5" style="background: url('<?php echo get_profile_pic($n['event']['user_id']) ?>'); "></div>
            <div class="d-grid">
                <a style="color: #616161" href="<?php echo $n['site_url'].'/account/'.get_username($n['event']['user_id']) ?>"><?php echo get_username($n['event']['user_id']) ?></a>
                <p class="text-bold" style="color: #616161; font-size: 13px"><?php echo $n['event']['name'] ?></p>
                <p style="font-size: 13px"><?php echo time_elapsed($n['event']['time']) ?></p>
            </div>
        </div>
    </div>
    <div id="more_info_<?php echo $n['event']['id'] ?>" class="hidden" style="background: #f9f9f9; border: 1px solid #f5f5f5;">
        <div class="px-2 py-2">
            <p><?php echo $n['event']['description'] ?></p>
        </div>
        <div class="d-grid">
            <img src="<?php echo $n['site_url'].'/'.$n['event']['img'] ?>" style="width: 100%">
            <div class="px-3 py-2 m-b-4">
                <p class="m-b-4" style="font-size: 13px;"><i class="fas fa-clock"></i> <?php echo $n['event']['timeh'] ?></p>
                <p class="m-b-4" style="font-size: 13px;"><i class="fas fa-calendar-day"></i> <?php echo $n['event']['date'] ?></p>
                <p class="m-b-4" style="font-size: 13px;"><i class="fas fa-map-marked-alt"></i> <?php echo $n['event']['city'].', '.$n['event']['region'].', '.$n['event']['country'].'.' ?></p>
                <p class="m-b-4" style="font-size: 13px;"><i class="fas fa-map-signs"></i> <?php echo $n['event']['address'] ?></p>
                <?php if ($n['event']['its_free'] == 1) { ?>
                    <p class="m-b-4" style="font-size: 13px;"><i class="fas fa-dollar-sign"></i> ¡Gratis!</p>
                <?php } elseif ($n['event']['its_free'] == 0) { ?>
                    <p class="m-b-4" style="font-size: 13px;"><i class="fas fa-dollar-sign"></i> <?php echo $n['event']['price'] ?></p>
                <?php } ?>
                <div class="d-flex">
                    <?php if (check_like_event($id, $n['event']['id']) == false) { ?>
                        <input type="number" id="tln_<?php echo $n['event']['id'] ?>" value="<?php echo total_likes_event($n['event']['id']) ?>" hidden>
                        <button id="like_event_<?php echo $n['event']['id'] ?>" onclick="like(<?php echo $n['event']['id'] ?>, <?php echo $n['event']['user_id'] ?>);" class="btn-1 m-r-1">
                            <i class="fas fa-heart"></i> <span id="tl_<?php echo $n['event']['id'] ?>"><?php echo total_likes_event($n['event']['id']) ?></span>
                        </button>
                    <?php } elseif (check_like_event($id, $n['event']['id']) == true) { ?>
                        <input type="number" id="tln_<?php echo $n['event']['id'] ?>" value="<?php echo total_likes_event($n['event']['id']) ?>" hidden>
                        <button id="like_event_<?php echo $n['event']['id'] ?>" onclick="like(<?php echo $n['event']['id'] ?>, <?php echo $n['event']['user_id'] ?>);" class="btn-1 m-r-1 liked">
                            <i class="fas fa-heart"></i> <span id="tl_<?php echo $n['event']['id'] ?>"><?php echo total_likes_event($n['event']['id']) ?></span>
                        </button>
                    <?php } ?>
                    <button id="interested_event_<?php echo $n['event']['id'] ?>" onclick="interested(<?php echo $n['event']['id'] ?>);" class="btn-1 m-r-1">Me interesa</button>
                    <button id="assist_event_<?php echo $n['event']['id'] ?>" onclick="assist(<?php echo $n['event']['id'] ?>);" class="btn-1">Asistiré</button>
                </div>
            </div>
            <!-- Comentarios -->
            <a id="comments_btn_<?php echo $n['event']['id'] ?>" class="px-2 py-1 m-b-4 normal-color" onclick="comments(<?php echo $n['event']['id'] ?>);"><i class="fas fa-plus"></i> Comentarios</a>
            <form id="publisher_comment_<?php echo $n['event']['id'] ?>" onsubmit="post_comment(<?php echo $n['event']['id'] ?>, <?php echo $n['event']['user_id'] ?>); return false;" class="d-flex m-b-4 hidden">
                <input id="info_<?php echo $n['event']['id'] ?>" username="<?php echo get_username($id) ?>" hidden>
                <input class="m-r-2" style="width: 100%" type="text" id="comment_text_<?php echo $n['event']['id'] ?>" name="text" placeholder="Escribe un comentario...">
                <button><i class="fas fa-chevron-right"></i></button>
            </form >
            <div id="load-comments_<?php echo $n['event']['id'] ?>" class="hidden"></div>
        </div>
    </div>
</div>