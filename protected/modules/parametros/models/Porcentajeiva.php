<?php

/**
 * This is the model class for table "porcentajeiva".
 *
 * The followings are the available columns in table 'porcentajeiva':
 * @property integer $id
 * @property string $porcentaje
 * @property string $vigentedesde
 * @property string $vigentehasta
 * @property integer $cuentacontablecredito
 * @property integer $cuentacontablegasto
 * @property integer $cuentacontableventa
 * @property string $descripcion
 *
 * The followings are the available model relations:
 * @property Compraingreso[] $compraingresos
 */
class Porcentajeiva extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PorcentajeIva the static model class
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
		return 'porcentajeiva';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('porcentaje, vigentedesde, vigentehasta, descripcion', 'required'),
			array('vigentehasta', 'myCheckdate'),
                        array('vigentedesde', 'myCheckdateVigenteDesde'),
                        array('cuentacontablecredito, cuentacontablegasto, cuentacontableventa', 'numerical', 'integerOnly'=>true),
			array('porcentaje', 'length', 'max'=>3),
			array('descripcion', 'length', 'max'=>40),
                        array('porcentaje', 'numerical','min'=>0),
                        array(
                              'vigentehasta',
                              'compare',
                              'compareAttribute'=>'vigentedesde',
                              'operator'=>'>',
                              'allowEmpty'=>false ,
                              'message'=>'{attribute} debe ser mayor  "{compareValue}".'
                            ),
                        
                        array('vigentedesde', 'date','format'=>'yyyy-M-d'),
                        array('vigentehasta', 'date','format'=>'yyyy-M-d'),
                        array('vigentehasta', 'myCheckdate'),
                        array('vigentedesde', 'myCheckdateVigenteDesde'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, porcentaje, vigentedesde, vigentehasta, cuentacontablecredito, cuentacontablegasto, cuentacontableventa, descripcion', 'safe', 'on'=>'search'),
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
			'compraingresos' => array(self::HAS_MANY, 'Compraingreso', 'idporcentajeiva'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => MessageHandler::transformar('id','Parametros','PorcentajeIva'),
			'porcentaje' => MessageHandler::transformar('porcentaje','Parametros','PorcentajeIva'),
			'vigentedesde' => MessageHandler::transformar('vigentedesde','Parametros','PorcentajeIva'),
			'vigentehasta' => MessageHandler::transformar('vigentehasta','Parametros','PorcentajeIva'),
			'cuentacontablecredito' => MessageHandler::transformar('cuentacontablecredito','Parametros','PorcentajeIva'),
			'cuentacontablegasto' => MessageHandler::transformar('cuentacontablegasto','Parametros','PorcentajeIva'),
			'cuentacontableventa' => MessageHandler::transformar('cuentacontableventa','Parametros','PorcentajeIva'),
			'descripcion' => MessageHandler::transformar('descripcion','Parametros','PorcentajeIva'),
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
		$criteria->compare('vigentedesde',$this->vigentedesde,true);
		$criteria->compare('vigentehasta',$this->vigentehasta,true);
		$criteria->compare('cuentacontablecredito',$this->cuentacontablecredito);
		$criteria->compare('cuentacontablegasto',$this->cuentacontablegasto);
		$criteria->compare('cuentacontableventa',$this->cuentacontableventa);
		$criteria->compare('descripcion',$this->descripcion,true);

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
			'vigentedesde',
			'vigentehasta',
                        array('name'=>'cuentacontablecredito','type'=>'raw','value'=>'$data->cuentaContable()'),
                        array('name'=>'cuentacontablegasto','type'=>'raw','value'=>'$data->cuentaContable("gasto")'),
	                array('name'=>'cuentacontableventa','type'=>'raw','value'=>'$data->cuentaContable("venta")'),
          );

            return $gridlista;
        }

        /*
         *Verifica si la fecha es valida vigenteHasta
         */
        public function myCheckdate($attribute,$params){

                if(! strtotime($this->{$attribute}))
                {
                    $this->addError($attribute,' La fecha  es incorrecta.');
                }
           
        }

        /*
         *Verifica si la fecha es valida vigenteDesde
         */
        public function myCheckdateVigenteDesde($attribute,$params){
           
                if(! strtotime($this->{$attribute}))
                {
                    $this->addError($attribute,'La fecha  es incorrecta.');
                }
           
        }

         /*
         * Retorna el nombre de la cuenta contable
         * @return <string>
         */
        public function nombreCuenta($tipo='credito'){
            if($tipo=='credito')
                $model=Plancuentasnec::model()->findByPk($this->cuentacontablecredito);
            else if($tipo=='venta')
                $model=Plancuentasnec::model()->findByPk($this->cuentacontableventa);
            else
                $model=Plancuentasnec::model()->findByPk($this->cuentacontablegasto);

            if ($model==null)
                return  array('ok'=>false,'message'=>MessageHandler::transformar('unset_cuenta','Parametros','PorcentajeIva',array('{nombre}'=>ucfirst($tipo))));
            else
                return array('ok'=>true,'message'=>$model->nombrecuenta);
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
         /*
         * Devuelve el nombre de la cuenta contable relacionada
         * o un mensaje
         * @var <string> $tipo
         * @return <string>
         */
        public function cuentaContable($tipo='credito'){
            $val=$this->nombreCuenta($tipo);
            if($val['ok']){
                if($tipo=='credito')
                    return (string)CHtml::link($val['message'],array("plancuentasnec/update","id"=>$this->cuentacontablecredito));
                else if($tipo=='venta')
                    return (string)CHtml::link($val['message'],array("plancuentasnec/update","id"=>$this->cuentacontableventa));
                else
                    return (string)CHtml::link($val['message'],array("plancuentasnec/update","id"=>$this->cuentacontablegasto));
            }else{
                return $val['message'];
            }

        }
}