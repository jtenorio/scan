<?php

Yii::import('application.vendors.excel_reader2', true);

/**
 * Representación abstracta de un libro de Excel para lectura, usando la tecnología que esté disponible
 *
 * @author vsayajin
 * @package components.carga
 */
class ExcelBook {

	public $file;
	public $sheet;
	public $sheet_name;
	public $sheet_num;
	public $reader;
	public $encoding = 'ISO-8859-1';
	public $use_utf8 = true;
	protected $_sheetNames = array();

	public function __construct($file = '') {
		if ($file) {
			$this->open($file);
		}
	}

	/**
	 * Abre un archivo de Excel para su procesamiento
	 * @param string $file 
	 */
	public function open($file) {
		$this->file = $file;
		$reader = new Spreadsheet_Excel_Reader();
		$reader->setOutputEncoding($this->encoding);
		$reader->read($file);
		$this->reader = $reader;
		$this->setSheet(0);
		$this->_sheetNames = array();
		foreach ($this->reader->boundsheets as $key => $value) {
			$this->_sheetNames[] = $value['name'];
		}
	}

	/**
	 * Selecciona una hoja dentro del libro para utilizar
	 * @param integer/string $sheet Número de la hoja
	 */
	public function setSheet($sheet) {
		$num = false;
		if (is_int($sheet)) {
			if (isset($this->reader->sheets[$sheet]))
				$num = $sheet;
		} elseif (is_string($sheet)) {
			$num = array_search($sheet, $this->_sheetNames);
		} else
			throw new Exception("sheet must be integer or string");
		if($num === false)
			return $false;

		$this->sheet_num = $num;
		$this->sheet_name = $this->reader->boundsheets[$sheet]['name'];
		$this->sheet = $this->reader->sheets[$sheet];
		return true;
	}

	/**
	 * Retorna los nombres de las hojas dentro del libro actual como un array
	 * @return array nombres de las hojas
	 */
	public function sheetNames() {
		return array_values($this->_sheetNames);
	}

	public function getNumRows() {
		return $this->sheet['numRows'];
	}

	public function getNumCols() {
		return $this->sheet['numCols'];
	}

	public function getCells() {
		return $this->sheet['cells'];
	}

	/**
	 * Retorna una fila del libro tomando en cuenta la codificación y 
	 * rellenando si es necesario hasta un número determinado.
	 * NOTA: si usa fill, los índices del array se ponen desde 0
	 * @param integer $num
	 * @param integer $fill opcional, número para rellenar
	 * @return array 
	 */
	public function getRow($num, $fill = null) {
		$row = @$this->sheet['cells'][$num];
		if (!$row)
			return array();
		$ret = new CMap();
		foreach ($row as $key => $value) {
			if (is_float($value) || is_int($value))
				$ret[$key] = $value;
			else {
				$val = trim($value);
				$ret[$key] = $val && $this->use_utf8 ? utf8_encode($val) : $val;
			}
		}
		if ($fill > 0 && count($ret) < $fill) {
			$ret = array_pad($ret, $fill, null);
		}
		return $ret;
	}

	/**
	 * Comprueba si la fila está vacía
	 * @param integer/array $row
	 * @return boolean
	 */
	public function isRowEmpty($row) {
		if(is_int($row))
			$row = $this->sheet['cells'][$row];
		foreach ($row as $value) {
			$v = $value . '';
			if ($value != '')
				return false;
		}
		return true;
	}
	
}

?>
