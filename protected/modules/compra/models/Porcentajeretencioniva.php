<?php

/**
 * This is the model class for table "porcentajeretencioniva".
 *
 * The followings are the available columns in table 'porcentajeretencioniva':
 * @property integer $id
 * @property string $codigo
 * @property string $porcentaje
 * @property string $descripcion
 * @property integer $cuentacontablecompra
 * @property integer $cuentacontableventa
 * @property integer $idempresa
 */
class Porcentajeretencioniva extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Porcentajeretencioniva the static model class
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
		return 'porcentajeretencioniva';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, porcentaje, descripcion, idempresa', 'required'),
			array('cuentacontablecompra, cuentacontableventa, idempresa', 'numerical', 'integerOnly'=>true),
			array('codigo', 'length', 'max'=>3),
			array('porcentaje', 'length', 'max'=>8),
			array('descripcion', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, codigo, porcentaje, descripcion, cuentacontablecompra, cuentacontableventa, idempresa', 'safe', 'on'=>'search'),
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
			'codigo' => 'Codigo',
			'porcentaje' => 'Porcentaje',
			'descripcion' => 'Descripcion',
			'cuentacontablecompra' => 'Cuentacontablecompra',
			'cuentacontableventa' => 'Cuentacontableventa',
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
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('porcentaje',$this->porcentaje,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('cuentacontablecompra',$this->cuentacontablecompra);
		$criteria->compare('cuentacontableventa',$this->cuentacontableventa);
		$criteria->compare('idempresa',$this->idempresa);

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
                	'codigo',
			'porcentaje',
                        'cuentacontablecompra',
                        'descripcion',
                        'cuentacontablecompra',
                        'idempresa',

            );

            return $gridlista;
        }
}