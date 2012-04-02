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
 * @property integer $idsubcategoria
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
 */
class Item extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Item the static model class
	 */
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
			array('idpresentacion, idcategoria, idsubcategoria, usarentipomovimiento, cuentacontablecompra, cuentacontableventa, cuentacontablecostoventa, cuentacontabledescuentoventa, cuentacontabledevolucionventa, tarifaiva', 'numerical', 'integerOnly'=>true),
			array('codigoproducto', 'length', 'max'=>60),
			array('nombre', 'length', 'max'=>120),
			array('costo, stock, stockminimo, preciopredefinido', 'length', 'max'=>10),
			array('imagen', 'length', 'max'=>150),
			array('estado, usatablaprecios', 'safe'),
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
			'id' => 'ID',
			'codigoproducto' => 'Codigoproducto',
			'nombre' => 'Nombre',
			'idpresentacion' => 'Idpresentacion',
			'idcategoria' => 'Idcategoria',
			'idsubcategoria' => 'Idsubcategoria',
			'costo' => 'Costo',
			'stock' => 'Stock',
			'stockminimo' => 'Stockminimo',
			'imagen' => 'Imagen',
			'preciopredefinido' => 'Preciopredefinido',
			'usarentipomovimiento' => 'Usarentipomovimiento',
			'cuentacontablecompra' => 'Cuentacontablecompra',
			'cuentacontableventa' => 'Cuentacontableventa',
			'cuentacontablecostoventa' => 'Cuentacontablecostoventa',
			'cuentacontabledescuentoventa' => 'Cuentacontabledescuentoventa',
			'cuentacontabledevolucionventa' => 'Cuentacontabledevolucionventa',
			'estado' => 'Estado',
			'usatablaprecios' => 'Usatablaprecios',
			'tarifaiva' => 'Tarifaiva',
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
		$criteria->compare('idsubcategoria',$this->idsubcategoria);
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
}