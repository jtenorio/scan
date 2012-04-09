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
<!--        <ul>
            <li class="nuevo"><a href="#">Nuevo</a></li>
        <li class="borrar"><a href="#">Borrar</a></li>
        <li class="exportar"><a href="#">Exportar</a></li>
        <li class="importar"><a href="#">Importar</a></li>
        <li class="listar"><a href="#">Listar</a></li>
        <li class="ayuda"><a href="#">Ayuda</a></li>
        </ul>-->
  </div>
        <div id="topbar">
		
        </div><!-- sidebar -->
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->

</div>

<?php $this->endContent(); ?>