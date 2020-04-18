<div class="d-grid">
	<div class="d-flex m-b-2">
		<div class="pp _50 m-r-3" style="background: url(<?php echo get_profile_pic($id) ?>); border-radius: 5px "></div>
		<p class='text-bold'><?php echo $n['location']['city'].', '.$n['location']['region'].', '.$n['location']['country'].'.' ?></p>
	</div>

	<div class="d-flex">
		<a class="text-bold m-b-3" style="font-size: 13px" href="#population"><i class="fas fa-users"></i> <?php echo $n['location']['population'] ?></a>
	</div>
</div>