<script>
$(document).ready(function(){
    $("#tabla").dataTable( {
        "sPaginationType": "full_numbers"
    } );
});

function cargarCcosto(valor,valor1){
    document.form1.idCcostoIngreso.value=valor;
    document.form1.nombreCcostoIngreso.value=valor1;
}
</script>
<form name="form1" id="form1">
<input type="hidden" id="idCcostoIngreso" name="idCcostoIngreso" />
<input type="hidden" id="nombreCcostoIngreso" name="nombreCcostoIngreso" />
<table width='80%' border='1' class='display' id='tabla'>
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
    <?php
    $i=0;
    if(count($producto)>0){
        foreach ($producto as $productos){
        echo '<tr>';
            echo '<td>'.$productos['codigoproducto'].'</td>';
            echo '<td>'.$productos['nombre'].'</td>';
            echo '<td><input type="text" id="cantidad" name="cantidad'.$i.'" size="5" value="0" /></td>';
            echo '<td><input type="text" id="valor" name="valor'.$i.'" size="5" value="0" /></td>';
            echo '<td>
                    <select name="ccosto[]" id="ccosto" style="width:100px;" onchange="cargarCcosto(this.value,this[this.selectedIndex].text)">
                    <option value="">Seleccionar</option>';                    
                    foreach ($ccosto as $ccostos){
                        if($ccostos['tipocuenta']=='t')
                            echo '<option value="'.$ccostos['idcuentagasto'].'" disabled="disabled">'.$ccostos['cuentagasto'].' '.$ccostos['nombrecuenta'].'</option>';
                        else
                            echo '<option value="'.$ccostos['idcuentagasto'].'">'.$ccostos['cuentagasto'].' '.$ccostos['nombrecuenta'].'</option>';
                    }

            echo '</select></td>';
            echo "<td><a href='javascript:agregar(\"$productos[codigoproducto]\",\"$productos[nombre]\",document.form1.cantidad".$i.".value,document.form1.valor".$i.".value,document.form1.nombreCcostoIngreso.value,".$productos[id].",document.form1.idCcostoIngreso.value,".$productos[tarifaiva].")'>Agregar</a>";


            echo '</td>';
        echo '</tr>';
        $i++;
        }
    }
    ?>
</tbody>
</table>
</form>