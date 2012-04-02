<?php

/**
 * This is the model class for table "item_cstm".
 *
 * The followings are the available columns in table 'item_cstm':
 * @property integer $id
 * @property integer $iditem
 * @property integer $idmodelo
 * @property integer $idmarca
 * @property string $numeroserie
 * @property string $ubicacion
 * @property string $codigobarras
 * @property string $estadoitemcalidad
 * @property string $detallenota
 */
class Itemcstm extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ItemCstm the static model class
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
		return 'item_cstm';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('iditem, idmodelo, idmarca', 'numerical', 'integerOnly'=>true),
			array('numeroserie', 'length', 'max'=>50),
			array('ubicacion, estadoitemcalidad', 'length', 'max'=>120),
			array('codigobarras, detallenota', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, iditem, idmodelo, idmarca, numeroserie, ubicacion, codigobarras, estadoitemcalidad, detallenota', 'safe', 'on'=>'search'),
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
			'iditem' => 'Iditem',
			'idmodelo' => 'Idmodelo',
			'idmarca' => 'Idmarca',
			'numeroserie' => 'Numeroserie',
			'ubicacion' => 'Ubicacion',
			'codigobarras' => 'Codigobarras',
			'estadoitemcalidad' => 'Estadoitemcalidad',
			'detallenota' => 'Detallenota',
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
		$criteria->compare('idmodelo',$this->idmodelo);
		$criteria->compare('idmarca',$this->idmarca);
		$criteria->compare('numeroserie',$this->numeroserie,true);
		$criteria->compare('ubicacion',$this->ubicacion,true);
		$criteria->compare('codigobarras',$this->codigobarras,true);
		$criteria->compare('estadoitemcalidad',$this->estadoitemcalidad,true);
		$criteria->compare('detallenota',$this->detallenota,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}