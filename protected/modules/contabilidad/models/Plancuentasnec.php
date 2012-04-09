<?php

/**
 * This is the model class for table "plancuentasnec".
 *
 * The followings are the available columns in table 'plancuentasnec':
 * @property integer $idcuentanec
 * @property string $cuentacontable
 * @property string $nombrecuenta
 * @property string $tipocuenta
 * @property string $nivelcuenta
 * @property integer $idcuentaniff
 * @property integer $idempresa
 */
class Plancuentasnec extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Plancuentasnec the static model class
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
		return 'plancuentasnec';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idcuentanec, cuentacontable, nombrecuenta, tipocuenta, nivelcuenta, idcuentaniff', 'required'),
			array('idcuentanec, idcuentaniff, idempresa', 'numerical', 'integerOnly'=>true),
			array('cuentacontable', 'length', 'max'=>40),
			array('nombrecuenta', 'length', 'max'=>120),
			array('tipocuenta', 'length', 'max'=>1),
			array('nivelcuenta', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idcuentanec, cuentacontable, nombrecuenta, tipocuenta, nivelcuenta, idcuentaniff, idempresa', 'safe', 'on'=>'search'),
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
			'idcuentanec' => 'Idcuentanec',
			'cuentacontable' => 'Cuentacontable',
			'nombrecuenta' => 'Nombrecuenta',
			'tipocuenta' => 'Tipocuenta',
			'nivelcuenta' => 'Nivelcuenta',
			'idcuentaniff' => 'Idcuentaniff',
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

		$criteria->compare('idcuentanec',$this->idcuentanec);
//		$criteria->compare('cuentacontable',$this->cuentacontable,true);
//		$criteria->compare('nombrecuenta',$this->nombrecuenta,true);
		$criteria->compare('tipocuenta',$this->tipocuenta,true);
//		$criteria->compare('nivelcuenta',$this->nivelcuenta,true);
//		$criteria->compare('idcuentaniff',$this->idcuentaniff);
//		$criteria->compare('idempresa',$this->idempresa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public static function getCuenta($idCuenta)
    {
        $result = Plancuentasnec::model()->findByPk($idCuenta);
        return $result;
    }
}