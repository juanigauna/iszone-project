<div id="bg-menu" class="bg-menu p-fixed hidden-bg-menu">
	<div id="menu" class="menu-nav p-fixed hidden-menu">
		<span onclick="menu();" class="btn-close p-absolute text-bold px-3 py-1"><i class="fas fa-times"></i></span>
		<?php if ($n['logged_in'] == true) { ?>
			<div class="m-b-6 py-2 px-2" style="background: #f5f5f5">
				<div id="profile_pic" class="pp _120" style="background: url('<?php echo $n['site_url'].'/'.$n['user']['profile_pic'] ?>'); margin: 0 auto;">
					<form id="form_change_pic" style="margin: 0 auto;">
						<label class="px-3 py-2 text-bold" style="font-size: 14px; background: #0009; border-radius: 50px; color: #fff;" for="change_pic"><i class="fas fa-camera"></i> Cambiar</label>
						<input type="file" name="picture" id="change_pic" accept="image/*" hidden>
					</form>
				</div>
				<div id="btn-change" class="m-t-2 text-center hidden">
					<button class="btn-change" id="change_pic_btn"><span id="loader_menu">Cambiar</span></button>
				</div>
				<div class="m-b-2"></div>
				<p class="m-b-5 text-1 text-bold text-center" style="font-size: 23px"><?php echo $n['user']['username'] ?> <?php if ($n['user']['verified'] == 1) { ?><i class="fad fa-badge-check badge-verified"></i> <?php } ?></p>
				<div class="d-flex">
					<div class="d-grid m-r-4" style="width: 100%; text-align: center; background: #f5f5f5; padding: 4px; border-radius: 5px; border: 1px solid #ddd">
						<p class="text-bold">Seguidores</p>
						<p><?php echo total_followers($id); ?></p>
					</div>
					<div class="d-grid" style="width: 100%; text-align: center; background: #f5f5f5; padding: 4px; border-radius: 5px; border: 1px solid #ddd">
						<p class="text-bold">Seguidos</p>
						<p><?php echo total_followed($id); ?></p>
					</div>
				</div>
			</div>
		<?php } ?>
		<div class="d-grid py-2 px-2">
			<?php if ($n['logged_in'] == true) { ?>
				<a class="text-1 text-bold m-b-4 py-2 px-3" href="<?php echo $n['site_url'] ?>/account/<?php echo get_username($id) ?>"><i class="fas fa-user"></i> Mi perfil</a>
				<a class="text-1 text-bold m-b-4 py-2 px-3" href="<?php echo $n['site_url'] ?>/home"><i class="fas fa-home"></i> Inicio</a>
				<a class="text-1 text-bold m-b-4 py-2 px-3" href="#"><i class="fas fa-users"></i> Seguidores</a>
				<a class="text-1 text-bold m-b-4 py-2 px-3" href="<?php echo $n['site_url'] ?>/terms-and-conditions"><i class="fas fa-journal-whills"></i> Términos y condiciones</a>
				<a class="text-1 text-bold m-b-4 py-2 px-3" onclick="logout();" style="color: #e74c3c;"><i class="fas fa-sign-out-alt"></i> Salir</a>
			<?php } else { ?>
				<div class="m-t-8">
					<a class="text-1 text-bold m-b-4 py-2 px-3" href="<?php echo $n['site_url'] ?>/terms-and-conditions"><i class="fas fa-journal-whills"></i> Términos y condiciones</a>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php if ($n['logged_in'] == true) { ?>
	<script type="text/javascript">
	function readImage (input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
		  	reader.onload = function (e) {
		    	document.querySelector('#profile_pic').setAttribute('style', "background: url(" + e.target.result + "); margin: 0 auto; width: 100%");
		  	}
		  	reader.readAsDataURL(input.files[0]);
		}
	}
	document.querySelector("#change_pic").addEventListener('change', function (e) {
		readImage(this);
		var btn = document.querySelector('#btn-change').className;
		if (btn == "m-t-2 text-center hidden") {
			document.querySelector('#btn-change').className = "m-t-2 text-center";
		}
	})
	</script>
<?php } ?>