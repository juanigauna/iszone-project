<div class="header px-2 py-2 <?php if ($link == "welcome" || $link == "new-account" || $link == "recover-password") { ?> box-shadow-none <?php } ?>">
    <div class="d-flex p-relative">
        <div>
            <span onclick="menu();" class="m-l-2 m-r-6 white-color" style="font-size: 24px;"><i class="fas fa-bars"></i></span>
	        <?php if ($n['logged_in'] == true) { ?>
	        	<a class="white-color p-relative m-r-6" style="font-size: 24px;" href="<?php echo $n['site_url'] ?>/notifications"><i class="fas fa-bell"></i>
	        	<?php if (total_notifications($id) > 0) { ?>
                    <sup id="not_num" class="alert-not"><?php echo total_notifications($id) ?></sup>
                <?php } elseif (total_notifications($id) == 0) { ?>
                    <sup id="not_num" class="hidden"></sup>
                <?php } ?>
                </a>
                <span class="white-color" style="font-size: 24px;" onclick="menu_location();"><i class="fas fa-map-marker-alt"></i></span>
	        <?php } ?>
        </div>
        <div class="wel_logo p-absolute" style="right: 0;">
            <a class="white-color bold-none" href="<?php echo $n['site_url'] ?>"><?php echo $n['site_title'] ?></a>
        </div>
    </div>
</div>