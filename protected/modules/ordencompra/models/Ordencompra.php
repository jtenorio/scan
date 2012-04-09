<?php

/**
 * This is the model class for table "ordencompra".
 *
 * The followings are the available columns in table 'ordencompra':
 * @property integer $id
 * @property integer $idempresa
 * @property string $fechaingreso
 * @property string $detalle
 * @property string $estado
 * @property string $numeroorden
 * @property boolean $anulado
 * @property integer $idusuario
 * @property integer $idusuarioaprueba
 * @property string $fechaaprueba
 * @property integer $idproveedor
 */
class Ordencompra extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Ordencompra the static model class
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
		return 'ordencompra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idempresa, fechaingreso, estado, numeroorden, idusuario, idproveedor', 'required'),
			array('idempresa, idusuario, idusuarioaprueba, idproveedor', 'numerical', 'integerOnly'=>true),
			array('detalle', 'length', 'max'=>250),
			array('estado', 'length', 'max'=>15),
			array('numeroorden', 'length', 'max'=>10),
			array('anulado, fechaaprueba', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idempresa, fechaingreso, detalle, estado, numeroorden, anulado, idusuario, idusuarioaprueba, fechaaprueba, idproveedor', 'safe', 'on'=>'search'),
                        array('numeroorden', 'application.modules.ordencompra.extensions.uniqueMultiColumnValidator'),
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
			'idempresa' => 'Idempresa',
			'fechaingreso' => 'Fecha de ingreso',
			'detalle' => 'Detalle',
			'estado' => 'Estado',
			'numeroorden' => 'Número Orden',
			'anulado' => 'Anulado',
			'idusuario' => 'Usuario Crea',
			'idusuarioaprueba' => 'Usuario Aprueba',
			'fechaaprueba' => 'Fecha de Aprobación',
			'idproveedor' => 'Id. del Proveedor',
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
		$criteria->compare('idempresa',$this->idempresa);
		$criteria->compare('fechaingreso',$this->fechaingreso,true);
		$criteria->compare('detalle',$this->detalle,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('numeroorden',$this->numeroorden,true);
		$criteria->compare('anulado',$this->anulado);
		$criteria->compare('idusuario',$this->idusuario);
		$criteria->compare('idusuarioaprueba',$this->idusuarioaprueba);
		$criteria->compare('fechaaprueba',$this->fechaaprueba,true);
		$criteria->compare('idproveedor',$this->idproveedor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        /*
         * Devuelve un array de todos los campos que se van a mostrar en
         * el grid
         */
         public function columnasLista(){
            $gridlista=array(
                          array('name'=>'detalle','type'=>'raw','value'=>'CHtml::link($data->detalle,array("viewaprobar","id"=>$data->id))'),
                          'fechaingreso',
                          'estado',
                          'numeroorden',
            );

            return $gridlista;
        }
}