<table id ="ajaxedGridView">
<?php
    foreach($table as $row){
        echo '<tr>';
        
        foreach($row as $name => $value)
        {
            echo '<td>'.$value.'</td>';
        }
        
        //Botones de editar y elminiar
        ?>
    
    <td><a onclick ="sendPage('null','<?php echo Yii::app()->request->baseUrl.'/'.$urlToAjax.'/'.$keyName.'/'.$row[$keyName]?>','<?php echo $divToAjax?>')"></a></td>
    <td></td>
    <?php
        
        echo '</tr>';
    }
 ?>
</table>
