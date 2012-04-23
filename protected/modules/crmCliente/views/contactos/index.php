<h2>Contactos del cliente</h2>
<p><a href="crmContacto/contacto/create">[+] Agregar Contacto</a></p>
<table style="">
    <tr>
        <td>Nombre</td>
        <td>Apellido</td>
        <td>Tel&eacute;fono</td>
        <td></td>
    </tr>

    <?php

        foreach($contactos->getData() as $row)
        {
    ?>
    <tr>
        <td><?php echo $row->nombres?></td>
        <td><?php echo $row->apellidos?></td>
        <td><?php echo $row->telefono_oficina?></td>
        <td><a href="crmContacto/contacto/create">[x] Agendar con este contacto</a></td>
    </tr>
    <?php
        }

    ?>
</table>
