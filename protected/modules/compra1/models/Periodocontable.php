<?php

/**
 * This is the model class for table "periodocontrable".
 *
 * The followings are the available columns in table 'periodocontrable':
 * @property integer $id
 * @property string $nombre
 * @property string $mesnumero
 * @property integer $idejercicio
 * @property integer $idempresa
 */
class Periodocontable extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Periodocontable the static model class
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
		return 'periodocontrable';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, mesnumero, idejercicio, idempresa', 'required'),
			array('idejercicio, idempresa', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>15),
			array('mesnumero', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, mesnumero, idejercicio, idempresa', 'safe', 'on'=>'search'),
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
			'nombre' => 'Nombre',
			'mesnumero' => 'Mesnumero',
			'idejercicio' => 'Idejercicio',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('mesnumero',$this->mesnumero,true);
		$criteria->compare('idejercicio',$this->idejercicio);
		$criteria->compare('idempresa',$this->idempresa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


        public function buscaNombre($id){

              if($id==null)
                return '';
            $model=$this->model()->findByPk($id);
            if($model!=null){
                return trim($model->nombre);
            }else
                return '';
        }

        public function buscaMesNumero($id){

              if($id==null)
                return '';
            $model=$this->model()->findByPk($id);
            if($model!=null){
                return trim($model->mesnumero);
            }else
                return '';
        }
}