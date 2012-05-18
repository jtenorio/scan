<?php

/**
 * This is the model class for table "llamada".
 *
 * The followings are the available columns in table 'llamada':
 * @property integer $id
 * @property string $asunto
 * @property string $fecha_ingreso
 * @property string $fecha_modificacion
 * @property string $descripcion
 * @property string $fecha_incio
 * @property string $fecha_fin
 * @property string $fecha_fin_real
 * @property string $estado_llamada
 * @property string $direccion_llamada
 * @property integer $tiempo_recordatorio
 * @property string $padre_tipo
 * @property boolean $estado_sistema
 * @property integer $padre_id
 */
class Llamada extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Llamada the static model class
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
		return 'llamada';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha_ingreso, fecha_modificacion, fecha_incio, fecha_fin, estado_llamada, direccion_llamada, estado_sistema', 'required'),
			array('tiempo_recordatorio, padre_id', 'numerical', 'integerOnly'=>true),
			array('asunto, padre_tipo', 'length', 'max'=>255),
			array('estado_llamada, direccion_llamada', 'length', 'max'=>36),
			array('descripcion, fecha_fin_real', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, asunto, fecha_ingreso, fecha_modificacion, descripcion, fecha_incio, fecha_fin, fecha_fin_real, estado_llamada, direccion_llamada, tiempo_recordatorio, padre_tipo, estado_sistema, padre_id', 'safe', 'on'=>'search'),
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
			'fecha_incio' => 'Fecha Incio',
			'fecha_fin' => 'Fecha Fin',
			'fecha_fin_real' => 'Fecha Fin Real',
			'estado_llamada' => 'Estado Llamada',
			'direccion_llamada' => 'Direccion Llamada',
			'tiempo_recordatorio' => 'Tiempo Recordatorio',
			'padre_tipo' => 'Padre Tipo',
			'estado_sistema' => 'Estado Sistema',
			'padre_id' => 'Padre',
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
		$criteria->compare('fecha_incio',$this->fecha_incio,true);
		$criteria->compare('fecha_fin',$this->fecha_fin,true);
		$criteria->compare('fecha_fin_real',$this->fecha_fin_real,true);
		$criteria->compare('estado_llamada',$this->estado_llamada,true);
		$criteria->compare('direccion_llamada',$this->direccion_llamada,true);
		$criteria->compare('tiempo_recordatorio',$this->tiempo_recordatorio);
		$criteria->compare('padre_tipo',$this->padre_tipo,true);
		$criteria->compare('estado_sistema',$this->estado_sistema);
		$criteria->compare('padre_id',$this->padre_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function getAllLlamadas($fecha,$id=NULL)
    {
            $criteria=new CDbCriteria;
            $criteria->addCondition("fecha_incio <= '$fecha'");
            $criteria->addCondition("fecha_fin >= '$fecha'");

            if(!is_null($id))
            {
                $criteria->compare('padre_id', $id);
            }
           
            return new CActiveDataProvider(Llamada::model(), array(
                'criteria'=>$criteria,
                ));
            
    }
}