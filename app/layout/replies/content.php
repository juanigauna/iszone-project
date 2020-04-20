<div id="reply_<?php echo $n['reply']['id'] ?>" class="px-1 py-1 m-b-4 p-relative">
	<div class="d-flex">
		<div class="pp _35 m-r-3" style="background: url(<?php echo get_profile_pic($n['reply']['user_id']) ?>);"></div>
		<div class="d-grid">
			<div class="d-flex m-b-3">
				<a class="m-r-2 normal-color" href='<?php echo $n['site_url'] ?>/account/<?php echo get_username($n['reply']['user_id']) ?>'><?php echo get_username($n['reply']['user_id']) ?> <?php if (check_user_verified($n['reply']['user_id']) == true) { ?><i class="fad fa-badge-check badge-verified-adap"></i> <?php } ?></a>
				<p style="font-size: 13px;"><?php echo mb_strtolower(time_elapsed($n['reply']['time'])) ?></p>
			</div>
			<p class="m-b-2"><?php echo text($n['reply']['text']) ?></p>
			<div class="d-flex m-b-3">
				<?php if ($n['logged_in'] == true && $n['reply']['user_id'] == $id) { ?>
					<span id="del_reply_<?php echo $n['reply']['id'] ?>" class="text-bold" style="font-size: 12px; color: #e74c3c;" onclick="delete_(<?php echo $n['reply']['id'] ?>, 'reply');">Eliminar</span>
				<?php } ?>
			</div>
		</div>
		<div class="d-flex p-absolute" style="right: 7px;">
			<?php if (check_like($id, $n['reply']['id'], "reply") == false) { ?>
				<span id="like_reply_<?php echo $n['reply']['id'] ?>" onclick="like_reply(<?php echo $n['reply']['id'] ?>, <?php echo $n['reply']['user_id'] ?>);"><i id="iconr_<?php echo $n['reply']['id'] ?>" class="far fa-heart"></i></span>
			<?php } elseif (check_like($id, $n['reply']['id'], "reply") == true) { ?>
				<span id="like_reply_<?php echo $n['reply']['id'] ?>" class="liked" onclick="like_reply(<?php echo $n['reply']['id'] ?>, <?php echo $n['reply']['user_id'] ?>);"><i id="iconr_<?php echo $n['reply']['id'] ?>" class="fas fa-heart"></i></span>
			<?php } ?>
		</div>
	</div>
</div>