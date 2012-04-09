<?php
$this->breadcrumbs=array(
	'Detalleasientoses',
);

//$this->menu=array(
//	array('label'=>'Create Detalleasientos', 'url'=>array('create')),
//	array('label'=>'Manage Detalleasientos', 'url'=>array('admin')),
//);
?>

<table>

<?php 
$totalDebe = 0;
$totalHaber =0;

foreach($dataProvider as $row){
    $totalDebe += $row->valordebe;
    $totalHaber += $row->valorhaber;
    
    ?>
     <tr>
        <td><?php echo $row->nombrecuenta; ?></td>
        <td><?php echo $row->valordebe; ?></td>
        <td><?php echo $row->valorhaber; ?></td>
        <td><?php echo $row->subdetalle; ?></td>
        <td><a onclick="
           if(confirm('Desea eliminar este detalle?'))
               {
                   loadPageAjax('detalleasientosform', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/detalleasientos/delete/id/<?php echo $row->id?>', 'listDetalleAsiento');
               }
           ">[X]</a></td>
    </tr>
    <?php       
}

//$this->widget('zii.widgets.CListView', array(
//	'dataProvider'=>$dataProvider,
//	'itemView'=>'_view',
//)); ?>
    
    <tr >
        <td></td>
        <td><?php echo $totalDebe?></td>
        <td><?php echo $totalHaber?></td>
        <td style="background-color: red;"><?php echo $totalDebe-$totalHaber?></td>
    </tr>    
    
</table>