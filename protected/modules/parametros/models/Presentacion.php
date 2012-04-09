<?php

/**
 * This is the model class for table "presentacion".
 *
 * The followings are the available columns in table 'presentacion':
 * @property integer $id
 * @property string $nombre
 * @property string $cantidadpresentacion
 * @property string $salida
 * @property integer $idempresa
 */
class Presentacion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Presentacion the static model class
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
		return 'presentacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, cantidadpresentacion, salida', 'required'),
			array('idempresa', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>80),
			array('cantidadpresentacion, salida', 'length', 'max'=>10),
                        array('cantidadpresentacion, salida', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, cantidadpresentacion, salida, idempresa', 'safe', 'on'=>'search'),
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
			'id' => MessageHandler::transformar('id','Parametros','Presentacion'),
			'nombre' => MessageHandler::transformar('nombre','Parametros','Presentacion'),
			'cantidadpresentacion' => MessageHandler::transformar('cantidadpresentacion','Parametros','Presentacion'),
			'salida' => MessageHandler::transformar('salida','Parametros','Presentacion'),
			'idempresa' => MessageHandler::transformar('idempresa','Parametros','Presentacion'),
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('cantidadpresentacion',$this->cantidadpresentacion,true);
		$criteria->compare('salida',$this->salida,true);
		$criteria->compare('idempresa',$this->idempresa);
                $criteria->order="nombre";
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
                array('name'=>'nombre','type'=>'raw','value'=>'CHtml::link($data->nombre,array("update","id"=>$data->id))'),
                'cantidadpresentacion',
                'salida',
               // 'idempresa',
               array('name'=>'idempresa','type'=>'raw','value'=>'$data->getNombreEmpresa()'),
            );

            return $gridlista;
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
         *  Busca la cuenta contable en el plan de cuentas ,dependiendo del parametro que
         *  @var <string> $param Parametro de busqueda
         *  @return <CDbCriteria>
         */

        public function buscaPresentacion($param,$limit=20){
            $crit=new CDbCriteria();
            $crit->addCondition("(trim(\"nombre\") LIKE :parametro)");
            $crit->params=array(':parametro' =>"%$param%");
            $crit->limit=$limit;
            return  $crit;

        }

        /*
         *  Rertorna el nombre de la cuenta contable
         *  @var <integer> $idcuenta Id de la Categoria
         *  @return <string>
         */

        public function buscaNombre($id){
            if($id==null)
                return '';
            $model=$this->model()->findByPk($id);
            if($model!=null){
                return trim($model->nombre);
            }else
                return '';

        }


}