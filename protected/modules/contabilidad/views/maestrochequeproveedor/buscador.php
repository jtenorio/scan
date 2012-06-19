<div id ="buscar">
     <form id ="formBusqueda" name ="formBusqueda">
        <table>
            <tr>
                <td>Buscar:</td>
                <td><input type="text" name="buscar"></input></td>
                <td><input type="button" name ="btnBuscar" value="buscar" onclick="sendPage('formBusqueda','<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestrochequeproveedor/buscador/', 'buscar');"></td>
            </tr>
        </table>
     </form >

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$content = "";
//$proveedorByRuc = array();
    $content .= '<table>';
        foreach($proveedorByRuc as $id =>$ruc){
            $content .= '<tr onclick="
                    $(\'#Maestroasiento_cedularuc\').val(\''.$ruc.'\');
                    $(\'#Maestroasiento_beneficiario\').val(\''.$proveedorByName[$id].'\');
                    $(\'#idProveedor\').val(\''.$id.'\');
                    $(\'#dialogProveedores\').dialog(\'close\');
                    sendPage(\'null\', \''.Yii::app()->request->baseUrl.'/index.php/contabilidad/maestrochequeproveedor/anticipos/idProveedor/'.$id.'\', \'anticipos\');
                    sendPage(\'null\', \''.Yii::app()->request->baseUrl.'/index.php/contabilidad/maestrochequeproveedor/compras/idProveedor/'.$id.'\', \'compras\');
                    $(\'#Maestroasiento_detalle\').val($(\'#Maestroasiento_beneficiario\').val()+ \' AB/CANC\');
                " style="cursor:pointer;">';
                $content .= "<td>$ruc</td>";
                $content .= "<td>{$proveedorByName[$id]}</td>";
            $content .= '</tr>';
        }


    $content .= '</table>';
echo $content;

?>
</div>