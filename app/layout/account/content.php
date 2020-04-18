<?php 
$account_id = $n['account']['id'];
$q = mysqli_query($con, "SELECT * FROM comments WHERE account_id = '$account_id'");
$row = $q->num_rows;
$qe = mysqli_query($con, "SELECT * FROM posts WHERE user_id = '$account_id'");
$rowe = $qe->num_rows;
?>
<div class="mx-5 m-t-8">
	<div>
		<div id="profile_pic_acc" class="pp _150 <?php if (timeElapsed($n['account']['last_seen']) < 5) { ?> status_con <?php } ?>" style="background: url('<?php echo $n['site_url'].'/'.$n['account']['profile_pic'] ?>'); margin: 0 auto; width: 100%;">
			<?php if ($n['logged_in'] == true && timeElapsed($n['account']['last_seen']) < 5) { ?>
				<span class="p-absolute online-circle"><i class="fad fa-circle"></i></span>
			<?php  } ?>
			<?php if ($n['logged_in'] == true && $n['account']['id'] == $n['user']['id']) { ?>
				<form id="form_change_pic_acc" style="margin: 0 auto;">
					<label class="px-3 py-2 text-bold white-color" style="font-size: 14px; background: #0009; border-radius: 50px;" for="change_pic_acc"><i class="fas fa-camera"></i> Cambiar</label>
					<input type="file" name="picture" id="change_pic_acc" accept="image/*" hidden>
				</form>
			<?php } ?>
		</div>
		<?php if ($n['logged_in'] == true && $n['account']['id'] == $n['user']['id']) { ?>
			<div id="btn-change-acc" class="m-t-2 text-center hidden">
				<button class="btn-change" id="change_pic_btn_acc"><span id="loader-acc">Cambiar</span></button>
			</div>
		<?php } ?>
		<div class="m-b-4"></div>
		<h3 class="m-b-5" style="text-align: center; font-size: 25px;"><?php echo $n['account']['username'] ?> <?php if ($n['account']['verified'] == 1) { ?><i class="fad fa-badge-check badge-verified-adap"></i> <?php } ?></h3>
		<div class="d-flex m-b-5">
			<div class="d-grid m-r-4" style="width: 100%; text-align: center; background: #f9f9f9; padding: 4px; border-radius: 5px; border: 1px solid #f5f5f5;">
				<p class="text-bold">Seguidores</p>
				<p><?php echo total_followers($n['account']['id']); ?></p>
			</div>
			<div class="d-grid" style="width: 100%; text-align: center; background: #f9f9f9; padding: 4px; border-radius: 5px; border: 1px solid #f5f5f5;">
				<p class="text-bold">Seguidos</p>
				<p><?php echo total_followed($n['account']['id']); ?></p>
			</div>
		</div>
		<div class="m-b-5" style="background: #f9f9f9; border: 1px solid #f5f5f5;">
			<div class="tb-d normal-color" style="padding: 12px 10px; background: #f3f3f3; font-size: 13px;">
    			<i class="far fa-info-circle"></i> Biografía
			</div>
			<div class="px-3 py-2">
				<?php if ($n['account']['biography']) { ?>
					<p class="m-b-4" style="font-size: 13px"><?php echo text($n['account']['biography']) ?></p>
				<?php } ?>
				<p class="m-b-3" style="font-size: 13px"><i class="fas fa-map-marker-alt"></i> <?php echo $n['account']['city'].', '.$n['account']['region'].', '.$n['account']['country'].'.' ?></p>
				<?php if ($n['account']['gender'] == 0) { ?>
					<p class="m-b-3 " style="font-size: 13px"><i class="fas fa-mars"></i> Hombre</p>
				<?php } elseif ($n['account']['gender'] == 1) { ?>
					<p class="m-b-3" style="font-size: 13px"><i class="fas fa-venus"></i> Mujer</p>
				<?php } ?>
				<p class="m-b-3" style="font-size: 13px"><i class="far fa-calendar-alt"></i> Publicaciones <?php echo $rowe ?></p>
				<?php if (timeElapsed($n['account']['last_seen']) < 5) { ?>
					<p class="m-b-3" style="font-size: 13px; color: #2ecc71"><i class="fad fa-circle"></i> Conectado</p>
				<?php } elseif (timeElapsed($n['account']['last_seen']) > 5) { ?>
					<p class="m-b-3" style="font-size: 13px"><i class="far fa-eye"></i> Últ. vez visto <span class="text-bold"><?php echo mb_strtolower(time_elapsed($n['account']['last_seen']), 'UTF-8') ?></span></p>
				<?php } ?>
				<?php if ($n['logged_in'] == true && $n['account']['id'] == $id) { ?>
					<a style="font-size: 13px" href="<?php echo $n['site_url'] ?>/edit/account"><i class="fas fa-pen"></i> Editar</a>
				<?php } ?>
				<?php if ($n['logged_in'] == true && $n['account']['id'] != $id) { ?>
					<?php if ($n['logged_in'] == true && check_follow($n['account']['id']) == false) { ?>
						<div class="d-flex">
							<a style="font-size: 13px;" follower-id="<?php echo $n['account']['id'] ?>" id="btn-follow" class="unfollow"><i class="fas fa-plus"></i> Seguir</a>
							<?php if (check_friend($n['user']['id'], $n['account']['id']) == true) { ?>
								<p class="m-l-3" style="font-size: 13px;">Te sigue</p>
							<?php } ?>
						</div>
					<?php } elseif ($n['logged_in'] == true && check_follow($n['account']['id']) == true) { ?>
						<a style="font-size: 13px;" follower-id="<?php echo $n['account']['id'] ?>" id="btn-follow" class="follow"><i class="fas fa-check"></i> Siguiendo</a>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
		<div id="posts_profile">
			
		</div>
		<!-- Comentarios -->
		<h4 class="m-b-4"><i class="fas fa-comment"></i> Comentarios <span id="total_comments"><?php echo $row ?></span></h4>
		<input type="number" id="tc" value="<?php echo $row ?>" hidden>
		<div id="profile-content">
			<div class="pc-1" id="content-comments" style="max-height: 200px; overflow: auto;">
				<p class="label-e"><i class="spinner fas fa-spinner"></i> Cargando</p>
			</div>
			<!-- Publisher box de comentarios al perfil -->
			<?php if ($n['logged_in'] == true) { ?>
				<div id="publisher-box_comment">
					<!-- Formulario -->
					<form id="new-comment" username="<?php echo $n['user']['username'] ?>" class="d-grid">
						<div class="d-flex">
							<div class="pp _45 m-r-2" style="background: url(<?php echo get_profile_pic($id) ?>);"></div>
							<input id="comment" class="m-r-2 w-full" name="text" type="text" autocomplete="off" placeholder="Escribe un comentario...">
							<input type="number" name="account_id" value="<?php echo $n['account']['id'] ?>" hidden>
							<button id="btn_comment"><i class="fas fa-chevron-right"></i></button>
						</div>
						<div id="result"></div>
					</form>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	setTimeout(function() {
		ajax({
			type: 'POST',
			url: site_url() + '?f=load_comments&o=account&account_id=<?php echo $n['account']['id'] ?>',
			success: function(res) {
				document.querySelector('#content-comments').innerHTML = res;
				document.querySelector('#content-comments').scrollTo(0, document.querySelector('#content-comments').scrollHeight);
			}
		})
	}, 2000)
	setTimeout(function() {
		ajax({
			type: 'POST',
			url: site_url() + '?f=load_posts_profile&user_id=<?php echo $n['account']['id'] ?>',
			success: function(res) {
				document.querySelector('#posts_profile').innerHTML = res;
			}
		})
	}, 500)
</script>
<?php if ($n['logged_in'] == true && $id == $n['account']['id']) { ?>
	<script type="text/javascript">
		function readImage_acc (input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
			  	reader.onload = function (e) {
			    	document.querySelector('#profile_pic_acc').setAttribute('style', "background: url(" + e.target.result + "); margin: 0 auto; width: 100%");
			  	}
			  	reader.readAsDataURL(input.files[0]);
			}
		}
		document.querySelector("#change_pic_acc").addEventListener('change', function () {
			readImage_acc(this);
			var btn = document.querySelector('#btn-change-acc').className;
			if (btn == "m-t-2 text-center hidden") {
				document.querySelector('#btn-change-acc').className = "m-t-2 text-center";
			}
		})
	</script>
<?php } ?>