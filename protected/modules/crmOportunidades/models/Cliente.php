<?php

/**
 * This is the model class for table "cliente".
 *
 * The followings are the available columns in table 'cliente':
 * @property integer $id
 * @property integer $tipodocumento
 * @property string $numerodocumento
 * @property string $nombrecompleto
 * @property string $fecha_ingreso
 * @property string $fecha_modificacion
 * @property string $tipocuenta
 * @property string $industria
 * @property string $telefono_oficina
 * @property string $fax
 * @property string $telefono_alternativo
 * @property string $direccion_facturacion
 * @property boolean $estado_sistema
 * @property integer $idusuario
 * @property integer $idequipo
 */
class Cliente extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cliente the static model class
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
		return 'cliente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipodocumento, numerodocumento, nombrecompleto, fecha_ingreso, fecha_modificacion, estado_sistema', 'required'),
			array('tipodocumento, idusuario, idequipo', 'numerical', 'integerOnly'=>true),
			array('numerodocumento', 'length', 'max'=>13),
			array('nombrecompleto', 'length', 'max'=>500),
			array('tipocuenta, industria', 'length', 'max'=>150),
			array('telefono_oficina, fax, telefono_alternativo', 'length', 'max'=>20),
			array('direccion_facturacion', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tipodocumento, numerodocumento, nombrecompleto, fecha_ingreso, fecha_modificacion, tipocuenta, industria, telefono_oficina, fax, telefono_alternativo, direccion_facturacion, estado_sistema, idusuario, idequipo', 'safe', 'on'=>'search'),
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
			'tipodocumento' => 'Tipodocumento',
			'numerodocumento' => 'Numerodocumento',
			'nombrecompleto' => 'Nombrecompleto',
			'fecha_ingreso' => 'Fecha Ingreso',
			'fecha_modificacion' => 'Fecha Modificacion',
			'tipocuenta' => 'Tipocuenta',
			'industria' => 'Industria',
			'telefono_oficina' => 'Telefono Oficina',
			'fax' => 'Fax',
			'telefono_alternativo' => 'Telefono Alternativo',
			'direccion_facturacion' => 'Direccion Facturacion',
			'estado_sistema' => 'Estado Sistema',
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
		$criteria->compare('tipodocumento',$this->tipodocumento);
		$criteria->compare('numerodocumento',$this->numerodocumento,true);
		$criteria->compare('nombrecompleto',$this->nombrecompleto,true);
		$criteria->compare('fecha_ingreso',$this->fecha_ingreso,true);
		$criteria->compare('fecha_modificacion',$this->fecha_modificacion,true);
		$criteria->compare('tipocuenta',$this->tipocuenta,true);
		$criteria->compare('industria',$this->industria,true);
		$criteria->compare('telefono_oficina',$this->telefono_oficina,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('telefono_alternativo',$this->telefono_alternativo,true);
		$criteria->compare('direccion_facturacion',$this->direccion_facturacion,true);
		$criteria->compare('estado_sistema',$this->estado_sistema);
		$criteria->compare('idusuario',$this->idusuario);
		$criteria->compare('idequipo',$this->idequipo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /**
         * Obtiene todos los clientes de la base de datos
         * @return \CActiveDataProvider 
         */
        public static function getAllCliente()
        {
                $criteria=new CDbCriteria;
                $criteria->addCondition("id >= 0");
                return new CActiveDataProvider(Cliente::model(), array(
                    'criteria'=>$criteria,                
                    ));
        }        
}