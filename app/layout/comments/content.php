<div id="comment_<?php echo $n['comment']['id'] ?>" class="px-1 py-1 m-b-4 p-relative">
	<div class="d-flex">
		<div class="pp _50 m-r-3" style="background: url(<?php echo get_profile_pic($n['comment']['user_id']) ?>);"></div>
		<div class="d-grid">
			<div class="d-flex m-b-3">
				<a class="m-r-2 normal-color" href='<?php echo $n['site_url'] ?>/account/<?php echo get_username($n['comment']['user_id']) ?>'><?php echo get_username($n['comment']['user_id']) ?> <?php if (check_user_verified($n['comment']['user_id']) == true) { ?><i class="fad fa-badge-check badge-verified-adap"></i> <?php } ?></a>
				<p style="font-size: 13px;"><?php echo mb_strtolower(time_elapsed($n['comment']['time'])) ?></p>
			</div>
			<p class="m-b-2"><?php echo text($n['comment']['text']) ?></p>
			<div class="d-flex m-b-3">
				<p class="normal-color text-bold m-r-2" style="font-size: 12px" onclick="reply(<?php echo $n['comment']['id'] ?>);">Responder</p>
				<?php if ($n['logged_in'] == true && $n['comment']['user_id'] == $id) { ?>
					<span id="del_comment_<?php echo $n['comment']['id'] ?>" class="text-bold" style="font-size: 12px; color: #e74c3c;" onclick="delete_(<?php echo $n['comment']['id'] ?>, 'comment');">Eliminar</span>
				<?php } ?>
			</div>
		</div>
		<div class="d-flex p-absolute" style="right: 7px;">
			<span id="like_comment_<?php echo $n['comment']['id'] ?>" onclick="like_comment(<?php echo $n['comment']['id'] ?>, <?php echo $n['comment']['user_id'] ?>);"><i id="iconc_<?php echo $n['comment']['id'] ?>" class="far fa-heart"></i></span>
		</div>
	</div>
	<div id="reply_comment_<?php echo $n['comment']['id'] ?>" class="hidden" style="padding-left: 50px;">
		<?php include 'reply-box.php'; ?>
		<div id="load_replies_<?php echo $n['comment']['id'] ?>" status="notLoad"></div>
	</div>
</div>