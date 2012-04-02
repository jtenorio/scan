<?php

/**
 * This is the model class for table "porcentajeiva".
 *
 * The followings are the available columns in table 'porcentajeiva':
 * @property integer $id
 * @property string $porcentaje
 * @property string $vigentedesde
 * @property string $vigentehasta
 * @property integer $cuentacontablecredito
 * @property integer $cuentacontablegasto
 * @property integer $cuentacontableventa
 * @property string $descripcion
 *
 * The followings are the available model relations:
 * @property Compraingreso[] $compraingresos
 */
class Porcentajeiva extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Porcentajeiva the static model class
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
		return 'porcentajeiva';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('porcentaje, vigentedesde, vigentehasta, descripcion', 'required'),
			array('cuentacontablecredito, cuentacontablegasto, cuentacontableventa', 'numerical', 'integerOnly'=>true),
			array('porcentaje', 'length', 'max'=>3),
			array('descripcion', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, porcentaje, vigentedesde, vigentehasta, cuentacontablecredito, cuentacontablegasto, cuentacontableventa, descripcion', 'safe', 'on'=>'search'),
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
			'compraingresos' => array(self::HAS_MANY, 'Compraingreso', 'idporcentajeiva'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'porcentaje' => 'Porcentaje',
			'vigentedesde' => 'Vigentedesde',
			'vigentehasta' => 'Vigentehasta',
			'cuentacontablecredito' => 'Cuentacontablecredito',
			'cuentacontablegasto' => 'Cuentacontablegasto',
			'cuentacontableventa' => 'Cuentacontableventa',
			'descripcion' => 'Descripcion',
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
		$criteria->compare('porcentaje',$this->porcentaje,true);
		$criteria->compare('vigentedesde',$this->vigentedesde,true);
		$criteria->compare('vigentehasta',$this->vigentehasta,true);
		$criteria->compare('cuentacontablecredito',$this->cuentacontablecredito);
		$criteria->compare('cuentacontablegasto',$this->cuentacontablegasto);
		$criteria->compare('cuentacontableventa',$this->cuentacontableventa);
		$criteria->compare('descripcion',$this->descripcion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}