<?php

/**
 * This is the model class for table "item".
 *
 * The followings are the available columns in table 'item':
 * @property integer $id
 * @property string $codigoproducto
 * @property string $nombre
 * @property integer $idpresentacion
 * @property integer $idcategoria
 * @property string $costo
 * @property string $stock
 * @property string $stockminimo
 * @property string $imagen
 * @property string $preciopredefinido
 * @property integer $usarentipomovimiento
 * @property integer $cuentacontablecompra
 * @property integer $cuentacontableventa
 * @property integer $cuentacontablecostoventa
 * @property integer $cuentacontabledescuentoventa
 * @property integer $cuentacontabledevolucionventa
 * @property boolean $estado
 * @property boolean $usatablaprecios
 * @property integer $tarifaiva
 * @property integer $tipoproducto
 */
class Item extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Item the static model class
	 */
        public $maxSize = 5;

        public $tipos=array('1'=>'Bienes','2'=>'Servicios');

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigoproducto, nombre, usarentipomovimiento, tarifaiva', 'required'),
			array('id,idpresentacion, idcategoria, tipoproducto, usarentipomovimiento, cuentacontablecompra, cuentacontableventa, cuentacontablecostoventa, cuentacontabledescuentoventa, cuentacontabledevolucionventa, tarifaiva', 'numerical', 'integerOnly'=>true),
			array('codigoproducto', 'length', 'max'=>60),
                    	array('codigoproducto', 'unique'),
			array('nombre', 'length', 'max'=>120),
			array('costo, stock, stockminimo, preciopredefinido', 'length', 'max'=>10),
                        array('costo, stock, stockminimo, preciopredefinido', 'numerical'),
                        array('costo, stock, stockminimo, preciopredefinido', 'default','value'=>0),
			//array('stock, stockminimo', 'min'=>0),
			array('estado, usatablaprecios', 'safe'),
                        array('imagen', 'file',
                                'types' => 'jpg, gif, png, jpeg',
				'maxSize' => 1024 * 1024 * $this->maxSize,
				'tooLarge' => "El archivo es más grande de $this->maxSize MB. Por favor suba un archivo más pequeño.",
				'wrongType' => 'Tipo de archivo no soportado',
				'allowEmpty' => true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, codigoproducto, nombre, idpresentacion, idcategoria, idsubcategoria, costo, stock, stockminimo, imagen, preciopredefinido, usarentipomovimiento, cuentacontablecompra, cuentacontableventa, cuentacontablecostoventa, cuentacontabledescuentoventa, cuentacontabledevolucionventa, estado, usatablaprecios, tarifaiva', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => MessageHandler::transformar('id','Parametros','Item'),
			'codigoproducto' => MessageHandler::transformar('codigoproducto','Parametros','Item'),
			'nombre' => MessageHandler::transformar('nombre', 'Parametros', 'Item'),
			'idpresentacion' => MessageHandler::transformar('idpresentacion', 'Parametros', 'Item'),
			'idcategoria' => MessageHandler::transformar('idcategoria','Parametros','Item'),
			'tipoproducto' => MessageHandler::transformar('tipoproducto','Parametros','Item'),
			'costo' => MessageHandler::transformar('costo','Parametros','Item'),
			'stock' => MessageHandler::transformar('stock','Parametros','Item'),
			'stockminimo' => MessageHandler::transformar('stockminimo','Parametros','Item'),
			'imagen' => MessageHandler::transformar('imagen','Parametros','Item'),
			'preciopredefinido' => MessageHandler::transformar('preciopredefinido','Parametros','Item'),
			'usarentipomovimiento' => MessageHandler::transformar('usarentipomovimiento','Parametros','Item'),
			'cuentacontablecompra' => MessageHandler::transformar('cuentacontablecompra','Parametros','Item'),
			'cuentacontableventa' => MessageHandler::transformar('cuentacontableventa','Parametros','Item'),
			'cuentacontablecostoventa' => MessageHandler::transformar('cuentacontablecostoventa','Parametros','Item'),
			'cuentacontabledescuentoventa' => MessageHandler::transformar('cuentacontabledescuentoventa','Parametros','Item'),
			'cuentacontabledevolucionventa' => MessageHandler::transformar('cuentacontabledevolucionventa', 'Parametros', 'Item'),
			'estado' => MessageHandler::transformar('estado','Parametros','Item'),
			'usatablaprecios' => MessageHandler::transformar('usatablaprecios','Parametros','Item'),
			'tarifaiva' => MessageHandler::transformar('tarifaiva','Parametros','Item'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('codigoproducto',$this->codigoproducto,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('idpresentacion',$this->idpresentacion);
		$criteria->compare('idcategoria',$this->idcategoria);
		$criteria->compare('tipoproducto',$this->tipoproducto);
		$criteria->compare('costo',$this->costo,true);
		$criteria->compare('stock',$this->stock,true);
		$criteria->compare('stockminimo',$this->stockminimo,true);
		$criteria->compare('imagen',$this->imagen,true);
		$criteria->compare('preciopredefinido',$this->preciopredefinido,true);
		$criteria->compare('usarentipomovimiento',$this->usarentipomovimiento);
		$criteria->compare('cuentacontablecompra',$this->cuentacontablecompra);
		$criteria->compare('cuentacontableventa',$this->cuentacontableventa);
		$criteria->compare('cuentacontablecostoventa',$this->cuentacontablecostoventa);
		$criteria->compare('cuentacontabledescuentoventa',$this->cuentacontabledescuentoventa);
		$criteria->compare('cuentacontabledevolucionventa',$this->cuentacontabledevolucionventa);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('usatablaprecios',$this->usatablaprecios);
		$criteria->compare('tarifaiva',$this->tarifaiva);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        

        /*
         * Devuelve un array de todos los campos que se van a mostrar en
         * el grid , puede enviarse con un array simple o como multiples array
         *
         */
        public function columnasLista(){
            $gridlista=array(
                array('name'=>'codigoproducto','type'=>'raw','value'=>'CHtml::link($data->codigoproducto,array("update","id"=>$data->id))'),
                'nombre',
                'costo',
                'stock',
                'stockminimo',
            );

            return $gridlista;
        }
        /*
         * Busca el nombre de la imagen para que sea mostrada en el popup
         * @var <integer> id de item
         * @return <array> Unica fila de items
         */

        public function buscaImagen($id){
            if(empty($id))
                return '';
            
            $sql = "Select imagen from item where id=:id";
		$db = Yii::app()->getDb();
		$cmd = $db->createCommand($sql);
		$nombre = "$id";
		$cmd->bindParam(':id', $id);
		return $cmd->queryAll();
        }

        /*
         * Valida los tipos unicos de validacion
         */
        public function validaTipos($attribute, $params){
            if(!in_array($this->tipoproducto, $this->tipos))
                    $this->addError ('tipoproducto', 'No esta permitido el tipo de producto');

        }

}