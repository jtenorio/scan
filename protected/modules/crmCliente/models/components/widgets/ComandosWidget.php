<?php

/**
 * Componente que dibuja un cuadro con comandos utilizado para la acción actual
 * Requiere poner el parámetro comandos como un array de arrays donde cada elemento se formatea así:
 * 'titulo' => 'Comandos por defecto',
 * 'comandos' => array(
 *    array(nombre, url , 'access' => 'control_acceso', 'cond'=>boolean, 'options'=> opcionesHtml = array())
 * )
 * el url puede ser una cadena o array. access es opcional y tiene una lista de los perfiles u operaciones
 * requeridas. options es opcional y tiene un array de opciones extra para el link.
 * cond es una condición que define si se renderiza el link o no, opcional.
 * @author vsayajin
 * @package components.widgets
 */
class ComandosWidget extends CWidget {
	/**
	 * Arreglo de comandos para generar
	 * @var array 
	 */
	public $comandos = array();
	public $titulo = '';
	/**
	 * Nombre de la vista, por defecto "comandos_view"
	 * @var string
	 */
	public $view = 'comandos_view'; //comandos_view_horiz

        public $menu = NULL;
        
	public function init() {
		parent::init();
	}

	public function run() {
		parent::run();
		$acciones = array();
                $this->menu=array();
		foreach ($this->comandos as $key => $value) {
			if(is_string($value)){
				$acciones[] = $value;
				continue;
			}
			if (isset($value['cond'])) {
				if (!$value['cond'])
					continue;
			}

			$nombre = trim($value[0]);
			$link = $value[1];
			if (!is_array($link))
				$link = array($link);
			if (isset($value['access'])) {
				$roles = explode(',', $value['access']);
				$valid = false;
				foreach ($roles as $rol) {
					if (Yii::app()->user->checkAccess(trim($rol)))
						$valid = true;
				}
				if (!$valid)
					continue;
			}
			$options = isset($value['options']) ? $value['options'] : array();
                        
                        //modificado por Jtenorio
                        //es necesario q todos los menus sean procesados por:
//                        $this->widget('zii.widgets.CMenu', array(
//				'items'=>$this->menu,
//				'htmlOptions'=>array('class'=>'operations',),
//                                
//			));
                        
			$linkHtml = CHtml::link($nombre, $link, $options);
			$acciones[] = $linkHtml;
                        
                        $this->menu = array('label'=>$nombre, 'url'=>$link);
                        
                        
		}
		$this->render($this->view, array(
			'titulo' => $this->titulo,
			'acciones' => $acciones
		));
	}

}

?>
