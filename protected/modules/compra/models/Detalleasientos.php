<?php

/**
 * This is the model class for table "detalleasientos".
 *
 * The followings are the available columns in table 'detalleasientos':
 * @property integer $id
 * @property integer $idasiento
 * @property integer $cuentacontable
 * @property string $valordebe
 * @property string $valorhaber
 * @property string $subdetalle
 * @property integer $idempresa
 */
class Detalleasientos extends CActiveRecord
{
    
        public $nombrecuenta;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @return Detalleasientos the static model class
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
		return 'detalleasientos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idasiento, cuentacontable, idempresa,valordebe,valorhaber', 'required'),
			array('idasiento, cuentacontable, idempresa', 'numerical', 'integerOnly'=>true),
			array('valordebe, valorhaber', 'length', 'max'=>10),
			//array('subdetalle', 'length'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idasiento, cuentacontable, valordebe, valorhaber, subdetalle, idempresa', 'safe', 'on'=>'search'),
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
			'idasiento' => 'Idasiento',
			'cuentacontable' => 'Cuenta Contable',
			'valordebe' => 'Debe',
			'valorhaber' => 'Haber',
			'subdetalle' => 'Subdetalle',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('idasiento',$this->idasiento);
		$criteria->compare('cuentacontable',$this->cuentacontable);
		$criteria->compare('valordebe',$this->valordebe,true);
		$criteria->compare('valorhaber',$this->valorhaber,true);
		$criteria->compare('subdetalle',$this->subdetalle,true);
		$criteria->compare('idempresa',$this->idempresa);
                
                

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getAsientoDetalle($idMaestroAsiento)
    {
        $result = $this->findAllBySql("select pc.nombrecuenta,dt.* from plancuentasnec as pc, detalleasientos dt
            where dt.idasiento = $idMaestroAsiento and dt.cuentacontable = pc.idcuentanec");
        return $result;
    }

    public function deleteAllDetalleAsiento($idMaestroAsiento){
        $this->deleteAll("idasiento = $idMaestroAsiento");
    }
}