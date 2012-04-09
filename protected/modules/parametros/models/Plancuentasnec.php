<?php

/**
 * This is the model class for table "plancuentasnec".
 *
 * The followings are the available columns in table 'plancuentasnec':
 * @property integer $idcuentanec
 * @property string $cuentacontable
 * @property string $nombrecuenta
 * @property boolean $tipocuenta
 * @property string $nivelcuenta
 * @property integer $idcuentaniff
 * @property integer $idempresa
 *
 * The followings are the available model relations:
 * @property Plancuentasniff $cuentaniff
 * @property Detalleasientos[] $detalleasiento
 * @property Cuentasbancarias[] $cuentabancaria
 */
class Plancuentasnec extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PlanCuentasNec the static model class
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
		return 'plancuentasnec';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cuentacontable, nombrecuenta, tipocuenta, nivelcuenta, idcuentaniff', 'required'),
			array('idcuentanec, idcuentaniff, idempresa', 'numerical', 'integerOnly'=>true),
			array('cuentacontable', 'length', 'max'=>40),
			array('nombrecuenta', 'length', 'max'=>120),
			array('tipocuenta', 'length', 'max'=>1),
			array('nivelcuenta', 'length', 'max'=>2),
                        array('cuentacontable+idempresa', 'application.modules.parametros.extensions.uniqueMultiColumnValidator'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idcuentanec, cuentacontable, nombrecuenta, tipocuenta, nivelcuenta, idcuentaniff, idempresa', 'safe', 'on'=>'search'),
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
			'cuentaniff' => array(self::BELONGS_TO, 'Plancuentasniff', 'idcuentaniff'),
			'detalleasiento' => array(self::HAS_MANY, 'Detalleasientos', 'cuentacontable'),
			'cuentabancaria' => array(self::HAS_MANY, 'Cuentasbancarias', 'idcuentanec'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcuentanec' =>  MessageHandler::transformar('idcuentanec','Parametros','PlanCuentasNec'),
			'cuentacontable' => MessageHandler::transformar('cuentacontable','Parametros','PlanCuentasNec'),
			'nombrecuenta' => MessageHandler::transformar('nombrecuenta','Parametros','PlanCuentasNec'),
			'tipocuenta' => MessageHandler::transformar('tipocuenta','Parametros','PlanCuentasNec'),
			'nivelcuenta' => MessageHandler::transformar('nivelcuenta','Parametros','PlanCuentasNec'),
			'idcuentaniff' => MessageHandler::transformar('idcuentaniff','Parametros','PlanCuentasNec'),
			'idempresa' => MessageHandler::transformar('idempresa','Parametros','PlanCuentasNec'),
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

		$criteria->compare('idcuentanec',$this->idcuentanec);
		$criteria->compare('cuentacontable',$this->cuentacontable,true);
		$criteria->compare('nombrecuenta',$this->nombrecuenta,true);
		$criteria->compare('tipocuenta',$this->tipocuenta,true);
		$criteria->compare('nivelcuenta',$this->nivelcuenta,true);
		$criteria->compare('idcuentaniff',$this->idcuentaniff);
		$criteria->compare('idempresa',$this->idempresa);
                $criteria->order="cuentacontable";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        /*
         * Devuelve un array de todos los campos que se van a mostrar en
         * el grid
         * @return <array>
         */
        public function columnasLista(){
            $gridlista=array(
                        array('name'=>'cuentacontable','type'=>'raw','value'=>'CHtml::link($data->cuentacontable,array("update","id"=>$data->idcuentanec))'),
			'nombrecuenta',
	                array('name'=>'tipocuenta','type'=>'raw','value'=>'$data->tipoAutomatico()'),
			'nivelcuenta',
                      
                        
                        array('name'=>'idcuentaniff','type'=>'raw','value'=>'$data->cuentaContable()'),
                        array('name'=>'idempresa','type'=>'raw','value'=>'$data->getNombreEmpresa()'),
	   );

            return $gridlista;
        }

        /*
         * Genera el tipo de cuenta y el nivel
         */
        protected function  beforeSave() {
            $this->cuentacontable=str_replace (" ", "", trim($this->cuentacontable));
           $texto=CuentaContable::existeNivel($this->cuentacontable);
           $val=CuentaContable::siguienteNivel($this->cuentacontable);

                $this->tipocuenta=($val['tipoc']==false)? 0 : 1;
                $this->nivelcuenta=$val['cnivel'];

            return parent::beforeSave();
        }


        /*
         *Sobreescribe la funcion basica de Yii, antes de guardar
         *aqui se generan los niveles de la cuenta, una vez que se ha validado la cuenta es
         * correcta
         */
        protected function  beforeValidate() {
                //poner el calculo del nivel de la cuenta
                $this->cuentacontable=str_replace (" ", "", trim($this->cuentacontable));
                $texto=CuentaContable::existeNivel($this->cuentacontable);
                $val=CuentaContable::siguienteNivel($this->cuentacontable);

                $this->tipocuenta=($val['tipoc']==false)? 0 : 1;
                $this->nivelcuenta=$val['cnivel'];

                return parent::beforeValidate();

        }
        /*
         * Concatena el codigo de la cuenta con el nombre ,
         * da una mejor vivisibilidad al usuario
         * @return <string>
         */
        public function getConcatened(){

            return $this->cuentacontable.' | '.$this->nombrecuenta;
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
            $model=Plancuentasniff::model()->findByPk($this->idcuentaniff);
            if ($model==null)
                return  array('ok'=>false,'message'=>MessageHandler::transformar('unset_cuenta','Parametros','PlanCuentasNec'));
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
              return (string)CHtml::link($val['message'],array("plancuentasniff/update","id"=>$this->idcuentaniff));
             }else{
                return $val['message'];
            }

        }
             /*
         *  Busca la cuenta contable en el plan de cuentas ,dependiendo del parametro que
         *  @var <string> $param Parametro de busqueda
         *  @return <CDbCriteria>
         */

        public function buscaCuentaNec($param,$limit=20){
            $crit=new CDbCriteria();
            $crit->addCondition("(trim(\"cuentacontable\") LIKE :parametro or trim(\"nombrecuenta\") LIKE :parametro)");
            $crit->addCondition('"tipocuenta" =:x');
            $crit->params=array(':parametro' =>"%$param%",':x'=>false);
            $crit->limit=$limit;
            return  $crit;

        }

        /*
         *  Rertorna el nombre de la cuenta contable
         *  @var <integer> $idcuenta Id de la cuenta contable Niff
         *  @return <string>
         */

        public function buscaNombre($idcuenta){
            if($idcuenta==null)
                return '';
            $model=$this->model()->findByPk($idcuenta);
            if($model!=null){

                return trim($model->cuentacontable).' | '.trim($model->nombrecuenta);
            }else
                return '';

        }



}