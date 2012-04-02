
<form name="pagos" method="POST" id="pagos">

<table border="1">
    <tr style="background-color: yellow;">
        <td colspan="14">COMPRAS </td>                
    </tr>
   
    
    <tr>
        <td>Prov.</td>
        <td>N.Fact.</td>
        <td>Fec. Emisi&oacute;n</td>
        <td>Fec. Venc.</td>
        <td>Sub-Total+Monto ICE</td>
        <td>IVA</td>
        <td>Total Factura</td>
        <td>Pagado</td>
        <td>Descuentos Ret. + NC</td>
        <td>Saldo</td>
        <td>Raz&oacute;n Social</td>
        <td>Abono</td>
        <td>Cancela</td>
        <td>Nuevo Saldo</td>
    </tr>
    
    <?php  
    foreach($compras as $idCompra => $compra)
    {
    ?>
     <tr>
        <td><?php echo $compra['prov']?></td>
        <td><?php echo $compra['numFactura']?></td>
        <td><?php echo $compra['fechaEmision']?></td>
        <td><?php echo $compra['fechaVencimiento']?></td>
        <td><?php echo $compra['subTotal']?></td>
        <td><?php echo $compra['iva']?></td>
        <td><?php echo $compra['total']?></td>
        <td><?php echo $compra['pagado']?></td>
        <td><?php echo $compra['descuento']?></td>
        <td><?php echo $compra['saldo']?></td>
        <td><?php echo $compra['razonSocial']?></td>
        <td>
            <input type="text" name="abono_<?php echo $idCompra?>_<?php echo$compra['idProveedor']?>" id="abono_<?php echo $idCompra?>_<?php echo $compra['idProveedor']?>" value="0" size="6" onblur="
                
               if(this.value <= <?php echo $compra['saldo']?>) {
                nuevoSaldo = <?php echo $compra['saldo']?> - this.value;
                $('#nuevoSaldo_<?php echo $idCompra?>').html(nuevoSaldo);
                
                sendPage('pagos', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestrocajachica/detalle/cuenta/'+$('#Maestroasiento_idcuentabancaria').val(), 'crearDetalleAsiento');
                }else{
                    alert('Cantidad incorrecta');
                    this.value=0;
                }
                
               "/>            
        </td>
        <td><input type="checkbox" name="cancela_<?php echo $idCompra?>" id="cancela_<?php echo $idCompra?>" value="1" 
                   onclick="
                        if($('input[name=cancela_<?php echo $idCompra?>]').is(':checked')){
                           $('#abono_<?php echo $idCompra?>_<?php echo $compra['idProveedor']?>').val(<?php echo $compra['saldo']?>);
                           
                           $('#nuevoSaldo_<?php echo $idCompra?>').html('0');
                           sendPage('pagos', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestrocajachica/detalle/cuenta/'+$('#Maestroasiento_idcuentabancaria').val(), 'crearDetalleAsiento');
                       }    
                                 
           "/></td>
        <td><div id="nuevoSaldo_<?php echo $idCompra?>"></div></td>
    </tr>
    
    <?php  
    }
    ?>
    
    <?php  ?>
    
</table>
</form>

<script type="text/javascript">
    sendPage('pagos', '<?php echo Yii::app()->request->baseUrl; ?>/index.php/contabilidad/maestrocajachica/detalle/cuenta/'+$('#Maestroasiento_idcuentabancaria').val(), 'crearDetalleAsiento');
</script>