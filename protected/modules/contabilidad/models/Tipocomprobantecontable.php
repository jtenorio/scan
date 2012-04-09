<?php

/**
 * This is the model class for table "tipocomprobantecontable".
 *
 * The followings are the available columns in table 'tipocomprobantecontable':
 * @property integer $idcomprobantecontable
 * @property string $descripcion
 * @property string $numeracion
 * @property integer $idempresa
 */
class Tipocomprobantecontable extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Tipocomprobantecontable the static model class
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
		return 'tipocomprobantecontable';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descripcion, numeracion, idempresa', 'required'),
			array('idempresa', 'numerical', 'integerOnly'=>true),
			array('descripcion', 'length', 'max'=>60),
			array('numeracion', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idcomprobantecontable, descripcion, numeracion, idempresa', 'safe', 'on'=>'search'),
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
			'idcomprobantecontable' => 'Idcomprobantecontable',
			'descripcion' => 'Descripcion',
			'numeracion' => 'Numeracion',
			'idempresa' => 'Idempresa',
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

//		$criteria->compare('idcomprobantecontable',$this->idcomprobantecontable);
//		$criteria->compare('descripcion',$this->descripcion,true);
//		$criteria->compare('numeracion',$this->numeracion,true);
		$criteria->compare('idempresa',$this->idempresa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

         public static function updateNumeroComprobante($idComprobante)
        {
            $actual = Tipocomprobantecontable::model()->findByPk($idComprobante);
            $actual->numeracion = $actual->numeracion + 1;
            $actual->save();
        }
        
        public static function getNuevoNumeroComprobante($idComprobante)
        {
            $actual = Tipocomprobantecontable::model()->findByPk($idComprobante);
            return $actual->numeracion;
        }
    
}