<div class="px-2 py-2 m-b-5">
    <p class="m-b-3 label-e">Tal vez conozcas a</p>
    <!--<hr class="m-b-3">-->
    <div id="pymk" style="overflow-y: hidden;overflow-x: visible;" class="d-flex">
        <?php 
            $n['user'] = user(get_username($id));
            $city = $n['user']['city'];
            $region = $n['user']['region'];
            $country = $n['user']['country'];
            $query = mysqli_query($con, "SELECT * FROM users WHERE city = '$city' AND region = '$region' AND country = '$country' ORDER BY RAND()");
            while ($q=mysqli_fetch_array($query)) {
        ?>
            <?php if (get_username($id) != get_username($q['id'])) { ?>
                <div class="d-grid m-r-3 content-preview-user">
                    <div class="pymk p-relative <?php if (timeElapsed($q['last_seen']) < 5) { ?> status_con <?php } ?>" style="background-image: url('<?php echo $n['site_url'].'/'.$q['profile_pic'] ?>');">
                        <?php if (timeElapsed($q['last_seen']) < 5) { ?>
                            <span class="p-absolute online-circle-min"><i class="fad fa-circle"></i></span>
                        <?php } ?>
                    </div>
                    <a href="<?php echo $n['site_url'] ?>/account/<?php echo get_username($q['id']) ?>" class="label-e"><?php echo get_username($q['id']) ?> <?php if (check_user_verified($q['id']) == true) { ?><i class="fad fa-badge-check badge-verified-adap"></i> <?php } ?></a>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>