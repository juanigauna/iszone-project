<div class="mx-5 m-t-8 m-b-5">
    <h3 class="m-b-5">Términos y condiciones</h3>
    <p class="m-b-3">
        Al crear una cuenta en nuestra aplicación aceptas una serie de términos y condiciones que debes
        tener en cuenta para evitar malos entendidos.
    </p>
    <h4 class="m-b-3">Cuando te registras nosotros podemos acceder a:</h4>
    <ul class="mx-7 m-b-3">
        <li class="m-b-2">Que nos proveas tu dirección de ip.</li>
        <li>Obtener tu ubicación (ciudad, provincia/estado, país).</li>
    </ul>
    <h4 class="m-b-3">También debes saber que:</h4>
    <ul class="mx-7 m-b-3">
        <li class="m-b-2">No nos haremos cargo de lo que pueda pasar en un evento, ni de que tipo de eventos difundas.</li>
        <li class="m-b-2">Cualquier evento de caracter ilícito correrá en absoluta responsabilidad del organizador.</li>
        <li class="m-b-2">Nosotros solamente brindamos un servicio y no nos hacemos cargo del uso que le dé el usuario.</li>
        <li class="m-b-2">Tu información tal como nombre, apellido, usuario, e-mail, contraseña, ubicación y dirección ip, se guardará en nuestra base de datos y nos será irrelevante.</li>
        <li>Nadie debe saber la contraseña de tu cuenta <?php echo $n['site_title'] ?>, solo tú.</li>
    </ul>
    <h4 class="m-b-3">¿Por qué necesitan saber mi dirección ip?</h4>
    <p class="m-b-3">
        Requerimos saber tu dirección ip para evitar que los usuarios abusen de la creación de cuentas innecesariamente, con ésto logramos
        tener un mayor control y evitar que nuestra app se llene de cuentas inactivas.<br>
        También usamos ésta para poder obtener tu ubicación mediante un protocolo de geolocaliación.
    </p>
    <h4 class="m-b-3">¿Por qué necesitan saber mi ubicación?</h4>
    <p class="m-b-5">
        Nuestra app se encarga de facilitarte la difusión y descubrimiento de eventos. <br>
        Con tu ubicación lo que hacemos es una relación de usuarios y los eventos que éstos crean, teniendo en cuenta que ellos <br>
        están en tu misma ubicación, de ésta forma es que podemos obtener resultados satisfactorios.
    </p>
    <hr class="m-b-4">
    <?php if ($n['logged_in'] == false) { ?>
        <a href="<?php echo $n['site_url'] ?>/welcome" target="_blank" >Iniciar Sesión </a> - <a href="<?php echo $n['site_url'] ?>/new/account" target="_blank">Crear cuenta</a>
    <?php } else { ?>
        <a href="<?php echo $n['site_url'] ?>/recommended" target="_blank" >Recomendados</a>
    <?php } ?>
</div>