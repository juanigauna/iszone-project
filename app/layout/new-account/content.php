<div class="formlrf">
    <div class="tb-d m-b-4" style="padding: 12px 10px; background: #f3f3f3;">
        <h2 class="bold-none">Registrarte en <b><?php echo $n['site_title'] ?></b></h2>
    </div>
    <div class="px-3 m-b-4">
        <h4 class="m-b-5">Podrás saber que va a ocurrir a tu alrededor.</h4>
        <form id="new-account">
            <div class="d-grid">
                <label class="m-b-4 label-e" for="username">Usuario</label>
                <input class="m-b-4" id="username" name="username" type="text" placeholder="my_user">
                <label class="m-b-4 label-e" for="email">E-mail</label>
                <input class="m-b-4" id="email" name="email" type="text" placeholder="my_email@domain.com">
                <label class="m-b-4 label-e" for="password">Contraseña</label>
                <input class="m-b-4" id="password" name="password" type="password" placeholder="**************">
                <label class="m-b-4 label-e" for="gender">Género</label>
                <select class="m-b-4" id="gender" name="gender">
                    <option value="0">Hombre</option>
                    <option value="1">Mujer</option>
                </select>
                <div class="m-b-4 d-flex">
                    <input class="m-r-1" type="checkbox" id="term-and-condition" name="terms">
                    <label for="term-and-condition">Acepto los <a href="<?php echo $n['site_url'] ?>/terms-and-conditions" target="_blank">términos y condiciones</a>.</label>
                </div>
                <button id="loader" class="m-b-4">Crear cuenta</button>
                <div id="result"></div>
            </div>
        </form>
    </div>
    <div class="tb-d m-b-4" style="padding: 12px 10px; background: #f3f3f3;">
        <p>¿Ya tienes cuenta? <a href="<?php echo $n['site_url'] ?>/welcome">Iniciar Sesión</a></p>
    </div>
</div>