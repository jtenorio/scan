<table id ="ajaxedGridView" class="ajaxedGridView">
    <tr >
<?php
    foreach($headers as $head)
    {
        
                echo '<td>'.$head.'</td>';
           
    }
    
    ?>
    </tr>     
   <?php
    foreach($table as $row){
        echo '<tr>';
        
        foreach($row as $name => $value)
        {
            echo '<td>'.$value.'</td>';
        }
        
        //Botones de editar y elminiar
        ?>
    
    <td><a onclick ="sendPage('null','<?php echo Yii::app()->request->baseUrl.'/'.$urlToAjax.'/'.$keyName.'/'.$row[$keyName]?>','<?php echo $divToAjax?>')">Ver</a></td>
    <td><a onclick ="sendPage('null','<?php echo Yii::app()->request->baseUrl.'/index.php/crmColaboracion/documento/delete/'.$keyName.'/'.$row[$keyName]?>','agenda')">Borrar</a></td>
    <?php
        
        echo '</tr>';
    }
 ?>
</table>
