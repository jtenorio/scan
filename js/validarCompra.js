function validar(){
    var htmlError = '';
    if($("#tipo_identificacion").val()==''){
        htmlError = htmlError + 'Ingresar Tipo de Identificación<br/>';
    }

    if($("#proveedor").val()==''){
        htmlError = htmlError + 'Ingresar Proveedor<br/>';
    }

    if($("#tipo_comprobante").val()==''){
        htmlError = htmlError + 'Ingresar Tipo de Comprobante<br/>';
    }

    if($("#fecha_emision").val()==''){
        htmlError = htmlError + 'Ingresar Fecha de Emisión<br/>';
    }

    if($("#fecha_registro").val()==''){
        htmlError = htmlError + 'Ingresar Fecha de registro<br/>';
    }

    if($("#numero_serie1").val()==''){
        htmlError = htmlError + 'Ingresar Número de Serie<br/>';
    }

    if($("#numero_serie2").val()==''){
        htmlError = htmlError + 'Ingresar Número de Serie<br/>';
    }

    if($("#secuencial").val()==''){
        htmlError = htmlError + 'Ingresar Secuencial<br/>';
    }

    if($("#numero_autorizacion").val()==''){
        htmlError = htmlError + 'Ingresar No. Autorización<br/>';
    }

    if($("#fecha_vencimiento").val()==''){
        htmlError = htmlError + 'Ingresar Fecha de Vencimiento<br/>';
    }

    if($("#identificacion_credito").val()==''){
        htmlError = htmlError + 'Ingresar Identi. Crédito<br/>';
    }

    if($("#ubicacion_formulario_104").val()==''){
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

    if($("#base_imponible_ice").val()>0){}
    else{
        $("#base_imponible_ice").val('0');
        $("#monto_ice").val('0');
    }

    if(($("#iva_bienes_monto_iva").val()>0) || ($("#iva_servicios_monto_iva").val()>0) || ($("#iva_100_monto_iva").val()>0)){
        var suma = parseFloat($("#iva_bienes_monto_iva").val()) + parseFloat($("#iva_servicios_monto_iva").val()) + parseFloat($("#iva_100_monto_iva").val());        
        if(redondear(suma,2) != redondear(parseFloat($("#monto_iva").val()),2)){
            htmlError = htmlError + 'El monto iva difiere de la suma de las bases de los montos a retener<br/>';
        }
    }

    var sumaBaseFuente = parseFloat($("#base_imponible_1").val()) + parseFloat($("#base_imponible_2").val()) + parseFloat($("#base_imponible_3").val()) + parseFloat($("#base_imponible_4").val()) + parseFloat($("#base_imponible_5").val()) + parseFloat($("#base_imponible_6").val());
    var sumaBaseImponible = parseFloat($("#base_imponible").val()) + parseFloat($("#base_imponible_gravada").val()) + parseFloat($("#base_imponible_no_iva").val());
    if(redondear(sumaBaseFuente,2) != redondear(sumaBaseImponible,2)){
        htmlError = htmlError + 'La suma de las bases (0, 12, no objeto) debe ser igual a las bases imponibles de retención en fuente<br/>';
    }

    var ultimoDiaMes = new Date($("#ultimoDiaMes").val());
    var fechaEmision = new Date($("#fecha_emision").val());
    var fechaRegistro = new Date($("#fecha_registro").val());
    var fechaVencimiento = new Date($("#fecha_vencimiento").val());
    var fechaEmisionRetencion = new Date($("#fecha_emision_comprobante").val());

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
    

    if($("#noSecuencialComprobante").val()==''){
        htmlError = htmlError + 'Ingresar No. Secuencial del Comprobante de Retención<br/>';
    }

    if($("#fechaVence").val()==''){
        htmlError = htmlError + 'Ingresar Fecha Vence<br/>';
    }

    if($("#pagado").val()>=0){}
    else{
        $("#pagado").val('0');
    }

    if($("#numeroPagos").val()>0){}
    else{
        htmlError = htmlError + 'El número de pagos debe ser por lo menos 1 <br/>';
    }


    if(htmlError!=''){
        $("#validacion").html(htmlError);
        window.scrollTo(0,0);
    }else{
        document.form11.submit();
    }
    

}