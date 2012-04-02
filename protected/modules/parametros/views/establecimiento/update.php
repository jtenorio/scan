<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('UpdateTitle','Parametros','Establecimiento',array('{nombre}'=>$model->establecimiento)) ?></h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'establecimiento-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'focus'=>array($model,'establecimiento'),

)); ?>

	<p class="note">Campos con  <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

        <br>
		<?php echo $form->labelEx($model,'establecimiento'); ?>
		<?php echo $form->textField($model,'establecimiento',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'establecimiento'); ?>

          <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('establecimiento_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>

        <br>


		<?php echo $form->labelEx($model,'puntoemision'); ?>
		<?php echo $form->textField($model,'puntoemision',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'puntoemision'); ?>
<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('establecimiento_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>
        <br>

		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'nombre'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('nombre_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>
        <br>
		<?php echo $form->labelEx($model,'numeronotadeventa'); ?>
		<?php echo $form->textField($model,'numeronotadeventa',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'numeronotadeventa'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('numeronotadeventa_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>
	<br>


		<?php echo $form->labelEx($model,'numerofactura'); ?>
		<?php echo $form->textField($model,'numerofactura',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'numerofactura'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('numerofactura_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>
	<br>


		<?php echo $form->labelEx($model,'numeronotacredito'); ?>
		<?php echo $form->textField($model,'numeronotacredito',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'numeronotacredito'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('numeronotacredigo_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>
	<br>


		<?php echo $form->labelEx($model,'numeronotaentrega'); ?>
		<?php echo $form->textField($model,'numeronotaentrega',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'numeronotaentrega'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('numeronotaentrega_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>

	<br>
		<?php echo $form->labelEx($model,'numeroretencion'); ?>
		<?php echo $form->textField($model,'numeroretencion',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'numeroretencion'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('numeroretencion_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>
	<br>
		<?php echo $form->labelEx($model,'autorizacionnotaventa'); ?>
		<?php echo $form->textField($model,'autorizacionnotaventa',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'autorizacionnotaventa'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('autorizacionnotaventa_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>
	<br>
		<?php echo $form->labelEx($model,'autorizacionfactura'); ?>
		<?php echo $form->textField($model,'autorizacionfactura',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'autorizacionfactura'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('autorizacionfactura_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>
	<br>
		<?php echo $form->labelEx($model,'autorizacionnotacredito'); ?>
		<?php echo $form->textField($model,'autorizacionnotacredito',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'autorizacionnotacredito'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('autorizacionnotacredito_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>
	<br>
		<?php echo $form->labelEx($model,'autorizacionretencion'); ?>
		<?php echo $form->textField($model,'autorizacionretencion',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'autorizacionretencion'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('autorizacionretencion_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>

	<br>
		<?php echo $form->labelEx($model,'impresionnotaventa'); ?>
		<?php echo $form->textField($model,'impresionnotaventa',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'impresionnotaventa'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('impresionnotaventa_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>
	<br>


		<?php echo $form->labelEx($model,'impresionfactura'); ?>
		<?php echo $form->textField($model,'impresionfactura',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'impresionfactura'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('impresionfactura_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>
	<br>


		<?php echo $form->labelEx($model,'impresionnotacredito'); ?>
		<?php echo $form->textField($model,'impresionnotacredito',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'impresionnotacredito'); ?>
        <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('impresionnotacredito_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>
	<br>


		<?php echo $form->labelEx($model,'impresionnotaentrega'); ?>
		<?php echo $form->textField($model,'impresionnotaentrega',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'impresionnotaentrega'); ?>
         <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('impresionnotaentrega_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>
	<br>



		<?php echo $form->labelEx($model,'impresionretencion'); ?>
		<?php echo $form->textField($model,'impresionretencion',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'impresionretencion'); ?>
 <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('impresionretencion_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>
	<br>



		<?php echo $form->labelEx($model,'retencionautomatica'); ?>
		<?php echo $form->checkBox($model,'retencionautomatica'); ?>
		<?php echo $form->error($model,'retencionautomatica'); ?>
 <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('retencionautomatica_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>
	<br>


		<?php echo $form->labelEx($model,'documentopredeterminado'); ?>
		<?php echo $form->textField($model,'documentopredeterminado',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'documentopredeterminado'); ?>
                <?php
                    $this->widget('HintWidget', array(
                                    'text' =>MessageHandler::transformar('documentopredeterminado_tooltip','Parametros','Establecimiento'),
                                    'effect' => 'normal'
                    ));
        	?>
	<br>



		<?php echo $form->labelEx($model,'bodegapredeterminada'); ?>
		<?php
                      echo CHtml::textField('nombrebodega', Bodega::model()->buscaNombre($model->bodegapredeterminada), array('readonly'=>true,'size'=>'35'));
                      echo CHtml::link('Escoger la Bodega','javascript:escogerBodega();');
                      echo $form->hiddenField($model,'bodegapredeterminada');
                ?>
		<?php echo $form->error($model,'bodegapredeterminada'); ?>
                 <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('bodegapredeterminada_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>
	<br>




		<?php echo $form->labelEx($model,'usaservicios'); ?>
		<?php echo $form->checkBox($model,'usaservicios'); ?>
		<?php echo $form->error($model,'usaservicios'); ?>
 <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('usaservicios_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>
	<br>


		<?php echo $form->labelEx($model,'cuentacontableservicios'); ?>
		<?php
                     echo CHtml::textField('nombrecuenta', Plancuentasnec::model()->buscaNombre($model->cuentacontableservicios), array('readonly'=>true,'size'=>'35'));
                echo CHtml::link('Escoger la cuenta','javascript:escogerModelo();');

                echo $form->hiddenField($model,'cuentacontableservicios',array('size'=>30,'readonly'=>true));

               // echo $form->textField($model,'cuentacontableservicios'); ?>
		<?php echo $form->error($model,'cuentacontableservicios'); ?>
 <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('cuentacontableservicios_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>
	<br>
		<?php echo $form->labelEx($model,'porcentajeservicios'); ?>
		<?php echo $form->textField($model,'porcentajeservicios'); ?>
		<?php echo $form->error($model,'porcentajeservicios'); ?>
 <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('porcentajeservicios_tooltip','Parametros','Establecimiento'),
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
			'text' =>MessageHandler::transformar('idempresa_tooltip','Parametros','Establecimiento'),
			'effect' => 'normal'
	));
	?>
	<br>



        <?php
                    $this->widget('BotonesWidget',array('permitidos'=>array('save','delete','exit')));
        ?>


<?php $this->endWidget(); ?>

<?php $this->widget('ModelosWidget', array(
	'id' => 'modelo_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectPlanCuentasNec',
        'title'=>'Seleccione Cuenta Contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Establecimiento',
        'obj_name'=>'nombrecuenta',
        'obj_fk'=>'cuentacontableservicios',
        'busqueda'=>'busquedaCuenta',


));?>

        <?php $this->widget('ModelosWidget', array(
	'id' => 'bodega_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectBodega',
        'title'=>'Seleccione la Bodega',
        'url_lista'=>'bodega/buscarAjaxBodega',
        'modelo'=>'Establecimiento',
        'obj_name'=>'nombrebodega',
        'obj_fk'=>'bodegapredeterminada',
        'busqueda'=>'busquedaBodega',


));?>


        <script type="text/javascript">
    function escogerModelo() {

            $("#modelo_dlg").dialog("open");
    }

function escogerBodega() {

            $("#bodega_dlg").dialog("open");
    }


    onSelectPlanCuentasNec = function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#modelo_dlg").dialog("close");
    }

    onSelectBodega = function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#bodega_dlg").dialog("close");
    }


</script>