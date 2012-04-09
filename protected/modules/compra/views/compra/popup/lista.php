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
                echo '<td>'.number_format($totalProductos[$i], 2, ".", "").'</td>';
                echo '<td></td>';
            echo '</tr>';
            $totalDebe = $totalDebe + $totalProductos[$i];
        }
        if($montoIva>0){
            echo '<tr>';
                echo '<td>'.$cuentaContableMontoIva.'</td>';
                echo '<td>'.number_format($montoIva, 2, ".", "").'</td>';
                echo '<td></td>';
            echo '</tr>';
            $totalDebe = $totalDebe + $montoIva;
        }
        if($montoIce>0){
            echo '<tr>';
                echo '<td>'.$cuentaContableMontoIce.'</td>';
                echo '<td>'.number_format($montoIce, 2, ".", "").'</td>';
                echo '<td></td>';
            echo '</tr>';
            $totalDebe = $totalDebe + $montoIce;
        }
        echo '<tr>';
            echo '<td>'.$cuentaContableCuentaPagar.'</td>';
            echo '<td></td>';
            echo '<td>'.number_format($saldo, 2, ".", "").'</td>';
        echo '</tr>';
        $totalHaber = $totalHaber + $saldo;
        if($retIva30>0){
            echo '<tr>';
                echo '<td>'.$cuentaContableRetencionIva30.'</td>';
                echo '<td></td>';
                echo '<td>'.number_format($retIva30, 2, ".", "").'</td>';
            echo '</tr>';
            $totalHaber = $totalHaber + $retIva30;
        }
        if($retIva70>0){
            echo '<tr>';
                echo '<td>'.$cuentaContableRetencionIva70.'</td>';
                echo '<td></td>';
                echo '<td>'.number_format($retIva70, 2, ".", "").'</td>';
            echo '</tr>';
            $totalHaber = $totalHaber + $retIva70;
        }
        if($retIva100>0){
            echo '<tr>';
                echo '<td>'.$cuentaContableRetencionIva100.'</td>';
                echo '<td></td>';
                echo '<td>'.number_format($retIva100, 2, ".", "").'</td>';
            echo '</tr>';
            $totalHaber = $totalHaber + $retIva100;
        }

        if($retFuente1>0){
            echo '<tr>';
                echo '<td>'.$cuentaContableRetencionFuente1.'</td>';
                echo '<td></td>';
                echo '<td>'.number_format($retFuente1, 2, ".", "").'</td>';
            echo '</tr>';
            $totalHaber = $totalHaber + $retFuente1;
        }
        if($retFuente2>0){
            echo '<tr>';
                echo '<td>'.$cuentaContableRetencionFuente2.'</td>';
                echo '<td></td>';
                echo '<td>'.number_format($retFuente2, 2, ".", "").'</td>';
            echo '</tr>';
            $totalHaber = $totalHaber + $retFuente2;
        }
        if($retFuente3>0){
            echo '<tr>';
                echo '<td>'.$cuentaContableRetencionFuente3.'</td>';
                echo '<td></td>';
                echo '<td>'.number_format($retFuente3, 2, ".", "").'</td>';
            echo '</tr>';
            $totalHaber = $totalHaber + $retFuente3;
        }
        if($retFuente4>0){
            echo '<tr>';
                echo '<td>'.$cuentaContableRetencionFuente4.'</td>';
                echo '<td></td>';
                echo '<td>'.number_format($retFuente4, 2, ".", "").'</td>';
            echo '</tr>';
            $totalHaber = $totalHaber + $retFuente4;
        }
        if($retFuente5>0){
            echo '<tr>';
                echo '<td>'.$cuentaContableRetencionFuente5.'</td>';
                echo '<td></td>';
                echo '<td>'.number_format($retFuente5, 2, ".", "").'</td>';
            echo '</tr>';
            $totalHaber = $totalHaber + $retFuente5;
        }
        if($retFuente6>0){
            echo '<tr>';
                echo '<td>'.$cuentaContableRetencionFuente6.'</td>';
                echo '<td></td>';
                echo '<td>'.number_format($retFuente6, 2, ".", "").'</td>';
            echo '</tr>';
            $totalHaber = $totalHaber + $retFuente6;
        }
        echo '<tr>';
            echo '<td><strong>TOTAL</strong></td>';
            echo '<td>'.number_format($totalDebe, 2, ".", "").'</td>';
            echo '<td>'.number_format($totalHaber, 2, ".", "").'</td>';
        echo '</tr>';
    ?>

    </tbody>
</table>