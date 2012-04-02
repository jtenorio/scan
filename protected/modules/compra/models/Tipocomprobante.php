<?php

/**
 * This is the model class for table "tipocomprobante".
 *
 * The followings are the available columns in table 'tipocomprobante':
 * @property integer $id
 * @property string $codigo
 * @property string $descripcion
 *
 * The followings are the available model relations:
 * @property Compraingreso[] $compraingresos
 * @property Documentosanulados[] $documentosanuladoses
 */
class Tipocomprobante extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Tipocomprobante the static model class
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
			array('codigo, descripcion', 'required'),
			array('codigo', 'length', 'max'=>3),
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
			'compraingresos' => array(self::HAS_MANY, 'Compraingreso', 'idtipocomprobante'),
			'documentosanuladoses' => array(self::HAS_MANY, 'Documentosanulados', 'idcomprobante'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'codigo' => 'Codigo',
			'descripcion' => 'Descripcion',
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        public function buscaNombre($id){

            if($id==null)
                return '';
            $model=$this->model()->findByPk($id);
            if($model!=null){
                return trim($model->descripcion);
            }else
                return '';
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