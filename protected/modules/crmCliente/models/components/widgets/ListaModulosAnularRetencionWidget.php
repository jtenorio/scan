<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.components.widgets
 */
class ListaModulosAnularRetencionWidget extends CWidget {

        public $columns=array();
        public $format_grid;
        public $model;
        public $id;
	public function init() {
                $this->format_grid=array(
                     'class'=>'CButtonColumn',
                     'template' => '{update}',
                );

		parent::init();
	}

	public function run() {
                parent::run();
                $this->columns=$this->model->columnasListaAnularRetencion();
                $this->columns[]=$this->format_grid;
                $data=array(
                    'columns'=>$this->columns,
                    'model'=>$this->model,
                    'id'=>$this->id,

                );
      	    $this->render('gridlista_view', $data);
	}

}
?>