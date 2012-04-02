<?php

/**
 * This is the model class for table "documentosanulados".
 *
 * The followings are the available columns in table 'documentosanulados':
 * @property integer $id
 * @property string $mes
 * @property string $anio
 * @property integer $idcomprobante
 * @property string $establecimiento
 * @property string $puntoemision
 * @property string $desde
 * @property string $hasta
 * @property string $autorizacion
 * @property string $fecha
 * @property integer $cantidad
 * @property integer $idempresa
 */
class Documentosanulados extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Documentosanulados the static model class
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
		return 'documentosanulados';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mes, anio, idcomprobante, establecimiento, puntoemision, desde, hasta, autorizacion, fecha, cantidad, idempresa', 'required'),
			array('idcomprobante, cantidad, idempresa', 'numerical', 'integerOnly'=>true),
			array('mes', 'length', 'max'=>2),
			array('anio', 'length', 'max'=>4),
			array('establecimiento, puntoemision', 'length', 'max'=>3),
			array('desde, hasta', 'length', 'max'=>7),
			array('autorizacion', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, mes, anio, idcomprobante, establecimiento, puntoemision, desde, hasta, autorizacion, fecha, cantidad, idempresa', 'safe', 'on'=>'search'),
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
			'mes' => 'Mes',
			'anio' => 'Anio',
			'idcomprobante' => 'Idcomprobante',
			'establecimiento' => 'Establecimiento',
			'puntoemision' => 'Puntoemision',
			'desde' => 'Desde',
			'hasta' => 'Hasta',
			'autorizacion' => 'Autorizacion',
			'fecha' => 'Fecha',
			'cantidad' => 'Cantidad',
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
		$criteria->compare('mes',$this->mes,true);
		$criteria->compare('anio',$this->anio,true);
		$criteria->compare('idcomprobante',$this->idcomprobante);
		$criteria->compare('establecimiento',$this->establecimiento,true);
		$criteria->compare('puntoemision',$this->puntoemision,true);
		$criteria->compare('desde',$this->desde,true);
		$criteria->compare('hasta',$this->hasta,true);
		$criteria->compare('autorizacion',$this->autorizacion,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('cantidad',$this->cantidad);
		$criteria->compare('idempresa',$this->idempresa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}