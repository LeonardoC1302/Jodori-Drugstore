<h1>Actualizar Cuenta</h1>
<div class="actualizar-cuenta">
    <a class="orange-btn" href="/cuenta">Volver al Panel</a>
    <form method="POST" class="form">
        <div class="form__field">
            <label for="name" class="form__label">Nombre</label>
            <input class="form__input" type="text" placeholder="Tu Nombre" id="name" name="name" value="<?php echo $user->name;?>">
        </div> <!-- /form__field -->
        <div class="form__field">
            <label for="surname" class="form__label">Apellido</label>
            <input class="form__input" type="text" placeholder="Tu Apellido" id="surname" name="surname" value="<?php echo $user->surname;?>">
        </div> <!-- /form__field -->
        <div class="form__field">
            <label for="phone" class="form__label">Teléfono</label>
            <input class="form__input" type="tel" placeholder="Tu Teléfono" id="phone" name="phone" value="<?php echo $user->phone;?>">
        </div> <!-- /form__field -->
        <div class="form__field">
            <label for="username" class="form__label">Nombre de Usuario</label>
            <input class="form__input" type="text" placeholder="Tu Apellido" id="username" name="username" value="<?php echo $user->username;?>">
        </div> <!-- /form__field -->

        <input type="submit" class="orange-btn" value="Actualizar">
    </form>
</div>