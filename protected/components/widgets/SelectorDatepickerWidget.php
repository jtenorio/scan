<?php

Yii::import('zii.widgets.jui.CJuiInputWidget');

/**
 * Control basado en CJuiDatePicker que permite aplicar el control a un selector jquery cualquiera.
 * Soporta internacionalización 
 *
 * @author vsayajin
 * @package components.widgets
 */
class SelectorDatepickerWidget extends CJuiInputWidget {
	/**
	 * @var string the locale ID (e.g. 'fr', 'de') for the language to be used by the date picker.
	 * If this property is not set, I18N will not be involved. That is, the date picker will show in English.
	 */
	public $language;
	
	/**
	 * @var string The i18n Jquery UI script file. It uses scriptUrl property as base url.
	 */
	public $i18nScriptFile = 'jquery-ui-i18n.min.js';
	
	/**
	 * @var array The default options called just one time per request. This options will alter every other CJuiDatePicker instance in the page.
	 * It has to be set at the first call of CJuiDatePicker widget in the request.
	 */
	public $defaultOptions;
	
	/**
	 * Selector jquery al cual aplicar el control DatePicker
	 * @var string Selector, por defecto 'input.date'
	 */
	public $selector = 'input.date';
	/**
	 * Define un nombre de función para volver a aplicar los settings del control 
	 * @var string 
	 */
	public $function;
	
	public function run() {
		if (!$this->selector)
			throw new Exception('El control SelectorDatepickerWidget necesita de un selector');
		$options = CJavaScript::encode($this->options);

		$js = "jQuery('{$this->selector}').datepicker($options);";

		if (isset($this->language)) {
			$this->registerScriptFile($this->i18nScriptFile);
			$js = "jQuery('{$this->selector}').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['{$this->language}'], {$options}));";
		}

		if (is_string($this->function)) {
			$func = "function {$this->function}() { " . $js . " }; {$this->function}(); ";
			$js = $func;
		}

		$cs = Yii::app()->getClientScript();
		$id = $this->getId(true);
		$cs->registerScript(__CLASS__, $this->defaultOptions ? 'jQuery.datepicker.setDefaults(' . CJavaScript::encode($this->defaultOptions) . ');' : '');
		$cs->registerScript(__CLASS__ . '#' . $id, $js);
	}

}

?>
