<?php

/**
 * This is the model class for table "tipodocumentocontable".
 *
 * The followings are the available columns in table 'tipodocumentocontable':
 * @property integer $iddocumento
 * @property string $descripcion
 * @property string $siglas
 * @property integer $tipocomprobante
 * @property boolean $numeraautomatico
 * @property string $numerodocumento
 * @property integer $idempresa
 */
class Tipodocumentocontable extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Tipodocumentocontable the static model class
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
		return 'tipodocumentocontable';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descripcion, siglas, tipocomprobante, idempresa', 'required'),
			array('tipocomprobante, idempresa', 'numerical', 'integerOnly'=>true),
			array('descripcion', 'length', 'max'=>60),
			array('siglas', 'length', 'max'=>3),
			array('numerodocumento', 'length', 'max'=>10),
			array('numeraautomatico', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('iddocumento, descripcion, siglas, tipocomprobante, numeraautomatico, numerodocumento, idempresa', 'safe', 'on'=>'search'),
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
			'iddocumento' => 'Iddocumento',
			'descripcion' => 'Descripcion',
			'siglas' => 'Siglas',
			'tipocomprobante' => 'Tipocomprobante',
			'numeraautomatico' => 'Numeraautomatico',
			'numerodocumento' => 'Numerodocumento',
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

		$criteria->compare('iddocumento',$this->iddocumento);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('siglas',$this->siglas,true);
		$criteria->compare('tipocomprobante',$this->tipocomprobante);
		$criteria->compare('numeraautomatico',$this->numeraautomatico);
		$criteria->compare('numerodocumento',$this->numerodocumento,true);
		$criteria->compare('idempresa',$this->idempresa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}