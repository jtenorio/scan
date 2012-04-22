<?php

/**
 * This is the model class for table "documento".
 *
 * The followings are the available columns in table 'documento':
 * @property integer $id
 * @property string $nombre
 * @property string $fechaingreso
 * @property string $fechamodificacion
 * @property string $tipodocumento
 * @property string $estadodocumento
 * @property string $categoria
 * @property string $subcategoria
 * @property string $fechapublicacion
 * @property string $fechacaducidad
 * @property integer $idusuario
 * @property integer $idequipo
 */
class Documento extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Documento the static model class
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
		return 'documento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idusuario, idequipo', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>255),
			array('tipodocumento, estadodocumento, categoria, subcategoria', 'length', 'max'=>60),
			array('fechaingreso, fechamodificacion, fechapublicacion, fechacaducidad', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, fechaingreso, fechamodificacion, tipodocumento, estadodocumento, categoria, subcategoria, fechapublicacion, fechacaducidad, idusuario, idequipo', 'safe', 'on'=>'search'),
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
			'nombre' => 'Nombre',
			'fechaingreso' => 'Fechaingreso',
			'fechamodificacion' => 'Fechamodificacion',
			'tipodocumento' => 'Tipodocumento',
			'estadodocumento' => 'Estadodocumento',
			'categoria' => 'Categoria',
			'subcategoria' => 'Subcategoria',
			'fechapublicacion' => 'Fechapublicacion',
			'fechacaducidad' => 'Fechacaducidad',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('fechaingreso',$this->fechaingreso,true);
		$criteria->compare('fechamodificacion',$this->fechamodificacion,true);
		$criteria->compare('tipodocumento',$this->tipodocumento,true);
		$criteria->compare('estadodocumento',$this->estadodocumento,true);
		$criteria->compare('categoria',$this->categoria,true);
		$criteria->compare('subcategoria',$this->subcategoria,true);
		$criteria->compare('fechapublicacion',$this->fechapublicacion,true);
		$criteria->compare('fechacaducidad',$this->fechacaducidad,true);
		$criteria->compare('idusuario',$this->idusuario);
		$criteria->compare('idequipo',$this->idequipo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
  
    public static function getAll()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition("id>=0");
        return new CActiveProvider(Documento::model(),array(
			'criteria'=>$criteria,));
    }

}