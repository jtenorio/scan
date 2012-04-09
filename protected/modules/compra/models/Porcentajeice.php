<?php

/**
 * This is the model class for table "porcentajeice".
 *
 * The followings are the available columns in table 'porcentajeice':
 * @property integer $id
 * @property string $codigo
 * @property string $descripcion
 * @property string $porcentaje
 * @property string $vigentedesde
 * @property string $vigentehasta
 * @property integer $cuentacontable
 * @property integer $idempresa
 *
 * The followings are the available model relations:
 * @property Compraingreso[] $compraingresos
 */
class Porcentajeice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Porcentajeice the static model class
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
		return 'porcentajeice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, descripcion, porcentaje, vigentedesde, vigentehasta, cuentacontable', 'required'),
			array('cuentacontable, idempresa', 'numerical', 'integerOnly'=>true),
			array('codigo', 'length', 'max'=>4),
			array('descripcion', 'length', 'max'=>60),
			array('porcentaje', 'length', 'max'=>8),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, codigo, descripcion, porcentaje, vigentedesde, vigentehasta, cuentacontable, idempresa', 'safe', 'on'=>'search'),
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
			'compraingresos' => array(self::HAS_MANY, 'Compraingreso', 'idporcentajeice'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'codigo' => 'Codigo',
			'descripcion' => 'Descripcion',
			'porcentaje' => 'Porcentaje',
			'vigentedesde' => 'Vigentedesde',
			'vigentehasta' => 'Vigentehasta',
			'cuentacontable' => 'Cuentacontable',
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
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('porcentaje',$this->porcentaje,true);
		$criteria->compare('vigentedesde',$this->vigentedesde,true);
		$criteria->compare('vigentehasta',$this->vigentehasta,true);
		$criteria->compare('cuentacontable',$this->cuentacontable);
		$criteria->compare('idempresa',$this->idempresa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}