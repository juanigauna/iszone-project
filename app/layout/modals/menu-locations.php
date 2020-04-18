<div id="menu-loc" class="menu-loc p-fixed hidden-menu-right">
    <span onclick="menu_location();" class="p-absolute text-bold px-3 py-1" style="background: #fff; color: #575fcf; top: 50%; right: 0; padding: 12px 8px 12px 16px; border-radius: 50px 0px 0px 50px; font-size: 18px; box-shadow: 0 1px 8px #2c3e50;"><i class="fas fa-chevron-right"></i></span>
    <div class="m-t-3" style="height: 100%; overflow: auto;">
        <?php if ($n['user_city'] && $n['user_regionName'] && $n['user_countryName']) { ?>
            <?php if ($n['user']['city'] != $n['user_city'] || $n['user']['region'] != $n['user_regionName'] || $n['user']['country'] != $n['user_countryName']) { ?>
                <div class="mx-2 my-2 px-3 py-3 m-b-5" style="background: #fff; border-radius: 10px;">
                    <h3>¿Qué tal todo por ahí?</h3>
                    <p>¡Actualiza tu ub. para más publicaciones!</p>
                    <a id="update_location" onclick="update_location();" href="#update">Actualizar a <?php echo $n['user_location'] ?></a>
                </div>
            <?php } ?>
        <?php } ?>
        <div class="mx-2 my-2 px-3 py-3 m-b-5" style="background: #fff; border-radius: 10px;">
            <h4 class="m-b-3">Buscar</h4>
            <form class="d-grid" id="search_location">
                <div class="d-flex">
                    <input id="city" class="m-r-2" style="width: 100%" onkeyup="search_location('result_search');" type="text" name="city" placeholder="Ciudad">
                    <input id="region" class="m-r-2" style="width: 100%" onkeyup="search_location('result_search');" type="text" name="region" placeholder="Región">
                    <input id="country" type="text" style="width: 100%" onkeyup="search_location('result_search');" name="country" placeholder="País">
                </div>
            </form>
            <div id="result_search" class="m-b-4 hidden">
                
            </div>
        </div>
        <div class="mx-2 my-2 px-3 py-3 m-b-5" style="background: #fff; border-radius: 10px;">
            <h4 class="m-b-3">Tus ubicaciones</h4>
            <div id="load-locations"><p class="page-color"><i class="spinner fad fa-spinner-third"></i> Cargando</p></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    setTimeout(function() {
        ajax({
            type: 'POST',
            url: site_url() + '?f=load_locations',
            success: function(res) {
                document.querySelector('#load-locations').innerHTML = res;
            }
        })
    }, 2000)
</script>