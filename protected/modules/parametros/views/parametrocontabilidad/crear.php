<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('Title','Parametros','ParametroContabilidad'); ?></h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'parametro-contabilidad-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>false,

)); ?>

	<p class="note">Campos con <span class="required">*</span> son  rewueridos.</p>


	<?php echo $form->errorSummary($model); ?>


		<?php //echo $form->labelEx($model,'idcuentaactivo'); ?>
		<?php //echo $form->textField($model,'idcuentaactivo'); ?>
		<?php //echo $form->error($model,'idcuentaactivo'); ?>
        <!--<br>-->
		<?php //echo $form->labelEx($model,'idcuentapasivo'); ?>
		<?php //echo $form->textField($model,'idcuentapasivo'); ?>
		<?php //echo $form->error($model,'idcuentapasivo'); ?>
	<!--<br>-->
		<?php //echo $form->labelEx($model,'idcuentapatrimonio'); ?>
		<?php //echo $form->textField($model,'idcuentapatrimonio'); ?>
		<?php //echo $form->error($model,'idcuentapatrimonio'); ?>
	<!--<br>-->


		<?php ///echo $form->labelEx($model,'idcuentaingreso'); ?>
		<?php //echo $form->textField($model,'idcuentaingreso'); ?>
		<?php //echo $form->error($model,'idcuentaingreso'); ?>
	<!--<br>-->


		<?php //echo $form->labelEx($model,'idcuentaegreso'); ?>
		<?php //echo $form->textField($model,'idcuentaegreso'); ?>
		<?php //echo $form->error($model,'idcuentaegreso'); ?>
	<!--<br>-->


		<?php //echo $form->labelEx($model,'idcuentaotros'); ?>
		<?php //echo $form->textField($model,'idcuentaotros'); ?>
		<?php //echo $form->error($model,'idcuentaotros'); ?>
	<!--<br>-->


		<?php echo $form->labelEx($model,'idcuentabancariapred'); ?>
		<?php
                 echo CHtml::textField('nombrecuentabancariapred', Plancuentasnec::model()->buscaNombre($model->idcuentabancariapred), array('readonly'=>true,'size'=>'35'));
                  echo CHtml::link('Cuenta Bancaria','javascript:escogerCuenta();');
                  echo $form->hiddenField($model,'idcuentabancariapred',array('size'=>30,'readonly'=>true));

                //echo $form->textField($model,'idcuentabancariapred');

                ?>
		<?php echo $form->error($model,'idcuentabancariapred'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('idcuentabancariapred_tooltip','Parametros','ParametroContabilidad'),
			'effect' => 'normal'
	));
     ?>
        <br>


		<?php echo $form->labelEx($model,'idcuentacierreutilidad'); ?>
		<?php
                  echo CHtml::textField('nombrecuentacierreutilidad', Plancuentasnec::model()->buscaNombre($model->idcuentacierreutilidad), array('readonly'=>true,'size'=>'35'));
                  echo CHtml::link('Escoger la cuenta','javascript:escogerUtilidad();');
                  echo $form->hiddenField($model,'idcuentacierreutilidad',array('size'=>30,'readonly'=>true));

                  ?>
		<?php echo $form->error($model,'idcuentacierreutilidad'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('idcuentacierreutilidad_tooltip','Parametros','ParametroContabilidad'),
			'effect' => 'normal'
	));
     ?>
        <br>
		<?php //echo $form->labelEx($model,'reporteingreso'); ?>
		<?php //echo $form->textField($model,'reporteingreso',array('size'=>60,'maxlength'=>254)); ?>
		<?php //echo $form->error($model,'reporteingreso'); ?>

<?php
//	$this->widget('HintWidget', array(
//			'text' =>MessageHandler::transformar('reporteingreso_tooltip','Parametros','ParametroContabilidad'),
//			'effect' => 'normal'
//	));
     ?>
	<!--<br>-->
		<?php //echo $form->labelEx($model,'reporteegreso'); ?>
		<?php //echo $form->textField($model,'reporteegreso',array('size'=>60,'maxlength'=>254)); ?>
		<?php //echo $form->error($model,'reporteegreso'); ?>
	<?php
//	$this->widget('HintWidget', array(
//			'text' =>MessageHandler::transformar('reporteegreso_tooltip','Parametros','ParametroContabilidad'),
//			'effect' => 'normal'
//	));
     ?>
        <!--<br>-->
		<?php //echo $form->labelEx($model,'reportecancelacion'); ?>
		<?php //echo $form->textField($model,'reportecancelacion',array('size'=>60,'maxlength'=>254)); ?>
		<?php //echo $form->error($model,'reportecancelacion'); ?>
	<?php
