function anularRetencion(){
    $("#Compra_montobaseiva30").val('0.00');
    $("#Compra_montobaseiva70").val('0.00');
    $("#Compra_montobaseiva100").val('0.00');
    $("#Compra_retencioniva30").val('0.00');
    $("#Compra_retenidoiva70").val('0.00');
    $("#Compra_retenidoiva100").val('0.00');
    $("#cod_ret_fuente_1").val('4');
    $("#cod_ret_fuente_2").val('');
    $("#cod_ret_fuente_3").val('');
    $("#cod_ret_fuente_4").val('');
    $("#cod_ret_fuente_5").val('');
    $("#cod_ret_fuente_6").val('');

    $("#base0_1").val($("#Compra_basecero").val());
    $("#base0_2").val('0.00');
    $("#base0_3").val('0.00');
    $("#base0_4").val('0.00');
    $("#base0_5").val('0.00');
    $("#base0_6").val('0.00');

    $("#base12_1").val($("#Compra_basegravada").val());
    $("#base12_2").val('0.00');
    $("#base12_3").val('0.00');
    $("#base12_4").val('0.00');
    $("#base12_5").val('0.00');
    $("#base12_6").val('0.00');

    $("#base_no_objeto_1").val($("#Compra_basenograva").val());
    $("#base_no_objeto_2").val('0.00');
    $("#base_no_objeto_3").val('0.00');
    $("#base_no_objeto_4").val('0.00');
    $("#base_no_objeto_5").val('0.00');
    $("#base_no_objeto_6").val('0.00');

    $("#porcentaje_retencion_1").val('0');
    $("#porcentaje_retencion_2").val('0');
    $("#porcentaje_retencion_3").val('0');
    $("#porcentaje_retencion_4").val('0');
    $("#porcentaje_retencion_5").val('0');
    $("#porcentaje_retencion_6").val('0');

    $("#valor_retenido_1").val('0.00');
    $("#valor_retenido_2").val('0.00');
    $("#valor_retenido_3").val('0.00');
    $("#valor_retenido_4").val('0.00');
    $("#valor_retenido_5").val('0.00');
    $("#valor_retenido_6").val('0.00');

    var baseImponible = parseFloat($("#Compra_basecero").val()) + parseFloat($("#Compra_basegravada").val()) + parseFloat($("#Compra_basenograva").val());

    $("#base_imponible_1").val(redondear(baseImponible,2));
    $("#base_imponible_2").val('0.00');
    $("#base_imponible_3").val('0.00');
    $("#base_imponible_4").val('0.00');
    $("#base_imponible_5").val('0.00');
    $("#base_imponible_6").val('0.00');
    
    $("#Compra_establecimientoretencion1").val('');
    $("#Compra_puntoemisionretencion1").val('');
    $("#Compra_secuencialretencion1").val('');
    $("#Compra_autorizacionretencion1").val('');
    $("#cod_ret_fuente_6").val('');
    
    var saldo = parseFloat($("#Compra_basecero").val()) + parseFloat($("#Compra_basegravada").val()) + parseFloat($("#Compra_basenograva").val()) + parseFloat($("#Compra_montoiva").val());

    $("#Compraingresocstm_saldocompra").val(redondear(saldo,2));
    $("#Compraingresocstm_pagosrealizados").val("1");
    generarPagos();

    if(confirm('¿Está seguro de anular la retención?'))
        document.formAnulaRetencion.submit();
}