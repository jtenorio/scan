<?php

class DefaultController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

        private $formTipoIdentificacion;
        private $formProveedor;
        private $formPorcentajeIva;
        private $formPorcentajeIce;
        private $formCodigoRetencionFuente;
        private $formIdentiCredito;
        private $formPorcentajeIvaRetencion;
        private $formFormaPago;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules(){
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','dynamiccities','cargarTipoComprobante','cargarImpuestoRenta','buscarAjaxProveedor'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$compra=new Compra;

                $resultado=array('error'=>'','url'=>'');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Compra'])){
                    try{
                        $model->attributes=$_POST['Compra'];
                        $model->autorizacompra=$_POST[''];

                        if ($model->validate()){
                        if($model->save())
                                $this->redirect(array('view','id'=>$model->idcompra));
                        }else
                            $resultado['error'][]=$model->getErrors();
                    }catch(Exception $ex){
                        $resultado['error'][]=$ex->getMessage();
                    }
		}
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Compra']))
		{
			$model->attributes=$_POST['Compra'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idcompra));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{

            $this->render('index');
//                $formaPago = $this->cargarFormaPago();
//                $codigosRetencionFuente = $this->cargarCodigosRetencionFuente();
//                $porcentajeIvaRetencion = $this->cargarPorcentajeIvaRetencion();
//                $proveedor = $this->cargarProveedor();
//                $tipoIdentificacion = $this->cargarTipoIdentificacion();
//                $tipoComprobante = $this->actionCargarTipoComprobante();
//                $porcentajeIva = $this->cargarPorcentajeIva();
//                $porcentajeIce = $this->cargarPorcentajeIce();
//                $tipoPago = $this->cargarTipoPago();
//                $identiCredito = $this->cargarIdentiCredito();
//                $ubicacionForm104 = $this->cargarUbicacionForm104();
//		$dataProvider=new CActiveDataProvider('Compra');
//		$this->render('index',array(
//			'proveedor'=>$proveedor,
//                        'dataProvider'=>$dataProvider,
//                        'tipoIdentificacion'=>$tipoIdentificacion,
//                        'tipoComprobante'=>$tipoComprobante,
//                        'porcentajeIva'=>$porcentajeIva,
//                        'porcentajeIce'=>$porcentajeIce,
//                        'tipoPago'=>$tipoPago,
//                        'identiCredito'=>$identiCredito,
//                        'ubicacionForm104'=>$ubicacionForm104,
//                        'porcentajeIvaRetencion'=>$porcentajeIvaRetencion,
//                        'codigosRetencionFuente'=>$codigosRetencionFuente,
//                        'formaPago'=>$formaPago,
//		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Compra('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Compra']))
			$model->attributes=$_GET['Compra'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Compra::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='compra-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

        /**
	 * Carga los tipos de identificación en el formulario.
	 */
	protected function cargarTipoIdentificacion() {
		$tipoIdentificacion = TipoIdentificacion::model()->findAll(array('order'=>'codigo'));
		$tipoIdentificacionItems = CHtml::listData($tipoIdentificacion, 'id','codigo', 'nombre');
		$this->formTipoIdentificacion = $tipoIdentificacionItems;
                return $this->formTipoIdentificacion;
	}

        /**
	 * Carga los tipos de comprobantes.
	 */
	public function actionCargarTipoComprobante() {
            if(isset ($_POST['tipo_identificacion'])){
                $comprobante = $_POST['tipo_identificacion'];
                if($comprobante != ''){
                    $data=TipoComprobante::model()->findAllBySql("SELECT * FROM tipocomprobante WHERE sustentotributariorelacionado LIKE '%".$comprobante."%'", array(':secuencial'=> $_POST['tipo_identificacion']));
                    $data=CHtml::listData($data,'codigo','descripcion');
                    echo CHtml::tag('option',array('value'=>''),CHtml::encode('Seleccionar'),true);
                    foreach($data as $value=>$name){
                        echo CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
                    }
                }else
                    echo CHtml::tag('option',array('value'=>''),CHtml::encode('Seleccionar'),true);
            }
	}

        /**
	 * Carga los porcentajes de IVA.
	 */
	protected function cargarPorcentajeIva() {
		$porcentajeIva = PorcentajeIva::model()->findAll(array('order'=>'descripcion'));
		$porcentajeIvaItems = CHtml::listData($porcentajeIva, 'id', 'porcentaje', 'descripcion');
		$this->formPorcentajeIva = $porcentajeIvaItems;
                return $this->formPorcentajeIva;
	}

        /**
	 * Carga los PROVEEDORES.
	 */
	protected function cargarProveedor() {
		$proveedor = Proveedor::model()->findAll(array('order'=>'razonsocial'));
		$proveedorItems = CHtml::listData($proveedor, 'id', 'razonsocial');
		$this->formProveedor = $proveedorItems;
                return $this->formProveedor;
	}

        /**
	 * Carga los porcentajes de ICE.
	 */
	protected function cargarPorcentajeIce() {
		$porcentajeIce = PorcentajeIce::model()->findAll(array('order'=>'porcentaje'));
		$porcentajeIceItems = CHtml::listData($porcentajeIce, 'id', 'porcentaje', 'descripcion');
		$this->formPorcentajeIce = $porcentajeIceItems;
                return $this->formPorcentajeIce;
	}

        /**
	 * Carga los códigos de retención a la fuente.
	 */
	protected function cargarCodigosRetencionFuente() {
		$codigoRetencionFuente = CodigoRetencionFuente::model()->findAll(array('order'=>'porcentaje'));
		$codigoRetencionFuenteItems = CHtml::listData($codigoRetencionFuente, 'idcodretfuente', 'codigo', 'descripcion');
		$this->formCodigoRetencionFuente = $codigoRetencionFuenteItems;
                return $this->formCodigoRetencionFuente;
	}

        /**
	 * Carga los tipos de comprobantes.
	 */
	public function actionCargarImpuestoRenta() {
            if(isset ($_POST['cod_ret_fuente_1'])){
                $codigoRetencion = $_POST['cod_ret_fuente_1'];
                if($codigoRetencion != ''){                    
                    $data=CodigoRetencionFuente::model()->findAllBySql("SELECT * FROM codigoretencionfuente WHERE idcodretfuente=".$codigoRetencion, array(':secuencial'=> $_POST['cod_ret_fuente_1']));
                    $data=CHtml::listData($data,'porcentaje','codigo');  
                    foreach($data as $value=>$name){
                        echo $value;
                    }
                }else
                    echo "vacio";
            }else{
                echo "vacio";
            }
	}

        /**
	 * Carga los tipos de pago.
	 */
	protected function cargarTipoPago() {
		$tipoPago = array("1"=>"Proveedor Frecuente","2"=>"Caja Chica");

                return $tipoPago;
	}

        /**
	 * Carga los Identi Crédito.
	 */
	protected function cargarIdentiCredito() {
		$identiCredito = SustentoCredito::model()->findAll(array('order'=>'codigo'));
		$codigoRetencionFuenteItems = CHtml::listData($identiCredito, 'id', 'codigo', 'nombre');
		$this->formIdentiCredito = $codigoRetencionFuenteItems;
                return $this->formIdentiCredito;
	}

        /**
	 * Carga las ubicaciones en el formulario 104.
	 */
	protected function cargarUbicacionForm104() {
		$ubicacionForm104 = array(
                                            "1"=>"Locales",
                                            "2"=>"Activos Fijos",
                                            "3"=>"Reembolso",
                                            "4"=>"RISE",
                                            "5"=>"No Sustenta",
                                         );

                return $ubicacionForm104;
	}

        public function actionDynamiccities(){
            $data=PorcentajeIva::model()->findAll('id=:id',
                          array(':id'=>(int) $_POST['country_id']));

            $data=CHtml::listData($data,'id','descripcion');
            foreach($data as $value=>$name)
            {
                echo CHtml::tag('option',
                           array('value'=>$value),CHtml::encode($name),true);
            }            
        }

        /**
	 * Carga los porcentajes de IVA retención.
	 */
	protected function cargarPorcentajeIvaRetencion() {
		$porcentajeIvaRetencion = PorcentajeRetencionIva::model()->findAll(array('order'=>'porcentaje'));
		$porcentajeIvaRetencionItems = CHtml::listData($porcentajeIvaRetencion, 'id', 'porcentaje', 'descripcion');
		$this->formPorcentajeIvaRetencion = $porcentajeIvaRetencionItems;
                return $this->formPorcentajeIvaRetencion;
	}

        /**
	 * Carga las formas de pago.
	 */
	protected function cargarFormaPago() {
		$formaPago = FormaPago::model()->findAll(array('order'=>'id'));
		$formaPagoItems = CHtml::listData($formaPago, 'id', 'nombre');
		$this->formFormaPago = $formaPagoItems;
                return $this->formFormaPago;
	}

        /*
        * Carga todos los proveedores dependiendo del filtro de busqueda
        * pasado por ajax
        *
        */
       public function actionbuscarAjaxProveedor(){
            $param=$this->getParam('nombre');
            $modelo=$this->getParam('modelo');
            $obj_fk=$this->getParam('obj_fk');
            $obj_name=$this->getParam('obj_name');
            $id=$this->getParam('id');
            $model = new Proveedor;
           
            $criterio=$model->buscaProveedor($param);
            $lista=$model->findAll($criterio);
            $this->renderPartial('parametros.views.proveedor.popup.lista',compact('lista','modelo','obj_fk','obj_name','id'));


       }
}
