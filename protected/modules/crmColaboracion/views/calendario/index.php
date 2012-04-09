<table>
    <tr>
        <td>Mes:</td>
        <td></td>
    </tr>
    <tr>
        <td>A&ntilde;o:</td>
        <td></td>
    </tr>
</table>

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