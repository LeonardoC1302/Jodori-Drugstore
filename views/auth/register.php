<div class="sm-container">
    <h1 class="align-left">Registrar Cuenta</h1>
    <form class="form">
        <div class="form__field">
            <label for="name" class="form__label">Nombre Completo</label>
            <input class="form__input" type="name" placeholder="Tu Nombre" id="name" name="name">
        </div> <!-- /form__field -->
        <div class="form__field">
            <label for="phone" class="form__label">Teléfono</label>
            <input class="form__input" type="tel" placeholder="Tu Número Telefónico" id="phone" name="phone">
        </div> <!-- /form__field -->
        <div class="form__field">
            <label for="email" class="form__label">Correo Electrónico</label>
            <input class="form__input" type="email" placeholder="Tu Correo Electrónico" id="email" name="email">
        </div> <!-- /form__field -->
        <div class="form__field">
            <label for="password" class="form__label">Contraseña</label>
            <input class="form__input" type="password" placeholder="Tu Contraseña" id="password" name="password">
        </div> <!-- /form__field -->
        <a href="/forgot" class="action align-right">¿Olvidaste tu Contraseña?</a>
        <input class="form__submit" type="submit" value="Ingresar">
        <a href="/login" class="action align-center">¿Ya tienes una cuenta? <span>Inicia Sesión</span></a>
    </form>
</div>