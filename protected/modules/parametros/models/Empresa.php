<?php

/**
 * This is the model class for table "empresa".
 *
 * The followings are the available columns in table 'empresa':
 * @property integer $idempresa
 * @property string $ruc
 * @property string $razonsocial
 * @property string $direccion
 * @property string $telefono
 * @property string $fax
 * @property string $email
 * @property string $cedularepresentante
 * @property string $ruccontador
 * @property boolean $estado
 * @property string $logo
 * @property integer $idtipoagenteretencion
 */
class Empresa extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Empresa the static model class
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
		return 'empresa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ruc, razonsocial, direccion, telefono, idtipoagenteretencion', 'required'),
			array('idtipoagenteretencion', 'numerical', 'integerOnly'=>true),
			array('ruc, ruccontador', 'length', 'max'=>13,'min'=>13),
                        array('cedularepresentante', 'length', 'max'=>10,'min'=>10),
			array('razonsocial', 'length', 'max'=>120),
			array('direccion', 'length', 'max'=>80),
			array('telefono, fax', 'length', 'max'=>12),
			array('email', 'length', 'max'=>40),
                    	array('email', 'email'),

			array('logo', 'length', 'max'=>254),
			array('estado', 'safe'),
                        array('ruc','verificaRuc'),
                        array('ruc','unique'),
                        array('cedularepresentante','verificacionCedula'),
                        array('ruccontador','verificacionRuc'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idempresa, ruc, razonsocial, direccion, telefono, fax, email, cedularepresentante, ruccontador, estado, logo, idtipoagenteretencion', 'safe', 'on'=>'search'),
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
			'idempresa' => MessageHandler::transformar('idempresa','Parametros','Empresa'),
			'ruc' => MessageHandler::transformar('ruc','Parametros','Empresa'),
			'razonsocial' => MessageHandler::transformar('razonsocial','Parametros','Empresa'),
			'direccion' => MessageHandler::transformar('direccion','Parametros','Empresa'),
			'telefono' => MessageHandler::transformar('telefono','Parametros','Empresa'),
			'fax' => MessageHandler::transformar('fax','Parametros','Empresa'),
			'email' => MessageHandler::transformar('email','Parametros','Empresa'),
			'cedularepresentante' => MessageHandler::transformar('cedularepresentante','Parametros','Empresa'),
			'ruccontador' => MessageHandler::transformar('ruccontador','Parametros','Empresa'),
			'estado' => MessageHandler::transformar('estado','Parametros','Empresa'),
			'logo' => MessageHandler::transformar('logo','Parametros','Empresa'),
			'idtipoagenteretencion' => MessageHandler::transformar('idtipoagenteretencion','Parametros','Empresa'),
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

		$criteria->compare('idempresa',$this->idempresa);
		$criteria->compare('ruc',$this->ruc,true);
		$criteria->compare('razonsocial',$this->razonsocial,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('cedularepresentante',$this->cedularepresentante,true);
		$criteria->compare('ruccontador',$this->ruccontador,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('idtipoagenteretencion',$this->idtipoagenteretencion);
                $criteria->order="razonsocial";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        /*
         * Validacion ruc
         */
      	public function verificaRuc($attribute, $params) {
		$res = ValidacionCedulaRuc::procesarDocumento($this->ruc);
		if (!$res->valido)
			$this->addError('ruc', $res->mensaje);
		if (!$res->ruc)
			$this->addError('ruc', 'Debe ser un RUC');
	}

        /*
         * Validacion del ruc del contador y de la cedula representante
         * Si esta vacio no ejecuta ninguna validacion
         *
         */
        public function verificacionCedula ($attribute, $params) {

                if(!empty($this->cedularepresentante)){
                    $res = ValidacionCedulaRuc::procesarDocumento($this->cedularepresentante);
                    if (!$res->valido)
                            $this->addError('cedularepresentante', $res->mensaje);
                  /*  if (!$res->ruc)
                            $this->addError('cedularepresentante', 'Debe ser un Cedula Representante');*/
                }
	}
        /*
         * Validacion del ruc del contador 
         * Si esta vacio no ejecuta ninguna validacion
         *
         */
        public function verificacionRuc ($attribute, $params) {

                if(!empty($this->ruccontador)){
                    $res = ValidacionCedulaRuc::procesarDocumento($this->ruccontador);
                    if (!$res->valido)
                            $this->addError('ruccontador', $res->mensaje);
                    if (!$res->ruc)
                            $this->addError('ruccontador', 'Debe ser un Cedula');
                }
	}
        /*
         * Devuelve un array de todos los campos que se van a mostrar en
         * el grid
         */
        public function columnasLista(){
            $gridlista=array(
        		 array('name'=>'ruc','type'=>'raw','value'=>'CHtml::link($data->ruc,array("update","id"=>$data->idempresa))'),
			'razonsocial',
			'direccion',
			'telefono',
                        'email',
	    );

            return $gridlista;
        }
                /*
         *  Rertorna el nombre de la cuenta contable
         *  @var <integer> $idcuenta Id de la cuenta contable Niff
         *  @return <string>
         */

        public function buscaNombre($id){
            if($id==null)
                return '';
            $model=$this->model()->findByPk($id);
            if($model!=null){

                return trim($model->razonsocial);
            }else
                return '';

        }
}