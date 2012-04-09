<?php

/**
 * Representa un item del catalogo general del sistema
 *
 * @property integer $id
 * @property string $clase
 * @property string $codigo
 * @property string $valor
 * @property string $descripcion
 * @property string $secuencia
 * @property string $padre_id
 *
 * @property Catalogo $padre
 * 
 * @package models
 */
class Catalogo extends CActiveRecord {

	/**
	 * @param string $className
	 * @return Catalogo
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return "catalogo";
	}

	public function relations() {
		return array(
			'padre' => array(self::BELONGS_TO, 'Catalogo', 'padre_id'),
		);
	}

	public function rules() {
		return array(
			array('clase, codigo', 'required'),
			array('clase', 'length', 'max' => 45),
			array('codigo', 'length', 'max' => 20),
			array('valor', 'length', 'max' => 500),
			array('secuencia', 'length', 'max' => 100),
			array('clase, codigo, valor, secuencia, padre_id', 'safe'),
		);
	}

	public function search($pageSize=0) {
		$criteria = new CDbCriteria;
		$criteria->compare('clase', $this->clase, true);
		$criteria->compare('codigo', $this->codigo, true);
		$criteria->compare('valor', $this->valor, true);
		$criteria->compare('descripcion', $this->descripcion, true);
		$options = array('criteria' => $criteria);
		if ($pageSize > 0)
		$options['pagination']['pageSize'] = $pageSize;

		return new CActiveDataProvider(get_class($this), $options);
	}
	
	/**
	 * Retorna un mapa asociativo de una grupo de items del catálogo,
	 * organizado por codigo => valor
	 * @param string $clase
	 * @return array
	 */
	public function mapaValores($clase){
		$items = array();
		$lista = $this->findAllByAttributes(array('clase'=>$clase), array('order'=>'valor'));
		foreach($lista as $cat){
			$items[$cat->codigo] = $cat->valor;
		}
		return $items;
	}
	
	/**
	 * Consulta el valor de un item del catálogo
	 * @param string $clase
	 * @param string $codigo
	 * @return mixed el valor si se encontró o null si no
	 */
	public function recuperarValor($clase, $codigo){
		$op = array('clase'=>$clase, 'codigo'=>$codigo);
		$dato = $this->findByAttributes($op);
		return $dato ? $dato->valor : null;
	}
	
	/**
	 * Retorna una lista de ubicaciones del catálogo utilizando un feo select con multiples joins a la misma tabla
	 * para sacar filas con ids y valores de ciudad, provincia y pais. Si no se puede asociar la ciudad a una
	 * provincia, se trata de asociar con el pais en la columna pais2
	 * @param string $nombre
	 * @return array 
	 */
	public function buscarCiudad($nombre){
		$sql = "SELECT c.id,c.valor as ciudad,a1.valor as provincia, a2.valor as pais, a3.valor as pais2
		, c.codigo as cod_ciudad, a1.codigo as cod_provincia, a2.codigo as cod_pais, a3.codigo as cod_pais2
		FROM CATALOGO c left join CATALOGO a1 on c.padre_id = a1.id
		left join CATALOGO a2 on a1.padre_id = a2.id
		left join CATALOGO a3 on c.padre_id = a3.id and a3.clase = 'pais'
		where c.clase = 'ciudad' and c.valor like :nombre
		order by ciudad, provincia, pais";
		$db = Yii::app()->getDb();
		$cmd = $db->createCommand($sql);
		$nombre = "%$nombre%";
		$cmd->bindParam(':nombre', $nombre);
		return $cmd->queryAll();
	}

       /* public function borrar(){
            	$sql = "delete  from CATALOGO";
		$db = Yii::app()->getDb();
		$cmd = $db->createCommand($sql);
		//$nombre = "%$nombre%";
		//$cmd->bindParam(':nombre', $nombre);
		return $cmd->queryAll();
        }*/
	
	/**
	 * Prepara y retorna un CDbCriteria preparado para buscar actividades económicas dentro del catálogo
	 * con las siguientes reglas: 
	 * - el texto se busca usando un like <br>
	 * - ignora los items donde la descripción es 'no', es decir no tomar en cuenta
	 * - ordena primero por descripcion, que se asume numérica para items más freuentes, luego por nombre.
	 * @param string $texto texto a buscar dentro del valor del catalogo
	 * @return CDbCriteria 
	 */
	public function criterioBuscarActividad($texto){
		$crit = new CDbCriteria();
		$crit->addCondition("descripcion <> 'no' or descripcion is null");
		$crit->addCondition("clase = 'actividad'");
		if($texto != '') {
			$crit->addCondition('valor like :nombre');
			$crit->params['nombre'] = "%$texto%";
		}
		$crit->order = 'descripcion desc, valor asc';
		return $crit;
	}
	
	public function codigosPadres() {
		if (!$this->secuencia)
			return array();
		$codigos = explode('.', $this->secuencia);
		array_pop($codigos);
		return $codigos;
	}

	/**
	 * Crea una secuencia de códigos separados por punto (.) para representar
	 * la herencia del item del catálogo actual, similar al proverbial plan de cuentas
	 * @param string $codHijo
	 * @param mixed $padre código u objeto padre
	 * @return <type> string
	 */
	public static function crearSecuencia($codHijo, $padre) {
		if ($codHijo instanceof Catalogo)
			$codHijo = $codHijo->codigo;
		if ($padre instanceof Catalogo)
			$padre = $padre->secuencia;
		if (!$padre || !$codHijo)
			return null;
		return $padre . '.' . $codHijo;
	}

	/**
	 *
	 * @return Node Retorna las categorias estándar expresadas como un árbol 
	 */
	public static function categorias() {
		$pais = new Node('pais', 'Paises');
		$prov = new Node('provincia', 'Provincias');
		$ciudad = new Node('ciudad', 'Ciudades');
		$capital = new Node('capital_provincia', 'Capital de provincia');
		$actividad = new Node('actividad_economica', 'Actividades económicas');

		$pais->addChild($prov);
		$prov->addChild($ciudad);
		$prov->addChild($capital);

		$root = new Node('root');
		$root->addChild($pais);
		$root->addChild($actividad);

		return $root;
	}

}

/**
 * Representa un nodo dentro de la secuencia de herencia. Experimental
 */
class Node {

	public $codigo;
	public $desc;
	public $objeto;
	public $children = array();

	function __construct($codigo, $desc='') {
		$this->codigo = $codigo;
		$this->desc = $desc;
	}

	function addChild(Node $child) {
		$this->children[$child->codigo] = $child;
	}

	public function __toString() {
		return "$this->codigo : $this->desc";
	}

	function flatten() {
		foreach ($this->children as $child)
			$stack[] = array('', $child);

		$res = array();
		while (count($stack) > 0) {
			/* @var $node Node */
			list($padre, $node) = array_shift($stack);
			$key = $padre . $node->codigo;
			//$res[$key] = $node->desc;
			$res[$node->codigo] = $key;
			if ($node->children) :
				$rev = array_reverse($node->children);
				$pkey = $key . '.';
				foreach ($rev as $child)
					array_unshift($stack, array($pkey, $child));
			endif;
		}
		return $res;
	}

}

?>
