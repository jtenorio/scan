<?php
 $this->widget('ComandosWidget', array(
	'comandos' => array(
		array('Cargar', 'cargar'),
	),
));
?>

<h3>Catálogo General</h3>
<br>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$provider,
	'ajaxUpdate' => true,
    'columns'=>array(
        'clase',
        'codigo',
        array(
            'name'=>'valor',
            'value'=>'FormatUtil::truncate($data->valor, 80)',
        ),
		'descripcion',
		'secuencia',
		array(
            'class'=>'CButtonColumn',
			'template' => '{view}',
        ),
    ),
	'summaryText' => 'Mostrando {start} - {end} de {count} resultados',
	'pager' => array('class'=>'CListPager')
));

?>