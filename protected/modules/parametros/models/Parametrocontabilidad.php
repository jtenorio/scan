<?php

/**
 * This is the model class for table "parametrocontabilidad".
 *
 * The followings are the available columns in table 'parametrocontabilidad':
 * @property integer $idparametrocontabilidad
 * @property integer $idcuentaactivo
 * @property integer $idcuentapasivo
 * @property integer $idcuentapatrimonio
 * @property integer $idcuentaingreso
 * @property integer $idcuentaegreso
 * @property integer $idcuentaotros
 * @property integer $idcuentabancariapred
 * @property integer $idcuentacierreutilidad
 * @property string $reporteingreso
 * @property string $reporteegreso
 * @property string $reportecancelacion
 * @property string $reporteform104
 * @property string $reporteform103
 * @property string $direccionrespaldo
 * @property boolean $generadoasientocierre
 * @property boolean $usarcamporeferecia
 * @property boolean $usarcampodetallenorec
 * @property integer $iddocumentocompragasto
 * @property integer $iddocumentocomprainventario
 * @property integer $iddocumentoventas
 * @property integer $iddocumentocancelacion
 * @property integer $idcuentacierreperdida
 * @property string $anioejercicio
 * @property boolean $estado
 * @property integer $idempresa
 * @property string $numeroasiento
 
 */
