<?php

/**
 * This is the model class for table "porcentajeretencionfuente".
 *
 * The followings are the available columns in table 'porcentajeretencionfuente':
 * @property integer $id
 * @property string $porcentaje
 *
 
 * @property Codigoretencionfuente[] $codigoretencionfuentes
 */
class Porcentajeretencionfuente extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Porcentajeretencionfuente the static model class
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
		return 'porcentajeretencionfuente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('porcentaje', 'numerical','min'=>0),
                        array('porcentaje', 'required'),
			array('porcentaje', 'length', 'max'=>3),
                        array('porcentaje', 'unique'),
                        
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, porcentaje', 'safe', 'on'=>'search'),
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
			'codigoretencionfuentes' => array(self::HAS_MANY, 'Codigoretencionfuente', 'idcodigoporcentaje'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
                return array(
			'id' => MessageHandler::transformar('ID','Parametros','PorcentajeRetencionFuente'),
			'porcentaje' => MessageHandler::transformar('Porcentaje','Parametros','PorcentajeRetencionFuente'),
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
		$criteria->compare('porcentaje',$this->porcentaje,true);
                   $criteria->order="porcentaje";
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

                array('name'=>'porcentaje','type'=>'raw','value'=>'CHtml::link($data->porcentaje,array("update","id"=>$data->id))'),

            );

            return $gridlista;
        }


}