<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('Title','Parametros','CuentaBancaria'); ?></h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cuenta-bancaria-form',
	'enableAjaxValidation'=>false, 
        'enableClientValidation'=>false,
        'focus'=>array($model,'descripcion'),
        ));
?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>
        <br>
	<?php echo $form->errorSummary($model); ?>
<?php echo CHtml::hiddenField('scenario', 'insert')?>
	
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textField($model,'descripcion',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
                 <?php
                    $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('Descripcion_tooltip','Parametros','CuentaBancaria'),
			'effect' => 'normal'
                	));
                ?>
                <br>

		<?php echo $form->labelEx($model,'idbanco'); ?>
                <?php /*echo $form->dropDownList($model, 'idbanco', CHtml::listData(
                    Banco::model()->findAll(), 'idbanco', 'nombre'),
                    array('prompt' => 'Selecciona el Banco')) */
                echo CHtml::textField('nombrebanco', Banco::model()->buscaNombre($model->idbanco), array('readonly'=>true,'size'=>'35'));
                echo CHtml::link('Escoger el Banco','javascript:escogerBanco();');

                echo $form->hiddenField($model,'idbanco',array('size'=>30,'readonly'=>true));


                        ?>
		<?php echo $form->error($model,'idbanco'); ?>

                 <?php
                    $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('Idbanco_tooltip','Parametros','CuentaBancaria'),
			'effect' => 'normal'
                	));
                ?>
                <br>
		<?php echo $form->labelEx($model,'numerocuenta'); ?>
		<?php echo $form->textField($model,'numerocuenta',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'numerocuenta'); ?>
                                 <?php
                    $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('Numerocuenta_tooltip','Parametros','CuentaBancaria'),
			'effect' => 'normal'
                	));
                ?>
                <br>

		<?php echo $form->labelEx($model,'idcuentanec'); ?>
		
                <?php
                 echo CHtml::textField('nombrecuenta', Plancuentasnec::model()->buscaNombre($model->idcuentanec), array('readonly'=>true,'size'=>'35'));
                echo CHtml::link('Escoger la cuenta','javascript:escogerModelo();');

                echo $form->hiddenField($model,'idcuentanec',array('size'=>30,'readonly'=>true));
               
               /* echo $form->dropDownList($model, 'idcuentanec', CHtml::listData(
                    PlanCuentasNec::model()->findAll(array('order'=>' "cuentacontable" ', 'condition'=>' "tipocuenta" =:x', 'params'=>array(':x'=>false))), 'idcuentanec', 'concatened'),array('prompt' => 'Selecciona la Cuenta'));*/
                ?>
		<?php echo $form->error($model,'idcuentanec'); ?>
                 <?php
                    $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('Idcuentanec_tooltip','Parametros','CuentaBancaria'),
			'effect' => 'normal'
                	));
                ?>
                <br>
		<?php echo $form->labelEx($model,'asistentecuenta'); ?>
		<?php echo $form->textField($model,'asistentecuenta',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'asistentecuenta'); ?>
                <?php
                    $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('Asistentecuenta_tooltip','Parametros','CuentaBancaria'),
			'effect' => 'normal'
                	));
                ?>
                <br>
                <?php echo $form->labelEx($model,'telefonoasistente'); ?>
		<?php echo $form->textField($model,'telefonoasistente',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'telefonoasistente'); ?>
                 <?php
                    $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('Telefonoasistente_tooltip','Parametros','CuentaBancaria'),
			'effect' => 'normal'
                	));
                ?>
                <br>
                <?php echo $form->labelEx($model,'ayudanteasistente'); ?>
		<?php echo $form->textField($model,'ayudanteasistente',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'ayudanteasistente'); ?>
         <?php
                    $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('Ayudanteasistente_tooltip','Parametros','CuentaBancaria'),
			'effect' => 'normal'
                	));
                ?>
                <br>
		<?php echo $form->labelEx($model,'chequeautomatico'); ?>
		<?php echo $form->checkBox($model,'chequeautomatico'); ?>
		<?php echo $form->error($model,'chequeautomatico'); ?>
                <?php
                    $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('Chequeautomatico_tooltip','Parametros','CuentaBancaria'),
			'effect' => 'normal'
                	));
                ?>

                <br>

	
		<?php echo $form->labelEx($model,'numerocheque'); ?>
		<?php echo $form->textField($model,'numerocheque',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'numerocheque'); ?>
        	 <?php
                    $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('Numerocheque_tooltip','Parametros','CuentaBancaria'),
			'effect' => 'normal'
                	));
                ?>
                <br>
	
		<?php echo $form->labelEx($model,'ubicacionimpresion'); ?>
		<?php echo $form->textField($model,'ubicacionimpresion',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'ubicacionimpresion'); ?>
        	 <?php
                    $this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('Ubicacionimpresion_tooltip','Parametros','CuentaBancaria'),
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
			'text' =>MessageHandler::transformar('Idempresa_tooltip','Parametros','CuentaBancaria'),
			'effect' => 'normal'
                	));
                ?>
                <br>
    <?php
            $this->widget('BotonesWidget',array('permitidos'=>array('save','exit')));
    ?>


<?php $this->endWidget(); ?>

<?php $this->widget('ModelosWidget', array(
	'id' => 'modelo_dlg',
	'nombre' => $model->descripcion,
	'selectCallback' => 'onSelectPlanCuentasNec',
        'title'=>'Seleccione Cuenta Contable',
        'url_lista'=>'plancuentasnec/buscarAjaxCuentaNec',
        'modelo'=>'Cuentabancaria',
        'obj_name'=>'nombrecuenta',
        'obj_fk'=>'idcuentanec',
        'busqueda'=>'busquedaCuenta',


));?>


<?php $this->widget('ModelosWidget', array(
	'id' => 'banco_dlg',
	'nombre' => $model->descripcion,
	'selectCallback' => 'onSelectCuentaBancaria',
        'title'=>'Seleccione el Banco',
        'url_lista'=>'banco/buscarAjaxBanco',
        'modelo'=>'Cuentabancaria',
        'obj_name'=>'nombrebanco',
        'obj_fk'=>'idbanco',
        'busqueda'=>'busquedaBanco',



));?>


<script type="text/javascript">
    function escogerModelo() {
            
            $("#modelo_dlg").dialog("open");
    }

  function escogerBanco() {
            
            $("#banco_dlg").dialog("open");
    }


    onSelectPlanCuentasNec = function(fk,nombre,objfk,name){
     
            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#modelo_dlg").dialog("close");
    }

     onSelectCuentaBancaria= function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#banco_dlg").dialog("close");
    }

</script>