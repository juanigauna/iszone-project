<div class="formlrf">
    <div class="tb-d m-b-4" style="padding: 12px 10px; background: #f3f3f3;">
        <h2 class="bold-none">Bienvenido a <b><?php echo $n['site_title'] ?></b></h2>
    </div>
    <div class="px-3 m-b-4">
        <h3 class="m-b-7">Sentite en tu lugar siendo como sos.</h3>
        <form id="login-account">
            <div class="d-grid">
                <label class="m-b-4 label-e" for="account_info">Usuario</label>
                <input class="m-b-4" id="account_info" type="text" name="username" placeholder="my_user">
                <label class="m-b-4 label-e" for="account_password">Contraseña</label>
                <input class="m-b-4" id="account_password" type="password" name="pass" placeholder="**************">
                <p class="m-b-4">¿Olvidaste tu contraseña? <a href="<?php echo $n['site_url'] ?>/recover/password">Recupérala</a></p>
                <!--<div class="m-b-4 d-flex">
                    <input class="m-r-1" type="checkbox" id="remember_me">
                    <label for="remember_me">Mantener iniciada la sesión</label>
                </div>-->
                <button id="loader" class="m-b-4">Inicar Sesión</button>
                <div id="result"></div>
            </div>
        </form>
    </div>
    <div class="tb-d m-b-4" style="padding: 12px 10px; background: #f3f3f3;">
        <p>¿No estas registrado? <a href="<?php echo $n['site_url']?>/new/account">Crear cuenta</a></p>
    </div>
</div>