//	$this->widget('HintWidget', array(
//			'text' =>MessageHandler::transformar('reportecancelacion_tooltip','Parametros','ParametroContabilidad'),
//			'effect' => 'normal'
//	));
//     ?>
        <!--<br>-->
		<?php //echo $form->labelEx($model,'reporteform104'); ?>
		<?php //echo $form->textField($model,'reporteform104',array('size'=>60,'maxlength'=>254)); ?>
		<?php //echo $form->error($model,'reporteform104'); ?>
	<?php
//	$this->widget('HintWidget', array(
//			'text' =>MessageHandler::transformar('reporteform104_tooltip','Parametros','ParametroContabilidad'),
//			'effect' => 'normal'
//	));
     ?>
        <!--<br>-->
		<?php //echo $form->labelEx($model,'reporteform103'); ?>
		<?php //echo $form->textField($model,'reporteform103',array('size'=>60,'maxlength'=>254)); ?>
		<?php //echo $form->error($model,'reporteform103'); ?>
	<?php
//	$this->widget('HintWidget', array(
//			'text' =>MessageHandler::transformar('reporteform103_tooltip','Parametros','ParametroContabilidad'),
//			'effect' => 'normal'
//	));
//     ?>
        <!--<br>-->
		<?php //echo $form->labelEx($model,'direccionrespaldo'); ?>
		<?php //echo $form->textField($model,'direccionrespaldo',array('size'=>60,'maxlength'=>254)); ?>
		<?php //echo $form->error($model,'direccionrespaldo'); ?>
	<?php
//	$this->widget('HintWidget', array(
//			'text' =>MessageHandler::transformar('direccionrespaldo_tooltip','Parametros','ParametroContabilidad'),
//			'effect' => 'normal'
//	));
     ?>
        <!--<br>-->
		<?php echo $form->labelEx($model,'generadoasientocierre'); ?>
		<?php echo $form->checkBox($model,'generadoasientocierre'); ?>
		<?php echo $form->error($model,'generadoasientocierre'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('generadoasientocierre_tooltip','Parametros','ParametroContabilidad'),
			'effect' => 'normal'
	));
     ?>
        <br>
		<?php echo $form->labelEx($model,'usarcamporeferecia'); ?>
		<?php echo $form->checkBox($model,'usarcamporeferecia'); ?>
		<?php echo $form->error($model,'usarcamporeferecia'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('usarcamporeferecia_tooltip','Parametros','ParametroContabilidad'),
			'effect' => 'normal'
	));
     ?>
        <br>
		<?php echo $form->labelEx($model,'usarcampodetallenorec'); ?>
		<?php echo $form->checkBox($model,'usarcampodetallenorec'); ?>
		<?php echo $form->error($model,'usarcampodetallenorec'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('usarcampodetallenorec_tooltip','Parametros','ParametroContabilidad'),
			'effect' => 'normal'
	));
     ?>
        <br>
		<?php echo $form->labelEx($model,'iddocumentocompragasto'); ?>
		<?php echo $form->dropDownList($model,'iddocumentocompragasto',$documentos,array('prompt'=>'Escoja el documento')); ?>
		<?php echo $form->error($model,'iddocumentocompragasto'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('iddocumentocompragasto_tooltip','Parametros','ParametroContabilidad'),
			'effect' => 'normal'
	));
     ?>
        <br>
		<?php echo $form->labelEx($model,'iddocumentocomprainventario'); ?>
		<?php echo $form->dropDownList($model,'iddocumentocomprainventario',$documentos,array('prompt'=>'Escoja el documento')); ?>
		<?php echo $form->error($model,'iddocumentocomprainventario'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('iddocumentocomprainventario_tooltip','Parametros','ParametroContabilidad'),
			'effect' => 'normal'
	));
     ?>
        <br>
		<?php echo $form->labelEx($model,'iddocumentoventas'); ?>
		<?php echo $form->dropDownList($model,'iddocumentoventas',$documentos,array('prompt'=>'Escoja el documento')); ?>
		<?php echo $form->error($model,'iddocumentoventas'); ?>
                <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('iddocumentoventas_tooltip','Parametros','ParametroContabilidad'),
			'effect' => 'normal'
	));
     ?>
	<br>
		<?php echo $form->labelEx($model,'iddocumentocancelacion'); ?>
		<?php echo $form->dropDownList($model,'iddocumentocancelacion',$documentos,array('prompt'=>'Escoja el documento')); ?>
		<?php echo $form->error($model,'iddocumentocancelacion'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('iddocumentocancelacion_tooltip','Parametros','ParametroContabilidad'),
			'effect' => 'normal'
	));
     ?>
	<br>
		<?php echo $form->labelEx($model,'idcuentacierreperdida'); ?>
		<?php
                  echo CHtml::textField('nombrecuentacierreperdida', Plancuentasnec::model()->buscaNombre($model->idcuentacierreperdida), array('readonly'=>true,'size'=>'35'));
                  echo CHtml::link('Escoger la cuenta','javascript:escogerPerdida();');
                  echo $form->hiddenField($model,'idcuentacierreperdida',array('size'=>30,'readonly'=>true));


                ?>
		<?php echo $form->error($model,'idcuentacierreperdida'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('idcuentacierreperdida_tooltip','Parametros','ParametroContabilidad'),
			'effect' => 'normal'
	));
     ?>
	<br>
		<?php echo $form->labelEx($model,'anioejercicio'); ?>
		<?php echo $form->dropDownList($model, 'anioejercicio',CHtml::listData(
     Ejerciciocontable::model()->findAll(), 'id', 'idanio'));?>
		<?php echo $form->error($model,'anioejercicio'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('anioejercicio_tooltip','Parametros','ParametroContabilidad'),
			'effect' => 'normal'
	));
     ?>
	<br>
		<?php echo $form->labelEx($model,'estado'); ?>
		<?php echo $form->checkBox($model,'estado'); ?>
		<?php echo $form->error($model,'estado'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('estado_tooltip','Parametros','ParametroContabilidad'),
			'effect' => 'normal'
	));
     ?>
	<br>
		<?php echo $form->labelEx($model,'idempresa'); ?>
		<?php echo $form->dropDownList($model, 'idempresa',CHtml::listData(
                    Empresa::model()->findAll(), 'idempresa', 'razonsocial'));?>
		<?php echo $form->error($model,'idempresa'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('idempresa_tooltip','Parametros','ParametroContabilidad'),
			'effect' => 'normal'
	));
     ?>
	<br>
		<?php echo $form->labelEx($model,'numeroasiento'); ?>
		<?php echo $form->textField($model,'numeroasiento',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'numeroasiento'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('numeroasiento_tooltip','Parametros','ParametroContabilidad'),
			'effect' => 'normal'
	));
     ?>
	<br>
		<?php
