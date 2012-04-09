<?php

/**
 * This is the model class for table "tarjetacredito".
 *
 * The followings are the available columns in table 'tarjetacredito':
 * @property integer $id
 * @property string $nombre
 * @property string $direccion
 * @property string $telefono
 */
class Tarjetacredito extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Tarjetacredito the static model class
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
		return 'tarjetacredito';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, direccion, telefono', 'required'),
			array('nombre', 'length', 'max'=>50),
			array('direccion', 'length', 'max'=>120),
			array('telefono', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, direccion, telefono', 'safe', 'on'=>'search'),
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
			'id' => MessageHandler::transformar('id','Parametros','Tarjetacredito'),
			'nombre' => MessageHandler::transformar('nombre','Parametros','Tarjetacredito'),
			'direccion' => MessageHandler::transformar('direccion','Parametros','Tarjetacredito'),
			'telefono' => MessageHandler::transformar('telefono','Parametros','Tarjetacredito'),
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('telefono',$this->telefono,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function columnasLista(){
            $gridlista=array(

                
                array('name'=>'nombre','type'=>'raw','value'=>'CHtml::link($data->nombre,array("update","id"=>$data->id))'),
                'direccion',
                'telefono',
                
            );

            return $gridlista;
        }

}