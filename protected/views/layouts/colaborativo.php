<?php $this->beginContent('//layouts/main'); ?>
<div class="container">

    <div id="listBancos">
  	<h2><?php echo CHtml::encode($this->pageTitle); ?></h2>
        <?php
			$this->beginWidget('zii.widgets.CPortlet', array(

			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations',),

			));
			$this->endWidget();
		?>

  </div>
        <div id="topbar">

        </div><!-- sidebar -->
	<div id="content">

        <div id="izquierda">
            <script type="text/javascript">
                sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/crmColaboracion/menu/index/id/NULL/dia/NULL/mes/NULL/anio/NULL', 'izquierda');
            </script>
        </div>
		<div id="agenda"><?php echo $content; ?>
             <script type="text/javascript">
                sendPage('null', '<?php echo Yii::app()->request->baseUrl;?>/index.php/crmColaboracion/calendario', 'agenda');
            </script>
        </div>
	</div><!-- content -->

</div>

<?php $this->endContent(); ?>