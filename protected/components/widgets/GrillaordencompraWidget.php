<?php
/**
 * Simula una grilla editable
 *
 * @author vsayajin
 * @package components.widgets
 */
class GrillaordencompraWidget extends CWidget{
	/**
	 * @var string Texto o html a desplegar
	 */
	public $text = 'Hint';
        public $tipo = '';
	public $delay = 100;
	public $iconFolder = '/images/icons';
	public $icon = 'information.png';
	/**
	 * Efecto a usar en la aparición/desaparición del cuadro
	 * @var string
	 */
	public $effect = 'fade';
	
	/**
	 * Variable interna para llevar la cuenta de los widgets creados y generar ids
	 * @var integer
	 */
	private static $count = 0; 
	
	public function init() {
		parent::init();
	}

	public function run() {
		self::$count++;
		$root = Yii::app()->getRequest()->getBaseUrl();		
		$path = $root . $this->iconFolder . '/' .$this->icon;
		
		
		$this->render('grillaordencompra_view', array(
			'text' => $this->text,
                        'tipo' => $this->tipo
		));
	}
	
}

?>
