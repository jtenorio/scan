<?php

/**
 * This is the model class for table "tarea".
 *
 * The followings are the available columns in table 'tarea':
 * @property integer $id
 * @property string $nombre_tarea
 * @property string $fecha_ingreso
 * @property string $fecha_modificacion
 * @property string $descripcion
 * @property integer $bandera_fecha_fin
 * @property string $fecha_fin
 * @property string $fecha_inicio
 * @property string $padre_tipo
 * @property boolean $estado_sistema
 * @property string $fecha_real_fin
 * @property integer $padre_id
 * @property integer $idusuario
 * @property integer $idequipo
 */
class Tarea extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tarea the static model class
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
		return 'tarea';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_tarea, fecha_ingreso, fecha_modificacion, fecha_fin, fecha_inicio, estado_sistema', 'required'),
			array('bandera_fecha_fin, padre_id, idusuario, idequipo', 'numerical', 'integerOnly'=>true),
			array('nombre_tarea', 'length', 'max'=>36),
			array('padre_tipo', 'length', 'max'=>255),
			array('descripcion, fecha_real_fin', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre_tarea, fecha_ingreso, fecha_modificacion, descripcion, bandera_fecha_fin, fecha_fin, fecha_inicio, padre_tipo, estado_sistema, fecha_real_fin, padre_id, idusuario, idequipo', 'safe', 'on'=>'search'),
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
			'nombre_tarea' => 'Nombre Tarea',
			'fecha_ingreso' => 'Fecha Ingreso',
			'fecha_modificacion' => 'Fecha Modificacion',
			'descripcion' => 'Descripcion',
			'bandera_fecha_fin' => 'Bandera Fecha Fin',
			'fecha_fin' => 'Fecha Fin',
			'fecha_inicio' => 'Fecha Inicio',
			'padre_tipo' => 'Padre Tipo',
			'estado_sistema' => 'Estado Sistema',
			'fecha_real_fin' => 'Fecha Real Fin',
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
		$criteria->compare('nombre_tarea',$this->nombre_tarea,true);
		$criteria->compare('fecha_ingreso',$this->fecha_ingreso,true);
		$criteria->compare('fecha_modificacion',$this->fecha_modificacion,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('bandera_fecha_fin',$this->bandera_fecha_fin);
		$criteria->compare('fecha_fin',$this->fecha_fin,true);
		$criteria->compare('fecha_inicio',$this->fecha_inicio,true);
		$criteria->compare('padre_tipo',$this->padre_tipo,true);
		$criteria->compare('estado_sistema',$this->estado_sistema);
		$criteria->compare('fecha_real_fin',$this->fecha_real_fin,true);
		$criteria->compare('padre_id',$this->padre_id);
		$criteria->compare('idusuario',$this->idusuario);
		$criteria->compare('idequipo',$this->idequipo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}