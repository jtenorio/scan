<?php

class ComboFromArrayWidget extends CWidget {

    /**
     * key del arreglo que sedebe cargar
     * @var string
     */
    public $arrayKey;

    public $name;

    public $id;

    public $selectedValue;

    public $dependencia;

    public $dependenciaData;

    public function init() {

    }

    public function run() {
        parent::run();

        //obtener el archivo de arreglos
        $file = Yii::getPathOfAlias('application.data.combo').'.php';
        $loaded = include($file);

        $data = $loaded[$this->arrayKey];


        //crear el combo
        $this->render('comboFromArray_view', array(
                'data'=>$data,
                'name'=>$this->name,
                'id'=>$this->id,
                'selected' => $this->selectedValue,
                'dependencia'=>$this->dependencia,
                'dependenciaData'=>$this->dependenciaData,
            )
        );

    }

}