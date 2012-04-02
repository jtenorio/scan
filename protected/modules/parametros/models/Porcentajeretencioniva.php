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
	 * @return PorcentajeRetencionIva the static model class
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
                    array('porcentaje,codigo', 'numerical', 'min'=>0),
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
			'id' => MessageHandler::transformar('id','Parametros','PorcentajeRetencionIva'),
			'codigo' => MessageHandler::transformar('codigo','Parametros','PorcentajeRetencionIva'),
			'porcentaje' => MessageHandler::transformar('porcentaje','Parametros','PorcentajeRetencionIva'),
			'descripcion' => MessageHandler::transformar('descripcion','Parametros','PorcentajeRetencionIva'),
			'cuentacontablecompra' => MessageHandler::transformar('cuentacontablecompra','Parametros','PorcentajeRetencionIva'),
			'cuentacontableventa' => MessageHandler::transformar('cuentacontableventa','Parametros','PorcentajeRetencionIva'),
			'idempresa' => MessageHandler::transformar('idempresa','Parametros','PorcentajeRetencionIva'),
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
                $criteria->order="codigo";
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
                	
                         array('name'=>'codigo','type'=>'raw','value'=>'CHtml::link($data->codigo,array("update","id"=>$data->id))'),
			'porcentaje',
                        'descripcion',
                        array('name'=>'cuentacontablecompra','type'=>'raw','value'=>'$data->cuentaContable()'),
                        array('name'=>'cuentacontableventa','type'=>'raw','value'=>'$data->cuentaContable("venta")'),
                        
                         array('name'=>'idempresa','type'=>'raw','value'=>'$data->getNombreEmpresa()'),

            );

            return $gridlista;
        }

        /*
         * Retorna el nombre de la cuenta contable
         * @return <string>
         */
        public function nombreCuenta($tipo='compra'){
            if($tipo=='compra')
                $model=Plancuentasnec::model()->findByPk($this->cuentacontablecompra);
            else
                $model=Plancuentasnec::model()->findByPk($this->cuentacontableventa);

            if ($model==null)
                return  array('ok'=>false,'message'=>MessageHandler::transformar('unset_cuenta','Parametros','PorcentajeRetencionIva',array('{nombre}'=>ucfirst($tipo))));
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
        public function cuentaContable($tipo='compra'){
            $val=$this->nombreCuenta($tipo);
            if($val['ok']){
                if($tipo=='compra')
                    return (string)CHtml::link($val['message'],array("plancuentasnec/update","id"=>$this->cuentacontablecompra));
                else
                    return (string)CHtml::link($val['message'],array("plancuentasnec/update","id"=>$this->cuentacontableventa));
            }else{
                return $val['message'];
            }

        }

}