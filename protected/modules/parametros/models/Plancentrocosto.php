<?php

/**
 * This is the model class for table "plancentrocosto".
 *
 * The followings are the available columns in table 'plancentrocosto':
 * @property integer $idcuentagasto
 * @property string $cuentagasto
 * @property string $nombrecuenta
 * @property boolean $tipocuenta
 * @property integer $nivelcuenta
 * @property integer $idempresa
 */
class Plancentrocosto extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PlanCentroCosto the static model class
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
		return 'plancentrocosto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cuentagasto, nombrecuenta, tipocuenta, nivelcuenta, idempresa', 'required'),
			array('nivelcuenta, idempresa', 'numerical', 'integerOnly'=>true),
			array('cuentagasto', 'length', 'max'=>40),
			array('nombrecuenta', 'length', 'max'=>120),
                        array('cuentagasto+idempresa', 'application.modules.parametros.extensions.uniqueMultiColumnValidator'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idcuentagasto, cuentagasto, nombrecuenta, tipocuenta, nivelcuenta, idempresa', 'safe', 'on'=>'search'),
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
			'idcuentagasto' => MessageHandler::transformar('idcuentagasto','Parametros','PlanCentroCosto'),
			'cuentagasto' => MessageHandler::transformar('cuentagasto','Parametros','PlanCentroCosto'),
			'nombrecuenta' => MessageHandler::transformar('nombrecuenta','Parametros','PlanCentroCosto'),
			'tipocuenta' => MessageHandler::transformar('tipocuenta','Parametros','PlanCentroCosto'),
			'nivelcuenta' => MessageHandler::transformar('nivelcuenta','Parametros','PlanCentroCosto'),
			'idempresa' => MessageHandler::transformar('idempresa','Parametros','PlanCentroCosto'),
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

		$criteria->compare('idcuentagasto',$this->idcuentagasto);
		$criteria->compare('cuentagasto',$this->cuentagasto,true);
		$criteria->compare('nombrecuenta',$this->nombrecuenta,true);
		$criteria->compare('tipocuenta',$this->tipocuenta);
		$criteria->compare('nivelcuenta',$this->nivelcuenta);
		$criteria->compare('idempresa',$this->idempresa);
                $criteria->order="cuentagasto";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

                /*
         * Devuelve un array de todos los campos que se van a mostrar en
         * el grid , puede enviarse con un array simple o como multiples array
         *
         */
        public function columnasLista(){
            $gridlista=array(
                
                array('name'=>'cuentagasto','type'=>'raw','value'=>'CHtml::link($data->cuentagasto,array("update","id"=>$data->idcuentagasto))'),
                'nombrecuenta',
                //'tipocuenta',
                   array('name'=>'tipocuenta','type'=>'raw','value'=>'$data->tipoAutomatico()'),
                'nivelcuenta',
                 array('name'=>'idempresa','type'=>'raw','value'=>'$data->getNombreEmpresa()'),
            );

            return $gridlista;
        }

               /*
         *  Busca la cuenta contable en el plan de cuentas ,dependiendo del parametro que
         *  @var <string> $param Parametro de busqueda
         *  @return <CDbCriteria>
         */

        public function buscaCentro($param,$limit=20){
            $crit=new CDbCriteria();
            $crit->addCondition("(trim(\"cuentagasto\") LIKE :parametro or trim(\"nombrecuenta\") LIKE :parametro)");
            $crit->params=array(':parametro' =>"%$param%");
            $crit->limit=$limit;
            return  $crit;

        }

        /*
         *  Rertorna el nombre de la cuenta contable
         *  @var <integer> $id Id de la cuenta contable
         *  @return <string>
         */

        public function buscaNombreCentro($id){
            if($id==null)
                return '';
            $model=$this->model()->findByPk($id);
            if($model!=null){

                return trim($model->cuentagasto).' | '.trim($model->nombrecuenta);
            }else
                return '';

        }

        protected function  beforeSave() {
           $this->cuentagasto=str_replace (" ", "", trim($this->cuentagasto));
           $texto=CuentaContable::existeNivel($this->cuentagasto);
           $val=CuentaContable::siguienteNivel($this->cuentagasto);

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
                $this->cuentagasto=str_replace (" ", "", trim($this->cuentagasto));
                $texto=CuentaContable::existeNivel($this->cuentagasto);
                $val=CuentaContable::siguienteNivel($this->cuentagasto);

                $this->tipocuenta=($val['tipoc']==false)? 0 : 1;
                $this->nivelcuenta=$val['cnivel'];

                return parent::beforeValidate();

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