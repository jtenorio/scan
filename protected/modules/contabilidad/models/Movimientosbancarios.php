<?php

/**
 * This is the model class for table "movimientosbancarios".
 *
 * The followings are the available columns in table 'movimientosbancarios':
 * @property integer $idmovimiento
 * @property integer $idcuentabancaria
 * @property integer $iddocumento
 * @property string $numerodocumento
 * @property string $beneficiario
 * @property string $detalle
 * @property string $valordebe
 * @property string $valorhaber
 * @property string $tipo
 * @property string $fechacreacion
 * @property string $fechaconcilia
 * @property integer $idempresa
 *
 * The followings are the available model relations:
 * @property Cuentasbancarias $idcuentabancaria0
 * @property Tipodocumentocontable $iddocumento0
 */
class Movimientosbancarios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Movimientosbancarios the static model class
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
		return 'movimientosbancarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idcuentabancaria, iddocumento, numerodocumento, detalle, tipo, fechacreacion, idempresa', 'required'),
			array('idcuentabancaria, iddocumento, idempresa', 'numerical', 'integerOnly'=>true),
			array('numerodocumento, valordebe, valorhaber', 'length', 'max'=>10),
			array('beneficiario', 'length', 'max'=>80),
			array('detalle', 'length', 'max'=>254),
			array('tipo', 'length', 'max'=>1),
			//array('fechaconcilia', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idmovimiento, idcuentabancaria, iddocumento, numerodocumento, beneficiario, detalle, valordebe, valorhaber, tipo, fechacreacion, fechaconcilia, idempresa', 'safe', 'on'=>'search'),
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
//		return array(
//			'idcuentabancaria0' => array(self::BELONGS_TO, 'Cuentasbancarias', 'idcuentabancaria'),
//			'iddocumento0' => array(self::BELONGS_TO, 'Tipodocumentocontable', 'iddocumento'),
//		);

            return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idmovimiento' => 'Idmovimiento',
			'idcuentabancaria' => 'Idcuentabancaria',
			'iddocumento' => 'Iddocumento',
			'numerodocumento' => 'Numerodocumento',
			'beneficiario' => 'Beneficiario',
			'detalle' => 'Detalle',
			'valordebe' => 'Valordebe',
			'valorhaber' => 'Valorhaber',
			'tipo' => 'Tipo',
			'fechacreacion' => 'Fechacreacion',
			'fechaconcilia' => 'Fechaconcilia',
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

		$criteria->compare('idmovimiento',$this->idmovimiento);
		$criteria->compare('idcuentabancaria',$this->idcuentabancaria);
		$criteria->compare('iddocumento',$this->iddocumento);
		$criteria->compare('numerodocumento',$this->numerodocumento,true);
		$criteria->compare('beneficiario',$this->beneficiario,true);
		$criteria->compare('detalle',$this->detalle,true);
		$criteria->compare('valordebe',$this->valordebe,true);
		$criteria->compare('valorhaber',$this->valorhaber,true);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('fechacreacion',$this->fechacreacion,true);
		$criteria->compare('fechaconcilia',$this->fechaconcilia,true);
		$criteria->compare('idempresa',$this->idempresa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}