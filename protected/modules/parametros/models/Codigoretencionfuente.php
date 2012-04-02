<?php

/**
 * This is the model class for table "codigoretencionfuente".
 *
 * The followings are the available columns in table 'codigoretencionfuente':
 * @property integer $idcodretfuente
 * @property string $codigo
 * @property string $descripcion
 * @property string $porcentaje
 * @property string $vigentedesde
 * @property string $vigentehasta
 * @property boolean $pormil
 * @property integer $cuentacontablecompras
 * @property integer $cuentacontableventas
 * @property integer $idcodigoporcentaje
 *
 * The followings are the available model relations:
 * @property Porcentajeretencionfuente $idcodigoporcentaje0
 * @property Retencionescompra[] $retencionescompras
 */
class Codigoretencionfuente extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CodigoRetencionFuente the static model class
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
		return 'codigoretencionfuente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, descripcion, porcentaje, vigentedesde, vigentehasta, cuentacontablecompras, idcodigoporcentaje', 'required'),
			array('cuentacontablecompras, cuentacontableventas, idcodigoporcentaje', 'numerical', 'integerOnly'=>true),
			array('codigo', 'length', 'max'=>3),
			array('descripcion', 'length', 'max'=>80),
			array('porcentaje', 'length', 'max'=>8),
			array('pormil', 'safe'),
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
			array('idcodretfuente, codigo, descripcion, porcentaje, vigentedesde, vigentehasta, pormil, cuentacontablecompras, cuentacontableventas, idcodigoporcentaje', 'safe', 'on'=>'search'),
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
			'idcodigoporcentaje0' => array(self::BELONGS_TO, 'Porcentajeretencionfuente', 'idcodigoporcentaje'),
			'retencionescompras' => array(self::HAS_MANY, 'Retencionescompra', 'idcodigoretencionfuente'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcodretfuente' => MessageHandler::transformar('idcodretfuente','Parametros','CodigoRetencionFuente'),
			'codigo' => MessageHandler::transformar('codigo','Parametros','CodigoRetencionFuente'),
			'descripcion' => MessageHandler::transformar('descripcion','Parametros','CodigoRetencionFuente'),
			'porcentaje' => MessageHandler::transformar('porcentaje','Parametros','CodigoRetencionFuente'),
			'vigentedesde' => MessageHandler::transformar('vigentedesde','Parametros','CodigoRetencionFuente'),
			'vigentehasta' => MessageHandler::transformar('vigentehasta','Parametros','CodigoRetencionFuente'),
			'pormil' => MessageHandler::transformar('pormil','Parametros','CodigoRetencionFuente'),
			'cuentacontablecompras' => MessageHandler::transformar('cuentacontablecompras','Parametros','CodigoRetencionFuente'),
			'cuentacontableventas' => MessageHandler::transformar('cuentacontableventas','Parametros','CodigoRetencionFuente'),
			'idcodigoporcentaje' => MessageHandler::transformar('idcodigoporcentaje','Parametros','CodigoRetencionFuente'),
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

		$criteria->compare('idcodretfuente',$this->idcodretfuente);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('porcentaje',$this->porcentaje,true);
		$criteria->compare('vigentedesde',$this->vigentedesde,true);
		$criteria->compare('vigentehasta',$this->vigentehasta,true);
		$criteria->compare('pormil',$this->pormil);
		$criteria->compare('cuentacontablecompras',$this->cuentacontablecompras);
		$criteria->compare('cuentacontableventas',$this->cuentacontableventas);
		$criteria->compare('idcodigoporcentaje',$this->idcodigoporcentaje);
                $criteria->order="descripcion";
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
                 array('name'=>'codigo','type'=>'raw','value'=>'CHtml::link($data->codigo,array("update","id"=>$data->idcodretfuente))'),
                'descripcion',
                'porcentaje',
                'vigentedesde',
                'vigentehasta',
                'pormil',
                 array('name'=>'cuentacontableventas','type'=>'raw','value'=>'$data->cuentaContable("venta")'),
                 array('name'=>'cuentacontablecompras','type'=>'raw','value'=>'$data->cuentaContable()'),
            );

            return $gridlista;
        }

        /*
         * Retorna el nombre de la cuenta contable
         * @return <string>
         */
        public function nombreCuenta($tipo='compra'){
            if($tipo=='compra')
                $model=Plancuentasnec::model()->findByPk($this->cuentacontablecompras);
            else
                $model=Plancuentasnec::model()->findByPk($this->cuentacontableventas);

            if ($model==null)
                return  array('ok'=>false,'message'=>MessageHandler::transformar('unset_cuenta','Parametros','CodigoRetencionFuente',array('{nombre}'=>ucfirst($tipo))));
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
            return $empresa->razonsocial;
        }

         /*
         * Devuelve el nombre de la cuenta contable relacionada
         * o un mensaje
         * @var <string> $tipo
         * @return <string>
         */
        public function cuentaContable($tipo='compra'){
            $val=$this->nombreCuenta($tipo);
            if($val['ok']){
                if($tipo=='compra')
                    return (string)CHtml::link($val['message'],array("plancuentasnec/update","id"=>$this->cuentacontablecompras));
                else
                    return (string)CHtml::link($val['message'],array("plancuentasnec/update","id"=>$this->cuentacontableventas));
            }else{
                return $val['message'];
            }

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

       
}