<?php

/**
 * This is the model class for table "codigoretencionfuente".
 *
 * The followings are the available columns in table 'codigoretencionfuente':
 * @property integer $idcodretfuente
 * @property string $codigo
 * @property string $descripcion
 * @property string $porcentaje
 * @property string $vigentedesde
 * @property string $vigentehasta
 * @property boolean $pormil
 * @property integer $cuentacontablecompras
 * @property integer $cuentacontableventas
 * @property integer $idcodigoporcentaje
 *
 * The followings are the available model relations:
 * @property Retencionescompra[] $retencionescompras
 * @property Porcentajeretencionfuente $idcodigoporcentaje0
 */
class CodigoRetencionFuente extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CodigoRetencionFuente the static model class
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
		return 'codigoretencionfuente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, descripcion, porcentaje, vigentedesde, vigentehasta, cuentacontablecompras, idcodigoporcentaje', 'required'),
			array('cuentacontablecompras, cuentacontableventas, idcodigoporcentaje', 'numerical', 'integerOnly'=>true),
			array('codigo', 'length', 'max'=>3),
			array('descripcion', 'length', 'max'=>80),
			array('porcentaje', 'length', 'max'=>8),
			array('pormil', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idcodretfuente, codigo, descripcion, porcentaje, vigentedesde, vigentehasta, pormil, cuentacontablecompras, cuentacontableventas, idcodigoporcentaje', 'safe', 'on'=>'search'),
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
			'retencionescompras' => array(self::HAS_MANY, 'Retencionescompra', 'idcodigoretencionfuente'),
			'idcodigoporcentaje0' => array(self::BELONGS_TO, 'Porcentajeretencionfuente', 'idcodigoporcentaje'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcodretfuente' => 'Idcodretfuente',
			'codigo' => 'Codigo',
			'descripcion' => 'Descripcion',
			'porcentaje' => 'Porcentaje',
			'vigentedesde' => 'Vigentedesde',
			'vigentehasta' => 'Vigentehasta',
			'pormil' => 'Pormil',
			'cuentacontablecompras' => 'Cuentacontablecompras',
			'cuentacontableventas' => 'Cuentacontableventas',
			'idcodigoporcentaje' => 'Idcodigoporcentaje',
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

		$criteria->compare('idcodretfuente',$this->idcodretfuente);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('porcentaje',$this->porcentaje,true);
		$criteria->compare('vigentedesde',$this->vigentedesde,true);
		$criteria->compare('vigentehasta',$this->vigentehasta,true);
		$criteria->compare('pormil',$this->pormil);
		$criteria->compare('cuentacontablecompras',$this->cuentacontablecompras);
		$criteria->compare('cuentacontableventas',$this->cuentacontableventas);
		$criteria->compare('idcodigoporcentaje',$this->idcodigoporcentaje);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}