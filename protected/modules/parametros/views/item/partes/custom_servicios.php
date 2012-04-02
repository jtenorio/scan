<?php
/*
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.views
 */
?>
         <!--   <br>
            <label>Modelo:</label>-->
		
		<?php
//                  echo CHtml::textField('nombremodelo', Modelo::model()->buscaNombre($model_cstm->idmodelo), array('readonly'=>true,'size'=>'35'));
//                  echo CHtml::activeHiddenField($model_cstm,'idmodelo',array('size'=>40,'maxlength'=>40));
//                  echo CHtml::link('Escoger el modelo','javascript:escogerModelo();',array('name'=>'linkmodelo','id'=>'linkmodelo'));
              ?>
		
<!--            <br>
                <label>Marca:<?php ?></label>-->
		
		<?php 
//                 echo CHtml::textField('nombremarca', Marca::model()->buscaNombre($model_cstm->idmarca), array('readonly'=>true,'size'=>'35'));
//                 echo CHtml::activeHiddenField($model_cstm,'idmarca',array('size'=>40,'maxlength'=>40));
//                 echo CHtml::link('Escoger la Marca','javascript:escogerMarca();',array('id'=>'linkmarca','name'=>'linkmarca'));
                ?>
		
            <!--<br>
            <label>Numero Serie:<?php ?></label>-->
		
		<?php
                //echo CHtml::activeTextField($model_cstm,'numeroserie',array('size'=>50,'maxlength'=>50));
                 
                ?>
		
            <!--<br>
            <label>Ubicacion:<?php ?></label>-->
		
		<?php
                //echo CHtml::activeTextField($model_cstm,'ubicacion',array('size'=>60,'maxlength'=>120)); ?>
		
            <!--<br>
            <label>Codigo Barras:</label>-->
		
		<?php
                //echo CHtml::activeTextField($model_cstm,'codigobarras',array('size'=>60,'maxlength'=>150)); ?>
		
            <!--<br>
            <label>Estado Item:<?php ?></label>-->
		
		<?php //echo CHtml::activeTextField($model_cstm,'estadoitemcalidad',array('size'=>60,'maxlength'=>120)); ?>
		
	<br>
        <label>Detalle Nota:<?php ?></label>
	<?php echo CHtml::activeTextArea($model_cstm,'detallenota',array('size'=>60,'maxlength'=>150)); ?>
		


       <?php $this->widget('ModelosWidget', array(
	'id' => 'marca_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectMarca',
        'title'=>'Seleccione el marca',
        'url_lista'=>'marca/buscarAjaxMarca',
        'modelo'=>'ItemCstm',
        'obj_name'=>'nombremarca',
        'obj_fk'=>'idmarca',
        'busqueda'=>'busquedaMarca',



));?>

    <?php $this->widget('ModelosWidget', array(
	'id' => 'modelo_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectModelo',
        'title'=>'Seleccione el Modelo',
        'url_lista'=>'modelo/buscarAjaxModelo',
        'modelo'=>'ItemCstm',
        'obj_name'=>'nombremodelo',
        'obj_fk'=>'idmodelo',
        'busqueda'=>'busquedaModelo',



));?>



<script type="text/javascript">



    function escogerMarca() {

            $("#marca_dlg").dialog("open");
    }

    function escogerModelo() {

            $("#modelo_dlg").dialog("open");
    }


   onSelectMarca= function(fk,nombre,objfk,name){
           $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#marca_dlg").dialog("close");
    }
   onSelectModelo= function(fk,nombre,objfk,name){
           $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#modelo_dlg").dialog("close");
    }

</script>

        