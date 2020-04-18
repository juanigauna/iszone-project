<?php
$view = '';
$comment_id = '';
if (isset($_GET['view'])) {
    $view = $_GET['view'];
}
if (isset($_GET['comment_id'])) {
    $comment_id = $_GET['comment_id'];
}
$images = explode(', ', $n['post']['img']);
?>
<div id="post_<?php echo $n['post']['id'] ?>" class="content-post m-b-5">
	<div class="d-flex p-relative pc-1 m-b-3">
        <?php if ($n['post']['secret'] == 0) { ?>
            <div class="pp _45 m-r-5" style="background: url('<?php echo get_profile_pic($n['post']['user_id']) ?>'); "></div>
        <?php } elseif ($n['post']['secret'] == 1) { ?>
            <div class="pp _45 m-r-5" style="background: url('<?php echo $n['site_url'].'/uploads/pp/default.png' ?>'); "></div>
        <?php } ?>
		<div class="d-grid">
             <div class="d-flex">
             	<?php if ($n['post']['secret'] == 0) { ?>
                    <a class="m-r-3" style="color: #616161" href="<?php echo $n['site_url'].'/account/'.get_username($n['post']['user_id']) ?>"><?php echo get_username($n['post']['user_id']) ?> <?php if (check_user_verified($n['post']['user_id']) == true) { ?><i class="fad fa-badge-check badge-verified-adap"></i> <?php } ?></a>
                <?php } elseif ($n['post']['secret'] == 1) { ?>
                    <a class="m-r-3" style="color: #616161; cursor: pointer;">Anónimo</a>
                <?php } ?>
             	<?php if ($n['post']['img']) { ?>
             		<?php if (count($images) >= 2) { ?>
                        <p class="normal-color">Subió <?php echo count($images) ?> fotos</p>
                    <?php } elseif (count($images) == 1) { ?>
                        <p class="normal-color">Subió una foto</p>
                    <?php } ?>
             	<?php } ?>
            </div>
            <?php if ($n['post']['location_id'] != 0) { ?>
                <p class="page-color text-bold" style="font-size: 13px"><i class="fas fa-map-marker-alt"></i> <?php echo get_location_name($n['post']['location_id']) ?></p>
            <?php } ?>
            <p style="font-size: 13px"><?php echo time_elapsed($n['post']['time']) ?></p>
		</div>
        <span class="p-absolute normal-color" style="right: 6px;" onclick="menu_post(<?php echo $n['post']['id'] ?>);"><i class="fas fa-ellipsis-h"></i></span>
        <div id="menu_post_<?php echo $n['post']['id'] ?>" class="hidden">
            <div class="p-absolute d-grid p-t-3 p-l-3 p-r-3 p-b-3" style="background: #fff; border: 1px solid #f5f5f5; right: 35px; top: 20px; border-radius: 5px">
                <a id="d-btn" class="normal-color m-b-3" style="font-size: 12px" href="<?php echo $n['site_url'] ?>/post/<?php echo $n['post']['id'] ?>" target="_blank"><i class="fas fa-external-link-alt"></i>Abrir publicación</a>
                <?php if ($n['logged_in'] == true && $id == $n['post']['user_id']) { ?>
                    <a onclick="delete_post(<?php echo $n['post']['id'] ?>);" id="d-btn_<?php echo $n['post']['id'] ?>" style="color: #e74c3c; font-size: 12px"><i class="fas fa-trash"></i> Borrar</a>
                <?php } ?>
            </div>
        </div>
	</div>
	<?php if ($n['post']['text']) { ?>
		<div id="text_post_<?php echo $n['post']['id'] ?>" class="pc-1 m-b-3">
			<p><?php echo text($n['post']['text']) ?></p>
		</div>
	<?php } ?>
	<?php if ($n['post']['img']) { ?>
		<div class="d-flex" style="background: #f5f5f5; overflow-x: auto;">
			<?php
            $num = 0;
            foreach ($images as $key => $img) { $num++ ?>
                <img class="w-full" src="<?php echo $n['site_url'].'/'.$img ?>">
            <?php } ?>
		</div>
	<?php } ?>
	<div class="d-flex">
        <?php if (check_like_post($id, $n['post']['id']) == false) { ?>
            <input type="number" id="tln_<?php echo $n['post']['id'] ?>" value="<?php echo total_likes_post($n['post']['id']) ?>" hidden>
            <button class="btn-action-post m-r-2" id="like_post_<?php echo $n['post']['id'] ?>" onclick="like(<?php echo $n['post']['id'] ?>, <?php echo $n['post']['user_id'] ?>);">
                <i id="icon_<?php echo $n['post']['id'] ?>" class="far fa-heart m-r-2"></i> <span id="tl_<?php echo $n['post']['id'] ?>"><?php echo total_likes_post($n['post']['id']) ?></span>
            </button>
        <?php } elseif (check_like_post($id, $n['post']['id']) == true) { ?>
            <input type="number" id="tln_<?php echo $n['post']['id'] ?>" value="<?php echo total_likes_post($n['post']['id']) ?>" hidden>
            <button class="btn-action-post m-r-2 liked" id="like_post_<?php echo $n['post']['id'] ?>" onclick="like(<?php echo $n['post']['id'] ?>, <?php echo $n['post']['user_id'] ?>);">
                <i id="icon_<?php echo $n['post']['id'] ?>" class="fas fa-heart m-r-2"></i> <span id="tl_<?php echo $n['post']['id'] ?>"><?php echo total_likes_post($n['post']['id']) ?></span>
            </button>
        <?php } ?>
        <button onclick="show_comments(<?php echo $n['post']['id'] ?>);" class="btn-action-post"><i class="far fa-comment"></i> Comentar</button>
    </div>
    <?php include 'comments.php'; ?>
</div>