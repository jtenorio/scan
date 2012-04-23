<?php

/**
 * This is the model class for table "contacto".
 *
 * The followings are the available columns in table 'contacto':
 * @property integer $id
 * @property string $nombres
 * @property string $apellidos
 * @property string $fecha_ingreso
 * @property string $fecha_modificacion
 * @property string $telefono_oficina
 * @property string $telefono_celular
 * @property string $telefono_alternativo
 * @property string $fecha_cumpleanos
 * @property boolean $estado_sistema
 * @property string $tipodocumento
 * @property string $numerodocumento
 * @property integer $idcliente
 * @property integer $idequipo
 * @property integer $idusuario
 */
class Contacto extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contacto the static model class
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
		return 'contacto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('idcliente, idequipo, idusuario', 'numerical', 'integerOnly'=>true),
			array('nombres, apellidos', 'length', 'max'=>250),
			array('telefono_oficina, telefono_celular, telefono_alternativo', 'length', 'max'=>36),
			array('tipodocumento', 'length', 'max'=>20),
			array('numerodocumento', 'length', 'max'=>13),
			array('fecha_ingreso, fecha_modificacion, fecha_cumpleanos, estado_sistema', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombres, apellidos, fecha_ingreso, fecha_modificacion, telefono_oficina, telefono_celular, telefono_alternativo, fecha_cumpleanos, estado_sistema, tipodocumento, numerodocumento, idcliente, idequipo, idusuario', 'safe', 'on'=>'search'),
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
			'nombres' => 'Nombres',
			'apellidos' => 'Apellidos',
			'fecha_ingreso' => 'Fecha Ingreso',
			'fecha_modificacion' => 'Fecha Modificacion',
			'telefono_oficina' => 'Telefono Oficina',
			'telefono_celular' => 'Telefono Celular',
			'telefono_alternativo' => 'Telefono Alternativo',
			'fecha_cumpleanos' => 'Fecha Cumpleanos',
			'estado_sistema' => 'Estado Sistema',
			'tipodocumento' => 'Tipodocumento',
			'numerodocumento' => 'Numerodocumento',
			'idcliente' => 'Idcliente',
			'idequipo' => 'Idequipo',
			'idusuario' => 'Idusuario',
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
		$criteria->compare('nombres',$this->nombres,true);
		$criteria->compare('apellidos',$this->apellidos,true);
		$criteria->compare('fecha_ingreso',$this->fecha_ingreso,true);
		$criteria->compare('fecha_modificacion',$this->fecha_modificacion,true);
		$criteria->compare('telefono_oficina',$this->telefono_oficina,true);
		$criteria->compare('telefono_celular',$this->telefono_celular,true);
		$criteria->compare('telefono_alternativo',$this->telefono_alternativo,true);
		$criteria->compare('fecha_cumpleanos',$this->fecha_cumpleanos,true);
		$criteria->compare('estado_sistema',$this->estado_sistema);
		$criteria->compare('tipodocumento',$this->tipodocumento,true);
		$criteria->compare('numerodocumento',$this->numerodocumento,true);
		$criteria->compare('idcliente',$this->idcliente);
		$criteria->compare('idequipo',$this->idequipo);
		$criteria->compare('idusuario',$this->idusuario);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function getContactosByCliente($idCliente)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('idcliente',$idCliente);

        return new CActiveDataProvider(Contacto::model(), array(
        'criteria'=>$criteria,

            ));
    }
}