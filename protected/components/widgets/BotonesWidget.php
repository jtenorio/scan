<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package components.widgets
 */
class BotonesWidget extends CWidget {
	
        public $botones=array(
                    'save'=>array(
                        'name'=>'save',
                        'id'=>'save',
                        'image_name'=>'guardar',
                    ),
                    'modify'=>array(
                        'name'=>'modify',
                        'id'=>'modify',
                        'image_name'=>'modificar',
                    ),
                    'delete'=>array(
                       'name'=>'delete',
                       'id'=>'delete',
                       'image_name'=>'eliminar',
                    ),
                    'exit'=>array(
                        'name'=>'exit',
                        'id'=>'exit',
                        'image_name'=>'pdf'
                    )
                );

        /**/
        public $rules=array(
            'new'=>'',
            'save'=>'',
            'modify'=>'',
            'delete'=>'',
            'exit'=>'',
        );
        public $permitidos=array();
        public $path;
	public function init() {
                $this->path=Yii::app()->request->baseUrl;
		parent::init();
	}

	public function run() {
                parent::run();
                $data=array(
                    'botones'=>$this->botones,
                    'permitidos'=>$this->permitidos,
                    'path'=>$this->path,
                );
      	    $this->render('botones_view', $data);
	}

}
?>