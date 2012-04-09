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
        htmlError = htmlError + 'Ingresar Fecha de Vencimiento<br/>';
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

    if(($("#Compra_montobaseiva30").val()>0) || ($("#Compra_montobaseiva70").val()>0) || ($("#Compra_montobaseiva100").val()>0)){
        var suma = parseFloat($("#Compra_montobaseiva30").val()) + parseFloat($("#Compra_montobaseiva70").val()) + parseFloat($("#Compra_montobaseiva100").val());
        if(redondear(suma,2) != redondear(parseFloat($("#Compra_montoiva").val()),2)){
            htmlError = htmlError + 'El monto iva difiere de la suma de las bases de los montos a retener<br/>';
        }
    }

    var sumaBaseFuente = parseFloat($("#base_imponible_1").val()) + parseFloat($("#base_imponible_2").val()) + parseFloat($("#base_imponible_3").val()) + parseFloat($("#base_imponible_4").val()) + parseFloat($("#base_imponible_5").val()) + parseFloat($("#base_imponible_6").val());
    var sumaBaseImponible = parseFloat($("#Compra_basecero").val()) + parseFloat($("#Compra_basegravada").val()) + parseFloat($("#Compra_basenograva").val());
    if(redondear(sumaBaseFuente,2) != redondear(sumaBaseImponible,2)){
        htmlError = htmlError + 'La suma de las bases (0, 12, no objeto) debe ser igual a las bases imponibles de retención en fuente<br/>';
    }

    var ultimoDiaMes = new Date($("#ultimoDiaMes").val());
    var fechaEmision = new Date($("#Compra_fechaemision").val());
    var fechaRegistro = new Date($("#Compra_fecharegistro").val());
    var fechaVencimiento = new Date($("#Compra_fechacaduca").val());
    var fechaEmisionRetencion = new Date($("#Compra_fecharetencion1").val());

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
    
    if(fechaEmisionRetencion.getTime()<fechaRegistro.getTime()){
        htmlError = htmlError + 'La Fecha de Emisión de Retención debe ser mayor o igual que la fecha de Registro <br/>';
    }


    if($("#Compraingresocstm_fechavencimiento").val()==''){
        htmlError = htmlError + 'Ingresar Fecha Vence<br/>';
    }

    if($("#Compraingresocstm_pagadocompra").val()>=0){}
    else{
        $("#Compraingresocstm_pagadocompra").val('0');
    }

    if($("#Compraingresocstm_pagosrealizados").val()>0){}
    else{
        htmlError = htmlError + 'El número de pagos debe ser por lo menos 1 <br/>';
    }

    if($("#cod_ret_fuente_1").val()==''){
        htmlError = htmlError + 'Ingresar por lo menos un código de retención fuente<br/>';
    }

    if(($("#cod_ret_fuente_1").val() != '') && ($("#cod_ret_fuente_2").val() != ''))
        if($("#cod_ret_fuente_1").val()==$("#cod_ret_fuente_2").val()){
            htmlError = htmlError + 'Cod. Ret. Fuente Duplicados<br/>';
        }
    if(($("#cod_ret_fuente_1").val() != '') && ($("#cod_ret_fuente_3").val() != ''))
        if(($("#cod_ret_fuente_1").val()==$("#cod_ret_fuente_3").val())){
            htmlError = htmlError + 'Cod. Ret. Fuente Duplicados<br/>';
        }
    if(($("#cod_ret_fuente_1").val() != '') && ($("#cod_ret_fuente_4").val() != ''))
        if(($("#cod_ret_fuente_1").val()==$("#cod_ret_fuente_4").val())){
            htmlError = htmlError + 'Cod. Ret. Fuente Duplicados<br/>';
        }
    if(($("#cod_ret_fuente_1").val() != '') && ($("#cod_ret_fuente_5").val() != ''))
        if(($("#cod_ret_fuente_1").val()==$("#cod_ret_fuente_5").val())){
            htmlError = htmlError + 'Cod. Ret. Fuente Duplicados<br/>';
        }
    if(($("#cod_ret_fuente_1").val() != '') && ($("#cod_ret_fuente_6").val() != ''))
        if(($("#cod_ret_fuente_1").val()==$("#cod_ret_fuente_6").val())){
            htmlError = htmlError + 'Cod. Ret. Fuente Duplicados<br/>';
        }

    if(($("#cod_ret_fuente_2").val() != '') && ($("#cod_ret_fuente_3").val() != ''))
        if(($("#cod_ret_fuente_2").val()==$("#cod_ret_fuente_3").val())){
            htmlError = htmlError + 'Cod. Ret. Fuente Duplicados<br/>';
        }
    if(($("#cod_ret_fuente_2").val() != '') && ($("#cod_ret_fuente_4").val() != ''))
        if(($("#cod_ret_fuente_2").val()==$("#cod_ret_fuente_4").val())){
            htmlError = htmlError + 'Cod. Ret. Fuente Duplicados<br/>';
        }
    if(($("#cod_ret_fuente_2").val() != '') && ($("#cod_ret_fuente_5").val() != ''))
        if(($("#cod_ret_fuente_2").val()==$("#cod_ret_fuente_5").val())){
            htmlError = htmlError + 'Cod. Ret. Fuente Duplicados<br/>';
        }
    if(($("#cod_ret_fuente_2").val() != '') && ($("#cod_ret_fuente_6").val() != ''))
        if(($("#cod_ret_fuente_2").val()==$("#cod_ret_fuente_6").val())){
            htmlError = htmlError + 'Cod. Ret. Fuente Duplicados<br/>';
        }

    if(($("#cod_ret_fuente_3").val() != '') && ($("#cod_ret_fuente_4").val() != ''))
        if(($("#cod_ret_fuente_3").val()==$("#cod_ret_fuente_4").val())){
            htmlError = htmlError + 'Cod. Ret. Fuente Duplicados<br/>';
        }
    if(($("#cod_ret_fuente_3").val() != '') && ($("#cod_ret_fuente_5").val() != ''))
        if(($("#cod_ret_fuente_3").val()==$("#cod_ret_fuente_5").val())){
            htmlError = htmlError + 'Cod. Ret. Fuente Duplicados<br/>';
        }
    if(($("#cod_ret_fuente_3").val() != '') && ($("#cod_ret_fuente_6").val() != ''))
        if(($("#cod_ret_fuente_3").val()==$("#cod_ret_fuente_6").val())){
            htmlError = htmlError + 'Cod. Ret. Fuente Duplicados<br/>';
        }

    if(($("#cod_ret_fuente_4").val() != '') && ($("#cod_ret_fuente_5").val() != ''))
        if(($("#cod_ret_fuente_4").val()==$("#cod_ret_fuente_5").val())){
            htmlError = htmlError + 'Cod. Ret. Fuente Duplicados<br/>';
        }
    if(($("#cod_ret_fuente_4").val() != '') && ($("#cod_ret_fuente_6").val() != ''))
        if(($("#cod_ret_fuente_4").val()==$("#cod_ret_fuente_6").val())){
            htmlError = htmlError + 'Cod. Ret. Fuente Duplicados<br/>';
        }

    if(($("#cod_ret_fuente_5").val() != '') && ($("#cod_ret_fuente_6").val() != ''))
        if(($("#cod_ret_fuente_5").val()==$("#cod_ret_fuente_6").val())){
            htmlError = htmlError + 'Cod. Ret. Fuente Duplicados<br/>';
        }

    if(htmlError!=''){
        $("#validacion").html(htmlError);
        window.scrollTo(0,0);
    }else{
        
        document.formUpdate.submit();
    }
    

}