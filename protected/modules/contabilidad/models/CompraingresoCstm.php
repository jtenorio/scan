<?php

/**
 * This is the model class for table "compraingreso_cstm".
 *
 * The followings are the available columns in table 'compraingreso_cstm':
 * @property integer $id
 * @property integer $idcompra
 * @property string $pagadocompra
 * @property string $saldocompra
 * @property string $conceptocompra
 * @property integer $asientocompra
 * @property integer $asientoretencion
 * @property string $fechacancelacion
 * @property string $totalretencionfuente
 * @property string $totalretencioniva
 * @property integer $tipotransaccioncompra
 * @property string $fechavencimiento
 * @property integer $tipoproveedor
 * @property string $pagosrealizados
 * @property string $referenciaadicional
 * @property integer $idcompranotacredito
 * @property string $valornotacredito
 * @property string $saldonotacredito
 * @property integer $idempresa
 *
 * The followings are the available model relations:
 * @property Compraingreso $idcompra0
 */
class CompraingresoCstm extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CompraingresoCstm the static model class
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
		return 'compraingreso_cstm';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pagadocompra, saldocompra, asientocompra, asientoretencion, totalretencionfuente, totalretencioniva, idempresa', 'required'),
			array('idcompra, asientocompra, asientoretencion, tipotransaccioncompra, tipoproveedor, idcompranotacredito, idempresa', 'numerical', 'integerOnly'=>true),
			array('pagadocompra, saldocompra, totalretencionfuente, totalretencioniva, pagosrealizados, valornotacredito, saldonotacredito', 'length', 'max'=>10),
			array('conceptocompra', 'length', 'max'=>250),
			array('referenciaadicional', 'length', 'max'=>30),
			array('fechacancelacion, fechavencimiento', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, idcompra, pagadocompra, saldocompra, conceptocompra, asientocompra, asientoretencion, fechacancelacion, totalretencionfuente, totalretencioniva, tipotransaccioncompra, fechavencimiento, tipoproveedor, pagosrealizados, referenciaadicional, idcompranotacredito, valornotacredito, saldonotacredito, idempresa', 'safe', 'on'=>'search'),
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
			'idcompra' => 'Idcompra',
			'pagadocompra' => 'Pagadocompra',
			'saldocompra' => 'Saldocompra',
			'conceptocompra' => 'Conceptocompra',
			'asientocompra' => 'Asientocompra',
			'asientoretencion' => 'Asientoretencion',
			'fechacancelacion' => 'Fechacancelacion',
			'totalretencionfuente' => 'Totalretencionfuente',
			'totalretencioniva' => 'Totalretencioniva',
			'tipotransaccioncompra' => 'Tipotransaccioncompra',
			'fechavencimiento' => 'Fechavencimiento',
			'tipoproveedor' => 'Tipoproveedor',
			'pagosrealizados' => 'Pagosrealizados',
			'referenciaadicional' => 'Referenciaadicional',
			'idcompranotacredito' => 'Idcompranotacredito',
			'valornotacredito' => 'Valornotacredito',
			'saldonotacredito' => 'Saldonotacredito',
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
		$criteria->compare('idcompra',$this->idcompra);
		$criteria->compare('pagadocompra',$this->pagadocompra,true);
		$criteria->compare('saldocompra',$this->saldocompra,true);
		$criteria->compare('conceptocompra',$this->conceptocompra,true);
		$criteria->compare('asientocompra',$this->asientocompra);
		$criteria->compare('asientoretencion',$this->asientoretencion);
		$criteria->compare('fechacancelacion',$this->fechacancelacion,true);
		$criteria->compare('totalretencionfuente',$this->totalretencionfuente,true);
		$criteria->compare('totalretencioniva',$this->totalretencioniva,true);
		$criteria->compare('tipotransaccioncompra',$this->tipotransaccioncompra);
		$criteria->compare('fechavencimiento',$this->fechavencimiento,true);
		$criteria->compare('tipoproveedor',$this->tipoproveedor);
		$criteria->compare('pagosrealizados',$this->pagosrealizados,true);
		$criteria->compare('referenciaadicional',$this->referenciaadicional,true);
		$criteria->compare('idcompranotacredito',$this->idcompranotacredito);
		$criteria->compare('valornotacredito',$this->valornotacredito,true);
		$criteria->compare('saldonotacredito',$this->saldonotacredito,true);
		$criteria->compare('idempresa',$this->idempresa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function updateSaldoCompra($idCompra,$pago)
    {
        $actual = CompraingresoCstm::model()->findByAttributes(array('idcompra'=>$idCompra));
        $actual->saldocompra = $actual->saldocompra - $pago;
        $actual->pagadocompra = $actual->pagadocompra + $pago;
        
        $actual->save();
        
        return $actual;
    }
    
}