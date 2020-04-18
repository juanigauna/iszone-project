<div class="m-b-4 d-grid">
    <a class="m-b-2" href="#"><?php echo $n['location']['city'].', '.$n['location']['region'].', '.$n['location']['country'].'.' ?></a>
    <div class="d-flex">
        <p class="text-bold m-r-4" style="font-size: 12px"><?php echo time_elapsed($n['location']['last_mod']) ?></p>
        <?php if (get_location($id) != $n['location']['city'].', '.$n['location']['region'].', '.$n['location']['country'].'.') { ?>
        	<a id="update_loc_<?php echo $n['location']['id'] ?>" onclick="updateLocation(<?php echo $n['location']['id'] ?>);" href="#update_location" class="text-bold m-r-4" style="font-size: 12px">Actualizar ubicación</a>
        <?php } ?>
        <?php if ($n['location']['city'].', '.$n['location']['region'].', '.$n['location']['country'].'.' == $n['user_location']) { ?>
        	<a class="text-bold m-r-4" style="font-size: 12px" href="#actual_location">Ub. actual</a>
        <?php } ?>
        <?php if (get_location($id) == $n['location']['city'].', '.$n['location']['region'].', '.$n['location']['country'].'.') { ?>
        	<a class="text-bold m-r-4" style="font-size: 12px" href="#default">Ub. Predeterminada</a>
        <?php } ?>
    </div>
</div>