<?php

/**
 * This is the model class for table "tipoidentificacion".
 *
 * The followings are the available columns in table 'tipoidentificacion':
 * @property integer $id
 * @property string $codigo
 * @property string $nombre
 */
class Tipoidentificacion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TipoIdentificacion the static model class
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
		return 'tipoidentificacion';
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
			array('codigo', 'length', 'max'=>1),
			array('nombre', 'length', 'max'=>30),
                        array('codigo','in','range'=>array('R','C','P','F')),
                        array('codigo','unique'),
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
			'id' => MessageHandler::transformar('ID','Parametros','TipoIdentificacion'),
			'codigo' => MessageHandler::transformar('Codigo','Parametros','TipoIdentificacion',array('{valor1}'=>'R','{valor2}'=>'C','{valor3}'=>'P','{valor4}'=>'F')),
			'nombre' => MessageHandler::transformar('Nombre','Parametros','TipoIdentificacion'),
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
                $criteria->order="nombre";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

         /*
         * Devuelve un array de todos los campos que se van a mostrar en
         * el grid , puede enviarse con un array simple o como multiples array
         *
         */
        public function columnasLista(){
            $gridlista=array(
                array('name'=>'nombre','type'=>'raw','value'=>'CHtml::link($data->nombre,array("update","id"=>$data->id))'),
                'nombre',
                
            );

            return $gridlista;
        }

}