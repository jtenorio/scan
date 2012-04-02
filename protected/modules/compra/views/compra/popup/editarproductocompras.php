<script>
$(document).ready(function(){


$("#tabla1").dataTable( {
    "sPaginationType": "full_numbers"
} );
$("#tabla1_filter").hide();
$("#tabla1_length").hide();
});
function cargarCcosto(valor,valor1){
    document.form1.idCcostoIngreso.value=valor;
    document.form1.nombreCcostoIngreso.value=valor1;
}
</script>

<form name="form2" id="form2">
<input type="hidden" id="idCcostoIngreso" name="idCcostoIngreso" />
<input type="hidden" id="nombreCcostoIngreso" name="nombreCcostoIngreso" />
<table width='80%' border='1' class='display' id='tabla1'>
<thead>
<tr>
    <th align='center'><strong>Código</strong></th>
    <th align='center'><strong>Producto</strong></th>
    <th align='center'><strong>Cantidad</strong></th>
    <th align='center'><strong>Valor</strong></th>
    <th align='center'><strong>C. Costo</strong></th>
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
            <select name="ccosto[]" id="ccosto" style="width:100px;" onchange="cargarCcosto(this.value,this[this.selectedIndex].text)">
                <option value="">Seleccionar</option>
            <?php
            foreach ($ccosto as $ccostoRecorrido){
                if($ccostoRecorrido['idcuentagasto'] == $idCcostos)
                    if($ccostoRecorrido['tipocuenta']=='t')
                        echo '<option value="'.$ccostoRecorrido['idcuentagasto'].'" disabled="disabled">'.$ccostoRecorrido['cuentagasto'].' '.$ccostoRecorrido['nombrecuenta'].'</option>';
                    else
                        echo '<option value="'.$ccostoRecorrido['idcuentagasto'].'" selected="selected">'.$ccostoRecorrido['cuentagasto'].' '.$ccostoRecorrido['nombrecuenta'].'</option>';
                else
                    if($ccostoRecorrido['tipocuenta']=='t')
                        echo '<option value="'.$ccostoRecorrido['idcuentagasto'].'" disabled="disabled">'.$ccostoRecorrido['cuentagasto'].' '.$ccostoRecorrido['nombrecuenta'].'</option>';
                    else
                        echo '<option value="'.$ccostoRecorrido['idcuentagasto'].'">'.$ccostoRecorrido['cuentagasto'].' '.$ccostoRecorrido['nombrecuenta'].'</option>';

            }
            ?>
            </select>
        </td>
        <td>
            <?php
            echo "<a href='javascript:modificar(\"$id\",\"$codigos\",\"$productos\",document.form2.cantidad.value,document.form2.valor.value,document.form2.nombreCcostoIngreso.value,".$idProductos.",document.form2.nombreCcostoIngreso.value,".$tarifaIvas.")'>Modificar</a>";
            ?>
        </td>
    </tr>
</tbody>
</table>


</form>