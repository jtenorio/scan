<?php

/**
 * This is the model class for table "proveedor".
 *
 * The followings are the available columns in table 'proveedor':
 * @property integer $id
 * @property string $cedularuc
 * @property string $razonsocial
 * @property string $direccion
 * @property string $telefono
 * @property string $fax
 * @property integer $ciudad
 * @property string $email
 * @property integer $tipodocumento
 * @property string $contacto
 * @property string $nota1
 * @property string $nota2
 * @property string $saldo
 * @property integer $cuentacontableporpagar
 * @property integer $cuentacontableanticipo
 * @property string $autorizacionfactura
 * @property string $fechacaducidad
 * @property integer $idtipoproveedor
 */
class Proveedor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Proveedor the static model class
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
		return 'proveedor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, cedularuc, razonsocial, direccion, telefono, fax, ciudad, tipodocumento, cuentacontableporpagar, autorizacionfactura, fechacaducidad, idtipoproveedor', 'required'),
			array('id, ciudad, tipodocumento, cuentacontableporpagar, cuentacontableanticipo, idtipoproveedor', 'numerical', 'integerOnly'=>true),
			array('cedularuc', 'length', 'max'=>13),
			array('razonsocial, direccion', 'length', 'max'=>60),
			array('telefono, saldo', 'length', 'max'=>12),
			array('fax, autorizacionfactura', 'length', 'max'=>10),
			array('email, contacto', 'length', 'max'=>40),
			array('nota1, nota2', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cedularuc, razonsocial, direccion, telefono, fax, ciudad, email, tipodocumento, contacto, nota1, nota2, saldo, cuentacontableporpagar, cuentacontableanticipo, autorizacionfactura, fechacaducidad, idtipoproveedor', 'safe', 'on'=>'search'),
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
			'cedularuc' => 'Cedularuc',
			'razonsocial' => 'Razonsocial',
			'direccion' => 'Direccion',
			'telefono' => 'Telefono',
			'fax' => 'Fax',
			'ciudad' => 'Ciudad',
			'email' => 'Email',
			'tipodocumento' => 'Tipodocumento',
			'contacto' => 'Contacto',
			'nota1' => 'Nota1',
			'nota2' => 'Nota2',
			'saldo' => 'Saldo',
			'cuentacontableporpagar' => 'Cuentacontableporpagar',
			'cuentacontableanticipo' => 'Cuentacontableanticipo',
			'autorizacionfactura' => 'Autorizacionfactura',
			'fechacaducidad' => 'Fechacaducidad',
			'idtipoproveedor' => 'Idtipoproveedor',
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
		$criteria->compare('cedularuc',$this->cedularuc,true);
		$criteria->compare('razonsocial',$this->razonsocial,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('ciudad',$this->ciudad);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('tipodocumento',$this->tipodocumento);
		$criteria->compare('contacto',$this->contacto,true);
		$criteria->compare('nota1',$this->nota1,true);
		$criteria->compare('nota2',$this->nota2,true);
		$criteria->compare('saldo',$this->saldo,true);
		$criteria->compare('cuentacontableporpagar',$this->cuentacontableporpagar);
		$criteria->compare('cuentacontableanticipo',$this->cuentacontableanticipo);
		$criteria->compare('autorizacionfactura',$this->autorizacionfactura,true);
		$criteria->compare('fechacaducidad',$this->fechacaducidad,true);
		$criteria->compare('idtipoproveedor',$this->idtipoproveedor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public static function getProveedor($idProveedor)
    {
        $result = Proveedor::model()->findByPk($idProveedor);
        return $result;
    }
}