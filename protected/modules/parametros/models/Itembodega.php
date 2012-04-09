<?php

/**
 * This is the model class for table "itembodega".
 *
 * The followings are the available columns in table 'itembodega':
 * @property integer $id
 * @property integer $iditem
 * @property integer $idbodega
 * @property string $stock
 * @property string $stockcomprometido
 * @property string $stockporllegar
 * @property integer $idempresa
 */
class Itembodega extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ItemBodega the static model class
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
		return 'itembodega';
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
			array('iditem, idbodega, idempresa', 'numerical', 'integerOnly'=>true),
			array('stock, stockcomprometido, stockporllegar', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, iditem, idbodega, stock, stockcomprometido, stockporllegar, idempresa', 'safe', 'on'=>'search'),
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
			'idbodega' => 'Idbodega',
			'stock' => 'Stock',
			'stockcomprometido' => 'Stockcomprometido',
			'stockporllegar' => 'Stockporllegar',
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
		$criteria->compare('iditem',$this->iditem);
		$criteria->compare('idbodega',$this->idbodega);
		$criteria->compare('stock',$this->stock,true);
		$criteria->compare('stockcomprometido',$this->stockcomprometido,true);
		$criteria->compare('stockporllegar',$this->stockporllegar,true);
		$criteria->compare('idempresa',$this->idempresa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}