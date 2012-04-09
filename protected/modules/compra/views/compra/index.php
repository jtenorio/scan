<script>
function submitFormulario(){
    if($("#anio").val()==''){
        alert("Ingresar Año");
    }else{
        if($("#mes").val()==''){
            alert("Ingresar Mes");
        }else{
            if($("#establecimiento").val()==''){
                alert("Ingresar Establecimiento");
            }else{
                document.form12.submit();
            }
        }
    }

}
</script>
<?php
echo CHtml::form("crear", "post",array("id"=>"form12","name"=>"form12"));
?>
<h1>Ingresar</h1>
<table align="center">
    <tr>
        <td>Año:</td>
        <td>
            <?php
                echo CHtml::listBox("anio", "", $ejercicioContable,array(
                    'size' => '1',
                    'style'=>'width:220px;',
                    'prompt' => 'Seleccionar',
                    'ajax' => array(
                    'type'=>'POST',
                    'url'=> CController::createUrl('Compra/cargarPeriodoContable'),
                    'update'=>'#mes',
                    'data'=>array('anio'=>'js:this.value'),
                )));
            ?>
        </td>
    </tr>
    <tr>
        <td>Mes:</td>
        <td><?php echo CHtml::listBox("mes", "", array(),array("size" => "1",'prompt'=>'Seleccionar','style'=>'width:220px;')); ?></td>
    </tr>
    <tr>
        <td>Establecimiento:</td>
        <td><?php echo CHtml::listBox("establecimiento", "", $establecimiento,array("size" => "1",'prompt'=>'Seleccionar','style'=>'width:220px;')); ?></td>
    </tr>
    <tr>
        <td colspan="2" align="center"><?php echo CHtml::button("INGRESAR", array("onclick"=>"submitFormulario();"));?></td>
    </tr>
</table>
<?php
echo CHtml::endForm();
?>

