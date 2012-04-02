<?php
 /**
 * @author josesambrano
 * @company B.O.S
 * @package messages
 */

class DatosEmpresa extends CComponent{


    /*
     * Devuelve los datos de la empresa
     * mas validaciones y mejoras
     * @param <integer> $empresa_id  Id de la empresa
     * @return Empresa
     * 
     */
    function datosGenerales($empresa_id=''){
        if(empty($empresa_id))
            return '';

        return Empresa::model()->findByPk($empresa_id);

    }
}

?>
