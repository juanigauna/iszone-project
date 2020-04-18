<div class="mx-1 m-t-8 m-b-10">
    <?php if (!$n['user']['city'] || !$n['user']['region'] || !$n['user']['country']) { ?>
        <h3 class="m-b-5">Al parecer no sabemos dondes estás :(</h3>
        <h4 class="m-b-5">Especifica bien tu ubicación</h4>
        <form id="upd_location">
            <div class="d-grid">
                <label class="m-b-5 label-e">Ubicación</label>
                <div class="d-flex m-b-5">
                    <input class="m-r-2" id="city_home" onkeyup="search_location('home');" type="text" autocomplete="off" style="width: 100%;" name="city" value="<?php echo $n['user']['city'] ?>" placeholder="Ciudad">
                    <input class="m-r-2" id="region_home" onkeyup="search_location('home');" type="text" autocomplete="off" style="width: 100%;" name="region" value="<?php echo $n['user']['region'] ?>" placeholder="Region">
                    <input type="text" id="country_home" onkeyup="search_location('home');" autocomplete="off" style="width: 100%;" name="country" value="<?php echo $n['user']['country'] ?>" placeholder="País">
                </div>
                <div class="m-b-4 hidden" id="result_home" style="background: #f5f5f5; padding: 7px 10px; border: 1px solid #ddd; border-radius: 6px;"></div>
                <button class="m-b-4" id="loader">Cambiar</button>
            </div>
        </form>
        <div id="res_form"></div>
    <?php } elseif ($n['user']['city'] && $n['user']['region'] && $n['user']['country']) { ?>
        <?php include 'people_you_may_know.php' ?>
        <?php include 'publisher-box.php'; ?>
        <p id="online"></p>
        <div class="d-flex p-relative m-b-5">
            <h4 class="m-r-2">Publicaciones</h4>
            <span class="page-color" style="font-size: 13px">Seguidores <i class="fas fa-chevron-down"></i></span>
        </div>
        <div id="content-posts">
            <p class="page-color"><i class="spinner fad fa-spinner-third"></i> Cargando</p>
        </div>
    <?php } ?>
</div>
<?php if ($n['user']['city'] && $n['user']['region'] && $n['user']['country']) { ?>
    <script type="text/javascript">
        setTimeout(function() {
            ajax({
                type: 'POST',
                url: site_url() + '?f=load_posts',
                success: function (res) {
                    document.querySelector('#content-posts').innerHTML = res;
                }
            })
        }, 3000);
    </script>
<?php } ?>