<?php

/**
 * This is the model class for table "categoria".
 *
 * The followings are the available columns in table 'categoria':
 * @property integer $id
 * @property string $nombre
 * @property boolean $categoriaprincipal
 * @property string $identificador
 * @property integer $idempresa
 * @property integer $cat_id
 */
class Categoria extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Categoria the static model class
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
		return 'categoria';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, categoriaprincipal', 'required'),
			array('idempresa, cat_id', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>120),
			array('identificador', 'length', 'max'=>40),
                        array('identificador+idempresa', 'application.modules.parametros.extensions.uniqueMultiColumnValidator'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, categoriaprincipal, identificador, idempresa', 'safe', 'on'=>'search'),
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
			'id' =>  MessageHandler::transformar('id','Parametros','Categoria'),
			'nombre' =>  MessageHandler::transformar('nombre','Parametros','Categoria'),
			'categoriaprincipal' =>  MessageHandler::transformar('categoriaprincipal','Parametros','Categoria'),
			'identificador' =>  MessageHandler::transformar('identificador','Parametros','Categoria'),
			'idempresa' =>  MessageHandler::transformar('idempresa','Parametros','Categoria'),
                        'cat_id' =>  MessageHandler::transformar('cat_id','Parametros','Categoria'),
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
		$criteria->compare('categoriaprincipal',$this->categoriaprincipal);
		$criteria->compare('identificador',$this->identificador,true);
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
                
                        array('name'=>'categoriaprincipal','type'=>'raw','value'=>'$data->categoriaPrincipal()'),
                'identificador',
                 array('name'=>'cat_id','type'=>'raw','value'=>'$data->buscaNombre($data->cat_id)'),
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

        public function buscaCategoria($param,$limit=20){
            $crit=new CDbCriteria();
            $crit->addCondition("(trim(\"nombre\") LIKE :parametro or trim(\"identificador\") LIKE :parametro)");
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

                /*
         * Devuelve el valor Si o No de un campo Booleano
         * para ser mostrado en la lista
         * @return <string>
         */
        public function categoriaPrincipal(){
            if($this->categoriaprincipal)
                    return MessageHandler::transformar( 'si','Default','Sistema');
                else
                    return MessageHandler::transformar( 'no','Default','Sistema');
        }


}