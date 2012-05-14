<?php

/**
 * This is the model class for table "oportunidad".
 *
 * The followings are the available columns in table 'oportunidad':
 * @property integer $id
 * @property string $nombre_oportunidad
 * @property string $fecha_creacion
 * @property string $fecha_modificacion
 * @property string $tomacontacto
 * @property double $cantidad_oportunidad
 * @property string $tipo_oportunidad
 * @property string $fecha_posiblecierre
 * @property string $fecha_realcierre
 * @property string $etapa_venta
 * @property integer $probabilidad
 * @property integer $cliente_id
 * @property boolean $estado_sistema
 * @property string $mediocontacto
 * @property string $detallecontacto
 *
 * The followings are the available model relations:
 * @property Cliente $cliente
 * @property Detalleproductos[] $detalleproductoses
 * @property Detalleoportunidad[] $detalleoportunidads
 */
class Oportunidad extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Oportunidad the static model class
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
		return 'oportunidad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_oportunidad, fecha_creacion, fecha_modificacion, cantidad_oportunidad, fecha_posiblecierre, etapa_venta, probabilidad, estado_sistema', 'required'),
			array('probabilidad, cliente_id', 'numerical', 'integerOnly'=>true),
			array('cantidad_oportunidad', 'numerical'),
			array('nombre_oportunidad, tomacontacto, tipo_oportunidad, etapa_venta', 'length', 'max'=>255),
			array('mediocontacto, detallecontacto', 'length', 'max'=>100),
			array('fecha_realcierre', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre_oportunidad, fecha_creacion, fecha_modificacion, tomacontacto, cantidad_oportunidad, tipo_oportunidad, fecha_posiblecierre, fecha_realcierre, etapa_venta, probabilidad, cliente_id, estado_sistema, mediocontacto, detallecontacto', 'safe', 'on'=>'search'),
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
			'cliente' => array(self::BELONGS_TO, 'Cliente', 'cliente_id'),
			'detalleproductoses' => array(self::HAS_MANY, 'Detalleproductos', 'oportunidad_id'),
			'detalleoportunidads' => array(self::HAS_MANY, 'Detalleoportunidad', 'parentid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre_oportunidad' => 'Nombre Oportunidad',
			'fecha_creacion' => 'Fecha Creacion',
			'fecha_modificacion' => 'Fecha Modificacion',
			'tomacontacto' => 'Tomacontacto',
			'cantidad_oportunidad' => 'Cantidad Oportunidad',
			'tipo_oportunidad' => 'Tipo Oportunidad',
			'fecha_posiblecierre' => 'Fecha Posiblecierre',
			'fecha_realcierre' => 'Fecha Realcierre',
			'etapa_venta' => 'Etapa Venta',
			'probabilidad' => 'Probabilidad',
			'cliente_id' => 'Cliente',
			'estado_sistema' => 'Estado Sistema',
			'mediocontacto' => 'Mediocontacto',
			'detallecontacto' => 'Detallecontacto',
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
		$criteria->compare('nombre_oportunidad',$this->nombre_oportunidad,true);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('fecha_modificacion',$this->fecha_modificacion,true);
		$criteria->compare('tomacontacto',$this->tomacontacto,true);
		$criteria->compare('cantidad_oportunidad',$this->cantidad_oportunidad);
		$criteria->compare('tipo_oportunidad',$this->tipo_oportunidad,true);
		$criteria->compare('fecha_posiblecierre',$this->fecha_posiblecierre,true);
		$criteria->compare('fecha_realcierre',$this->fecha_realcierre,true);
		$criteria->compare('etapa_venta',$this->etapa_venta,true);
		$criteria->compare('probabilidad',$this->probabilidad);
		$criteria->compare('cliente_id',$this->cliente_id);
		$criteria->compare('estado_sistema',$this->estado_sistema);
		$criteria->compare('mediocontacto',$this->mediocontacto,true);
		$criteria->compare('detallecontacto',$this->detallecontacto,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


    public static function getOportunidadesByCliente($idCliente)
    {
            $criteria=new CDbCriteria;
            $criteria->compare('cliente_id', $idCliente);

            return new CActiveDataProvider(Oportunidad::model(), array(
			'criteria'=>$criteria,
                ));
    }
}