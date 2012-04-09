<?php

class MaestroasientoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','detalle'),
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
		$model=new Maestroasiento;

                //Iniciar la session
                $session=new CHttpSession;
                $session->open();
                ///////////////////////////////////////////
                /*Obtener los comprobantes*/
                $comprobante = new Tipocomprobantecontable;
                                
                $listaComprobante = $comprobante->search();
                $comprobanteData =array();
                $comprobanteData[''] = 'Seleccione';
                
                $mensaje = "";
                
                foreach($listaComprobante->getData() as $comp)
                {
                    if($comp->idcomprobantecontable != 2)
                        $comprobanteData[$comp->idcomprobantecontable]= $comp->descripcion;
                }
                
                //inicializar los array
                $documentoData = array();
                $cuentasArray = array();
                
                
                //numero de documento
                $numeroDoc = NULL;
                $numeroComp =NULL;
                
                $documentoData[''] = 'Seleccione';
                
                //validar el tipo de comprobante para obtene los documentos
                
                
                if(isset($_POST['Maestroasiento']['idcomprobantecontable']))
                {
                    
                    /*Obtener los documentos*/
                    $documento = new Tipodocumentocontable();
                    $documento->tipocomprobante = $_POST['Maestroasiento']['idcomprobantecontable'];
                    $listaDocumento = $documento->search();

                    
                    foreach($listaDocumento->getData() as $doc)
                    {
                        $documentoData[$doc->iddocumento]= $doc->descripcion;
                    }
                
                    //
                    
                    if(isset($_POST['Maestroasiento']['iddocumento']) && $_POST['Maestroasiento']['idcomprobantecontable']!=3)
                    {
                        /*Obtener cuentas bancarias*/
                        $cuentas = new Cuentasbancarias;
                        $cuentas->idempresa = 1;
                        $listaCuentas = $cuentas->search();

                        $cuentasArray['']='NINGUNA';
                        foreach($listaCuentas->getData() as $cu)
                        {
                            $cuentasArray[$cu->idcuentabancaria] = $cu->descripcion;
                        }
                    }else{
                        //no esta disponible cuentas bancarias
                        $cuentasArray['']='NO DISPONIBLE';
                    }
                    
                    //obtener numero de comprobante
                    $comprobante = Tipocomprobantecontable::model()->findByPk($_POST['Maestroasiento']['idcomprobantecontable']);                   
                    $numeroComp = $comprobante->numeracion;
                    
                    if(isset($_POST['Maestroasiento']['iddocumento']))
                    {
                        //obtener el si automatico o no el numero de documento
                        $documento->iddocumento = $_POST['Maestroasiento']['iddocumento'];
                        $rowDocumento = $documento->search()->getData();
                        if(count($rowDocumento)){
                            if($rowDocumento[0]['numeraautomatico'])
                            {
                                $numeroDoc = $rowDocumento[0]['numerodocumento'];
                            }
                        }
                    }
                 }else{
                     if(isset($session['detalle_asiento_temp']))
                         unset($session['detalle_asiento_temp']);
                 }
                
                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                     //autocrear asientos
                     
                     if(isset($_POST['Maestroasiento']) && $_POST['Maestroasiento']['valormovimiento']!='' 
                             && $_POST['Maestroasiento']['idcuentabancaria']!=''
                             && !isset($session['detalle_asiento_temp']))
                     {


                            
                            //obtener la cuenta de banco
                            $cuentas = new Cuentasbancarias;
                            $cuentas->idcuentabancaria = $_POST['Maestroasiento']['idcuentabancaria'];
                            $listaCuentas = $cuentas->search()->getData();
                            $cuentaNec = $listaCuentas[0]->idcuentanec;
                            //obtener la cuenta contable
                            $cuenta = new Plancuentasnec;
                            $cuenta->idcuentanec = $cuentaNec;
                            $dataCuentaNec = $cuenta->search()->getData();


                            $detAsiento[0]['cuentacontable'] = $cuentaNec;
                            $detAsiento[0]['valordebe']= $_POST['Maestroasiento']['valormovimiento'];
                            $detAsiento[0]['valorhaber'] = 0;
                            $detAsiento[0]['subdetalle'] = $_POST['Maestroasiento']['detalle'];
                            $detAsiento[0]['nombre'] = "{$dataCuentaNec[0]->cuentacontable} ({$dataCuentaNec[0]->nombrecuenta})";
                            $session['detalle_asiento_temp']=$detAsiento;
                     }

                        if(isset($_POST['Maestroasiento']))
                        {
                            $model->attributes=$_POST['Maestroasiento'];
                            $model->numeroasiento = Parametrocontabilidad::getNuevoNumeroAsiento(1);                            
                            //cambiar la empresa solo por TEST
                            $model->idempresa = 1;
                            //cuando es asiento la cedula va vacia
                            $model->cedularuc = '';
                            $model->fechamodificacion = date('Y-m-d');
                            $model->estado = 0;
                            $model->periodocontable = Parametrocontabilidad::getParamtrosByEmpresa(1)->anioejercicio;
                            $model->tipodecheque = 6;
                            $model->mayorizado = 0;
                            /////////////////////////////////////////////////
                            
                            //debe existir mas de un asiento para que cuadre
                            if(isset($session['detalle_asiento_temp']) 
                                    && count($session['detalle_asiento_temp'])>1){
                                
                                //////////////////////////////////////////////////////////
                                //obtener los numeros de documento y comprobanye q toquen
                                $model->numerocomprobante = Tipocomprobantecontable::getNuevoNumeroComprobante($_POST['Maestroasiento']['idcomprobantecontable']);
                                
                                if(Tipodocumentocontable::getTipoDocumentoById($_POST['Maestroasiento']['iddocumento'])->numeraautomatico)
                                    $model->numerodocumento = Tipodocumentocontable::getNuevoNumeroDocumento($_POST['Maestroasiento']['iddocumento']);
                                ////////////////////////////////////////////////////////
                               
                                if($model->save())
                                {   
                                    //crear los detalles
                                    $totalDebe = 0;
                                    $totalHaber =0;

                                    foreach($session['detalle_asiento_temp'] as $row){
                                        $totalDebe += $row['valordebe'];
                                        $totalHaber += $row['valorhaber']; 
                                        
                                        $detalle = new Detalleasientos;
                                        $detalle->idasiento = $model->idasiento;
                                        $detalle->idempresa = 1;
                                        $detalle->cuentacontable = $row['cuentacontable'];
                                        $detalle->valordebe = $row['valordebe'];
                                        $detalle->valorhaber = $row['valorhaber'];
                                        $detalle->subdetalle = $row['subdetalle'];
                                        
                                        $detalle->save();
                                    
                                    }
                                    
                                    unset($session['detalle_asiento_temp']);
                                    ////////////////////////////////////////////////////////////
                                    //Actualizar el numero de asiento en la tabla de parametros
                                    Parametrocontabilidad::updateNumeroAsiento(1);
                                    
                                    ////////////////////////////////////////////////////////////////////////////////////////    
                                    //actualizar el numero de comprobante
                                    Tipocomprobantecontable::updateNumeroComprobante($_POST['Maestroasiento']['idcomprobantecontable']);
                                    
                                    //actualizar el numero de documento si es automatico
                                    $documento = Tipodocumentocontable::model()->findByPk($_POST['Maestroasiento']['iddocumento']);
                                    
                                    if($documento->numeraautomatico){
                                        Tipodocumentocontable::updateNumeroDocumento($_POST['Maestroasiento']['iddocumento']);
                                    }
                                    ////////////////////////////////////////////////////////////////////////////////////////

                                    $this->redirect(array('maestroasiento/admin',));
                                }
                            }else{
                                $mensaje = "No ha registrado ningun detalle.";
                            }
                        }

                            $this->render('create',array(
                                    'model'=>$model,
                                    'comprobanteData'=> $comprobanteData,
                                    'documentoData'=>$documentoData,
                                    'cuentasData'=>$cuentasArray,
                                    'numeroDoc'=>$numeroDoc,
                                    'numeroComp'=>$numeroComp,
                                    'mensaje'=>$mensaje,
                            ));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
            /**
             *@var Maestroasiento
             */
            $model=$this->loadModel($id);

            //si el asiento esta mayorizado no debe permitir editar
            if($model->mayorizado || $model->estado)
            {
                $this->redirect(array('maestroasiento/view','id'=>$id));
            }


            //Iniciar la session
            $session=new CHttpSession;
            $session->open();
        
        
                /*Obtener los comprobantes*/
                $comprobante = new Tipocomprobantecontable;
                                
                $listaComprobante = $comprobante->search();
                $comprobanteData =array();
                $comprobanteData[''] = 'Seleccione';
                
                foreach($listaComprobante->getData() as $comp)
                {
                  if($comp->idcomprobantecontable != 2)  
                    $comprobanteData[$comp->idcomprobantecontable]= $comp->descripcion;
                }
                
                //inicializar los array
                $documentoData = array();
                $cuentasArray = array();
                
                
                //numero de documento
                $numeroDoc = NULL;
                $numeroComp =NULL;
                
                $documentoData[''] = 'Seleccione';
                
                //validar el tipo de comprobante para obtene los documentos
                
                
              
                    
                    /*Obtener los documentos*/
                    $documento = new Tipodocumentocontable();
                    $documento->tipocomprobante = $model->idcomprobantecontable;
                    $listaDocumento = $documento->search();

                    
                    foreach($listaDocumento->getData() as $doc)
                    {
                        $documentoData[$doc->iddocumento]= $doc->descripcion;
                    }
                
                    //
                    
                    
                        /*Obtener cuentas bancarias*/
                        $cuentas = new Cuentasbancarias;
                        //$cuentas->idempresa = 3;
                        $listaCuentas = $cuentas->search();


                        foreach($listaCuentas->getData() as $cu)
                        {
                            $cuentasArray[$cu->idcuentabancaria] = $cu->descripcion;
                        }
                    
                    
                    //obtener numero de comprobante
                    $comprobante->idcomprobantecontable = $model->idcomprobantecontable;
                    $rowComprobante = $comprobante->search()->getData();
                    $numeroComp = $rowComprobante[0]->numeracion;
                    
                    
                        //obtener el si automatico o no el numero de documento
                        $documento->iddocumento = $model->iddocumento;
                        $rowDocumento = $documento->search()->getData();
                        if(count($rowDocumento)){
                            if($rowDocumento[0]['numeraautomatico'])
                            {
                                $numeroDoc = $rowDocumento[0]['numerodocumento'];
                            }
                        }
                    
                 
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Maestroasiento']))
		{
                        $model->attributes=$_POST['Maestroasiento'];

                        //cambiar la empresa solo por TEST

                        $model->fechamodificacion = date('Y-m-d');

                        ////////////////////////////////////////


                        if($model->save()){
                           $model->idasiento;
                            //borrar los destalles para volver a genrarlos
                            $detalle = new Detalleasientos;
                            $detalle->deleteAllDetalleAsiento($model->idasiento);
                            //crear los detalles
                            foreach($session['detalle_asiento_temp'] as $row){
                                

                                $detalle = new Detalleasientos;
                                $detalle->idasiento = $model->idasiento;
                                $detalle->idempresa = 1;
                                $detalle->cuentacontable = $row['cuentacontable'];
                                $detalle->valordebe = $row['valordebe'];
                                $detalle->valorhaber = $row['valorhaber'];
                                $detalle->subdetalle = $row['subdetalle'];

                                $detalle->save();

                            }

                            unset($session['detalle_asiento_temp']);

                        }
				//$this->redirect(array('detalleasientos/create','id'=>$model->idasiento));
		}

		$this->render('update',array(			            
                                    'model'=>$model,
                                    'comprobanteData'=> $comprobanteData,
                                    'documentoData'=>$documentoData,
                                    'cuentasData'=>$cuentasArray,
                                    'numeroDoc'=>$numeroDoc,
                                    'numeroComp'=>$numeroComp,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
            //cambiar estado a false;
            
            $model=$this->loadModel($id);
            $model->estado =1;

            if($model->save())
                $this->redirect(array('maestroasiento/admin',));
            else
                die('Lo sentimos, no se puede anular el asiento.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        
        $this->redirect(array('admin'));
        
//		$dataProvider=new CActiveDataProvider('Maestroasiento');
//		$this->render('index',array(
//			'dataProvider'=>$dataProvider,
//		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
                $this->layout  = '//layouts/listado';
		$model=new Maestroasiento('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Maestroasiento']))
			$model->attributes=$_GET['Maestroasiento'];

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
		$model=Maestroasiento::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

    
        public function actionDetalle(){
        
        //modelo de detalle asientos
        $detalle = new Detalleasientos;

        $asientos = array();

        $subdetalle = "";

        $editar = NULL;

        //session
        $session=new CHttpSession;
        $session->open();

        ///////////////////////////////////////////////////////////////////////
        //Edicion inicia la primera vez
        if(isset($_REQUEST['inicia']))
        {
            //inicia edicion se debe recuperar los datos
            $criteria=new CDbCriteria;
            $criteria->compare('idasiento',$_REQUEST['edit']);

            $dataProvider=new CActiveDataProvider('Detalleasientos', array(
                            'criteria'=>$criteria,
                    ));

            $data = $detalle->getAsientoDetalle($_REQUEST['edit']);

            $dataExistente = array();
            
            foreach($data as $row){
              $detAsiento = array();
              $detAsiento['cuentacontable'] = $row->cuentacontable;
              $detAsiento['valordebe']= $row->valordebe;
              $detAsiento['valorhaber'] = $row->valorhaber;
              $detAsiento['subdetalle'] = $row->subdetalle;
              $detAsiento['nombre'] = $row->nombrecuenta;

              array_push($dataExistente, $detAsiento);
            }

            $session['detalle_asiento_temp']= $dataExistente;
        }
        ///////////////////////////////////////////////////////////////////////

        
        
         if(isset($_REQUEST['editar']))
         {
            $editar = $_REQUEST['editar'];
            
                            
            $actualArray = $session['detalle_asiento_temp'];
            
            //colocar los datos modificados del asiento
            
              $detAsiento = array();
              $detAsiento['cuentacontable'] = $_POST['Detalleasientos']['cuentacontable'];
              $detAsiento['valordebe']= $_POST['Detalleasientos']['valordebe'];
              $detAsiento['valorhaber'] = $_POST['Detalleasientos']['valorhaber'];
              $detAsiento['subdetalle'] = $_POST['Detalleasientos']['subdetalle'];
              $detAsiento['nombre'] = $_POST['autocompletado'];

              $subdetalle = $detAsiento['subdetalle'];
            
              
              if(strlen($detAsiento['nombre'])){
                $actualArray[$editar] = $detAsiento;
                $editar = NULL;
              }
              //colocar el asiento editado
              $session['detalle_asiento_temp']=$actualArray;
            
         }elseif(isset($_POST['Detalleasientos'])&& $_POST['autocompletado']!='' && is_null($editar))          
             {                                 
              $detAsiento = array();
              $detAsiento['cuentacontable'] = $_POST['Detalleasientos']['cuentacontable'];
              $detAsiento['valordebe']= $_POST['Detalleasientos']['valordebe'];
              $detAsiento['valorhaber'] = $_POST['Detalleasientos']['valorhaber'];
              $detAsiento['subdetalle'] = $_POST['Detalleasientos']['subdetalle'];
              $detAsiento['nombre'] = $_POST['autocompletado'];
              
              $subdetalle = $detAsiento['subdetalle'];
              
             
              
              if(isset($session['detalle_asiento_temp'])){
                 $actualArray = $session['detalle_asiento_temp'];
              }else{
                  $actualArray = array();
              }
              array_push($actualArray, $detAsiento);
              
              $session['detalle_asiento_temp']=$actualArray;
          }
          
          //borrar el detalle del array
          
          if(isset($_REQUEST['delete']))
          {
             
                            
              $actualArray = $session['detalle_asiento_temp'];
              
              unset($actualArray[$_REQUEST['delete']]);
              
              //reconstruir el arreglo
              $nuevo = array();
              foreach($actualArray as $detallev)
              {
                  array_push($nuevo, $detallev);
              }
              $session['detalle_asiento_temp']=$nuevo;  
               
          }
          
        
        if(!isset ($session['maestroCuentasC'])){  
            //Obetner todas las cuentas
            $planCuentas = new Plancuentasnec;
            //$planCuentas->tipocuenta= TRUE;
            $listaCuentas = $planCuentas->findAll();

            $cuentas = array();


            foreach($listaCuentas as $cu)
            {
                $cuentas[$cu->idcuentanec] = trim($cu->cuentacontable)." (".trim($cu->nombrecuenta).")";
            }
            
            $session['maestroCuentasC'] = $cuentas;
            
        }
        
        $this->renderPartial('detalle',array(
            'model'=>$detalle,            
            'asientos'=>$asientos,
            'subdetalle'=>$subdetalle,
            'editar'=>$editar,
            
        ));
    }
    
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='maestroasiento-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
