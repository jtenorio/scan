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

    var ultimoDiaMes = new Date($("#ultimoDiaMes").val());
    var fechaEmision = new Date($("#Compra_fechaemision").val());
    var fechaRegistro = new Date($("#Compra_fecharegistro").val());

    if(fechaEmision.getTime()>ultimoDiaMes.getTime()){
        htmlError = htmlError + 'La Fecha de Emisión no debe ser mayor que '+$("#ultimoDiaMes").val()+'<br/>';
    }

    if(fechaRegistro.getTime()<fechaEmision.getTime()){
        htmlError = htmlError + 'La Fecha de Registro debe ser mayor o igual a la Fecha de Emisión <br/>';
    }
    if(fechaRegistro.getTime()>ultimoDiaMes.getTime()){
        htmlError = htmlError + 'La Fecha de Registro no debe ser mayor que '+$("#ultimoDiaMes").val()+'<br/>';
    }

    if($("#Compraingresocstm_pagosrealizados").val()>0){}
    else{
        htmlError = htmlError + 'El número de pagos debe ser por lo menos 1 <br/>';
    }

    if($("#Compra_basecero").val()>0){}
    else{
        $("#Compra_basecero").val('0');
    }

    if($("#Compraingresocstm_saldocompra").val()>0){}
    else{
        htmlError = htmlError + 'Ingresar un valor válido para saldo <br/>';
    }

    if(htmlError!=''){
        $("#validacion").html(htmlError);
        window.scrollTo(0,0);
    }else{        
        document.formComprasAnteriores.submit();
    }
    

}