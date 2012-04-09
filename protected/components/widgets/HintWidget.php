<?php
/**
 * Crea html y javascript con un 'hint' o ayuda rápida que se muestra mientras se mantiene el mouse
 * sobre la imagen. El div que tiene el texto tiene la clase css 'hint' 
 * Las propiedades que se pueden cambiar son: <br>
 * text : Texto del hint <br>
 * delay : Tiempo que se demora entre apariciones, default 100 <br>
 * iconFolder : carpeta de los iconos, default /images/icons <br>
 * icon : nombre del icono, default information.png <br>
 * effect : Efecto de aparicion, puede ser 'fade' o 'normal' <br>
 *
 * @author vsayajin
 * @package components.widgets
 */
class HintWidget extends CWidget{
	/**
	 * @var string Texto o html a desplegar
	 */
	public $text = 'Hint';
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
		
		$imgid = 'yt_imghint_'.self::$count;
		$id = 'yt_hint_'.self::$count;
		
		$imgHtml = CHtml::image($path, 'Hint', array('id'=>$imgid));
		$hover = "\n";
		if($this->effect == 'fade')
			$hover .= '$("#{img_id}").hover(function(){$("#{id}").fadeIn(100);}, function(){$("#{id}").fadeOut(100);});';
		else
			$hover .= '$("#{img_id}").hover(function(){$("#{id}").show();}, function(){$("#{id}").hide();});';
		$hover = str_replace(array('{img_id}','{id}', '{delay}'), 
			array($imgid, $id, $this->delay), $hover);
		Yii::app()->clientScript->registerScript('hint'.self::$count, $hover);
		
		$this->render('hint_view', array(
			'imgHtml' => $imgHtml,
			'id' => $id,
			'text' => $this->text
		));
	}
	
}

?>
