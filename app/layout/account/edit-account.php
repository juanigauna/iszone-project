<div class="mx-5 m-t-8">
    <h2 class="m-b-7">Editar</h2>
    <form id="edit-account">
        <div class="d-grid">
            <label class="m-b-4 label-e">Usuario</label>
            <input class="m-b-4" type="text" name="username" placeholder="Usuario" value="<?php echo $n['user']['username'] ?>">

            <label class="m-b-4 label-e">Biografía</label>
            <textarea class="m-b-4" name="bio" maxlength="175" placeholder="Pon información sobre tí."><?php echo $n['user']['biography'] ?></textarea>

            <label class="m-b-4 label-e" for="e-mail">E-mail</label>
            <input id="e-mail" class="m-b-4" type="email" name="email" value="<?php echo $n['user']['email'] ?>">

            <label class="m-b-4 label-e" for="location">Ubicación</label>
            <div class="d-flex m-b-3">
                <input onkeyup="search_location('res_location');" class="m-r-3" style="width: 100%;" id="city" type="text" name="city" autocomplete="off" placeholder="Ciudad" value="<?php echo $n['user']['city'] ?>">
                <input onkeyup="search_location('res_location');" class="m-r-3" style="width: 100%;" id="region" type="text" name="region" autocomplete="off" placeholder="Region" value="<?php echo $n['user']['region'] ?>">
                <input onkeyup="search_location('res_location');" type="text" style="width: 100%;" id="country" type="text" name="country" autocomplete="off" placeholder="País" value="<?php echo $n['user']['country'] ?>">
            </div>
            <div class="m-b-4 hidden" id="res_location" style="background: #f5f5f5; padding: 7px 10px; border: 1px solid #ddd; border-radius: 6px;"></div>

            <label class="m-b-4 label-e" for="gender">Género</label>
            <select class="m-b-4" name="gender">
                <option value="<?php echo $n['user']['gender'] ?>"><?php if ($n['user']['gender'] == 0) { echo "Hombre"; } else { echo "Mujer"; } ?></option>
                <?php foreach ($n['gender'] as $key => $value) { ?>
                    <?php if ($n['user']['gender'] != $key) { ?>
                        <option value="<?php echo $key ?>"><?php echo $value ?></option>
                    <?php } ?>
                <?php } ?>
            </select>

            <button id="loader" class="m-b-4">Editar</button>
            <div class="hidden-alert" id="result"></div>
        </div>
    </form>
</div>