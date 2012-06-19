<?php

class MaestrochequeproveedorController extends Controller
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
				'actions'=>array('create','update','detalle','anticipos','compras','admin','buscador'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('anticipos','delete'),
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
                    if($comp->idcomprobantecontable == 2)
                        $comprobanteData[$comp->idcomprobantecontable]= $comp->descripcion;
                }

                ////////////////////////////////////////////
                //Obtener los proveedores
                $proveedorByRuc = array();
                $proveedorByName = array();

                $proveedores = new Proveedor();
                //$listaProveedores = $proveedores->search()->getData();
                $listaProveedores = Proveedor::getALlProveedor();
                $loadAnticipos = FALSE;

                foreach($listaProveedores as $prov)
                {
                    $proveedorByRuc[$prov->id] = $prov->cedularuc;
                    $proveedorByName[$prov->id] = utf8_encode($prov->razonsocial);
                }

                ///////////////////////////////////////////

                //inicializar los array
                $documentoData = array();
                $cuentasArray = array();
                $idProveedor = NULL;

                ///////////////////////////////////////////////////////////////
                //conservar el proveedor si ya lo han escojido
                if(isset($_POST['idProveedor']) && $_POST['idProveedor']!=''){
                    $idProveedor =$_POST['idProveedor'];
                }
                ////////////////////////////////////////////////////////////////
                
                //numero de documento
                $numeroDoc = NULL;
                $numeroComp =NULL;
                $guardar = TRUE;

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

                        //$cuentasArray['']='NINGUNA';
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

