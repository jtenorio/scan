<table width="100%">
	<tr>
		<th>Ciudad</th>
		<th>Provincia</th>
		<th>País</th>
	</tr>
	<?php
        
        $folder = Yii::getPathOfAlias('application.data');
        $path=$folder.'/catalogos_ciudades.php';
        if(file_exists($path)){
            $codigos_provinciales=  include_once $path;

        }
	foreach ($lista as $row):
		$pais = !empty($row['pais']) ? $row['pais'] : $row['pais2'];
		$ciudad = $row['ciudad'];
		$prov = $row['provincia'];
                $codigo_telefonico=$codigos_provinciales[ucfirst($prov)];
		$cods = array($row['cod_ciudad'], $row['cod_provincia'], $row['cod_pais'], $row['cod_pais2']);
		$codigos = implode('|', $cods);
		$js = "select".$modelo.$id."('$ciudad','$prov','".$modelo."_".$obj_fk."','".$modelo."_".$obj_name."')";
	?>
		<tr>
			<td><?php echo CHtml::link($ciudad, 'javascript:' . $js);	?></td>
			<td><?php echo $prov ?></td>
			<td><?php echo $pais; ?></td>
		</tr>
<?php endforeach; ?>
</table>