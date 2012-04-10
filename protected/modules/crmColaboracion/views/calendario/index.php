<form name="parametros" id="parametros" method="POST" enctype="multipart/form-data">

<table>
    <tr>
        <td>Mes:</td>
        <td>
            <select name="mes" id="mes">
                <option value="1" <?php echo $mes==1?'selected':''?>>Enero</option>
                <option value="2" <?php echo $mes==2?'selected':''?>>Febrero</option>
                <option value="3" <?php echo $mes==3?'selected':''?>>Marzo</option>
                <option value="4" <?php echo $mes==4?'selected':''?>>Abril</option>
                <option value="5" <?php echo $mes==5?'selected':''?>>Mayo</option>
                <option value="6" <?php echo $mes==6?'selected':''?>>Junio</option>
                <option value="7" <?php echo $mes==7?'selected':''?>>Julio</option>
                <option value="8" <?php echo $mes==8?'selected':''?>>Agosto</option>
                <option value="9" <?php echo $mes==9?'selected':''?>>Septiembre</option>
                <option value="10" <?php echo $mes==10?'selected':''?>>Octubre</option>
                <option value="11" <?php echo $mes==11?'selected':''?>>Noviembre</option>
                <option value="12" <?php echo $mes==12?'selected':''?>>Diciembre</option>                
            </select>
            
            
        </td>
    </tr>
    <tr>
        <td>A&ntilde;o:</td>
        <td>
            <select name="anio" id="anio">
                <?php
                                      
                    for( $anioi = date('Y') -2;$anioi<=date('Y')+2;$anioi++)
                    {
                        $selected = $anioi==$anio?'selected':'';
                        echo '<option value="'.$anioi.'" '.$selected.'>'.$anioi.'</option>';
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <input type="button" value="Ver" name="view" onclick="
                sendPage('parametros', '<?php echo Yii::app()->request->baseUrl;?>/index.php/crmColaboracion/calendario', 'agenda');
           "/>
        </td>
    </tr>
</table>
</form>
<?php
/**
 *Construir el calendario
 */

 $date= time();

 //$day = date('d',$date);
 $month = $mes;
 $year = $anio;

 $firstDay = mktime(0,0,0,$month,1,$year);

 $title = date('F',$firstDay);

 $dayOfTheWeek = date('D',$firstDay);

 switch($dayOfTheWeek){
        case "Sun": $blank = 0; break;
        case "Mon": $blank = 1; break;
        case "Tue": $blank = 2; break;
        case "Wed": $blank = 3; break;
        case "Thu": $blank = 4; break;
        case "Fri": $blank = 5; break;
        case "Sat": $blank = 6; break;
    }

$daysInMonth = cal_days_in_month(0, $month, $year);

 echo '<table width="100%" class="calendario">';

 echo "<tr><th colspan=7> $title $year </th></tr>";

 echo "<tr><td>Domingo</td><td>Lunes</td><td>Martes</td><td>Miercoles</td><td>Jueves</td><td>Viernes</td><td>Sabado</td></tr>";

 $day_count = 1;

 echo "<tr>";

 //first we take care of those blank days
 while ( $blank > 0 )
 {
    echo "<td></td>";
    $blank = $blank-1;
    $day_count++;
 }


 //sets the first day of the month to 1

 $day_num = 1;

 //count up the days, untill we've done all of them in the month
 while ( $day_num <= $daysInMonth )
 {
    //aqui se deben imprimir los eventos para el dia/mes/anio
    $class = ($day_num == date('d'))?'hoy':''; 
    echo '<td class="'.$class.'">'. $day_num .'</td>';
    $day_num++;
    $day_count++;

    //Make sure we start a new row every week
    if ($day_count > 7)
    {
        echo "</tr><tr>";
        $day_count = 1;
    }
 }