class Parametrocontabilidad extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ParametroContabilidad the static model class
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
		return 'parametrocontabilidad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idcuentaactivo, idcuentapasivo, idcuentapatrimonio, idcuentaingreso, idcuentaegreso, idcuentabancariapred, idcuentacierreutilidad, iddocumentocompragasto, iddocumentocomprainventario, iddocumentoventas, iddocumentocancelacion, idcuentacierreperdida, anioejercicio, idempresa', 'required'),
			array('idcuentaactivo, idcuentapasivo, idcuentapatrimonio, idcuentaingreso, idcuentaegreso, idcuentaotros, idcuentabancariapred, idcuentacierreutilidad, iddocumentocompragasto, iddocumentocomprainventario, iddocumentoventas, iddocumentocancelacion, idcuentacierreperdida, idempresa', 'numerical', 'integerOnly'=>true),
			array('reporteingreso, reporteegreso, reportecancelacion, reporteform104, reporteform103, direccionrespaldo', 'length', 'max'=>254),
			array('anioejercicio', 'length', 'max'=>4),
			array('numeroasiento', 'length', 'max'=>10),
                        
                        array('idempresa+anioejercicio', 'application.modules.parametros.extensions.uniqueMultiColumnValidator'),
			array('generadoasientocierre, usarcamporeferecia, usarcampodetallenorec, estado', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idparametrocontabilidad, idcuentaactivo, idcuentapasivo, idcuentapatrimonio, idcuentaingreso, idcuentaegreso, idcuentaotros, idcuentabancariapred, idcuentacierreutilidad, reporteingreso, reporteegreso, reportecancelacion, reporteform104, reporteform103, direccionrespaldo, generadoasientocierre, usarcamporeferecia, usarcampodetallenorec, iddocumentocompragasto, iddocumentocomprainventario, iddocumentoventas, iddocumentocancelacion, idcuentacierreperdida, anioejercicio, estado, idempresa, numeroasiento', 'safe', 'on'=>'search'),
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
			'idparametrocontabilidad' => MessageHandler::transformar('idparametrocontabilidad','Parametros','ParametroContabilidad'),
			'idcuentaactivo' => MessageHandler::transformar('idcuentaactivo','Parametros','ParametroContabilidad'),
			'idcuentapasivo' => MessageHandler::transformar('idcuentapasivo','Parametros','ParametroContabilidad'),
			'idcuentapatrimonio' => MessageHandler::transformar('idcuentapatrimonio','Parametros','ParametroContabilidad'),
			'idcuentaingreso' => MessageHandler::transformar('idcuentaingreso','Parametros','ParametroContabilidad'),
			'idcuentaegreso' => MessageHandler::transformar('idcuentaegreso','Parametros','ParametroContabilidad'),
			'idcuentaotros' => MessageHandler::transformar('idcuentaotros','Parametros','ParametroContabilidad'),
			'idcuentabancariapred' => MessageHandler::transformar('idcuentabancariapred','Parametros','ParametroContabilidad'),
			'idcuentacierreutilidad' => MessageHandler::transformar('idcuentacierreutilidad','Parametros','ParametroContabilidad'),
			'reporteingreso' => MessageHandler::transformar('reporteingreso', 'Parametros', 'ParametroContabilidad'),
			'reporteegreso' => MessageHandler::transformar('reporteegreso','Parametros','ParametroContabilidad'),
			'reportecancelacion' => MessageHandler::transformar('reportecancelacion','Parametros','ParametroContabilidad'),
			'reporteform104' => MessageHandler::transformar('reporteform104','Parametros','ParametroContabilidad'),
			'reporteform103' => MessageHandler::transformar('reporteform103','Parametros','ParametroContabilidad'),
			'direccionrespaldo' => MessageHandler::transformar('direccionrespaldo','Parametros','ParametroContabilidad'),
			'generadoasientocierre' => MessageHandler::transformar('generadoasientocierre', 'Parametros', 'ParametroContabilidad'),
			'usarcamporeferecia' => MessageHandler::transformar('usarcamporeferecia','Parametros','ParametroContabilidad'),
			'usarcampodetallenorec' => MessageHandler::transformar('usarcampodetallenorec','Parametros','ParametroContabilidad'),
			'iddocumentocompragasto' => MessageHandler::transformar('iddocumentocompragasto','Parametros','ParametroContabilidad'),
			'iddocumentocomprainventario' => MessageHandler::transformar('iddocumentocomprainventario','Parametros','ParametroContabilidad'),
			'iddocumentoventas' => MessageHandler::transformar('iddocumentoventas','Parametros','ParametroContabilidad'),
			'iddocumentocancelacion' => MessageHandler::transformar('iddocumentocancelacion','Parametros','ParametroContabilidad'),
			'idcuentacierreperdida' => MessageHandler::transformar('idcuentacierreperdida','Parametros','ParametroContabilidad'),
			'anioejercicio' => MessageHandler::transformar('anioejercicio','Parametros','ParametroContabilidad'),
			'estado' => MessageHandler::transformar('estado','Parametros','ParametroContabilidad'),
			'idempresa' => MessageHandler::transformar('idempresa','Parametros','ParametroContabilidad'),
			'numeroasiento' => MessageHandler::transformar('numeroasiento','Parametros','ParametroContabilidad'),
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

		$criteria->compare('idparametrocontabilidad',$this->idparametrocontabilidad);
		$criteria->compare('idcuentaactivo',$this->idcuentaactivo);
		$criteria->compare('idcuentapasivo',$this->idcuentapasivo);
		$criteria->compare('idcuentapatrimonio',$this->idcuentapatrimonio);
		$criteria->compare('idcuentaingreso',$this->idcuentaingreso);
		$criteria->compare('idcuentaegreso',$this->idcuentaegreso);
		$criteria->compare('idcuentaotros',$this->idcuentaotros);
		$criteria->compare('idcuentabancariapred',$this->idcuentabancariapred);
		$criteria->compare('idcuentacierreutilidad',$this->idcuentacierreutilidad);
		$criteria->compare('reporteingreso',$this->reporteingreso,true);
		$criteria->compare('reporteegreso',$this->reporteegreso,true);
		$criteria->compare('reportecancelacion',$this->reportecancelacion,true);
		$criteria->compare('reporteform104',$this->reporteform104,true);
		$criteria->compare('reporteform103',$this->reporteform103,true);
		$criteria->compare('direccionrespaldo',$this->direccionrespaldo,true);
		$criteria->compare('generadoasientocierre',$this->generadoasientocierre);
		$criteria->compare('usarcamporeferecia',$this->usarcamporeferecia);
		$criteria->compare('usarcampodetallenorec',$this->usarcampodetallenorec);
		$criteria->compare('iddocumentocompragasto',$this->iddocumentocompragasto);
		$criteria->compare('iddocumentocomprainventario',$this->iddocumentocomprainventario);
		$criteria->compare('iddocumentoventas',$this->iddocumentoventas);
		$criteria->compare('iddocumentocancelacion',$this->iddocumentocancelacion);
		$criteria->compare('idcuentacierreperdida',$this->idcuentacierreperdida);
		$criteria->compare('anioejercicio',$this->anioejercicio,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('idempresa',$this->idempresa);
		$criteria->compare('numeroasiento',$this->numeroasiento,true);

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
                array('name'=>'anioejercicio','type'=>'raw','value'=>'CHtml::link($data->anioejercicio,array("update","id"=>$data->idparametrocontabilidad))'),
               'numeroasiento',
            );

            return $gridlista;
        }

        
        
}