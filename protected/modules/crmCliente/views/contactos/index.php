<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.dialog.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.draggable.js"></script>

<h2>Contactos del cliente</h2>
<p><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/crmContacto/contacto/create">[+] Agregar Contacto</a></p>
<table style="">
    <tr>
        <td>Nombre</td>
        <td>Apellido</td>
        <td>Tel&eacute;fono</td>
        <td></td>
    </tr>

    <?php
    foreach ($contactos->getData() as $row) {
        ?>
        <tr>
            <td><?php echo $row->nombres ?></td>
            <td><?php echo $row->apellidos ?></td>
            <td><?php echo $row->telefono_oficina ?></td>
            <td><a onclick="
                sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/crmColaboracion', 'agendaContacto');
                $('#agendaContacto').dialog('open');
               ">[x] Agendar con este contacto</a></td>
        </tr>
    <?php
    }
    ?>
</table>
<div id="agendaContacto" style="display: none;">


</div>
<script>
	$(function() {
		$( "#agendaContacto" ).dialog({ autoOpen: false },{ draggable: true },{ minWidth: 1100 },{ position: [10,120] });
	});
</script>