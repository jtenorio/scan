<?php

/**
 * This is the model class for table "detallecompra".
 *
 * The followings are the available columns in table 'detallecompra':
 * @property integer $id
 * @property integer $idcompra
 * @property integer $iditembodega
 * @property string $cantidad
 * @property string $valorunitario
 * @property string $valortotal
 * @property integer $idtransaccioncompra
 * @property integer $idcentrocosto
 * @property integer $idempresa
 *
 * The followings are the available model relations:
 * @property Compraingreso $idcompra0
 * @property Itembodega $iditembodega0
 * @property Plancentrocosto $idcentrocosto0
 * @property Tipotransaccioncompra $idtransaccioncompra0
 */
class Detallecompra extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Detallecompra the static model class
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
		return 'detallecompra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idcompra, iditembodega, cantidad, valorunitario, valortotal, idtransaccioncompra, idempresa', 'required'),
			array('idcompra, iditembodega, idtransaccioncompra, idcentrocosto, idempresa', 'numerical', 'integerOnly'=>true),
			array('cantidad, valorunitario, valortotal', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idcompra, iditembodega, cantidad, valorunitario, valortotal, idtransaccioncompra, idcentrocosto, idempresa', 'safe', 'on'=>'search'),
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
			'idcompra0' => array(self::BELONGS_TO, 'Compraingreso', 'idcompra'),
			'iditembodega0' => array(self::BELONGS_TO, 'Itembodega', 'iditembodega'),
			'idcentrocosto0' => array(self::BELONGS_TO, 'Plancentrocosto', 'idcentrocosto'),
			'idtransaccioncompra0' => array(self::BELONGS_TO, 'Tipotransaccioncompra', 'idtransaccioncompra'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idcompra' => 'Idcompra',
			'iditembodega' => 'Iditembodega',
			'cantidad' => 'Cantidad',
			'valorunitario' => 'Valorunitario',
			'valortotal' => 'Valortotal',
			'idtransaccioncompra' => 'Idtransaccioncompra',
			'idcentrocosto' => 'Idcentrocosto',
			'idempresa' => 'Idempresa',
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
		$criteria->compare('idcompra',$this->idcompra);
		$criteria->compare('iditembodega',$this->iditembodega);
		$criteria->compare('cantidad',$this->cantidad,true);
		$criteria->compare('valorunitario',$this->valorunitario,true);
		$criteria->compare('valortotal',$this->valortotal,true);
		$criteria->compare('idtransaccioncompra',$this->idtransaccioncompra);
		$criteria->compare('idcentrocosto',$this->idcentrocosto);
		$criteria->compare('idempresa',$this->idempresa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}