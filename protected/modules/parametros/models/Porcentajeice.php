<?php

/**
 * This is the model class for table "porcentajeice".
 *
 * The followings are the available columns in table 'porcentajeice':
 * @property integer $id
 * @property string $codigo
 * @property string $descripcion
 * @property string $porcentaje
 * @property string $vigentedesde
 * @property string $vigentehasta
 * @property integer $cuentacontable
 * @property integer $idempresa
 */
class Porcentajeice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PorcentajeIce the static model class
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
		return 'porcentajeice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, descripcion, porcentaje, vigentedesde, vigentehasta, cuentacontable', 'required'),
			array('cuentacontable, idempresa', 'numerical', 'integerOnly'=>true),
			array('codigo', 'length', 'max'=>4),
			array('descripcion', 'length', 'max'=>60),
			array('porcentaje', 'length', 'max'=>8),
                        array('porcentaje,codigo', 'numerical','min'=>0),
                    
                        array(
                              'vigentehasta',
                              'compare',
                              'compareAttribute'=>'vigentedesde',
                              'operator'=>'>',
                              'allowEmpty'=>false ,
                              'message'=>'{attribute} debe ser mayor  "{compareValue}".'
                            ),

                      array('vigentedesde', 'date','format'=>'yyyy-M-d','message'=>'{attribute} Formato equivocado .'),
                     array('vigentehasta', 'date','format'=>'yyyy-M-d','message'=>'{attribute} Formato equivocado .'),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, codigo, descripcion, porcentaje, vigentedesde, vigentehasta, cuentacontable, idempresa', 'safe', 'on'=>'search'),
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
			'id' => MessageHandler::transformar('id','Parametros','PorcentajeIce'),
			'codigo' => MessageHandler::transformar('codigo','Parametros','PorcentajeIce'),
			'descripcion' => MessageHandler::transformar('descripcion','Parametros','PorcentajeIce'),
			'porcentaje' => MessageHandler::transformar('porcentaje','Parametros','PorcentajeIce'),
			'vigentedesde' => MessageHandler::transformar('vigentedesde','Parametros','PorcentajeIce'),
			'vigentehasta' => MessageHandler::transformar('vigentehasta','Parametros','PorcentajeIce'),
			'cuentacontable' => MessageHandler::transformar('cuentacontable','Parametros','PorcentajeIce'),
			'idempresa' => MessageHandler::transformar('idempresa','Parametros','PorcentajeIce'),
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
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('porcentaje',$this->porcentaje,true);
		$criteria->compare('vigentedesde',$this->vigentedesde,true);
		$criteria->compare('vigentehasta',$this->vigentehasta,true);
		$criteria->compare('cuentacontable',$this->cuentacontable);
		$criteria->compare('idempresa',$this->idempresa);
                $criteria->order="codigo";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
         * Devuelve un array de todos los campos que se van a mostrar en
         * el grid
         */
        public function columnasLista(){
            $gridlista=array(
                        array('name'=>'codigo','type'=>'raw','value'=>'CHtml::link($data->codigo,array("update","id"=>$data->id))'),
			'porcentaje',
			'vigentedesde',
			'vigentehasta',
                        array('name'=>'cuentacontable','type'=>'raw','value'=>'$data->cuentaContable()'),
                        array('name'=>'idempresa','type'=>'raw','value'=>'$data->getNombreEmpresa()'),
            );

            return $gridlista;
        }

         public function getNombreEmpresa(){
            $empresa=DatosEmpresa::datosGenerales($this->idempresa);
            if($empresa==null)
                return '';
            else
                return $empresa->razonsocial;
        }
          /*
         * Devuelve el valor Si o No de un campo Booleano
         * para ser mostrado en la lista
         * @return <string>
         */
        public function tipoAutomatico(){
            if($this->tipocuenta)
                    return MessageHandler::transformar( 'si','Default','Sistema');
                else
                    return MessageHandler::transformar( 'no','Default','Sistema');
        }


        /*
         * Retorna el nombre de la cuenta contable
         * @return <string>
         */
        public function nombreCuenta(){
            $model=Plancuentasnec::model()->findByPk($this->cuentacontable);
            if ($model==null)
                return  array('ok'=>false,'message'=>MessageHandler::transformar('unset_cuenta','Parametros','PorcentajeIce'));
            else
                return array('ok'=>true,'message'=>$model->nombrecuenta);
        }
         /*
         * Devuelve el nombre de la cuenta contable relacionada
         * o un mensaje
         * @var <string> $tipo
         * @return <string>
         */
        public function cuentaContable(){
            $val=$this->nombreCuenta();
            if($val['ok']){
              return (string)CHtml::link($val['message'],array("plancuentasnec/update","id"=>$this->cuentacontable));
             }else{
                return $val['message'];
            }

        }

}