function validar(){
    var htmlError = '';
    if($("#Compra_idsecuencialtransaccion").val()==''){
        htmlError = htmlError + 'Ingresar Tipo de Identificación<br/>';
    }

    if($("#proveedor").val()==''){
        htmlError = htmlError + 'Ingresar Proveedor<br/>';
    }

    if($("#Compra_idtipocomprobante").val()==''){
        htmlError = htmlError + 'Ingresar Tipo de Comprobante<br/>';
    }

    if($("#Compra_fechaemision").val()==''){
        htmlError = htmlError + 'Ingresar Fecha de Emisión<br/>';
    }

    if($("#Compra_fecharegistro").val()==''){
        htmlError = htmlError + 'Ingresar Fecha de registro<br/>';
    }

    if($("#Compra_estabcompra").val()==''){
        htmlError = htmlError + 'Ingresar Número de Serie<br/>';
    }

    if($("#Compra_puntocompra").val()==''){
        htmlError = htmlError + 'Ingresar Número de Serie<br/>';
    }

    if($("#Compra_secuencialcompra").val()==''){
        htmlError = htmlError + 'Ingresar Secuencial<br/>';
    }

    if($("#Compra_autorizacompra").val()==''){
        htmlError = htmlError + 'Ingresar No. Autorización<br/>';
    }

    if($("#Compra_fechacaduca").val()==''){
        htmlError = htmlError + 'Ingresar Caducidad Factura<br/>';
    }

    if($("#Compra_idsustentotributario").val()==''){
        htmlError = htmlError + 'Ingresar Identi. Crédito<br/>';
    }

    if($("#Compra_ubicacionformulario").val()==''){
        htmlError = htmlError + 'Ingresar Ubicación en Form. 104<br/>';
    }

    var numItems = jQuery('#list').jqGrid('getGridParam','records');
    var ret;
    var cont=0;
    for(i=1;i<=numItems;i++){
        ret = jQuery("#list").jqGrid('getRowData',i);
        if(cont==0)
            if(ret.codigo!=0)
                cont = 1;

    }
    if(cont==0){
        htmlError = htmlError + 'Ingresar por lo menos un producto para la compra<br/>';
    }

    if($("#Compra_baseice").val()>0){}
    else{
        $("#Compra_baseice").val('0');
        $("#Compra_montoice").val('0');
    }

    var ultimoDiaMes = new Date($("#ultimoDiaMes").val());
    var fechaEmision = new Date($("#Compra_fechaemision").val());
    var fechaRegistro = new Date($("#Compra_fecharegistro").val());
    var fechaVencimiento = new Date($("#Compra_fechacaduca").val());
    var fechaEmisionCompra = new Date($("#txtFechaEmision").val());

    if(fechaEmision.getTime()>ultimoDiaMes.getTime()){
        htmlError = htmlError + 'La Fecha de Emisión no debe ser mayor que '+$("#ultimoDiaMes").val()+'<br/>';
    }

    if(fechaRegistro.getTime()<fechaEmision.getTime()){
        htmlError = htmlError + 'La Fecha de Registro debe ser mayor o igual a la Fecha de Emisión <br/>';
    }
    if(fechaRegistro.getTime()>ultimoDiaMes.getTime()){
        htmlError = htmlError + 'La Fecha de Registro no debe ser mayor que '+$("#ultimoDiaMes").val()+'<br/>';
    }

    if(fechaVencimiento.getTime()<fechaEmision.getTime()){
        htmlError = htmlError + 'La Fecha de Vencimiento debe ser mayor o igual que la fecha de Emisión <br/>';
    }

    if(fechaEmisionCompra.getTime()>fechaEmision.getTime()){
        htmlError = htmlError + 'La Fecha de la nota de crédito debe ser mayor a la fecha del documento de compra <br/>';
    }

    
    if($("#Compraingresocstm_fechavencimiento").val()==''){
        htmlError = htmlError + 'Ingresar Fecha Vence<br/>';
    }

    if($("#Compraingresocstm_pagadocompra").val()>=0){}
    else{
        $("#Compraingresocstm_pagadocompra").val('0');
    }


    if(parseFloat($("#Compraingresocstm_pagadocompra").val()) > parseFloat($("#txtSaldoDoc").val())){
        htmlError = htmlError + 'El valor pagado no debe ser mayor que el valor de la compra<br/>';
    }
    

    if(htmlError!=''){
        $("#validacion").html(htmlError);
        window.scrollTo(0,0);
    }else{

        document.formDevolucionCompra.submit();
    }


}