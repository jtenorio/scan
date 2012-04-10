<form name="parametros" id="parametros" method="POST" enctype="multipart/form-data">

<table>
    <tr>
        <td>Mes:</td>
        <td>
            <select name="mes" id="mes">
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>                
            </select>
            
            
        </td>
    </tr>
    <tr>
        <td>A&ntilde;o:</td>
        <td>
            <select name="anio" id="anio">
                <?php
                                      
                    for( $anio = date('Y') -2;$anio<=date('Y')+2;$anio++)
                    {
                        echo '<option value="'.$anio.'">'.$anio.'</option>';
                    }
                ?>
            </select>
        </td>
    </tr>
</table>
</form>
<?php
/**
 *Construir el calendario
 */

 $date= time();

 $day = date('d',$date);
 $month = date('m',$date);
 $year = date('Y',$date);

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

 echo '<table border=1 width="100%">';

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

    echo "<td> $day_num </td>";
    $day_num++;
    $day_count++;

    //Make sure we start a new row every week
    if ($day_count > 7)
    {
        echo "</tr><tr>";
        $day_count = 1;
    }
 }