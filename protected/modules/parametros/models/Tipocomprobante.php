<?php

/**
 * This is the model class for table "tipocomprobante".
 *
 * The followings are the available columns in table 'tipocomprobante':
 * @property integer $id
 * @property string $codigo
 * @property string $descripcion
 * @property string $sustentotributariorelacionado
 */
class Tipocomprobante extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TipoComprobante the static model class
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
		return 'tipocomprobante';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, descripcion,sustentotributariorelacionado', 'required'),
			array('codigo', 'length', 'max'=>3),
                        array('codigo', 'numerical','min'=>0),
			array('descripcion', 'length', 'max'=>120),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, codigo, descripcion', 'safe', 'on'=>'search'),
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
			'id' => MessageHandler::transformar('ud','Parametros','TipoComprobante'),
			'codigo' => MessageHandler::transformar('codigo','Parametros','TipoComprobante'),
			'descripcion' => MessageHandler::transformar('descripcion','Parametros','TipoComprobante'),
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
		$criteria->compare('descripcion',$this->descripcion,true);
                $criteria->order='"codigo"';
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
			'descripcion',
            );

            return $gridlista;
        }

        public function buscaIdentiCredito($id){
            if($id==null)
                return '';
            else{
                $model=$this->model()->findByPk($id);

                $sustentoTributarioRelacionadoArray = explode(',',$model->sustentotributariorelacionado);
                for($i=0;$i<count($sustentoTributarioRelacionadoArray);$i++){
                    $datos = trim($sustentoTributarioRelacionadoArray[$i]);
                    $data=Sustentocredito::model()->findAllBySql("SELECT * FROM sustentocredito WHERE codigo = '".$datos."'", array(':secuencial'=> $_POST['tipo_identificacion']));
                    $data=CHtml::listData($data,'id','nombre');

                    foreach($data as $value=>$name){
                        $datos2[$value] = $name;
                    }
                }
                return $datos2;
            }
        }
}