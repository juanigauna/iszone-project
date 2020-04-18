<div class="mx-5 m-t-8">
    <h2 class="m-b-7">Crear evento</h2>
    <form id="new-event">
        <div class="d-grid">
            <label class="m-b-4 label-e" for="event_name">Nombre del evento</label>
            <input class="m-b-4" id="event_name" type="text" name="event_name" placeholder="Fiesta en mi casa">

            <label class="m-b-4 label-e" for="description">descripción</label>
            <textarea class="m-b-4" name="description" id="description" placeholder="Organizamos una fiesta en mi casa para todo aquel que quiera asistir, solo debe traer bebidas individuales."></textarea>
            
            <label class="m-b-4 label-e" for="date">Fecha</label>
            <div class="m-b-4 d-flex">
                <select class="m-r-3" name="day">
                    <?php foreach ($n['day'] as $key => $day) { ?>
                        <option value="<?php echo($key) ?>"><?php echo $day; ?></option>
                    <?php } ?>
                </select>
                <select class="m-r-3" name="month">
                    <?php foreach ($n['month'] as $key => $month) { ?>
                        <option value="<?php echo($key) ?>"><?php echo $month; ?></option>
                    <?php } ?>
                </select>
            </div>

            <label class="m-b-4 label-e" for="time">Hora</label>
            <div class="m-b-4 d-flex">
                <select class="m-r-3" name="hour">
                    <?php foreach ($n['hour'] as $key => $hour) { ?>
                        <option value="<?php echo($key) ?>"><?php echo $hour; ?></option>
                    <?php } ?>
                </select>
                <select name="minute">
                    <?php foreach ($n['minute'] as $key => $minute) { ?>
                        <option value="<?php echo($key) ?>"><?php echo $minute ?></option>
                    <?php } ?>
                </select>
            </div>
            <label class="m-b-4 label-e" for="location">Ubicación</label>
            <div class="d-flex m-b-3">
                <input onkeyup="search_location();" class="m-r-3" style="width: 100%;" id="city" type="text" name="city" autocomplete="off" placeholder="Ciudad" value="<?php echo $n['user']['city'] ?>">
                <input onkeyup="search_location();" class="m-r-3" style="width: 100%;" id="region" type="text" name="region" autocomplete="off" placeholder="Region" value="<?php echo $n['user']['region'] ?>">
                <input onkeyup="search_location();" type="text" style="width: 100%;" id="country" type="text" name="country" autocomplete="off" placeholder="País" value="<?php echo $n['user']['country'] ?>">
            </div>
            <div class="m-b-4 hidden" id="res_location" style="background: #f5f5f5; padding: 7px 10px; border: 1px solid #ddd; border-radius: 6px;"></div>


            <label class="m-b-4 label-e" for="address">Dirección</label>
            <input class="m-b-4" type="text" id="address" name="address" placeholder="Dirección">

            <label class="m-b-4 label-e" for="its_free">¿Es gratis?</label>
            <select class="m-b-4" name="its_free" id="its_free">
                <option value="yes">Si</option>
                <option value="no">No</option>
            </select>
            <h3 id="jeje"></h3>
            <div id="content-price" class="hidden m-b-4">
                <label class="m-b-4 label-e" for="price">Precio</label>
                <input class="m-b-4" name="price" type="number" id="price">
            </div>
            <label class="m-b-4 label-e" for="img">Imagen</label>
            <input class="m-b-4" type="file" name="img" id="img" accept="image/*">
            <button id="loader" class="m-b-4">Crear evento</button>
            <div id="result"></div>
        </div>
    </form>
</div>