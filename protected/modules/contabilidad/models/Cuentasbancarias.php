<?php

/**
 * This is the model class for table "cuentasbancarias".
 *
 * The followings are the available columns in table 'cuentasbancarias':
 * @property integer $idcuentabancaria
 * @property string $descripcion
 * @property integer $idbanco
 * @property string $numerocuenta
 * @property integer $idcuentanec
 * @property string $asistentecuenta
 * @property string $telefonoasistente
 * @property string $ayudanteasistente
 * @property boolean $chequeautomatico
 * @property string $numerocheque
 * @property string $ubicacionimpresion
 * @property integer $idempresa
 */
class Cuentasbancarias extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cuentasbancarias the static model class
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
		return 'cuentasbancarias';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descripcion, idbanco, numerocuenta, chequeautomatico, ubicacionimpresion, idempresa', 'required'),
			array('idbanco, idcuentanec, idempresa', 'numerical', 'integerOnly'=>true),
			array('descripcion, asistentecuenta, ayudanteasistente', 'length', 'max'=>50),
			array('numerocuenta, telefonoasistente', 'length', 'max'=>20),
			array('numerocheque', 'length', 'max'=>10),
			array('ubicacionimpresion', 'length', 'max'=>120),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idcuentabancaria, descripcion, idbanco, numerocuenta, idcuentanec, asistentecuenta, telefonoasistente, ayudanteasistente, chequeautomatico, numerocheque, ubicacionimpresion, idempresa', 'safe', 'on'=>'search'),
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
			'idcuentabancaria' => 'Idcuentabancaria',
			'descripcion' => 'Descripcion',
			'idbanco' => 'Idbanco',
			'numerocuenta' => 'Numerocuenta',
			'idcuentanec' => 'Idcuentanec',
			'asistentecuenta' => 'Asistentecuenta',
			'telefonoasistente' => 'Telefonoasistente',
			'ayudanteasistente' => 'Ayudanteasistente',
			'chequeautomatico' => 'Chequeautomatico',
			'numerocheque' => 'Numerocheque',
			'ubicacionimpresion' => 'Ubicacionimpresion',
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

//		$criteria->compare('idcuentabancaria',$this->idcuentabancaria);
//		$criteria->compare('descripcion',$this->descripcion,true);
//		$criteria->compare('idbanco',$this->idbanco);
//		$criteria->compare('numerocuenta',$this->numerocuenta,true);
//		$criteria->compare('idcuentanec',$this->idcuentanec);
//		$criteria->compare('asistentecuenta',$this->asistentecuenta,true);
//		$criteria->compare('telefonoasistente',$this->telefonoasistente,true);
//		$criteria->compare('ayudanteasistente',$this->ayudanteasistente,true);
//		$criteria->compare('chequeautomatico',$this->chequeautomatico);
//		$criteria->compare('numerocheque',$this->numerocheque,true);
//		$criteria->compare('ubicacionimpresion',$this->ubicacionimpresion,true);
		$criteria->compare('idempresa',$this->idempresa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public static function getCuentaBancaria($idCuenta)
    {
        $result = Cuentasbancarias::model()->findByPk($idCuenta);
        return $result;
    }
}