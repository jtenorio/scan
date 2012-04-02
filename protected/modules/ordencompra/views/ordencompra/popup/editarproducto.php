<script>
$(document).ready(function(){
$("#tabla1").dataTable( {
    "sPaginationType": "full_numbers"
} );
$("#tabla1_filter").hide();
$("#tabla1_length").hide();
});
</script>

<form name="form2" id="form2">
<table width='80%' border='1' class='display' id='tabla1'>
<thead>
<tr>
    <th align='center'><strong>Código</strong></th>
    <th align='center'><strong>Producto</strong></th>
    <th align='center'><strong>Cantidad</strong></th>
    <th align='center'><strong>Valor</strong></th>
    <th align='center'><strong>Elegir</strong></th>
</tr>
</thead>
<tbody>
    <tr>
        <td><?php echo $codigos ?></td>
        <td><?php echo $productos ?></td>
        <td><input type="text" id="cantidad" name="cantidad" size="5" value="<?php echo $cantidads ?>" /></td>
        <td><input type="text" id="valor" name="valor" size="5" value="<?php echo $valors ?>" /></td>
        <td>
            <?php
            echo "<a href='javascript:modificar(\"$id\",\"$codigos\",\"$productos\",document.form2.cantidad.value,document.form2.valor.value,".$idProductos.")'>Modificar</a>";
            ?>
        </td>
    </tr>
</tbody>
</table>


</form>