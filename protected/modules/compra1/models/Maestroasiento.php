<?php

/**
 * This is the model class for table "maestroasiento".
 *
 * The followings are the available columns in table 'maestroasiento':
 * @property integer $idasiento
 * @property string $numeroasiento
 * @property string $periodocontable
 * @property string $cedularuc
 * @property string $beneficiario
 * @property string $fechacreacion
 * @property string $fechamodificacion
 * @property string $detalle
 * @property integer $iddocumento
 * @property string $numerodocumento
 * @property integer $idcuentabancaria
 * @property integer $idcomprobantecontable
 * @property string $numerocomprobante
 * @property boolean $estado
 * @property boolean $mayorizado
 * @property boolean $impreso
 * @property string $valormovimiento
 * @property string $referenciaadicional
 * @property boolean $asientocuadrado
 * @property integer $idempresa
 * @property integer $tipodecheque
 */
class Maestroasiento extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Maestroasiento the static model class
	 */
    public $nuevoNumeroAsiento;
    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'maestroasiento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('numerodocumento, numeroasiento,  beneficiario, fechacreacion, iddocumento, idcomprobantecontable, valormovimiento, idempresa', 'required'),
			array('iddocumento, idcuentabancaria, idcomprobantecontable, idempresa', 'numerical', 'integerOnly'=>true),
			array('numeroasiento, numerodocumento, numerocomprobante', 'length', 'max'=>10),
			array('periodocontable', 'length', 'max'=>4),
			array('cedularuc', 'length', 'max'=>13),
			array('beneficiario', 'length', 'max'=>80),
			array('detalle', 'length', 'max'=>254),
			array('valormovimiento', 'length', 'max'=>12),
			array('referenciaadicional', 'length', 'max'=>20),
			array('mayorizado, impreso, asientocuadrado', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idasiento, numeroasiento, periodocontable, cedularuc, beneficiario, fechacreacion, fechamodificacion, detalle, iddocumento, numerodocumento, idcuentabancaria, idcomprobantecontable, numerocomprobante, estado, mayorizado, impreso, valormovimiento, referenciaadicional, asientocuadrado, idempresa', 'safe', 'on'=>'search'),
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
			'idasiento' => 'Idasiento',
			'numeroasiento' => 'Numero de Asiento',
			'periodocontable' => 'Periodocontable',
			'cedularuc' => 'Cedularuc',
			'beneficiario' => 'Beneficiario',
			'fechacreacion' => 'Fechacreacion',
			'fechamodificacion' => 'Fechamodificacion',
			'detalle' => 'Detalle',
			'iddocumento' => 'Iddocumento',
			'numerodocumento' => 'Numerodocumento',
			'idcuentabancaria' => 'Idcuentabancaria',
			'idcomprobantecontable' => 'Idcomprobantecontable',
			'numerocomprobante' => 'Numerocomprobante',
			'estado' => 'Estado',
			'mayorizado' => 'Mayorizado',
			'impreso' => 'Impreso',
			'valormovimiento' => 'Valormovimiento',
			'referenciaadicional' => 'Referenciaadicional',
			'asientocuadrado' => 'Asientocuadrado',
			'idempresa' => 'Idempresa',
            'tipodecheque'=>'Tipo de cheque',
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

		$criteria->compare('idasiento',$this->idasiento);
		$criteria->compare('numeroasiento',$this->numeroasiento,true);
		$criteria->compare('periodocontable',$this->periodocontable,true);
		$criteria->compare('cedularuc',$this->cedularuc,true);
		$criteria->compare('beneficiario',$this->beneficiario,true);
		$criteria->compare('fechacreacion',$this->fechacreacion,true);
		$criteria->compare('fechamodificacion',$this->fechamodificacion,true);
		$criteria->compare('detalle',$this->detalle,true);
		$criteria->compare('iddocumento',$this->iddocumento);
		$criteria->compare('numerodocumento',$this->numerodocumento,true);
		$criteria->compare('idcuentabancaria',$this->idcuentabancaria);
		$criteria->compare('idcomprobantecontable',$this->idcomprobantecontable);
		$criteria->compare('numerocomprobante',$this->numerocomprobante,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('mayorizado',$this->mayorizado);
		$criteria->compare('impreso',$this->impreso);
		$criteria->compare('valormovimiento',$this->valormovimiento,true);
		$criteria->compare('referenciaadicional',$this->referenciaadicional,true);
		$criteria->compare('asientocuadrado',$this->asientocuadrado);
		$criteria->compare('idempresa',$this->idempresa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        
//        public function getNuevoNumeroAsiento()
//        {
//            $maxNumber = Yii::app()->db->createCommand()
//              ->select('max(numeroasiento) as max')
//              ->from('maestroasiento')
//              ->queryScalar();
//                      
//            return $maxNumber + 1;
//        }
        
        
        public function getAsientos($idEmpresa)
        {
            /**
             * @var CDbCriteria
             */
            $criteria=new CDbCriteria;
            $criteria->addCondition("tipodecheque is null or tipodecheque = 0");
            $criteria->compare('idempresa',$idEmpresa);
            
            return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
        }
        
        public function getChequesVarios($idEmpresa)
        {
            $criteria=new CDbCriteria;
            $criteria->compare('tipodecheque',4);
            $criteria->compare('idempresa',$idEmpresa);
            
            return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
        }

        
}