<?php

/**
 * This is the model class for table "ejerciciocontable".
 *
 * The followings are the available columns in table 'ejerciciocontable':
 * @property integer $id
 * @property string $idanio
 * @property boolean $ejerciciocerrado
 * @property string $ubicacion
 * @property string $anioanterior
 * @property boolean $estado
 * @property integer $idempresa
 */
class Ejerciciocontable extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return EjercicioContable the static model class
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
		return 'ejerciciocontable';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idanio, ejerciciocerrado, ubicacion, estado, idempresa', 'required'),
			array('idempresa', 'numerical', 'integerOnly'=>true),
			array('idanio, anioanterior', 'length', 'max'=>4),
			array('ubicacion', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idanio, ejerciciocerrado, ubicacion, anioanterior, estado, idempresa', 'safe', 'on'=>'search'),
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
			'idanio' => 'Idanio',
			'ejerciciocerrado' => 'Ejerciciocerrado',
			'ubicacion' => 'Ubicacion',
			'anioanterior' => 'Anioanterior',
			'estado' => 'Estado',
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
		$criteria->compare('idanio',$this->idanio,true);
		$criteria->compare('ejerciciocerrado',$this->ejerciciocerrado);
		$criteria->compare('ubicacion',$this->ubicacion,true);
		$criteria->compare('anioanterior',$this->anioanterior,true);
		$criteria->compare('estado',$this->estado);
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
                return trim($model->idanio);
            }else
                return '';
        }
}