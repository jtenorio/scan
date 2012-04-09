<?php

/**
 * This is the model class for table "retencionescompra".
 *
 * The followings are the available columns in table 'retencionescompra':
 * @property integer $id
 * @property string $baseimponible
 * @property string $basenogravada
 * @property string $basecero
 * @property string $basegravada
 * @property integer $porcentajeretencion
 * @property string $valorretenido
 * @property integer $idcompra
 * @property integer $idcodigoretencionfuente
 *
 * The followings are the available model relations:
 * @property Codigoretencionfuente $idcodigoretencionfuente0
 * @property Compraingreso $idcompra0
 */
class Retencionescompra extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Retencionescompra the static model class
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
		return 'retencionescompra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('baseimponible, basenogravada, basecero, basegravada, porcentajeretencion, valorretenido, idcompra, idcodigoretencionfuente', 'required'),
			array('porcentajeretencion, idcompra, idcodigoretencionfuente', 'numerical', 'integerOnly'=>true),
			array('baseimponible, basenogravada, basecero, basegravada, valorretenido', 'length', 'max'=>12),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, baseimponible, basenogravada, basecero, basegravada, porcentajeretencion, valorretenido, idcompra, idcodigoretencionfuente', 'safe', 'on'=>'search'),
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
			'idcodigoretencionfuente0' => array(self::BELONGS_TO, 'Codigoretencionfuente', 'idcodigoretencionfuente'),
			'idcompra0' => array(self::BELONGS_TO, 'Compraingreso', 'idcompra'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'baseimponible' => 'Baseimponible',
			'basenogravada' => 'Basenogravada',
			'basecero' => 'Basecero',
			'basegravada' => 'Basegravada',
			'porcentajeretencion' => 'Porcentajeretencion',
			'valorretenido' => 'Valorretenido',
			'idcompra' => 'Idcompra',
			'idcodigoretencionfuente' => 'Idcodigoretencionfuente',
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
		$criteria->compare('baseimponible',$this->baseimponible,true);
		$criteria->compare('basenogravada',$this->basenogravada,true);
		$criteria->compare('basecero',$this->basecero,true);
		$criteria->compare('basegravada',$this->basegravada,true);
		$criteria->compare('porcentajeretencion',$this->porcentajeretencion);
		$criteria->compare('valorretenido',$this->valorretenido,true);
		$criteria->compare('idcompra',$this->idcompra);
		$criteria->compare('idcodigoretencionfuente',$this->idcodigoretencionfuente);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        public function buscaRetencion($idCompra){
            if($idCompra==null)
                return '';

            $model=$this->model()->findAll(
                    array(
                    'condition' => '"idcompra" = :id',
                    'params' => array(
                            ':id' => $idCompra
                    )));
            if($model!=null){
                return ($model);
            }else
                return '';
        }
}