$this->widget('BotonesWidget',array('permitidos'=>array('save','exit')));
?>

<?php $this->endWidget(); ?>

<?php $this->widget('ModelosWidget', array(
	'id' => 'utilidad_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectUtilidad',
        'title'=>'Seleccione Cuenta Contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Parametrocontabilidad',
        'obj_name'=>'nombrecuentacierreutilidad',
        'obj_fk'=>'idcuentacierreutilidad',
        'busqueda'=>'busquedaUtilidad',


));?>


<?php $this->widget('ModelosWidget', array(
	'id' => 'perdida_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectPerdida',
        'title'=>'Seleccione la cuenta contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Parametrocontabilidad',
        'obj_name'=>'nombrecuentacierreperdida',
        'obj_fk'=>'idcuentacierreperdida',
        'busqueda'=>'busquedaPerdida',



));?>

<?php $this->widget('ModelosWidget', array(
	'id' => 'cuenta_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectCuenta',
        'title'=>'Seleccione la cuenta bancaria',
        'url_lista'=>'cuentabancaria/buscarAjaxCuenta',
        'modelo'=>'Parametrocontabilidad',
        'obj_name'=>'nombrecuentabancariapred',
        'obj_fk'=>'idcuentabancariapred',
        'busqueda'=>'busquedaCuenta',



));?>




<script type="text/javascript">
    function escogerUtilidad() {

            $("#utilidad_dlg").dialog("open");
    }

  function escogerPerdida() {

            $("#perdida_dlg").dialog("open");
    }

function escogerCuenta() {

            $("#cuenta_dlg").dialog("open");
    }


    onSelectUtilidad = function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#utilidad_dlg").dialog("close");
    }

    onSelectCuenta = function(fk,nombre,objfk,name){
            
            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#cuenta_dlg").dialog("close");
    }

     onSelectPerdida= function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#perdida_dlg").dialog("close");
    }

</script>