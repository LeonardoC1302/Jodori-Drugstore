<?php
    if($result){
        $message = showNotification(intval($result));
        if($message) { ?>
            <p class='alert success'> <?php echo s($message) ?> </p>;
        <?php }
    }
?>


<div class="actions">
    <a href="/admin" class="orange-btn">Volver al Panel</a>
</div>

<h1>Usuarios Activos</h1>
<table class="products">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Condición</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($usuarios as $user){  
                if($user->verified == 1 && $user->id != $current){ ?>
            <tr>
                <td><?php echo $user->id ?></td>
                <td><?php echo $user->name ?> <?php echo $user->surname ?></td>
                <td><?php echo $user->username ?></td>
                <td> <?php echo $user->email ?> </td>
                <td>
                    <form method="POST" class="w-100" action="/admin/asignarAdmin">
                        <input type="hidden" name="id" value="<?php echo $user->id ?>">
                        <?php if($user->admin == 0){ ?>
                            <input type="hidden" name="admin" value="1">
                            <input type="submit" class="red-btn-block" value="Cliente"onclick="return confirm('Desea asignar el rol de administrador a este usuario ')">
                        <?php }else{ ?>
                            <input type="hidden" name="admin" value="0">
                            <input type="submit" class="red-btn-block" value="Admin."onclick="return confirm('Desea revocar el rol de administrador a este usuario')">
                        <?php } ?>
                    </form>
                </td>
            </tr>
        <?php }
            } ?>
    </tbody>
</table>