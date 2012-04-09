<?php

/**
 * This is the model class for table "detalleordencompra".
 *
 * The followings are the available columns in table 'detalleordencompra':
 * @property integer $idordencompra
 * @property integer $iditem
 * @property integer $idempresa
 * @property string $cantidadsolicitada
 * @property string $valorunitario
 * @property integer $id
 * @property string $valortotal
 */
class Detalleordencompra extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Detalleordencompra the static model class
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
		return 'detalleordencompra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idempresa', 'required'),
			array('idordencompra, iditem, idempresa', 'numerical', 'integerOnly'=>true),
			array('cantidadsolicitada, valorunitario, valortotal', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idordencompra, iditem, idempresa, cantidadsolicitada, valorunitario, id, valortotal', 'safe', 'on'=>'search'),
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
			'idordencompra' => 'Idordencompra',
			'iditem' => 'Iditem',
			'idempresa' => 'Idempresa',
			'cantidadsolicitada' => 'Cantidadsolicitada',
			'valorunitario' => 'Valorunitario',
			'id' => 'ID',
			'valortotal' => 'Valortotal',
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

		$criteria->compare('idordencompra',$this->idordencompra);
		$criteria->compare('iditem',$this->iditem);
		$criteria->compare('idempresa',$this->idempresa);
		$criteria->compare('cantidadsolicitada',$this->cantidadsolicitada,true);
		$criteria->compare('valorunitario',$this->valorunitario,true);
		$criteria->compare('id',$this->id);
		$criteria->compare('valortotal',$this->valortotal,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}