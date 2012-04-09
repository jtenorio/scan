<?php

/**
 * This is the model class for table "cuentasbancarias".
 *
 * The followings are the available columns in table 'cuentasbancarias':
 * @property integer $idcuentabancaria
 * @property string $descripcion
 * @property integer $idbanco
 * @property string $numerocuenta
 * @property integer $idcuentanec
 * @property string $asistentecuenta
 * @property string $telefonoasistente
 * @property string $ayudanteasistente
 * @property boolean $chequeautomatico
 * @property string $numerocheque
 * @property string $ubicacionimpresion
 * @property integer $idempresa
 *
 * The followings are the available model relations:
 * @property Maestroasiento[] $maestroasientos
 * @property Movimientosbancarios[] $movimientosbancarioses
 * @property Plancuentasnec $cuentacontable
 * @property Banco $banco
 */
class Cuentabancaria extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CuentaBancaria the static model class
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
		return 'cuentasbancarias';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descripcion, idbanco, numerocuenta, chequeautomatico, ubicacionimpresion, idempresa', 'required'),
			array('idbanco, idcuentanec, idempresa', 'numerical', 'integerOnly'=>true),
			array('descripcion, asistentecuenta, ayudanteasistente', 'length', 'max'=>50),
			array('numerocuenta, telefonoasistente', 'length', 'max'=>20),
			array('numerocheque', 'length', 'max'=>10),
			array('ubicacionimpresion', 'length', 'max'=>120),
                    array('numerocuenta, telefonoasistente,numerocheque', 'numerical','min'=>0),
                    
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idcuentabancaria, descripcion, idbanco, numerocuenta, idcuentanec, asistentecuenta, telefonoasistente, ayudanteasistente, chequeautomatico, numerocheque, ubicacionimpresion, idempresa', 'safe', 'on'=>'search'),
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
			'maestroasientos' => array(self::HAS_MANY, 'Maestroasiento', 'idcuentabancaria'),
			'movimientosbancarioses' => array(self::HAS_MANY, 'Movimientosbancarios', 'idcuentabancaria'),
			'cuentacontable' => array(self::BELONGS_TO, 'Plancuentasnec', 'idcuentanec'),
			'banco' => array(self::BELONGS_TO, 'Banco', 'idbanco'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcuentabancaria' =>MessageHandler::transformar('Idcuentabancaria','Parametros','CuentaBancaria'),
			'descripcion' =>MessageHandler::transformar( 'Descripcion','Parametros','CuentaBancaria'),
			'idbanco' =>MessageHandler::transformar( 'Idbanco','Parametros','CuentaBancaria'),
			'numerocuenta' => MessageHandler::transformar('Numerocuenta','Parametros','CuentaBancaria'),
			'idcuentanec' =>MessageHandler::transformar('Idcuentanec','Parametros','CuentaBancaria'),
			'asistentecuenta' =>MessageHandler::transformar( 'Asistentecuenta','Parametros','CuentaBancaria'),
			'telefonoasistente' =>MessageHandler::transformar( 'Telefonoasistente','Parametros','CuentaBancaria'),
			'ayudanteasistente' => MessageHandler::transformar('Ayudanteasistente','Parametros','CuentaBancaria'),
			'chequeautomatico' =>MessageHandler::transformar( 'Chequeautomatico','Parametros','CuentaBancaria'),
			'numerocheque' =>MessageHandler::transformar('Numerocheque','Parametros','CuentaBancaria'),
			'ubicacionimpresion' =>MessageHandler::transformar( 'Ubicacionimpresion','Parametros','CuentaBancaria'),
			'idempresa' =>MessageHandler::transformar( 'Idempresa','Parametros','CuentaBancaria'),
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

		$criteria->compare('idcuentabancaria',$this->idcuentabancaria);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('idbanco',$this->idbanco);
		$criteria->compare('numerocuenta',$this->numerocuenta,true);
		$criteria->compare('idcuentanec',$this->idcuentanec);
		$criteria->compare('asistentecuenta',$this->asistentecuenta,true);
		$criteria->compare('telefonoasistente',$this->telefonoasistente,true);
		$criteria->compare('ayudanteasistente',$this->ayudanteasistente,true);
		$criteria->compare('chequeautomatico',$this->chequeautomatico);
		$criteria->compare('numerocheque',$this->numerocheque,true);
		$criteria->compare('ubicacionimpresion',$this->ubicacionimpresion,true);
		$criteria->compare('idempresa',$this->idempresa);

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
                	
                         array('name'=>'descripcion','type'=>'raw','value'=>'CHtml::link($data->descripcion,array("update","id"=>$data->idcuentabancaria))'),
			
			array('name'=>'idbanco','type'=>'raw','value'=>'CHtml::link($data->banco->nombre,array("banco/update","id"=>$data->idcuentabancaria))'),
                        'numerocuenta',

                       
			array('name'=>'idcuentanec','type'=>'raw','value'=>'CHtml::link($data->cuentacontable->nombrecuenta,array("plancuentasnec/update","id"=>$data->idcuentanec))'),
                        'asistentecuenta',
			'telefonoasistente',
			 array('name'=>'chequeautomatico','type'=>'raw','value'=>'$data->chuequeAutomatico()'),
                        'numerocheque',
        		
                        array('name'=>'idempresa','type'=>'raw','value'=>'$data->getNombreEmpresa()'),
            );

            return $gridlista;
        }
        /*
         * Devuelve el valor Si o No de un campo Booleano
         * para ser mostrado en la lista
         * @return <string>
         */
        public function chuequeAutomatico(){
            if($this->chequeautomatico)
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

         /*
         *  Busca la cuenta bancaria
         *  @var <string> $param Parametro de busqueda
         *  @return <CDbCriteria>
         */

        public function buscaCuentaBancaria($param,$limit=20){
            $crit=new CDbCriteria();
            $crit->addCondition("(trim(\"descripcion\") LIKE :parametro)");
            $crit->params=array(':parametro' =>"%$param%");
            $crit->limit=$limit;
            return  $crit;

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
                return trim($model->idcuentabancaria).' | '.trim($model->descripcion);
            }else
                return '';

        }



}