<?php

/*
 * Widget que crea un campo auto complete basado en un recordset y el nombre del
 * campo en el formulario
 *
 * @author Jorge Tenorio
 * @version 1.0
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

    /**
     * id column in the data base
     * @var string
     */
    public $idColumn;

    /**
     * text to show in autocomplete field
     * @var string
     */
    public $nameColumn;

    public function init() {


    }

    public function run() {
        parent::run();
        $dataToShow = array();
        //Procesar y crear un arrgelo
        foreach($this->data->getData() as $row)
        {

            $index = $row->{$this->idColumn};
            $dataToShow[$index] = $row->{$this->nameColumn};
        }


        $this->render('autocompleteAjax_view', array(
            'data'=>$dataToShow,
            'fieldName'=>$this->fieldName,
            'ajaxFieldName'=>'autocomplete_'.$this->fieldId,
        ));

    }
}

