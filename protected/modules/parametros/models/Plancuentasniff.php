<?php

/**
 * This is the model class for table "plancuentasniff".
 *
 * The followings are the available columns in table 'plancuentasniff':
 * @property integer $idcuentaniff
 * @property string $cuentacontableniff
 * @property string $nombrecuenta
 * @property boolean $tipocuenta
 * @property string $nivelcuenta
 */
class Plancuentasniff extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PlanCuentasNiff the static model class
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
		return 'plancuentasniff';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cuentacontableniff, nombrecuenta, nivelcuenta', 'required'),
			array('cuentacontableniff', 'length', 'max'=>40),
			array('nombrecuenta', 'length', 'max'=>120),
			array('nivelcuenta', 'length', 'max'=>2),
                        array('cuentacontableniff', 'unique'),
                        array('cuentacontableniff', 'verificaCuenta'),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idcuentaniff, cuentacontableniff, nombrecuenta, tipocuenta, nivelcuenta', 'safe', 'on'=>'search'),
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
			'idcuentaniff' => MessageHandler::transformar('idcuentaniff','Parametros','PlanCuentasNiff'),
			'cuentacontableniff' => MessageHandler::transformar('cuentacontableniff','Parametros','PlanCuentasNiff'),
			'nombrecuenta' => MessageHandler::transformar('nombrecuenta','Parametros','PlanCuentasNiff'),
			'tipocuenta' => MessageHandler::transformar('tipocuenta','Parametros','PlanCuentasNiff'),
			'nivelcuenta' => MessageHandler::transformar('nivelcuenta','Parametros','PlanCuentasNiff'),
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

		$criteria->compare('idcuentaniff',$this->idcuentaniff);
		$criteria->compare('cuentacontableniff',$this->cuentacontableniff,true);
		$criteria->compare('nombrecuenta',$this->nombrecuenta,true);
		$criteria->compare('tipocuenta',$this->tipocuenta,true);
		$criteria->compare('nivelcuenta',$this->nivelcuenta,true);
                $criteria->order='cuentacontableniff';
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
                        array('name'=>'cuentacontableniff','type'=>'raw','value'=>'CHtml::link($data->cuentacontableniff,array("update","id"=>$data->idcuentaniff))'),
			'nombrecuenta',
			'tipocuenta',
			'nivelcuenta',
         );

            return $gridlista;
        }
        /*
         *Sobreescribe la funcion basica de Yii, antes de guardar
         *aqui se generan los niveles de la cuenta, una vez que se ha validado la cuenta es
         * correcta
         */
        protected function  beforeValidate() {
                //poner el calculo del nivel de la cuenta
                $this->cuentacontableniff=str_replace (" ", "", trim($this->cuentacontableniff));
                $texto=CuentaContable::existeNivel($this->cuentacontableniff);
                $val=CuentaContable::siguienteNivel($this->cuentacontableniff);

                $this->tipocuenta=($val['tipoc']==false)? 0 : 1;
                $this->nivelcuenta=$val['cnivel'];
                
                return parent::beforeValidate();

        }
 /*
         * Genera el tipo de cuenta y el nivel
         */
        protected function  beforeSave() {
            $this->cuentacontableniff=str_replace (" ", "", trim($this->cuentacontableniff));
           
            return parent::beforeSave();
        }
        
        /*
         * Concatena el codigo de la cuenta con el nombre ,
         * da una mejor vivisibilidad al usuario
         *@$return <string>
         */
        public function getConcatened(){

            return $this->cuentacontableniff.' | '.$this->nombrecuenta;
        }

        /*
         * Verifica si la cuenta contable que se esta ingresando es una
         * cuenta valida
         *@return <Error>
         */
      	public function verificaCuenta($attribute, $params) {
                if($this->cuentacontableniff!='1.'){
                        $texto=CuentaContable::existeNivel($this->cuentacontableniff);
                        $model=Plancuentasniff::model()->findAll(array('condition'=>' trim("cuentacontableniff") =:x', 'params'=>array(':x'=>$texto)));
                        if($model==null)
                            $this->addError('cuentacontableniff',MessageHandler::transformar('error_cuenta','Parametros','PlanCuentasNiff'));
                }

                
	}
        /*
         *  Busca la cuenta contable en el plan de cuentas ,dependiendo del parametro que
         *  @var <string> $param Parametro de busqueda
         *  @return <CDbCriteria>
         */

        public function buscaCuentaNiff($param,$limit=20){
            $crit=new CDbCriteria();
            $crit->addCondition("(trim(\"cuentacontableniff\") LIKE :parametro or trim(\"nombrecuenta\") LIKE :parametro)");
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
               
                return trim($model->cuentacontableniff).' | '.trim($model->nombrecuenta);
            }else
                return '';

        }




}