<?php

/**
 * This is the model class for table "detallepagoproveedor".
 *
 * The followings are the available columns in table 'detallepagoproveedor':
 * @property integer $id
 * @property integer $idproveedor
 * @property string $fechamovimiento
 * @property string $valormomimiento
 * @property string $saldocompra
 * @property string $tipopagocrdb
 * @property string $documentopago
 * @property string $fechahoragrabado
 * @property string $asientoreferencia
 * @property boolean $estado
 * @property integer $idperiodo
 *
 * The followings are the available model relations:
 * @property Periodocontrable $idperiodo0
 */
class Detallepagoproveedor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Detallepagoproveedor the static model class
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
		return 'detallepagoproveedor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idproveedor, fechamovimiento, valormomimiento, saldocompra, tipopagocrdb, documentopago, fechahoragrabado, asientoreferencia, estado, idperiodo', 'required'),
			array('idproveedor, idperiodo', 'numerical', 'integerOnly'=>true),
			array('valormomimiento, saldocompra, asientoreferencia', 'length', 'max'=>10),
			array('tipopagocrdb', 'length', 'max'=>2),
			array('documentopago', 'length', 'max'=>18),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idproveedor, fechamovimiento, valormomimiento, saldocompra, tipopagocrdb, documentopago, fechahoragrabado, asientoreferencia, estado, idperiodo', 'safe', 'on'=>'search'),
		);
        
        //return array();
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			//'idperiodo0' => array(self::BELONGS_TO, 'Periodocontrable', 'idperiodo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idproveedor' => 'Idproveedor',
			'fechamovimiento' => 'Fechamovimiento',
			'valormomimiento' => 'Valormomimiento',
			'saldocompra' => 'Saldocompra',
			'tipopagocrdb' => 'Tipopagocrdb',
			'documentopago' => 'Documentopago',
			'fechahoragrabado' => 'Fechahoragrabado',
			'asientoreferencia' => 'Asientoreferencia',
			'estado' => 'Estado',
			'idperiodo' => 'Idperiodo',
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
		$criteria->compare('idproveedor',$this->idproveedor);
		$criteria->compare('fechamovimiento',$this->fechamovimiento,true);
		$criteria->compare('valormomimiento',$this->valormomimiento,true);
		$criteria->compare('saldocompra',$this->saldocompra,true);
		$criteria->compare('tipopagocrdb',$this->tipopagocrdb,true);
		$criteria->compare('documentopago',$this->documentopago,true);
		$criteria->compare('fechahoragrabado',$this->fechahoragrabado,true);
		$criteria->compare('asientoreferencia',$this->asientoreferencia,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('idperiodo',$this->idperiodo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}