<?php

/**
 * Sirve para llenar datos del catálogo a partir de un archivo de excel
 * @author vsayajin
 * @package components.carga
 */
class CargadorCatalogo extends CargadorExcel {

        
	/**
	 * Toma el path de un archivo de excel con el formato del catálogo, lo
	 * procesa y guarda los resultados en la tabla catálogo. Solo se toma en cuenta
	 * la primera hoja del libro de excel
	 * TODO: controles y validaciones de formato
	 * @param string $archivo
	 * @param boolean $guardar Si se guarda o no en la base, default true
	 */
	public function procesarArchivo($archivo) {
		$reader = new Spreadsheet_Excel_Reader();
		$reader->setOutputEncoding('ISO-8859-1');
		//$reader->setOutputEncoding('UTF-8');
		$reader->read($archivo);
		$lista = $this->procesarHoja($reader);
		return $lista;
	}
	
	public function procesarYGuardar($archivo) {
		$lista = $this->procesarArchivo($archivo);
		$this->guardarLista($lista);
		return $lista;
	}
	
	protected function procesarHoja(Spreadsheet_Excel_Reader $reader) {
		$hoja = $reader->sheets[0];
		$cells = $hoja["cells"];
		$rows = $hoja["numRows"];
		$cols = $hoja["numCols"];

		$mapa = array();
		$todos = Catalogo::model()->with('padre')->findAll();
		foreach($todos as $cat){
			$mapa[$cat->clase][$cat->codigo] = $cat;
		}
		$limite = $this->limite ? $this->limite : $rows;
		$lista = array();
		for ($i = 2; $i <= $limite; $i++) {
			$datos_row = $this->encodeRow($cells[$i]);
			$row = new CMap($datos_row);
			if ($this->filaVacia($row))
				break;
			$clase = $row[1];
			$codigo = $row[2];
			$cat = isset($mapa[$clase][$codigo]) ? $mapa[$clase][$codigo] : new Catalogo();
			$cat->clase = $clase;
			$cat->codigo = $codigo;
			$cat->valor = $row[3];
			$codpadre = $row[4];
			$cat->descripcion = $row[5];
			$cat->secuencia = $cat->codigo;
			$index[$cat->clase][$cat->codigo] = $cat;
			if ($codpadre) {
				$ix = $this->determinarPadre($cat->clase);
				if (isset($index[$ix][$codpadre])) {
					$padre = $index[$ix][$codpadre];
					$cat->padre = $padre;
					$sec = Catalogo::crearSecuencia($cat->codigo, $padre);
					if ($sec)
						$cat->secuencia = $sec;
				}
			}
			$lista[] = $cat;
		}
		return $lista;
	}
	
	function determinarPadre($clase){
		switch ($clase) {
			case 'provincia': return 'pais';
			case 'capital_provincia':
			case 'ciudad': 
				return 'provincia';
		}
		return '';
	}
	
	/**
	 * Toma una lista de objetos tipo Catálogo y los guarda en la base, enlazando padres e hijos si corresponde
	 * TODO: hacer que se compruebe los que esten en desorden para enlazar
	 * @param array $lista 
	 * @param boolean $update Si se debe comprobar que el codigo exista y actualizarlo o crear nuevos
	 */
	function guardarLista($lista) {
		$db = Yii::app()->getDb();
		$tx = $db->beginTransaction();
		/* @var $cat Catalogo */
		try {
			foreach ($lista as $cat) {
				if($cat->padre)
					$cat->padre_id = $cat->padre->id;
				$cat->save();
			}
			$tx->commit();
		} catch (Exception $ex) {
			$tx->rollback();
			throw $ex;
		}
	}
	
}

