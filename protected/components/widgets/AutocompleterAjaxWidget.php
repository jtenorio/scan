<?php

/*
 * Widget que crea un campo auto complete basado en un recordset y el nombre del
 * campo en el formulario
 * 
 */


class AutocompleterAjaxWidget extends CWidget {
    
    /**
     * Arrgelo de los datos q componen el autocompletamiento
     * @var \CActiveDataProvider
     */
    public $data;
    
    /**
     * Id del feld que se va crear en el form
     * @var string
     */
    public $fieldId;
    
    /**
     * Nombre del field que se va a crear en el form
     * @var string
     */
    public $fieldName;
    
    
    public function init() {
        
        
    }
    
    public function run() {
        parent::run();
        
        $this->render('modelos_view', array(
            'data'=>$this->data,
            'fieldName'=>$this->fieldName,
            'ajaxFieldName'=>'ajaxInput_'.$this->fieldId,
        ));
        
    }
}

