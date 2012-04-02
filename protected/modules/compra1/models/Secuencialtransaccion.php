<?php

/**
 * This is the model class for table "secuencialtransaccion".
 *
 * The followings are the available columns in table 'secuencialtransaccion':
 * @property integer $id
 * @property string $codigo
 * @property string $nombre
 * @property integer $modulousarse
 * @property integer $ididentificacion
 * @property string $tipocomprobanterelacionado
 */
class Secuencialtransaccion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Secuencialtransaccion the static model class
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
		return 'secuencialtransaccion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, nombre, modulousarse, ididentificacion,tipocomprobanterelacionado', 'required'),
			array('id, modulousarse, ididentificacion', 'numerical', 'integerOnly'=>true),
			array('codigo', 'length', 'max'=>2),
                        array('codigo','unique'),
			array('nombre', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, codigo, nombre, modulousarse, ididentificacion,tipocomprobanterelacionado', 'safe', 'on'=>'search'),
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
                    'tipoidentificacion'=>array(self::BELONGS_TO,'Tipoidentificacion','ididentificacion')
                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => MessageHandler::transformar('ID','Parametros','Secuencialtransaccion'),
			'codigo' => MessageHandler::transformar('codigo','Parametros','Secuencialtransaccion'),
			'nombre' => MessageHandler::transformar('nombre','Parametros','Secuencialtransaccion'),
			'modulousarse' => MessageHandler::transformar('modulousarse','Parametros','Secuencialtransaccion'),
			'ididentificacion' => MessageHandler::transformar('ididentificacion','Parametros','Secuencialtransaccion'),
                        'tipocomprobanterelacionado'=>    MessageHandler::transformar('tipocomprobanterelacionado','Parametros','Secuencialtransaccion'),
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('modulousarse',$this->modulousarse);
		$criteria->compare('ididentificacion',$this->ididentificacion);

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
			'nombre',
                        'modulousarse',
                        array('name'=>'ididentificacion','type'=>'raw','value'=>'$data->tipoidentificacion->nombre'),
                        
            );

            return $gridlista;
        }

        public function buscaTipoComprobante($id){
            if($id==null)
                return '';
            else{
                $model=$this->model()->findByPk($id);
                
                $tipoComprobanteRelacionadoArray = explode(',',$model->tipocomprobanterelacionado);
                for($i=0;$i<count($tipoComprobanteRelacionadoArray);$i++){
                    $datos = trim($tipoComprobanteRelacionadoArray[$i]);
                    $data=Tipocomprobante::model()->findAllBySql("SELECT * FROM tipocomprobante WHERE codigo = '".$datos."' AND codigo <> '5' AND codigo <> '4'", array(':secuencial'=> $_POST['tipo_identificacion']));
                    $datos1=CHtml::listData($data,'id','descripcion');
                    foreach($datos1 as $value=>$name){
                        $datos2[$value] = $name;
                    }
                } 
                return $datos2;
            }
        }

        public function buscaTipoComprobanteDevolucion($id){
            if($id==null)
                return '';
            else{
                $model=$this->model()->findByPk($id);

                $tipoComprobanteRelacionadoArray = explode(',',$model->tipocomprobanterelacionado);
                for($i=0;$i<count($tipoComprobanteRelacionadoArray);$i++){
                    $datos = trim($tipoComprobanteRelacionadoArray[$i]);
                    $data=Tipocomprobante::model()->findAllBySql("SELECT * FROM tipocomprobante WHERE codigo = '5' OR codigo = '4'", array(':secuencial'=> $_POST['tipo_identificacion']));
                    $datos1=CHtml::listData($data,'id','descripcion');
                    foreach($datos1 as $value=>$name){
                        $datos2[$value] = $name;
                    }
                }
                return $datos2;
            }
        }
}