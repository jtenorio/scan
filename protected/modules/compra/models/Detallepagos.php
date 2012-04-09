<?php

/**
 * This is the model class for table "detallepagos".
 *
 * The followings are the available columns in table 'detallepagos':
 * @property integer $id
 * @property integer $idcompra
 * @property string $valor
 * @property string $saldo
 * @property string $fecha
 * @property boolean $estado
 * @property integer $idasiento
 *
 * The followings are the available model relations:
 * @property Compraingreso $idcompra0
 */
class Detallepagos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Detallepagos the static model class
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
		return 'detallepagos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idcompra, valor, saldo, fecha, estado', 'required'),
			array('idcompra, idasiento', 'numerical', 'integerOnly'=>true),
			array('valor, saldo', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idcompra, valor, saldo, fecha, estado, idasiento', 'safe', 'on'=>'search'),
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
			'idcompra0' => array(self::BELONGS_TO, 'Compraingreso', 'idcompra'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idcompra' => 'Idcompra',
			'valor' => 'Valor',
			'saldo' => 'Saldo',
			'fecha' => 'Fecha',
			'estado' => 'Estado',
			'idasiento' => 'Idasiento',
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
		$criteria->compare('idcompra',$this->idcompra);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('saldo',$this->saldo,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('idasiento',$this->idasiento);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        public function buscaPagos($idCompra){
            if($idCompra==null)
                return '';

            $model=$this->model()->findAll(
                    array(
                    'condition' => '"idcompra" = :id',
                    'params' => array(
                            ':id' => $idCompra
                    )));
            if($model!=null){
                return ($model);
            }else
                return '';
        }
}