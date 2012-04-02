<?php

class MaestrocombosController extends Controller
{
    public function actionIndex()
    {
		$this->render('index');
	}

    public function actionComprobante($egresos)
    {
        
        ///////////////////////////////////////////
        /*Obtener los comprobantes*/
        $comprobante = new Tipocomprobantecontable;

        $listaComprobante = $comprobante->search();
        $comprobanteData =array();        

        $mensaje = "";
       
        foreach($listaComprobante->getData() as $comp)
        {            
            if(!$egresos){
                if($comp->idcomprobantecontable != 2)
                    $comprobanteData[$comp->idcomprobantecontable]= $comp->descripcion;
            }else{
                if($comp->idcomprobantecontable == 2)
                        $comprobanteData[$comp->idcomprobantecontable]= $comp->descripcion;
            }
        }
        
        $this->renderPartial('comprobante',array(           
            'comprobanteData'=>$comprobanteData,
            'default'=>$_REQUEST['d']
        ));
    }
    
    public function actionDocumento()
    {
        //inicializar los array
        $documentoData = array();
        
        /*Obtener los documentos*/
        $documento = new Tipodocumentocontable();
        $documento->tipocomprobante = $_REQUEST['id'];
        $listaDocumento = $documento->search();


        foreach($listaDocumento->getData() as $doc)
        {
            $documentoData[$doc->iddocumento]= $doc->descripcion;
        }

        $default = isset ($_REQUEST['d'])?$_REQUEST['d']:NULL;
        //
        $this->renderPartial('documento',array(           
            'documentoData'=>$documentoData,
            'default'=>$default,
        ));
    }
    
    public function actionBanco()
    {
        $cuentasArray = array();
        $numeroDoc = NULL;
        $tipoDocumento = $_REQUEST['id'];
        
        if($tipoDocumento != 3){
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
            $cuentasArray['']='NO APLICA';
        }
        
        //verificar si el numero de documento es automático
        $documento = new Tipodocumentocontable();
        $documento->iddocumento = $tipoDocumento;
        $rowDocumento = $documento->search()->getData();
        if(count($rowDocumento)){
            if($rowDocumento[0]['numeraautomatico'])
            {
                $numeroDoc = $rowDocumento[0]['numerodocumento'];
            }
        }
        
        $default = isset ($_REQUEST['d'])?$_REQUEST['d']:NULL;
        
        $this->renderPartial('banco',array(           
            'cuentasArray'=>$cuentasArray,
            'numeroDoc'=>$numeroDoc,
            'default'=>$default,
        ));
    }
    
    
    public function actionAutoMaestrAsiento($cuenta,$valor,$detalle){
        
                
        $session=new CHttpSession;
        $session->open();
        //obtener la cuenta de banco
        $cuentas = new Cuentasbancarias;
        $cuentas->idcuentabancaria = $cuenta;
        $listaCuentas = $cuentas->search()->getData();
        $cuentaNec = $listaCuentas[0]->idcuentanec;
        //obtener la cuenta contable
        $cuenta = new Plancuentasnec;
        $cuenta->idcuentanec = $cuentaNec;
        $dataCuentaNec = $cuenta->search()->getData();


        $detAsiento[0]['cuentacontable'] = $cuentaNec;
        $detAsiento[0]['valordebe']= $valor;
        $detAsiento[0]['valorhaber'] = 0;
        $detAsiento[0]['subdetalle'] = $detalle;
        $detAsiento[0]['nombre'] = "{$dataCuentaNec[0]->cuentacontable} ({$dataCuentaNec[0]->nombrecuenta})";
        $session['detalle_asiento_temp']=$detAsiento;
                            
                            
        $this->renderPartial('autoMaestroAsiento',array(           
            
        ));
    }
	
    public function actionAutoAnticipos($cuentap,$valorp,$detallep,$proveedorp)
    {
        $session=new CHttpSession;
        $session->open();
        //Verificar que el proveedor tenga una cuenta contable asociada
        $modelProv= Proveedor::model()->findByPk($proveedorp);

        if(!strlen($modelProv->cuentacontableanticipo)){
            $mensaje .= 'Lo sentimos, no se puede emitir anticipos a este proveedor';
        }else{

            //obtener la cuenta de banco
            $cuentas = new Cuentasbancarias;
            $cuentas->idcuentabancaria = $cuentap;
            $listaCuentas = $cuentas->search()->getData();
            $cuentaNec = $listaCuentas[0]->idcuentanec;
            //obtener la cuenta contable
            $cuenta = new Plancuentasnec;
            $cuenta->idcuentanec = $cuentaNec;
            $dataCuentaNec = $cuenta->search()->getData();


            $detAsiento[0]['cuentacontable'] = $cuentaNec;
            $detAsiento[0]['valordebe']= 0;
            $detAsiento[0]['valorhaber'] = $valorp;
            $detAsiento[0]['subdetalle'] = $detallep;
            $detAsiento[0]['nombre'] = "{$dataCuentaNec[0]->cuentacontable} ({$dataCuentaNec[0]->nombrecuenta})";


            //obtener la cuenta del proveedor
            $cuenta->idcuentanec = $modelProv->cuentacontableanticipo;
            $dataCuentaNec = $cuenta->search()->getData();

            $detAsiento[1]['cuentacontable'] = $cuentaNec;
            $detAsiento[1]['valordebe']= $valorp;
            $detAsiento[1]['valorhaber'] = 0;
            $detAsiento[1]['subdetalle'] = $detallep;
            $detAsiento[1]['nombre'] = "{$dataCuentaNec[0]->cuentacontable} ({$dataCuentaNec[0]->nombrecuenta})";        

            $session['detalle_asiento_temp']=$detAsiento;   
            $guardar = FALSE;
            
             
        }
        
        $this->renderPartial('autoMaestroAsiento',array(           
            
        ));
    }
// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}