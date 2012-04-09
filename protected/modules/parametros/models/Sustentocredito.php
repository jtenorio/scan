<?php

/**
 * This is the model class for table "sustentocredito".
 *
 * The followings are the available columns in table 'sustentocredito':
 * @property integer $id
 * @property string $codigo
 * @property string $nombre
 */
class Sustentocredito extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SustentoCredito the static model class
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
		return 'sustentocredito';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, nombre', 'required'),
			array('codigo', 'length', 'max'=>2),
			array('nombre', 'length', 'max'=>120),
                        array('codigo', 'numerical','min'=>0),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, codigo, nombre', 'safe', 'on'=>'search'),
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
			'id' => MessageHandler::transformar('id','Parametros','SustentoCredito'),
			'codigo' => MessageHandler::transformar('codigo','Parametros','SustentoCredito'),
			'nombre' => MessageHandler::transformar('nombre','Parametros','SustentoCredito'),
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
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('nombre',$this->nombre,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
          /*
         * Devuelve un array de todos los campos que se van a mostrar en
         * el grid
         */

         public function columnasLista(){
            $gridlista=array(
                	
                         array('name'=>'codigo','type'=>'raw','value'=>'CHtml::link($data->codigo,array("update","id"=>$data->id))'),
			'nombre',
            );

            return $gridlista;
        }
}