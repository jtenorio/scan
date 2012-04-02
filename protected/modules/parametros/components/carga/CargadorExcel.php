<?php

Yii::import('application.vendors.excel_reader2', true);

/**
 * Clase base para los cargadores de archivos
 *
 * @package components.carga
 */
class CargadorExcel {
	/**
	 * Si se debe forzar codificación utf-8 a los datos entrantes
	 * @var boolean
	 */
	public $encode = false;
	public $limite = 0;

	protected function filaVacia($row) {
		foreach ($row as $value) {
			$v = $value . '';
			if ($value != '')
				return false;
		}
		return true;
	}

	protected function encodeRow($row, $fill = null) {
		$ret = array();
		if (!$row)
			return $ret;
		foreach ($row as $key => $value) {
			if (is_float($value) || is_int($value))
				$ret[$key] = $value;
			else {
				$val = trim($value);
				$ret[$key] = $val && $this->encode ? utf8_encode($val) : $val;
			}
		}
		if($fill > 0 && count($ret) < $fill) {
			$ret = array_pad($ret, $fill, '');
		}
		return new CMap($ret);
	}
}

?>
