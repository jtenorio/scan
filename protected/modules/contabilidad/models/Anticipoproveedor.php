<?php

/**
 * This is the model class for table "anticipoproveedor".
 *
 * The followings are the available columns in table 'anticipoproveedor':
 * @property integer $id
 * @property integer $idasiento
 * @property string $fecha
 * @property string $numeroegreso
 * @property string $valoranticipo
 * @property string $pagadoanticipo
 * @property string $saldoanticipo
 * @property integer $idproveedor
 * @property integer $idempresa
 */
class Anticipoproveedor extends CActiveRecord
{
    
        public $cedularuc;
        public $razonsocial;
                
	/**
	 * Returns the static model of the specified AR class.
	 * @return Anticipoproveedor the static model class
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
		return 'anticipoproveedor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idempresa', 'required'),
			array('idasiento, idproveedor, idempresa', 'numerical', 'integerOnly'=>true),
			array('numeroegreso, valoranticipo, pagadoanticipo, saldoanticipo', 'length', 'max'=>10),
			array('fecha', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idasiento, fecha, numeroegreso, valoranticipo, pagadoanticipo, saldoanticipo, idproveedor, idempresa', 'safe', 'on'=>'search'),
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
			'fecha' => 'Fecha',
			'numeroegreso' => 'Numeroegreso',
			'valoranticipo' => 'Valoranticipo',
			'pagadoanticipo' => 'Pagadoanticipo',
			'saldoanticipo' => 'Saldoanticipo',
			'idproveedor' => 'Idproveedor',
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
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('numeroegreso',$this->numeroegreso,true);
		$criteria->compare('valoranticipo',$this->valoranticipo,true);
		$criteria->compare('pagadoanticipo',$this->pagadoanticipo,true);
		$criteria->compare('saldoanticipo',$this->saldoanticipo,true);
		$criteria->compare('idproveedor',$this->idproveedor);
		$criteria->compare('idempresa',$this->idempresa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    
    public static function getAnticiposByProveedor($idProveedor)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('idproveedor',$idProveedor);
        return new CActiveDataProvider(new Anticipoproveedor, array(
			'criteria'=>$criteria,
		));
    }
    
    
    public static function getAnticipoByAsiento($idAsiento)
    {
        $criteria=new CDbCriteria;
        $criteria->compare('idasiento',$idAsiento);
        return new CActiveDataProvider(new Anticipoproveedor, array(
			'criteria'=>$criteria,
		));
    }
    
    
    public function getAnticiposList($idEmpresa)
    {
        
        $sql="SELECT p.*,ap.* FROM proveedor p JOIN anticipoproveedor ap
            ON p.id = ap.idproveedor
            WHERE ap.idempresa = $idEmpresa";
        return new CSqlDataProvider($sql, array(            
            'sort'=>array(
                'attributes'=>array(
                     'fecha', 
                ),
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));
    }
    
}