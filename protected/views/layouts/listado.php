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
<div id="busqueda" class="closed">
	
  	<table>
    	<tr>
      	<td>Desde:</td><td align="right"><input type="text" id="desde" name="desde" value="" readonly="readonly" /></td>
      </tr>
      <tr>
        <td>Hasta:</td><td align="right"><input type="text" id="hasta" name="hasta" value="" readonly="readonly" /></td>
      </tr>
      <tr>
        <td>Campus:</td><td><input type="text" id="campus" name="campus" value="" /></td>
      </tr>
      <tr>
        <td>Campus:</td><td><input type="text" id="campus" name="campus" value="" /></td>
      </tr>
      <tr>
        <td>Campus:</td><td><input type="text" id="campus" name="campus" value="" /></td>
      </tr>
      <tr>
        <td></td><td align="right"><input type="submit" id="buscar" value=""/></td>
      </tr>
    </table>
 
  <a class="open" id="openBusqueda">Abrir Busqueda</a>
  <a class="open" id="close">Abrir Busqueda</a>
</div>	


<script type="text/javascript" language="javascript">
$(document).ready(function(){
	$('#desde').calendarsPicker();
	$('#hasta').calendarsPicker();
});
$(function() {
		$( "#openBusqueda" ).click(function() {
			$( "#busqueda" ).addClass( "open", 500);
			$( "#openBusqueda" ).attr( "style", "display:none");
			$( "#close" ).attr( "style", "display:block");
			return false;
		});
		$( "#close" ).click(function() {
			$( "#busqueda" ).removeClass( "open", 500);
			$( "#openBusqueda" ).attr( "style", "display:block");
			$( "#close" ).attr( "style", "display:none");
			return false;
		});
	});
</script>
<?php $this->endContent(); ?>