<?php

/**
 * This is the model class for table "reunion".
 *
 * The followings are the available columns in table 'reunion':
 * @property integer $id
 * @property string $asunto
 * @property string $fecha_ingreso
 * @property string $fecha_modificacion
 * @property string $descripcion
 * @property string $lugar
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $fecha_fin_real
 * @property string $estado_reunion
 * @property integer $tiempo_recordatorio
 * @property string $padre_tipo
 * @property boolean $estado_sistema
 * @property integer $padre_id
 * @property integer $idusuario
 * @property integer $idequipo
 */
class Reunion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Reunion the static model class
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
		return 'reunion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('asunto', 'required'),
			array('tiempo_recordatorio, padre_id, idusuario, idequipo', 'numerical', 'integerOnly'=>true),
			array('asunto, padre_tipo', 'length', 'max'=>255),
			array('estado_reunion', 'length', 'max'=>36),
			array('fecha_ingreso, fecha_modificacion, descripcion, lugar, fecha_inicio, fecha_fin, fecha_fin_real, estado_sistema', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, asunto, fecha_ingreso, fecha_modificacion, descripcion, lugar, fecha_inicio, fecha_fin, fecha_fin_real, estado_reunion, tiempo_recordatorio, padre_tipo, estado_sistema, padre_id, idusuario, idequipo', 'safe', 'on'=>'search'),
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
			'asunto' => 'Asunto',
			'fecha_ingreso' => 'Fecha Ingreso',
			'fecha_modificacion' => 'Fecha Modificacion',
			'descripcion' => 'Descripcion',
			'lugar' => 'Lugar',
			'fecha_inicio' => 'Fecha Inicio',
			'fecha_fin' => 'Fecha Fin',
			'fecha_fin_real' => 'Fecha Fin Real',
			'estado_reunion' => 'Estado Reunion',
			'tiempo_recordatorio' => 'Tiempo Recordatorio',
			'padre_tipo' => 'Padre Tipo',
			'estado_sistema' => 'Estado Sistema',
			'padre_id' => 'Padre',
			'idusuario' => 'Idusuario',
			'idequipo' => 'Idequipo',
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
		$criteria->compare('asunto',$this->asunto,true);
		$criteria->compare('fecha_ingreso',$this->fecha_ingreso,true);
		$criteria->compare('fecha_modificacion',$this->fecha_modificacion,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('lugar',$this->lugar,true);
		$criteria->compare('fecha_inicio',$this->fecha_inicio,true);
		$criteria->compare('fecha_fin',$this->fecha_fin,true);
		$criteria->compare('fecha_fin_real',$this->fecha_fin_real,true);
		$criteria->compare('estado_reunion',$this->estado_reunion,true);
		$criteria->compare('tiempo_recordatorio',$this->tiempo_recordatorio);
		$criteria->compare('padre_tipo',$this->padre_tipo,true);
		$criteria->compare('estado_sistema',$this->estado_sistema);
		$criteria->compare('padre_id',$this->padre_id);
		$criteria->compare('idusuario',$this->idusuario);
		$criteria->compare('idequipo',$this->idequipo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}