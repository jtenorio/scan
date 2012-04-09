<?php

/**
 * This is the model class for table "tablaprecios".
 *
 * The followings are the available columns in table 'tablaprecios':
 * @property integer $id
 * @property integer $iditem
 * @property string $cantidaddesde
 * @property string $cantidadhasta
 * @property string $valor
 * @property string $vigentedesde
 * @property string $vigentehasta
 * @property boolean $estado
 *
 * The followings are the available model relations:
 * @property Item $iditem0
 */
class Tablaprecios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TablaPrecios the static model class
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
		return 'tablaprecios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cantidaddesde, cantidadhasta, valor', 'required'),
			array('iditem', 'numerical', 'integerOnly'=>true),
			array('cantidaddesde, cantidadhasta, valor', 'length', 'max'=>10),
			array('vigentedesde, vigentehasta, estado', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, iditem, cantidaddesde, cantidadhasta, valor, vigentedesde, vigentehasta, estado', 'safe', 'on'=>'search'),
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
			'iditem0' => array(self::BELONGS_TO, 'Item', 'iditem'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'iditem' => 'Iditem',
			'cantidaddesde' => 'Cantidaddesde',
			'cantidadhasta' => 'Cantidadhasta',
			'valor' => 'Valor',
			'vigentedesde' => 'Vigentedesde',
			'vigentehasta' => 'Vigentehasta',
			'estado' => 'Estado',
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
		$criteria->compare('iditem',$this->iditem);
		$criteria->compare('cantidaddesde',$this->cantidaddesde,true);
		$criteria->compare('cantidadhasta',$this->cantidadhasta,true);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('vigentedesde',$this->vigentedesde,true);
		$criteria->compare('vigentehasta',$this->vigentehasta,true);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        /*
         * Acutaliza los estado de los precios
         */
        public function actualizar($ids=array(),$itemid=null){
                if(count($ids)>0){
                    $in="  id not in ('". implode("','",$ids) ."')";
                $sql="Update tablaprecios set estado=:estado where ".$in." and iditem=:iditem";
            	$db = Yii::app()->getDb();
		$cmd = $db->createCommand($sql);
		$estado = false;
		$cmd->bindParam(':estado', $estado);
                $cmd->bindParam(':iditem', $iditem);
                $cmd->execute();
                }


        }
        /*
         * Acutaliza los estado de los precios
         */
        public function eliminar($iditem){
              
                $sql="Update tablaprecios set estado=:estado where iditem=:iditem";
            	$db = Yii::app()->getDb();
		$cmd = $db->createCommand($sql);
		$estado = false;
		$cmd->bindParam(':estado', $estado);
                $cmd->bindParam(':iditem', $iditem);
                $cmd->execute();


        }
}