<?php

/**
 * This is the model class for table "establecimiento".
 *
 * The followings are the available columns in table 'establecimiento':
 * @property integer $id
 * @property string $establecimiento
 * @property string $puntoemision
 * @property string $nombre
 * @property string $numeronotadeventa
 * @property string $numerofactura
 * @property string $numeronotacredito
 * @property string $numeronotaentrega
 * @property string $numeroretencion
 * @property string $autorizacionnotaventa
 * @property string $autorizacionfactura
 * @property string $autorizacionnotacredito
 * @property string $autorizacionretencion
 * @property string $impresionnotaventa
 * @property string $impresionfactura
 * @property string $impresionnotacredito
 * @property string $impresionnotaentrega
 * @property string $impresionretencion
 * @property boolean $retencionautomatica
 * @property string $documentopredeterminado
 * @property integer $bodegapredeterminada
 * @property boolean $usaservicios
 * @property integer $cuentacontableservicios
 * @property integer $porcentajeservicios
 * @property integer $idempresa
 */
class Establecimiento extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Establecimiento the static model class
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
		return 'establecimiento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('establecimiento, puntoemision, nombre, documentopredeterminado, bodegapredeterminada, idempresa', 'required'),
			array('bodegapredeterminada, cuentacontableservicios, porcentajeservicios, idempresa', 'numerical', 'integerOnly'=>true),
			array('establecimiento, puntoemision', 'length', 'max'=>3),
			array('nombre', 'length', 'max'=>80),
			array('numeronotadeventa, numerofactura, numeronotacredito, numeronotaentrega, numeroretencion, autorizacionnotaventa, autorizacionfactura, autorizacionnotacredito, autorizacionretencion', 'length', 'max'=>10),
			array('impresionnotaventa, impresionfactura, impresionnotacredito, impresionnotaentrega, impresionretencion', 'length', 'max'=>150),
			array('documentopredeterminado', 'length', 'max'=>2),
			array('retencionautomatica, usaservicios', 'safe'),
                        array('numeronotadeventa, numerofactura, numeronotacredito, numeronotaentrega, numeroretencion, autorizacionnotaventa,
                               autorizacionfactura, autorizacionnotacredito, autorizacionretencion', 'numerical'),
                        array('establecimiento+puntoemision+idempresa', 'application.modules.parametros.extensions.uniqueMultiColumnValidator'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, establecimiento, puntoemision, nombre, numeronotadeventa, numerofactura, numeronotacredito, numeronotaentrega, numeroretencion, autorizacionnotaventa, autorizacionfactura, autorizacionnotacredito, autorizacionretencion, impresionnotaventa, impresionfactura, impresionnotacredito, impresionnotaentrega, impresionretencion, retencionautomatica, documentopredeterminado, bodegapredeterminada, usaservicios, cuentacontableservicios, porcentajeservicios, idempresa', 'safe', 'on'=>'search'),
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
			'id' => MessageHandler::transformar('id','Parametros','Establecimiento'),
			'establecimiento' => MessageHandler::transformar('establecimiento','Parametros','Establecimiento'),
			'puntoemision' => MessageHandler::transformar('puntoemision','Parametros','Establecimiento'),
			'nombre' => MessageHandler::transformar('nombre','Parametros','Establecimiento'),
			'numeronotadeventa' => MessageHandler::transformar('numeronotadeventa','Parametros','Establecimiento'),
			'numerofactura' => MessageHandler::transformar('numerofactura','Parametros','Establecimiento'),
			'numeronotacredito' => MessageHandler::transformar('numeronotacredito','Parametros','Establecimiento'),
			'numeronotaentrega' => MessageHandler::transformar('numeronotaentrega','Parametros','Establecimiento'),
			'numeroretencion' => MessageHandler::transformar('numeroretencion','Parametros','Establecimiento'),
			'autorizacionnotaventa' => MessageHandler::transformar('autorizacionnotaventa','Parametros','Establecimiento'),
			'autorizacionfactura' => MessageHandler::transformar('autorizacionfactura','Parametros','Establecimiento'),
			'autorizacionnotacredito' => MessageHandler::transformar('autorizacionnotacredito','Parametros','Establecimiento'),
			'autorizacionretencion' => MessageHandler::transformar('autorizacionretencion','Parametros','Establecimiento'),
			'impresionnotaventa' => MessageHandler::transformar('impresionnotaventa','Parametros','Establecimiento'),
			'impresionfactura' => MessageHandler::transformar('impresionfactura','Parametros','Establecimiento'),
			'impresionnotacredito' => MessageHandler::transformar('impresionnotacredito','Parametros','Establecimiento'),
			'impresionnotaentrega' => MessageHandler::transformar('impresionnotaentrega', 'Parametros', 'Establecimiento'),
			'impresionretencion' =>MessageHandler::transformar( 'impresionretencion', 'Parametros', 'Establecimiento'),
			'retencionautomatica' => MessageHandler::transformar('retencionautomatica','Parametros','Establecimiento'),
			'documentopredeterminado' => MessageHandler::transformar('documentopredeterminado', 'Parametros', 'Establecimiento'),
			'bodegapredeterminada' => MessageHandler::transformar('bodegapredeterminada', 'Parametros', 'Establecimiento'),
			'usaservicios' =>MessageHandler::transformar( 'usaservicios','Parametros','Establecimiento'),
			'cuentacontableservicios' => MessageHandler::transformar('cuentacontableservicios','Parametros','Establecimiento'),
			'porcentajeservicios' => MessageHandler::transformar('porcentajeservicios','Parametros','Establecimiento'),
			'idempresa' =>MessageHandler::transformar('idempresa','Parametros','Establecimiento'),
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
		$criteria->compare('establecimiento',$this->establecimiento,true);
		$criteria->compare('puntoemision',$this->puntoemision,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('numeronotadeventa',$this->numeronotadeventa,true);
		$criteria->compare('numerofactura',$this->numerofactura,true);
		$criteria->compare('numeronotacredito',$this->numeronotacredito,true);
		$criteria->compare('numeronotaentrega',$this->numeronotaentrega,true);
		$criteria->compare('numeroretencion',$this->numeroretencion,true);
		$criteria->compare('autorizacionnotaventa',$this->autorizacionnotaventa,true);
		$criteria->compare('autorizacionfactura',$this->autorizacionfactura,true);
		$criteria->compare('autorizacionnotacredito',$this->autorizacionnotacredito,true);
		$criteria->compare('autorizacionretencion',$this->autorizacionretencion,true);
		$criteria->compare('impresionnotaventa',$this->impresionnotaventa,true);
		$criteria->compare('impresionfactura',$this->impresionfactura,true);
		$criteria->compare('impresionnotacredito',$this->impresionnotacredito,true);
		$criteria->compare('impresionnotaentrega',$this->impresionnotaentrega,true);
		$criteria->compare('impresionretencion',$this->impresionretencion,true);
		$criteria->compare('retencionautomatica',$this->retencionautomatica);
		$criteria->compare('documentopredeterminado',$this->documentopredeterminado,true);
		$criteria->compare('bodegapredeterminada',$this->bodegapredeterminada);
		$criteria->compare('usaservicios',$this->usaservicios);
		$criteria->compare('cuentacontableservicios',$this->cuentacontableservicios);
		$criteria->compare('porcentajeservicios',$this->porcentajeservicios);
		$criteria->compare('idempresa',$this->idempresa);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        protected function  beforeSave() {

                $this->numeronotadeventa=(empty($this->numeronotadeventa))? 0 : $this->numeronotadeventa;
		$this->numerofactura=(empty($this->numerofactura))? 0 : $this->numerofactura;
		$this->numeronotacredito=(empty($this->numeronotacredito))? 0 : $this->numeronotacredito;
		$this->numeronotaentrega=(empty($this->numeronotaentrega))? 0 : $this->numeronotaentrega;
		$this->numeroretencion=(empty($this->numeroretencion))? 0 : $this->numeroretencion;
		$this->autorizacionnotaventa=(empty($this->autorizacionnotaventa))? 0 : $this->autorizacionnotaventa;
		$this->autorizacionfactura=(empty($this->autorizacionfactura))? 0 : $this->autorizacionfactura;
		$this->autorizacionnotacredito=(empty($this->autorizacionnotacredito))? 0 : $this->autorizacionnotacredito;
		$this->autorizacionretencion=(empty($this->autorizacionretencion))? 0 : $this->autorizacionretencion;

            return parent::beforeSave();
        }
        /*
         * Devuelve un array de todos los campos que se van a mostrar en
         * el grid , puede enviarse con un array simple o como multiples array
         *
         */
        public function columnasLista(){
            $gridlista=array(
                array('name'=>'establecimiento','type'=>'raw','value'=>'CHtml::link($data->establecimiento."-".$data->puntoemision,array("update","id"=>$data->id))'),
                
                'nombre',
                'numeronotadeventa',
                'numerofactura',
                'numeroretencion',
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

        public function buscaNombre($id){

            if($id==null)
                return '';
            $model=$this->model()->findByPk($id);
            if($model!=null){
                return trim($model->nombre);
            }else
                return '';
        }

        public function buscaRetencionAutomatica($id){

            if($id==null)
                return '';
            $model=$this->model()->findByPk($id);
            if($model!=null){
                return trim($model->retencionautomatica);
            }else
                return '';
        }

        public function buscaEstablecimiento($id){

            if($id==null)
                return '';
            $model=$this->model()->findByPk($id);
            if($model!=null){
                return trim($model->establecimiento);
            }else
                return '';
        }

        public function buscaPuntoEmision($id){

            if($id==null)
                return '';
            $model=$this->model()->findByPk($id);
            if($model!=null){
                return trim($model->puntoemision);
            }else
                return '';
        }

        public function buscaNumeroRetencion($id){

            if($id==null)
                return '';
            $model=$this->model()->findByPk($id);
            if($model!=null){
                return trim($model->numeroretencion);
            }else
                return '';
        }

        public function buscaAutorizacionRetencion($id){

            if($id==null)
                return '';
            $model=$this->model()->findByPk($id);
            if($model!=null){
                return trim($model->autorizacionretencion);
            }else
                return '';
        }

        

}
?>