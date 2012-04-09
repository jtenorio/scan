<?php

/**
 * This is the model class for table "banco".
 *
 * The followings are the available columns in table 'banco':
 * @property integer $idbanco
 * @property string $codigobanco
 * @property string $nombre
 * @property string $direccion
 * @property string $telefono
 * @property string $paginaweb
 *
 * The followings are the available model relations:
 * @property Cuentasbancarias[] $cuentasbancariases
 */
class Banco extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Banco the static model class
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
		return 'banco';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigobanco, nombre, direccion, telefono', 'required'),
			array('codigobanco', 'length', 'max'=>2),
                        array('codigobanco', 'numerical', 'integerOnly'=>true),
                        array('telefono', 'numerical'),
                        array('codigobanco', 'numerical', 'min'=>0),
                        array('codigobanco', 'validarNumero'),
                        array('codigobanco','unique'),
			array('nombre', 'length', 'max'=>80),
			array('direccion, paginaweb', 'length', 'max'=>120),
			array('telefono', 'length', 'max'=>40),
                        array('idbanco,codigobanco','unique'),
                        array('paginaweb','url'),
                        
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idbanco, codigobanco, nombre, direccion, telefono, paginaweb', 'safe', 'on'=>'search'),
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
			'cuentasbancariases' => array(self::HAS_MANY, 'Cuentasbancarias', 'idbanco'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idbanco' => MessageHandler::transformar('Idbanco','Parametros','Banco'),
			'codigobanco' => MessageHandler::transformar('Codigo Banco','Parametros','Banco'),
			'nombre' => MessageHandler::transformar('Nombre','Parametros','Banco'),
			'direccion' => MessageHandler::transformar('Direccion','Parametros','Banco'),
			'telefono' => MessageHandler::transformar('Telefono','Parametros','Banco'),
			'paginaweb' => MessageHandler::transformar('Paginaweb','Parametros','Banco'),
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

		$criteria->compare('idbanco',$this->idbanco);
		$criteria->compare('codigobanco',$this->codigobanco,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('paginaweb',$this->paginaweb,true);
                $criteria->order="codigobanco";
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        /*
         * Valida que no se guarde un -
         *
         */
        public function validarNumero($attribute,$params){

            if($this->codigobanco=='-0'){
                $this->addError("codigobanco",MessageHandler::transformar('solo_numeros','Parametros','Banco'));
            }
        }
        /*
         * Devuelve un array de todos los campos que se van a mostrar en
         * el grid , puede enviarse con un array simple o como multiples array
         * 
         */
        public function columnasLista(){
            $gridlista=array(
                array('name'=>'codigobanco','type'=>'raw','value'=>'CHtml::link($data->codigobanco,array("update","id"=>$data->idbanco))'),
                'nombre',
                'direccion',
                'telefono',
                'paginaweb',
            );

            return $gridlista;
        }

               /*
         *  Busca la cuenta contable en el plan de cuentas ,dependiendo del parametro que
         *  @var <string> $param Parametro de busqueda
         *  @return <CDbCriteria>
         */

        public function buscaBanco($param,$limit=20){
            $crit=new CDbCriteria();
            $crit->addCondition("(trim(\"codigobanco\") LIKE :parametro or trim(\"nombre\") LIKE :parametro)");
            $crit->params=array(':parametro' =>"%$param%");
            $crit->limit=$limit;
            return  $crit;

        }

        /*
         *  Rertorna el nombre de la cuenta contable
         *  @var <integer> $idcuenta Id de la cuenta contable Niff
         *  @return <string>
         */

        public function buscaNombre($idbanco){
            if($idbanco==null)
                return '';
            $model=$this->model()->findByPk($idbanco);
            if($model!=null){

                return trim($model->codigobanco).' | '.trim($model->nombre);
            }else
                return '';

        }


}