<div id="not_<?php echo $n['notification']['id'] ?>" class="content-not" <?php if ($n['notification']['seen'] == 0) { ?> style="background: #f1f1f1 !important;" <?php } ?>>
	<?php if ($n['notification']['type'] == 1) { ?>
		<!-- Notificación para comentarios en los perfiles -->
		<div class="d-flex m-b-4">
			<div class="pp _50 m-r-3" style="background: url(<?php echo get_profile_pic($n['notification']['user_id']) ?>);"></div>
			<div class="d-grid">
				<p><a class="normal-color" href="<?php echo $n['site_url'] ?>/account/<?php echo get_username($n['notification']['user_id']) ?>"><?php echo get_username($n['notification']['user_id']) ?> <?php if (check_user_verified($n['notification']['user_id']) == true) { ?><i class="fad fa-badge-check badge-verified-adap"></i> <?php } ?></a> comentó tu <a class="normal-color" href="<?php echo $n['site_url'] ?>/account/<?php echo get_username($n['notification']['account_id']) ?>">cuenta.</a></p>
				<p style="font-size: 13px"><?php echo time_elapsed($n['notification']['time']) ?></p>
			</div>
		</div>
		<?php 
		$comment_id = $n['notification']['ref_id'];
		$n['comment'] = fetch_array("SELECT * FROM comments WHERE id = '$comment_id'");
		?>
		<div class="d-flex">
			<p>"<a class="normal-color" href="<?php echo $n['site_url'] ?>/account/<?php echo get_username($n['comment']['user_id']) ?>"><?php echo get_username($n['comment']['user_id']) ?> <?php if (check_user_verified($n['notification']['user_id']) == true) { ?><i class="fad fa-badge-check badge-verified-adap"></i> <?php } ?></a> <?php echo $n['comment']['text'] ?>".</p>
		</div>
	<?php } elseif ($n['notification']['type'] == 2) { ?>
		<div class="d-flex">
			<div class="pp _50 m-r-3" style="background: url(<?php echo get_profile_pic($n['notification']['user_id']) ?>);"></div>
			<div class="d-grid">
				<p><a class="normal-color" href="<?php echo $n['site_url'] ?>/account/<?php echo get_username($n['notification']['user_id']) ?>"><?php echo get_username($n['notification']['user_id']) ?> <?php if (check_user_verified($n['notification']['user_id']) == true) { ?><i class="fad fa-badge-check badge-verified-adap"></i> <?php } ?></a> comenzó a seguirte.</p>
				<p style="font-size: 13px"><?php echo time_elapsed($n['notification']['time']) ?></p>
			</div>
		</div>
	<?php } elseif ($n['notification']['type'] == 3) { ?>
		<div class="d-flex">
			<div class="pp _50 m-r-3" style="background: url(<?php echo get_profile_pic($n['notification']['user_id']) ?>);"></div>
			<div class="d-grid">
				<p><a class="normal-color" href="<?php echo $n['site_url'] ?>/account/<?php echo get_username($n['notification']['user_id']) ?>"><?php echo get_username($n['notification']['user_id']) ?> <?php if (check_user_verified($n['notification']['user_id']) == true) { ?><i class="fad fa-badge-check badge-verified-adap"></i> <?php } ?></a> le gustó tu <a class="normal-color" href="<?php echo $n['site_url'].'/post/'.$n['notification']['ref_id'] ?>">publicación</a>.</p>
				<p style="font-size: 13px"><?php echo time_elapsed($n['notification']['time']) ?></p>
			</div>
		</div>
	<?php } elseif ($n['notification']['type'] == 4) { ?>
		<div class="d-flex">
			<div class="pp _50 m-r-3" style="background: url(<?php echo get_profile_pic($n['notification']['user_id']) ?>);"></div>
			<div class="d-grid">
				<p><a class="normal-color" href="<?php echo $n['site_url'] ?>/account/<?php echo get_username($n['notification']['user_id']) ?>"><?php echo get_username($n['notification']['user_id']) ?> <?php if (check_user_verified($n['notification']['user_id']) == true) { ?><i class="fad fa-badge-check badge-verified-adap"></i> <?php } ?></a> comentó tu <a class="normal-color" href="<?php echo $n['site_url'].'/post/'.$n['notification']['post_id'] ?>?view=comment&comment_id=<?php echo $n['notification']['ref_id'] ?>">publicación</a>.</p>
				<p style="font-size: 13px"><?php echo time_elapsed($n['notification']['time']) ?></p>
			</div>
		</div>
	<?php } elseif ($n['notification']['type'] == 5) { ?>
		<?php 
		$comment_id = $n['notification']['comment_id'];
		$n['comment'] = fetch_array("SELECT * FROM comments WHERE id = '$comment_id'");
		?>
		<div class="d-flex m-b-4">
			<div class="pp _50 m-r-3" style="background: url(<?php echo get_profile_pic($n['notification']['user_id']) ?>);"></div>
			<div class="d-grid">
				<p><a class="normal-color" href="<?php echo $n['site_url'] ?>/account/<?php echo get_username($n['notification']['user_id']) ?>"><?php echo get_username($n['notification']['user_id']) ?> <?php if (check_user_verified($n['notification']['user_id']) == true) { ?><i class="fad fa-badge-check badge-verified-adap"></i> <?php } ?></a></p>
				<p>respondió tu <a class="normal-color" href="#comment">comentario</a>: <?php echo $n['comment']['text'] ?></p>
				<p style="font-size: 13px"><?php echo time_elapsed($n['notification']['time']) ?></p>
			</div>
		</div>
		<?php 
		$reply_id = $n['notification']['ref_id'];
		$n['reply'] = fetch_array("SELECT * FROM replies WHERE id = '$reply_id'");
		?>
		<div class="d-flex">
			<p><a class="normal-color" href="<?php echo $n['site_url'] ?>/account/<?php echo get_username($n['reply']['user_id']) ?>"><?php echo get_username($n['reply']['user_id']) ?> <?php if (check_user_verified($n['notification']['user_id']) == true) { ?><i class="fad fa-badge-check badge-verified-adap"></i> <?php } ?></a> <?php echo $n['reply']['text'] ?></p>
		</div>
	<?php } elseif ($n['notification']['type'] == 6) { ?>
		<?php 
		$comment_id = $n['notification']['ref_id'];
		$n['comment'] = fetch_array("SELECT * FROM comments WHERE id = '$comment_id'");
		?>
		<div class="d-flex">
			<div class="pp _50 m-r-3" style="background: url(<?php echo get_profile_pic($n['notification']['user_id']) ?>);"></div>
			<div class="d-grid">
				<p><a class="normal-color" href="<?php echo $n['site_url'] ?>/account/<?php echo get_username($n['notification']['user_id']) ?>"><?php echo get_username($n['notification']['user_id']) ?> <?php if (check_user_verified($n['notification']['user_id']) == true) { ?><i class="fad fa-badge-check badge-verified-adap"></i> <?php } ?></a></p>
				<p>Le gustó tu <a class="normal-color" href="#comment">comentario</a>: <?php echo $n['comment']['text'] ?></p>
				<p style="font-size: 13px"><?php echo time_elapsed($n['notification']['time']) ?></p>
			</div>
		</div>
	<?php } elseif ($n['notification']['type'] == 7) { ?>
		<?php 
		$reply_id = $n['notification']['ref_id'];
		$n['reply'] = fetch_array("SELECT * FROM replies WHERE id = '$reply_id'");
		?>
		<div class="d-flex">
			<div class="pp _50 m-r-3" style="background: url(<?php echo get_profile_pic($n['notification']['user_id']) ?>);"></div>
			<div class="d-grid">
				<p><a class="normal-color" href="<?php echo $n['site_url'] ?>/account/<?php echo get_username($n['notification']['user_id']) ?>"><?php echo get_username($n['notification']['user_id']) ?> <?php if (check_user_verified($n['notification']['user_id']) == true) { ?><i class="fad fa-badge-check badge-verified-adap"></i> <?php } ?></a></p>
				<p>Le gustó tu <a class="normal-color" href="#reply">respuesta</a>: <?php echo $n['reply']['text'] ?></p>
				<p style="font-size: 13px"><?php echo time_elapsed($n['notification']['time']) ?></p>
			</div>
		</div>
	<?php } ?>
</div>