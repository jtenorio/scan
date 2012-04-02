<?php

/**
 * This is the model class for table "parametrofacturacion".
 *
 * The followings are the available columns in table 'parametrofacturacion':
 * @property integer $id
 * @property integer $idempresa
 * @property integer $cuentacaja
 * @property integer $cuentaventasdoce
 * @property integer $cuentaventascero
 * @property integer $cuentaivaventas
 * @property integer $cuentadescuentoventas
 * @property integer $cuentaretfuenteventa
 * @property integer $cuentaretivaventa
 * @property integer $cuentaporcobrarcliente
 * @property integer $cuentareembolsocliente
 * @property integer $cuentacomprasdoce
 * @property integer $cuentacomprascero
 * @property integer $cuentadescuentocompra
 * @property integer $cuentaivacompras
 * @property integer $cuentaporpagarproveedor
 * @property integer $cuentaanticipoproveedor
 * @property string  $numerocompra
 * @property integer $numerocompradevolucion
 * @property integer $numerocompraanterior
 */
class Parametrofacturacion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ParametroFacturacion the static model class
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
		return 'parametrofacturacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idempresa, cuentacaja, cuentaventasdoce, cuentaventascero, cuentaivaventas, cuentadescuentoventas, cuentaretfuenteventa, cuentaretivaventa, cuentaporcobrarcliente, cuentareembolsocliente, cuentacomprasdoce, cuentacomprascero, cuentadescuentocompra, cuentaivacompras, cuentaporpagarproveedor, cuentaanticipoproveedor', 'numerical', 'integerOnly'=>true),
			array('numerocompra', 'length', 'max'=>10),
                        array('idempresa', 'unique'),
                        array('numerocompra', 'default','value'=>0),
                        array('numerocompradevolucion,numerocompraanterior','numerical', 'integerOnly'=>true),
                        array('numerocompradevolucion,numerocompraanterior','default', 'value'=>0),
                        array('numerocompradevolucion,numerocompraanterior', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idempresa, cuentacaja, cuentaventasdoce, cuentaventascero, cuentaivaventas, cuentadescuentoventas, cuentaretfuenteventa, cuentaretivaventa, cuentaporcobrarcliente, cuentareembolsocliente, cuentacomprasdoce, cuentacomprascero, cuentadescuentocompra, cuentaivacompras, cuentaporpagarproveedor, cuentaanticipoproveedor, numerocompra', 'safe', 'on'=>'search'),
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
			'idempresa' => 'Empresa',
			'cuentacaja' => 'Cuenta Caja',
			'cuentaventasdoce' => 'Cuenta ventas doce',
			'cuentaventascero' => 'Cuenta ventas cero',
			'cuentaivaventas' => 'Cuenta iva ventas',
			'cuentadescuentoventas' => 'Cuenta descuento ventas',
			'cuentaretfuenteventa' => 'Cuenta ret fuente venta',
			'cuentaretivaventa' => 'Cuenta ret iva venta',
			'cuentaporcobrarcliente' => 'Cuenta por cobrar cliente',
			'cuentareembolsocliente' => 'Cuenta reembolso cliente',
			'cuentacomprasdoce' => 'Cuenta compras doce',
			'cuentacomprascero' => 'Cuenta compras cero',
			'cuentadescuentocompra' => 'Cuenta descuento compra',
			'cuentaivacompras' => 'Cuenta iva compras',
			'cuentaporpagarproveedor' => 'Cuenta por pagar proveedor',
			'cuentaanticipoproveedor' => 'Cuenta anticipo proveedor',
			'numerocompra' => 'Numerocompra',
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
		$criteria->compare('idempresa',$this->idempresa);
		$criteria->compare('cuentacaja',$this->cuentacaja);
		$criteria->compare('cuentaventasdoce',$this->cuentaventasdoce);
		$criteria->compare('cuentaventascero',$this->cuentaventascero);
		$criteria->compare('cuentaivaventas',$this->cuentaivaventas);
		$criteria->compare('cuentadescuentoventas',$this->cuentadescuentoventas);
		$criteria->compare('cuentaretfuenteventa',$this->cuentaretfuenteventa);
		$criteria->compare('cuentaretivaventa',$this->cuentaretivaventa);
		$criteria->compare('cuentaporcobrarcliente',$this->cuentaporcobrarcliente);
		$criteria->compare('cuentareembolsocliente',$this->cuentareembolsocliente);
		$criteria->compare('cuentacomprasdoce',$this->cuentacomprasdoce);
		$criteria->compare('cuentacomprascero',$this->cuentacomprascero);
		$criteria->compare('cuentadescuentocompra',$this->cuentadescuentocompra);
		$criteria->compare('cuentaivacompras',$this->cuentaivacompras);
		$criteria->compare('cuentaporpagarproveedor',$this->cuentaporpagarproveedor);
		$criteria->compare('cuentaanticipoproveedor',$this->cuentaanticipoproveedor);
		$criteria->compare('numerocompra',$this->numerocompra,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function columnasLista(){
            $gridlista=array(
                        array('name'=>'idempresa','type'=>'raw','value'=>'$data->getNombreEmpresa()'),
                        'numerocompra',
            );

            return $gridlista;
        }

              /*
         * Devuelve el nombre de la empresa para mostrar en la lista
         *
         * @return <string>
         */
        public function getNombreEmpresa(){
            $empresa=DatosEmpresa::datosGenerales($this->idempresa);
            if($empresa==null)
                return '';
            else
            return $empresa->razonsocial;
        }
}