//                     if(isset($_POST['Maestroasiento']) && $_POST['Maestroasiento']['valormovimiento']!=''
//                             && $_POST['Maestroasiento']['idcuentabancaria']!=''
//                             && !isset($session['detalle_asiento_temp']))
//                     {
//
//                            //Verificar que el proveedor tenga una cuenta contable asociada
//                            $modelProv= Proveedor::model()->findByPk($_POST['idProveedor']);
//
//                            if(!strlen($modelProv->cuentacontableanticipo)){
//                                $mensaje .= 'Lo sentimos, no se puede emitir anticipos a este proveedor';
//                            }else{
//
//                                //obtener la cuenta de banco
//                                $cuentas = new Cuentasbancarias;
//                                $cuentas->idcuentabancaria = $_POST['Maestroasiento']['idcuentabancaria'];
//                                $listaCuentas = $cuentas->search()->getData();
//                                $cuentaNec = $listaCuentas[0]->idcuentanec;
//                                //obtener la cuenta contable
//                                $cuenta = new Plancuentasnec;
//                                $cuenta->idcuentanec = $cuentaNec;
//                                $dataCuentaNec = $cuenta->search()->getData();
//
//
//                                $detAsiento[0]['cuentacontable'] = $cuentaNec;
//                                $detAsiento[0]['valordebe']= 0;
//                                $detAsiento[0]['valorhaber'] = $_POST['Maestroasiento']['valormovimiento'];
//                                $detAsiento[0]['subdetalle'] = $_POST['Maestroasiento']['detalle'];
//                                $detAsiento[0]['nombre'] = "{$dataCuentaNec[0]->cuentacontable} ({$dataCuentaNec[0]->nombrecuenta})";
//
//
//                                //obtener la cuenta del proveedor
//                                $cuenta->idcuentanec = $modelProv->cuentacontableanticipo;
//                                $dataCuentaNec = $cuenta->search()->getData();
//
//                                $detAsiento[1]['cuentacontable'] = $cuentaNec;
//                                $detAsiento[1]['valordebe']= $_POST['Maestroasiento']['valormovimiento'];
//                                $detAsiento[1]['valorhaber'] = 0;
//                                $detAsiento[1]['subdetalle'] = $_POST['Maestroasiento']['detalle'];
//                                $detAsiento[1]['nombre'] = "{$dataCuentaNec[0]->cuentacontable} ({$dataCuentaNec[0]->nombrecuenta})";
//
//                                $session['detalle_asiento_temp']=$detAsiento;
//                                $guardar = FALSE;
//                            }
//                     }

                        if(isset($_POST['Maestroasiento']))
                        {
                            //modelo de moviemientos bancarios
                            $movimientos = new Movimientosbancarios;
                           


                            $model->attributes=$_POST['Maestroasiento'];
                            $model->numeroasiento = Parametrocontabilidad::getNuevoNumeroAsiento(1);
                            //cambiar la empresa solo por TEST
                            $model->idempresa = 1;
                            //cuando es asiento la cedula va vacia
                            $model->fechamodificacion = date('Y-m-d');
                            $model->estado = 0;
                            $model->periodocontable = Parametrocontabilidad::getParamtrosByEmpresa(1)->anioejercicio;
                            $model->tipodecheque = 1;
                            $model->mayorizado=0;
                            
                            $movimientos->tipo = 0;

                            //debe existir mas de un asiento para que cuadre
                            if(isset($session['detalle_asiento_temp'])
                                    && count($session['detalle_asiento_temp'])>1
                                    && $guardar){

                                    foreach($model->attributes as $atributo => $valor)
                                    {
                                       try {
                                        $movimientos->$atributo = $valor;
                                       }catch (Exception $e){
                                       }
                                    }

                                    //guardar los movimientos bancarios
                                 //////////////////////////////////////////////////////////
                                //obtener los numeros de documento y comprobanye q toquen
                                $model->numerocomprobante = Tipocomprobantecontable::getNuevoNumeroComprobante($_POST['Maestroasiento']['idcomprobantecontable']);
                                
                                if(Tipodocumentocontable::getTipoDocumentoById($_POST['Maestroasiento']['iddocumento'])->numeraautomatico)
                                    $model->numerodocumento = Tipodocumentocontable::getNuevoNumeroDocumento($_POST['Maestroasiento']['iddocumento']);
                                echo($model->numerodocumento);
                                ////////////////////////////////////////////////////////
                                if($model->save())
                                {
                                   


                                    ////////////////////////////////////////////////////////
                                    //Grabar movimiento bancario
                                    if($movimientos->save())
                                    {

                                    }else{
                                        //echo $movimientos->idcuentabancaria;
                                        die('no se puede grabar el detalle asiento');
                                    }
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
                                    
                                    //////////////////////////////////////////////////////
                                    //actualizar los saldos de las compras
                                    
                                    //print_r($session['pagos_proveedores']);
                                    
                                    foreach($session['pagos_proveedores'] as $idCompra => $pago)
                                    {
                                        
                                        //actualizar el saldo
                                        //die($idCompra.'okok');
                                        $compracstm = CompraingresoCstm::updateSaldoCompra($idCompra, $pago);
                                        $compra = Compraingreso::getCompra($idCompra);
                                        
                                        //generar el detalle del pago a proveedor
//                                        $detallePago = Detallepagoproveedor::model();
                                        $detallePago = new Detallepagoproveedor;
                                        $detallePago->fechamovimiento= date('Y-m-d');
                                
                                        $detallePago->valormomimiento = $pago;
                                        $detallePago->saldocompra = $compracstm->saldocompra;
                                        $detallePago->tipopagocrdb = 'AB';
                                        $detallePago->asientoreferencia = $model->idasiento;
                                        $detallePago->idperiodo = $model->periodocontable;
                                        $detallePago->estado= 0;
                                        $detallePago->fechahoragrabado = date('Y-m-d');
                                        $detallePago->idproveedor = $compra->idproveedor;
                                        
                                        //////////////////////////////////////////////////////
                                        //generar el numero de documentopago
                                        
                                        $documentopago = $compra->estabcompra.$compra->secuencialcompra;
                                        
                                        for($i=strlen($documentopago);$i<16;$i++)
                                            $documentopago.= '0';
                                        
                                        $documentopago.= '-1';
                                        //////////////////////////////////////////////////////
                                        
                                        $detallePago->documentopago = $documentopago;
                                        
                                        if($detallePago->validate())
                                        {
                                            if($detallePago->save()){

                                                print_r($detallePago->attributes);

                                            }else{
                                                print_r($detallePago->attributes);
                                                die('No se puede guardar el detalle del pago al proveedor');
                                            }
                                            print_r($detallePago->getErrors());
                                        }
                                       
                                        
                                    }

                                    //////////////////////////////////////////////////////
                                    unset($session['detalle_asiento_temp']);
                                    unset($session['pagos_proveedores']);
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
                                    $this->redirect(array('maestrochequeproveedor/admin',));
                                }
                            }else{
                                $mensaje .= "No ha registrado ningun detalle.";
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
                                    'proveedorByRuc'=>$proveedorByRuc,
                                    'proveedorByName'=>$proveedorByName,
                                    'loadAnticipos'=>$loadAnticipos,
                                    'idProveedor'=>$idProveedor,
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
                  if($comp->idcomprobantecontable == 2)
                    $comprobanteData[$comp->idcomprobantecontable]= $comp->descripcion;
                }

                ////////////////////////////////////////////
                //Obtener los proveedores
                $proveedorByRuc = array();
                $proveedorByName = array();
                $guardar = TRUE;

                $proveedores = new Proveedor();
                //$listaProveedores = $proveedores->search()->getData();
                $listaProveedores = Proveedor::getALlProveedor();
                
                foreach($listaProveedores as $prov)
                {
                    $proveedorByRuc[$prov->id] = $prov->cedularuc;
                    $proveedorByName[$prov->id] = $prov->razonsocial;
                }

                ///////////////////////////////////////////

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
                                    'proveedorByRuc'=>$proveedorByRuc,
                                    'proveedorByName'=>$proveedorByName,
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
                $this->redirect(array('maestrocheques/admin',));
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

    /**
     * Obtiene el detalle de los asientos para ser editados
     */
    public function actionDetalle(){

       
        
    //modelo de detalle asientos
    $detalle = new Detalleasientos;

    $asientos = array();
    
   

    $detalleGenereal = "";

    $editar = NULL;

    //session
    $session=new CHttpSession;
    $session->open();
    
    $valor = 0;
    /////////////////////////////////////////////////////////////////////////
    //Llenar al asiento
    if(isset($_REQUEST['cuenta'])){
       
        $pagosProveedores = array();
        $dataExistente = array();
        
        //informacion del proveedor
        
          $cuenta = $_REQUEST['cuenta'];
          $idProveedor = $_REQUEST['idProveedor'];

          $cuentaBanco = Cuentasbancarias::getCuentaBancaria($cuenta);
          $cunetaNec = Plancuentasnec::getCuenta($cuentaBanco->idcuentanec);

          $proveedor = Proveedor::getProveedor($idProveedor);
          $cuentaProveedor = Plancuentasnec::getCuenta($proveedor->cuentacontableporpagar);
          
          $detalleGenereal = $proveedor->razonsocial." AB/CANC ";
        /////////////////////////////////////////////////////////////////////////          
          foreach($_POST as $field => $value)  {
              $temp = explode('_', $field);
              
              if(count($temp)==3 && $temp[0]=='abono'){
                  $valor+=$value;
                  $idCompra = $temp[1];
                  $factura = $temp[2];
                  
                  $pagosProveedores[$idCompra] = $value;

                  
                  if($value > 0){
                      //detalle del asiento
                        $detalleAs = $proveedor->razonsocial." AB/CANC ".$factura;
                        $detalleGenereal .= $factura.' ';
                      //////////////////////////////////////////////////////
                        
                      $detAsiento = array();
                      $detAsiento['cuentacontable'] = $cuentaProveedor->idcuentanec;
                      $detAsiento['valordebe']= $value;
                      $detAsiento['valorhaber'] = 0;
                      $detAsiento['subdetalle'] = $detalleAs;
                      $detAsiento['nombre'] = $cuentaProveedor->nombrecuenta;
                      ///////////////////////////////////////////////
                      array_push($dataExistente, $detAsiento);
                  }
              }
          }
          
          
          //////////////////////////////////////////////////
              $detAsiento = array();
              $detAsiento['cuentacontable'] = $cunetaNec->idcuentanec;
              $detAsiento['valordebe']= 0;
              $detAsiento['valorhaber'] = $valor;
              $detAsiento['subdetalle'] = $detalleGenereal;
              $detAsiento['nombre'] = $cunetaNec->nombrecuenta;
              $detAsiento['banco'] = TRUE;
              array_push($dataExistente, $detAsiento);
              //////////////////////////////////////////////////
          if($valor > 0)
          {
                $session['detalle_asiento_temp']= array_reverse($dataExistente);
                /////////////////////////////////////////////////
                $session['pagos_proveedores']= $pagosProveedores;
          }
    }
    ////////////////////////////////////////////////////////////////////////
    
    //Se va a utilizar un anticipo
    if(isset($_REQUEST['anticipo']))
    {
        //recuperar los detalles actuales
        $dataExistente = $session['detalle_asiento_temp'];
       
        $j=0;
        foreach($dataExistente as $detalleB)
        {
            if(isset($detalleB['banco']))
            {
                //restar el valor del ascientos
                $dataExistente[$j]['valorhaber'] -=$_REQUEST['valor'];
                
                //die();
            }
            $j++;
        }
                        
        $modelProv= Proveedor::model()->findByPk($_REQUEST['proveedor']); 
        
        $cuenta = Plancuentasnec::model()->findByPk($modelProv->cuentacontableanticipo);               
       
        //////////////////////////////////////////////////
              $detAsiento = array();
              $detAsiento['cuentacontable'] = $cuenta->idcuentanec;
              $detAsiento['valordebe']= 0;
              $detAsiento['valorhaber'] = $_REQUEST['valor'];
              $detAsiento['subdetalle'] = 'Pago anticipo';
              $detAsiento['nombre'] = $cuenta->nombrecuenta;
              array_push($dataExistente, $detAsiento);
        //////////////////////////////////////////////////
        $session['detalle_asiento_temp']= $dataExistente;
    }
    
    
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
        'subdetalle'=>$detalleGenereal,
        'editar'=>$editar,
        'valor'=>$valor,
    ));
}


    public function actionCompras($idProveedor)
    {         
         $compras = Compraingreso::getComprasProveedor($idProveedor);
         
         $arregloCompras = array();
         
         foreach($compras->getData() as $compra)
         {
            
             //arreglo de compra especifica
             $arregloCompras[$compra['idcompra']]= array();
             $temp = array();
             
             $temp['prov'] = $compra['numerocompratransaccion'];    
             $temp['numFactura'] = $compra['estabcompra'].'-'.$compra['puntocompra'].'-'.$compra['secuencialcompra'];
             $temp['fechaEmision'] = $compra['fecharegistro'];
             $temp['fechaVencimiento'] = $compra['fechavencimiento'];
             $temp['subTotal'] = $compra['basenograva'] + $compra['basecero'] + $compra['basegravada'] + $compra['montoice'];
             $temp['iva'] = $compra['montoiva'];
             $temp['total']= $temp['subTotal'] + $temp['iva'];
             $temp['pagado'] = $compra['pagadocompra'];
             $temp['descuento']= $compra['totalretencionfuente'] + $compra['totalretencioniva'] + $compra['valornotacredito'];
             $temp['saldo'] = $temp['total'] - $temp['pagado'] - $temp['descuento'];
             $temp['secuencial']= $compra['secuencialcompra'];
             //obtener los saldos a pagar o vencidos
             $detallePagos = new Detallepagos;
             
             $saldos = $detallePagos->getDetallaPagosCompra($compra['idcompra']);
             $saldo = 0;
             
             foreach($saldos->getData() as $pagos)
             {
                 $saldo += $pagos->saldo;
             }
             $temp['apagar'] = $saldo;
             /////////////////////////////////////////////////
             $arregloCompras[$compra['idcompra']]=$temp;                          
         }
        
         //print_r($arregloCompras);
         $this->renderPartial('compras',array(
             'compras'=>$arregloCompras,
         ));
    }

    public function actionAnticipos($idProveedor){
       
        $result = Anticipoproveedor::getAnticiposByProveedor($idProveedor);
        $this->renderPartial('anticipos',array(
            'data'=>$result->getData(),
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
    
    public function actionBuscador()
    {
        
        $proveedorByRuc = array();
        $proveedorByName = array();
        
        if(isset($_REQUEST['buscar']))
        {
            $listaProveedores = Proveedor::getByName($_REQUEST['buscar']);
        }
        else{
            
            $listaProveedores = Proveedor::getALlProveedor();
        }

        foreach($listaProveedores as $prov)
        {
//                    echo($prov->cedularuc) ;

            $proveedorByRuc[$prov->id] = $prov->cedularuc;
            $proveedorByName[$prov->id] = utf8_encode($prov->razonsocial);
        }

        
        $this->renderPartial('buscador',array(
            
            'proveedorByRuc'=>$proveedorByRuc,
           'proveedorByName'=>$proveedorByName,
        ));
    }

}
