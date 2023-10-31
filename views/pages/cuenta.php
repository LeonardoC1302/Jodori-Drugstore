<?php
    if($result){
        $message = showNotification(intval($result));
        if($message) { ?>
            <p class='alert success'> <?php echo s($message) ?> </p>;
        <?php }
    }
?>

<div class="info-cuenta">
    <div class="imagen-cuenta"></div>
    <div class="form-cuenta">
        <form class="form">
            <div class="form__field">
                <label for="name" class="form__label">Nombre Completo</label>
                <input disabled class="form__input" type="text" placeholder="Nombre de usuario" id="name" name="name" value="<?php echo $user->name . " " . $user->surname; ?>">
            </div> <!-- /form__field -->  
            <div class="form__field">
                <label for="username" class="form__label">Nombre Usuario</label>
                <input disabled class="form__input" type="text" placeholder="Nombre de usuario" id="username" name="username" value="<?php echo $user->username; ?>">
            </div> <!-- /form__field -->        
            <div class="form__field">
                <label for="phone" class="form__label">Teléfono</label>
                <input disabled class="form__input" type="tel" placeholder="Teléfono de usuario" id="phone" name="phone" value="<?php echo $user->phone; ?>">
            </div> <!-- /form__field -->        
            <div class="form__field">
                <label for="email" class="form__label">Correo Electrónico</label>
                <input disabled class="form__input" type="email" placeholder="Correo Electrónico de usuario" id="email" name="email" value="<?php echo $user->email; ?>">
            </div> <!-- /form__field -->        
            <div class="form__field">
                <label for="password" class="form__label">Contraseña</label>
                <input disabled class="form__input" type="password" placeholder="Contraseña" id="password" name="password" value="<?php echo $user->password; ?>">
            </div> <!-- /form__field -->     
        </form>
        <div class="acciones-cuenta">
            <a href="/cuenta/actualizar" class="orange-btn">Actualizar</a>
            <a href="/cuenta/eliminar" class="red-btn">Eliminar cuenta</a>
        </div>
    </div>

</div> 


