<script>
$(document).ready(function(){
    $("#tabla").dataTable( {
        "sPaginationType": "full_numbers"
    } );
});
</script>
<form name="form1" id="form1">
<table width='80%' border='1' class='display' id='tabla'>
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
    <?php
    $i=0;
    if(count($producto)>0){
        foreach ($producto as $productos){
        echo '<tr>';
            echo '<td>'.$productos['codigoproducto'].'</td>';
            echo '<td>'.$productos['nombre'].'</td>';
            echo '<td><input type="text" id="cantidad" name="cantidad'.$i.'" size="5" value="0" /></td>';
            echo '<td><input type="text" id="valor" name="valor'.$i.'" size="5" value="0" /></td>';
            echo "<td><a href='javascript:agregar(\"$productos[codigoproducto]\",\"$productos[nombre]\",document.form1.cantidad".$i.".value,document.form1.valor".$i.".value,".$productos[id].")'>Agregar</a>";


            echo '</td>';
        echo '</tr>';
        $i++;
        }
    }
    ?>
</tbody>
</table>
</form>