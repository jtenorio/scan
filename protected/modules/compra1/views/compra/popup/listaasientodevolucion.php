<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */
?>

<table width="100%">
    <thead>
    <th>Cuenta Contable</th>
    <th>Debe</th>
    <th>Haber</th>
    </thead>
    <tbody>    
    <?php
        $totalDebe = 0;
        $totalHaber = 0;
        $cuentaProducto = explode("|",$cuentaContableProducto);
        $totalProductos = explode("|",$totalProducto);
        for($i=1;$i<count($cuentaProducto);$i++){
            echo '<tr>';
                echo '<td>'.$cuentaProducto[$i].'</td>';
                echo '<td></td>';
                echo '<td>'.number_format($totalProductos[$i], 2, ".", "").'</td>';
            echo '</tr>';
            $totalDebe = $totalDebe + $totalProductos[$i];
        }
        if($montoIva>0){
            echo '<tr>';
                echo '<td>'.$cuentaContableMontoIva.'</td>';
                echo '<td></td>';
                echo '<td>'.number_format($montoIva, 2, ".", "").'</td>';
            echo '</tr>';
            $totalDebe = $totalDebe + $montoIva;
        }
        if($montoIce>0){
            echo '<tr>';
                echo '<td>'.$cuentaContableMontoIce.'</td>';
                echo '<td></td>';
                echo '<td>'.number_format($montoIce, 2, ".", "").'</td>';
            echo '</tr>';
            $totalDebe = $totalDebe + $montoIce;
        }
        echo '<tr>';
            echo '<td>'.$cuentaContableCuentaPagar.'</td>';
            echo '<td>'.number_format($saldo, 2, ".", "").'</td>';
            echo '<td></td>';
        echo '</tr>';
        $totalHaber = $totalHaber + $saldo;
        
        
        echo '<tr>';
            echo '<td><strong>TOTAL</strong></td>';
            echo '<td>'.number_format($totalDebe, 2, ".", "").'</td>';
            echo '<td>'.number_format($totalHaber, 2, ".", "").'</td>';
        echo '</tr>';
    ?>

    </tbody>
</table>