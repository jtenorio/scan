<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>
<h1><?php echo MessageHandler::transformar('Title','Parametros','Banco'); ?></h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	 'id'=>'categoria-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
    'focus'=>array($model,'nombre'),
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<br>
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'nombre'); ?>
          <?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('nombre_tooltip','Parametros','Categoria'),
			'effect' => 'normal'
	));
	?>
	<br>


		<?php echo $form->labelEx($model,'categoriaprincipal'); ?>
		<?php echo $form->checkBox($model,'categoriaprincipal'); ?>
		<?php echo $form->error($model,'categoriaprincipal'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('categoriaprincipal_tooltip','Parametros','Categoria'),
			'effect' => 'normal'
	));
	?>
        <br>


		<?php echo $form->labelEx($model,'identificador'); ?>
		<?php echo $form->textField($model,'identificador',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'identificador'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('identificador_tooltip','Parametros','Categoria'),
			'effect' => 'normal'
	));
	?>
        <br>

		<?php echo $form->labelEx($model,'cat_id'); ?>
		<?php 
                 echo CHtml::textField('nombrecategoria', Categoria::model()->buscaNombre($model->cat_id), array('readonly'=>true,'size'=>'35'));
                echo $form->hiddenField($model,'cat_id',array('size'=>40,'maxlength'=>40));
                   echo CHtml::link('Escoger la cuenta','javascript:escogerCategoria();');

                ?>
		<?php echo $form->error($model,'cat_id'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('identificador_tooltip','Parametros','Categoria'),
			'effect' => 'normal'
	));
	?>
        <br>


		<?php echo $form->labelEx($model,'idempresa'); ?>
		<?php echo $form->dropDownList($model, 'idempresa',CHtml::listData(
                    Empresa::model()->findAll(), 'idempresa', 'razonsocial')); ?>
		<?php echo $form->error($model,'idempresa'); ?>
	<?php
	$this->widget('HintWidget', array(
			'text' =>MessageHandler::transformar('idempresa_tooltip','Parametros','Categoria'),
			'effect' => 'normal'
	));
	?>
        <br>

	<br>
    <?php
            $this->widget('BotonesWidget',array('permitidos'=>array('save','exit')));
    ?>


<?php $this->endWidget(); ?>


        <?php $this->widget('ModelosWidget', array(
	'id' => 'categoria_dlg',
	'nombre' => '',
	'selectCallback' => 'onSelectCategoria',
        'title'=>'Seleccione la Categoria',
        'url_lista'=>'categoria/buscarAjaxCategoria',
        'modelo'=>'Categoria',
        'obj_name'=>'nombrecategoria',
        'obj_fk'=>'cat_id',
        'busqueda'=>'busquedaCategoria',



));?>
<script type="text/javascript">
    function escogerCategoria() {

            $("#categoria_dlg").dialog("open");
    }



     onSelectCategoria= function(fk,nombre,objfk,name){

            $("#"+objfk).val(fk);
            $("#"+name).val(nombre);
            $("#categoria_dlg").dialog("close");
    }

</script>