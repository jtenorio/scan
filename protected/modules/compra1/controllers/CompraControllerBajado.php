<?php

class CompraController extends Controller
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
		//	'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules(){
//		return array(
//			array('allow',  // allow all users to perform 'index' and 'view' actions
//				'actions'=>array('index','view','dynamiccities','cargarTipoComprobante','cargarImpuestoRenta','buscarAjaxProveedor'),
//				'users'=>array('*'),
//			),
//			array('allow', // allow authenticated user to perform 'create' and 'update' actions
//				'actions'=>array('create','update'),
//				'users'=>array('*'),
//			),
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('admin','delete'),
//				'users'=>array('*'),
//			),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
//		);
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
	public function actionCrear()
	{
		$compra=new Compra;
                $detalleCompra = new DetalleCompra;
                $compraCstm = new CompraIngresoCstm;
                $detallePagos = new DetallePagos;
                $retencionesCompra = new RetencionesCompra;
                $maestroAsiento = new MaestroAsiento;
                $detallePagoProveedor = new DetallePagoProveedor;
                $detalleAsiento = new Detalleasientos;

                $maestroAsiento->periodocontable = $_POST['anio'];
                $compra->idmesperiodo = $_POST['mes'];
                $compra->idbodega = $_POST['establecimiento'];

                $resultado=array('error'=>'','url'=>'');
		if(isset($_POST['bandera'])){
                    $tx = Yii::app()->getDb()->beginTransaction();
                    try{
                        $compra->autorizaciondocumentomodificanc='';
                        $compra->autorizacionretencion1=$_POST['noAutorizacionComprobante'];
                        $compra->autorizacionretencion2='';
                        $compra->autorizacompra=$_POST['numero_autorizacion'];
                        $compra->basecero=$_POST['base_imponible'];
                        $compra->basegravada=$_POST['base_imponible_gravada'];
                        $compra->baseice=$_POST['base_imponible_ice'];
                        $compra->basenograva=$_POST['base_imponible_no_iva'];
                        $compra->codigodocumentomodificanc='';
                        $compra->estabcompra=$_POST['numero_serie1'];
                        $compra->estabdocumentomodificanc='';
                        $compra->establecimientoretencion1=$_POST['noSerieComprobante1']; //se cambio a tipo text
                        $compra->establecimientoretencion2='';
                        $compra->estado="1";
                        $compra->fechacaduca=$_POST['fecha_vencimiento'];//error de fecha
                        $compra->fechadocumentomodificanc='2012-01-01';//NO ES POSIBLE DEJAR VACIO
                        $compra->fechaemision=$_POST['fecha_emision'];
                        $compra->fecharegistro=$_POST['fecha_registro'];
                        $compra->fecharetencion1=$_POST['fecha_emision_comprobante'];
                        $compra->fecharetencion2='2012-01-01';
                        $compra->formapago=$_POST['formaPago'];
//                        $compra->idbodega=$_POST['establecimiento'];//identificador de la bodega
                        $parametroContabilidad = ParametroContabilidad::model()->findAll(
                                array(
                                'condition' => '"idempresa" = :idempresa',
                                'params' => array(
                                        ':idempresa' => 1
                                )));
                        foreach($parametroContabilidad as $parametrosContabilidad){
                            $compra->idejercicio=$parametrosContabilidad['anioejercicio'];//tabla ejercicio contable (año)
                        }                        
                        $compra->idempresa=1;//identificador de la empresa que esta logeado
//                        $compra->idmesperiodo=$_POST['mes'];//tabla periodocontable (mes)
                        $compra->idporcentajeice=$_POST['porcentajeIce'];
                        $compra->idporcentajeiva=$_POST['porcentajeIva'];
                        $compra->idproveedor=$_POST['proveedorId'];
                        $compra->idsecuencialtransaccion=$_POST['tipo_identificacion'];
                        $compra->idsustentotributario=$_POST['identificacion_credito'];
                        $compra->idtarjetacredito=$_POST['tarjeta'];
                        $compra->idtipocomprobante=$_POST['tipo_comprobante'];
                        $compra->montobaseiva100=$_POST['iva_100_monto_iva'];
                        $compra->montobaseiva30=$_POST['iva_bienes_monto_iva'];
                        $compra->montobaseiva70=$_POST['iva_servicios_monto_iva'];
                        $compra->montoice=$_POST['monto_ice'];
                        $compra->montoiva=$_POST['monto_iva'];
                        $compra->numerocompratransaccion=17;//tabla parametro facturacion
                        $compra->porcentajeretencioniva100=$_POST['iva_100_porcentaje_retencion'];
                        $compra->porcentajeretencioniva70=$_POST['iva_servicios_porcentaje_retencion'];
                        $compra->puntocompra=$_POST['numero_serie2'];
                        $compra->puntoemisiondocumentomodificanc='';
                        $compra->puntoemisionretencion1=$_POST['noSerieComprobante2'];
                        $compra->puntoemisionretencion2='';
                        $compra->retencioniva30=$_POST['iva_bienes_valor_retencion'];
                        $compra->retenidoiva100=$_POST['iva_100_valor_retencion'];
                        $compra->retenidoiva70=$_POST['iva_servicios_valor_retencion'];
                        $compra->secuencialcompra=$_POST['secuencial'];
                        $compra->secuencialdocumentomodificanc='';
                        $compra->secuencialretencion1=$_POST['noSecuencialComprobante'];
                        $compra->secuencialretencion2='';
                        $compra->ubicacionformulario=$_POST['ubicacion_formulario_104'];
                        $compra->compraempresa=1;
                        
                        if ($compra->validate()){
                            if($compra->save()){
                                $idCompra = $compra->idcompra;

                            }else
                                $tx->rollback();
                        }else{
                            $resultado['error'][]=$compra->getErrors();
                            $tx->rollback();
                        }

                        //ALMACENO EL MAESTRO ASIENTO
                        $maestroAsiento->asientocuadrado=1;
                        $datoProveedor = explode("|",$_POST['proveedor']);
                        $cedulaRuc = trim($datoProveedor[0]);
                        $nombreBeneficiario = trim($datoProveedor[1]);
                        $maestroAsiento->beneficiario = $nombreBeneficiario;
                        $maestroAsiento->cedularuc = $cedulaRuc;
                        $maestroAsiento->detalle = $_POST['concepto'];
                        $maestroAsiento->estado = 0;
                        $maestroAsiento->fechacreacion = $_POST['fecha_registro'];
                        $maestroAsiento->fechamodificacion = $_POST['fecha_registro'];
                        
                        $parametroContabilidad = ParametroContabilidad::model()->findAll(
                                array(
                                'condition' => '"idempresa" = :idempresa',
                                'params' => array(
                                        ':idempresa' => 1
                                )));
                        foreach($parametroContabilidad as $parametrosContabilidad){
                            $idParametroContabilidad = $parametrosContabilidad['idparametrocontabilidad'];
                            $numeroAsiento = $parametrosContabilidad['numeroasiento'];
                            $idParametros = $parametrosContabilidad['iddocumentocompragasto'];
                            $maestroAsiento->iddocumento = $parametrosContabilidad['iddocumentocompragasto'];
                            
                        }

                        $maestroAsiento->idcuentabancaria = 1;//NO HAY COMO PONERLE 0 DEBIDO A LA RELACION CON LA TABLA CUENTAS BANCARIAS

                        $tipoDocumentoContable = TipoDocumentoContable::model()->findAll(
                                array(
                                'condition' => '"iddocumento" = :iddocumento',
                                'params' => array(
                                        ':iddocumento' => $idParametros
                                )));
                        foreach($tipoDocumentoContable as $tipoDocumentoContables){
                            $numeroDocumento = $tipoDocumentoContables['numerodocumento'];
                            $documentoComprobante = $tipoDocumentoContables['tipocomprobante'];
                            $maestroAsiento->idcomprobantecontable = $tipoDocumentoContables['tipocomprobante'];
                        }
                        
                        $maestroAsiento->idempresa = 1;
                        $maestroAsiento->impreso = 0;
                        $maestroAsiento->mayorizado = 0;

                        $maestroAsiento->numeroasiento = $numeroAsiento+1; //DE LA TABLA PARAMETRO CONTABILIDAD

                        $tipoComprobanteContable = TipoComprobanteContable::model()->findAll(
                                array(
                                'condition' => '"idcomprobantecontable" = :idcomprobante',
                                'params' => array(
                                        ':idcomprobante' => $documentoComprobante
                                )));
                        foreach($tipoComprobanteContable as $tipoComprobanteContables){
                            $maestroAsiento->numerocomprobante = $tipoComprobanteContables['idcomprobantecontable']; //DE LA TABLA TIPO DOCUMENTO CONTABLE
                        }

                        $maestroAsiento->numerodocumento = $numeroDocumento; //DE LA TABLA TIPO DOCUMENTO CONTABLE

//                        $maestroAsiento->periodocontable = $_POST['anio'];//AÑO
                        $maestroAsiento->referenciaadicional = '';//BLANCO
                        $maestroAsiento->valormovimiento = $_POST['pagado'] + $_POST['saldo'];//VALOR DE SUMA PAGADO + SALDO
                        if ($maestroAsiento->validate()){
                            if($maestroAsiento->save()){
                                //EN LA TABLA PARAMETROCONTABILIDAD EL CAMPO NUMEROASIENTO AUMENTAR EN 1
                                $numAsiento = ParametroContabilidad::model()->findByPk($idParametroContabilidad);
                                $numAsiento->numeroasiento = $numAsiento->numeroasiento + 1;
                                $numAsiento->update();

                                //EN LA TABLA TIPOCOMPROBANTECONTABLE EL CAMPO NUMERACION AUMENTAR EN 1
                                $numeracion = new TipoComprobanteContable;
                                $numeracion = TipoComprobanteContable::model()->findByPk($documentoComprobante);
                                $numeracion->numeracion = $numeracion->numeracion + 1;
                                $numeracion->update();

                                $idMaestroAsiento = $maestroAsiento->idasiento;
                            }
                            else
                                $tx->rollback();
                        }else{
                            $resultado['error'][]=$maestroAsiento->getErrors();
                            $aux = 0;
                            $tx->rollback();
                        }

                        //ALMACENO COMPRA CSTM
                        $compraCstm->asientocompra = $idMaestroAsiento;//ID DEL MAESTRO ASIENTO
                        $compraCstm->asientoretencion = $idMaestroAsiento;//ID DEL MAESTRO ASIENTO
                        $compraCstm->conceptocompra=$_POST['concepto'];
                        $compraCstm->fechacancelacion=$_POST['fechaVence'];//FECHA VENCE
                        $compraCstm->fechavencimiento=$_POST['fechaVence'];
                        $compraCstm->idcompra = $idCompra; //identificador de la compra
                        $compraCstm->idcompranotacredito = 0;//PONER EN 0
                        $compraCstm->idempresa = 1; //IDENTIFICADOR DE LA EMPRESA
                        $compraCstm->pagadocompra = $_POST['pagado'];//VALOR DE CAMPO Pagado
                        $compraCstm->pagosrealizados = 1;
                        $compraCstm->referenciaadicional = '';//BLANCO
                        $compraCstm->saldocompra = $_POST['saldo'];
                        $compraCstm->saldonotacredito = 0;//EN 0
                        $compraCstm->tipoproveedor = 1;//IDENTIFICADOR DEL TIPO DE PROVEEDOR
                        $compraCstm->tipotransaccioncompra = $_POST['tipo_pago'];//CAMPO Tipo de Pago
                        $compraCstm->totalretencionfuente = $_POST['valor_retenido_1'] + $_POST['valor_retenido_2'] + $_POST['valor_retenido_3'] + $_POST['valor_retenido_4'] + $_POST['valor_retenido_5'] + $_POST['valor_retenido_6'];
                        $compraCstm->totalretencioniva = $_POST['iva_bienes_valor_retencion'] + $_POST['iva_servicios_valor_retencion'] + $_POST['iva_100_valor_retencion'];
                        $compraCstm->valornotacredito = 0;
                        if ($compraCstm->validate()){
                            if($compraCstm->save()){}
                            else
                                $tx->rollback();
                        }else{
                            $resultado['error'][]=$compraCstm->getErrors();
                            $tx->rollback();
                        }
                     
                        //ALMACENO EL DETALLE DE LA COMPRA
                        $codProd[] = $_POST['codigoProducto'];
                        $nomProd[] = $_POST['nombreProducto'];
                        $cantProd[] = $_POST['cantidadProducto'];
                        $valProd[] = $_POST['valorProducto'];
                        $totProd[] = $_POST['totalProducto'];
                        $ccoProd[] = $_POST['ccostoProducto'];
                        $idProd[] = $_POST['idProducto'];
                        $idCc[] = $_POST['idCcosto'];
                        $ivaProd[] = $_POST['tarifaIvaProducto'];
                        $contador = count($codProd);
                        for($i=0;$i<$contador;$i++){
                            $contador1 = count($cantProd[$i]);
                            for($j=0;$j<$contador1;$j++){
                                $cantidad = $cantProd[$i][$j];
                                $detalleCompra->cantidad = $cantidad;
                                $detalleCompra->idcentrocosto = $idCc[$i][$j];
                                $detalleCompra->idcompra = $idCompra; //identificador de la compra
                                $detalleCompra->idempresa = 1;
                                $detalleCompra->iditembodega = $idProd[$i][$j];
                                $detalleCompra->idtransaccioncompra=1;
                                $detalleCompra->valortotal=$totProd[$i][$j];
                                $detalleCompra->valorunitario=$valProd[$i][$j];
                                if ($detalleCompra->validate()){
                                    if($detalleCompra->save()){}
                                    else
                                        $tx->rollback();
                                }else{
                                    $resultado['error'][]=$detalleCompra->getErrors();
                                    $tx->rollback();
                                }
                            }
                        }

                        

                        //ALMACENO EL DETALLE DE LOS PAGOS


                        if($_POST['numeroPagos']>0){
                            $saldo[] = $_POST['saldoPago'];
                            $valor[] = $_POST['valorPago'];
                            $contador = count($saldo);
                            for($i=0;$i<$contador;$i++){
                                $contador1 = count($saldo[$i]);
                                for($j=0;$j<$contador1;$j++){
                                    if($saldo[$i][$j] > 0 && $valor[$i][$j] > 0){
                                        $detallePagos->estado=0;
                                        $detallePagos->fecha='2012-01-26';
                                        $detallePagos->idasiento=0;//PONER EN 0
                                        $detallePagos->idcompra=$idCompra; //IDENTIFICACION DE LA COMPRA
                                        $detallePagos->saldo=$saldo[$i][$j];
                                        $detallePagos->valor=$valor[$i][$j];
                                        if ($detallePagos->validate()){
                                            if($detallePagos->save()){}
                                            else
                                                $tx->rollback();
                                        }else{
                                            $resultado['error'][]=$detallePagos->getErrors();
                                            $tx->rollback();
                                        }
                                    }
                                }
                            }
                        }                        
                        //ALMACENO LA RETENCION EN LA FUENTE DE LA COMPRA
                        if($_POST['base_imponible_1'] != 0){
                            $retencionesCompra->basecero = $_POST['base0_1'];
                            $retencionesCompra->basegravada = $_POST['base12_1'];
                            $retencionesCompra->baseimponible = $_POST['base_imponible_1'];
                            $retencionesCompra->basenogravada = $_POST['base_no_objeto_1'];
                            $retencionesCompra->idcodigoretencionfuente = $_POST['cod_ret_fuente_1'];
                            $retencionesCompra->idcompra = $idCompra; //IDENTIFICACION DE LA COMPRA
                            $retencionesCompra->porcentajeretencion = $_POST['porcentaje_retencion_1'];
                            $retencionesCompra->valorretenido = $_POST['valor_retenido_1'];
                            if ($retencionesCompra->validate()){
                                if($retencionesCompra->save()){}
                                else
                                    $tx->rollback();
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                $tx->rollback();
                            }
                        }
                        if($_POST['base_imponible_2'] != 0){
                            $retencionesCompra->basecero = $_POST['base0_2'];
                            $retencionesCompra->basegravada = $_POST['base12_2'];
                            $retencionesCompra->baseimponible = $_POST['base_imponible_2'];
                            $retencionesCompra->basenogravada = $_POST['base_no_objeto_2'];
                            $retencionesCompra->idcodigoretencionfuente = $_POST['cod_ret_fuente_2'];
                            $retencionesCompra->idcompra = $idCompra; //IDENTIFICACION DE LA COMPRA
                            $retencionesCompra->porcentajeretencion = $_POST['porcentaje_retencion_2'];
                            $retencionesCompra->valorretenido = $_POST['valor_retenido_2'];
                            if ($retencionesCompra->validate()){
                                if($retencionesCompra->save()){}
                                else
                                    $tx->rollback();
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                $tx->rollback();
                            }
                        }
                        if($_POST['base_imponible_3'] != 0){
                            $retencionesCompra->basecero = $_POST['base0_3'];
                            $retencionesCompra->basegravada = $_POST['base12_3'];
                            $retencionesCompra->baseimponible = $_POST['base_imponible_3'];
                            $retencionesCompra->basenogravada = $_POST['base_no_objeto_3'];
                            $retencionesCompra->idcodigoretencionfuente = $_POST['cod_ret_fuente_3'];
                            $retencionesCompra->idcompra = $idCompra; //IDENTIFICACION DE LA COMPRA
                            $retencionesCompra->porcentajeretencion = $_POST['porcentaje_retencion_3'];
                            $retencionesCompra->valorretenido = $_POST['valor_retenido_3'];
                            if ($retencionesCompra->validate()){
                                if($retencionesCompra->save()){}
                                else
                                    $tx->rollback();
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                $tx->rollback();
                            }
                        }
                        if($_POST['base_imponible_4'] != 0){
                            $retencionesCompra->basecero = $_POST['base0_4'];
                            $retencionesCompra->basegravada = $_POST['base12_4'];
                            $retencionesCompra->baseimponible = $_POST['base_imponible_4'];
                            $retencionesCompra->basenogravada = $_POST['base_no_objeto_4'];
                            $retencionesCompra->idcodigoretencionfuente = $_POST['cod_ret_fuente_4'];
                            $retencionesCompra->idcompra = $idCompra; //IDENTIFICACION DE LA COMPRA
                            $retencionesCompra->porcentajeretencion = $_POST['porcentaje_retencion_4'];
                            $retencionesCompra->valorretenido = $_POST['valor_retenido_4'];
                            if ($retencionesCompra->validate()){
                                if($retencionesCompra->save()){}
                                else
                                    $tx->rollback();
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                $tx->rollback();
                            }
                        }
                        if($_POST['base_imponible_5'] != 0){
                            $retencionesCompra->basecero = $_POST['base0_5'];
                            $retencionesCompra->basegravada = $_POST['base12_5'];
                            $retencionesCompra->baseimponible = $_POST['base_imponible_5'];
                            $retencionesCompra->basenogravada = $_POST['base_no_objeto_5'];
                            $retencionesCompra->idcodigoretencionfuente = $_POST['cod_ret_fuente_5'];
                            $retencionesCompra->idcompra = $idCompra; //IDENTIFICACION DE LA COMPRA
                            $retencionesCompra->porcentajeretencion = $_POST['porcentaje_retencion_5'];
                            $retencionesCompra->valorretenido = $_POST['valor_retenido_5'];
                            if ($retencionesCompra->validate()){
                                if($retencionesCompra->save()){}
                                else
                                    $tx->rollback();
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                $tx->rollback();
                            }
                        }
                        if($_POST['base_imponible_6'] != 0){
                            $retencionesCompra->basecero = $_POST['base0_6'];
                            $retencionesCompra->basegravada = $_POST['base12_6'];
                            $retencionesCompra->baseimponible = $_POST['base_imponible_6'];
                            $retencionesCompra->basenogravada = $_POST['base_no_objeto_6'];
                            $retencionesCompra->idcodigoretencionfuente = $_POST['cod_ret_fuente_6'];
                            $retencionesCompra->idcompra = $idCompra; //IDENTIFICACION DE LA COMPRA
                            $retencionesCompra->porcentajeretencion = $_POST['porcentaje_retencion_6'];
                            $retencionesCompra->valorretenido = $_POST['valor_retenido_6'];
                            if ($retencionesCompra->validate()){
                                if($retencionesCompra->save()){}
                                else
                                    $tx->rollback();
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                $tx->rollback();
                            }
                        }

                        

                        //ALMACENO EL DETALLE PAGO PROVEEDOR
                        $detallePagoProveedor->asientoreferencia = $idMaestroAsiento;
                        $cadena = $_POST['secuencial'];
                        $tamanoCadena = strlen($cadena);
                        if($tamanoCadena<9){
                            $diferencia = 9 - $tamanoCadena;
                            for($i=0;$i<$diferencia;$i++){
                                $cadena = '0'.$cadena;
                            }
                        }
                        $detallePagoProveedor->documentopago = $_POST['numero_serie1'].'-'.$_POST['numero_serie1'].'-'.$cadena;//No de serie pero el secuencial de 9 digitos
                        $detallePagoProveedor->estado = 1;
                        $detallePagoProveedor->fechahoragrabado = date('Y-m-d');
                        $detallePagoProveedor->fechamovimiento = $_POST['fecha_registro'];
                        $detallePagoProveedor->idperiodo = 1;
                        $detallePagoProveedor->idproveedor = $_POST['proveedorId'];
                        $detallePagoProveedor->saldocompra = $_POST['saldo'];
                        $detallePagoProveedor->tipopagocrdb = 'CN';//COMPRA NUEVA
                        $detallePagoProveedor->valormomimiento = $_POST['saldo'];
                        if ($detallePagoProveedor->validate()){
                            if($detallePagoProveedor->save()){}
                            else
                                $tx->rollback();
                        }else{
                            $resultado['error'][]=$detallePagoProveedor->getErrors();
                            $tx->rollback();
                        }


                        //ALMACENO EL DETALLE ASIENTO
                        //ASIENTO DE LOS PRODUCTOS
                        $contador = count($codProd);
                        for($i=0;$i<$contador;$i++){
                            $contador1 = count($cantProd[$i]);
                            for($j=0;$j<$contador1;$j++){
                                $cantidad = $cantProd[$i][$j];                                
                                $itemProducto = Item::model()->findAll(
                                        array(
                                        'condition' => '"id" = :idItem',
                                        'params' => array(
                                                ':idItem' => $idProd[$i][$j]
                                        )));
                                foreach($itemProducto as $itemProductos){
                                    $detalleAsiento->cuentacontable=$itemProductos['cuentacontablecompra'];
                                }                                
                                $detalleAsiento->idasiento=$idMaestroAsiento;
                                $detalleAsiento->idempresa=1;
                                $detalleAsiento->subdetalle='';//PREGUNTAR
                                $detalleAsiento->valordebe=$totProd[$i][$j];
                                $detalleAsiento->valorhaber=0;
                                if ($detalleAsiento->validate()){
                                    if($detalleAsiento->save()){}
                                    else
                                        $tx->rollback();
                                }else{
                                    $resultado['error'][]=$detalleAsiento->getErrors();
                                    $tx->rollback();
                                }
                            }
                        }

                        //ASIENTO DE MONTO IVA
                        if($_POST['monto_iva']>0){
                            $porcentajeIvaCuenta = PorcentajeIva::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $_POST['porcentajeIva']
                                    )));
                            foreach($porcentajeIvaCuenta as $porcentajeIvaCuentas){
                                $detalleAsiento->cuentacontable=$porcentajeIvaCuentas['cuentacontablecredito'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=1;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=$_POST['monto_iva'];
                            $detalleAsiento->valorhaber=0;
                            if ($detalleAsiento->validate()){
                                    if($detalleAsiento->save()){}
                                    else
                                        $tx->rollback();
                                }else{
                                    $resultado['error'][]=$detalleAsiento->getErrors();
                                    $tx->rollback();
                                }
                        }

                        //ASIENTO DE MONTO ICE
                        if($_POST['monto_ice']>0){
                            $porcentajeIceCuenta = PorcentajeIce::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $_POST['porcentajeIce']
                                    )));
                            foreach($porcentajeIceCuenta as $porcentajeIceCuentas){
                                $detalleAsiento->cuentacontable=$porcentajeIceCuentas['cuentacontable'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=1;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=$_POST['monto_ice'];
                            $detalleAsiento->valorhaber=0;
                            if ($detalleAsiento->validate()){
                                    if($detalleAsiento->save()){}
                                    else
                                        $tx->rollback();
                                }else{
                                    $resultado['error'][]=$detalleAsiento->getErrors();
                                    $tx->rollback();
                                }
                        }

                        //ASIENTO DE CUENTA POR PAGAR
                        $cuentaCuentaPorPagar = Proveedor::model()->findAll(
                                array(
                                'condition' => '"id" = :id',
                                'params' => array(
                                        ':id' => $_POST['proveedorId']
                                )));
                        foreach($cuentaCuentaPorPagar as $cuentaCuentaPorPagars){
                            $detalleAsiento->cuentacontable=$cuentaCuentaPorPagars['cuentacontableporpagar'];
                        }
                        $detalleAsiento->idasiento=$idMaestroAsiento;
                        $detalleAsiento->idempresa=1;
                        $detalleAsiento->subdetalle='';//PREGUNTAR
                        $detalleAsiento->valordebe=0;
                        $detalleAsiento->valorhaber=$_POST['saldo'];
                        if ($detalleAsiento->validate()){
                            if($detalleAsiento->save()){}
                            else
                                $tx->rollback();
                        }else{
                            $resultado['error'][]=$detalleAsiento->getErrors();
                            $tx->rollback();
                        }

                        //ASIENTO DE VALOR RETENCION IVA 30%
                        if($_POST['iva_bienes_valor_retencion']>0){
                            $cuentaRetencionIva = PorcentajeRetencionIva::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $_POST['iva_bienes_porcentaje_retencion']
                                    )));
                            foreach($cuentaRetencionIva as $cuentaRetencionIvas){
                                $detalleAsiento->cuentacontable=$cuentaRetencionIvas['cuentacontablecompra'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=1;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['iva_bienes_valor_retencion'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else
                                    $tx->rollback();
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                $tx->rollback();
                            }
                        }

                        //ASIENTO DE VALOR RETENCION IVA 70%
                        if($_POST['iva_servicios_valor_retencion']>0){
                            $cuentaRetencionIva = PorcentajeRetencionIva::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $_POST['iva_servicios_porcentaje_retencion']
                                    )));
                            foreach($cuentaRetencionIva as $cuentaRetencionIvas){
                                $detalleAsiento->cuentacontable=$cuentaRetencionIvas['cuentacontablecompra'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=1;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['iva_servicios_valor_retencion'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else
                                    $tx->rollback();
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                $tx->rollback();
                            }
                        }

                        //ASIENTO DE VALOR RETENCION IVA 100%
                        if($_POST['iva_100_valor_retencion']>0){
                            $cuentaRetencionIva = PorcentajeRetencionIva::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $_POST['iva_100_porcentaje_retencion']
                                    )));
                            foreach($cuentaRetencionIva as $cuentaRetencionIvas){
                                $detalleAsiento->cuentacontable=$cuentaRetencionIvas['cuentacontablecompra'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=1;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['iva_100_valor_retencion'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else
                                    $tx->rollback();
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                $tx->rollback();
                            }
                        }

                        //ASIENTO DE VALOR RETENCION FUENTE 1
                        if($_POST['valor_retenido_1']>0){
                            $cuentaRetencionFuente = CodigoRetencionFuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_1']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=1;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_1'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else
                                    $tx->rollback();
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                $tx->rollback();
                            }
                        }
                        //ASIENTO DE VALOR RETENCION FUENTE 2
                        if($_POST['valor_retenido_2']>0){
                            $cuentaRetencionFuente = CodigoRetencionFuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_2']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=1;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_2'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else
                                    $tx->rollback();
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                $tx->rollback();
                            }
                        }
                        //ASIENTO DE VALOR RETENCION FUENTE 3
                        if($_POST['valor_retenido_3']>0){
                            $cuentaRetencionFuente = CodigoRetencionFuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_3']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=1;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_3'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else
                                    $tx->rollback();
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                $tx->rollback();
                            }
                        }
                        //ASIENTO DE VALOR RETENCION FUENTE 4
                        if($_POST['valor_retenido_4']>0){
                            $cuentaRetencionFuente = CodigoRetencionFuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_4']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=1;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_4'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else
                                    $tx->rollback();
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                $tx->rollback();
                            }
                        }
                        //ASIENTO DE VALOR RETENCION FUENTE 5
                        if($_POST['valor_retenido_5']>0){
                            $cuentaRetencionFuente = CodigoRetencionFuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_5']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=1;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_5'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else
                                    $tx->rollback();
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                $tx->rollback();
                            }
                        }
                        //ASIENTO DE VALOR RETENCION FUENTE 6
                        if($_POST['valor_retenido_6']>0){
                            $cuentaRetencionFuente = CodigoRetencionFuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_6']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=1;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_6'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else
                                    $tx->rollback();
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                $tx->rollback();
                            }
                        }

                    }catch(Exception $ex){
                        $resultado['error'][]=$ex->getMessage();
                        $tx->rollback();
                    }
                    $tamanoResultado = count($resultado['error']);
                    if($tamanoResultado == 1){
                        $tx->commit();
                        $establecimiento = $this->cargarEstablecimiento();
                        $tarjetaCredito = $this->cargarTarjetaCredito();
                        $formaPago = $this->cargarFormaPago();
                        $codigosRetencionFuente = $this->cargarCodigosRetencionFuente();
                        $porcentajeIvaRetencion = $this->cargarPorcentajeIvaRetencion();
                        $proveedor = $this->cargarProveedor();
                        $tipoIdentificacion = $this->cargarTipoIdentificacion();
                        $porcentajeIva = $this->cargarPorcentajeIva();
                        $porcentajeIce = $this->cargarPorcentajeIce();
                        $tipoPago = $this->cargarTipoPago();
                        $ubicacionForm104 = $this->cargarUbicacionForm104();
                        $dataProvider=new CActiveDataProvider('Compra');
                        $this->render('update',array(
                                'proveedor'=>$proveedor,
                                'dataProvider'=>$dataProvider,
                                'tipoIdentificacion'=>$tipoIdentificacion,
                                'porcentajeIva'=>$porcentajeIva,
                                'porcentajeIce'=>$porcentajeIce,
                                'tipoPago'=>$tipoPago,
                                'ubicacionForm104'=>$ubicacionForm104,
                                'porcentajeIvaRetencion'=>$porcentajeIvaRetencion,
                                'codigosRetencionFuente'=>$codigosRetencionFuente,
                                'formaPago'=>$formaPago,
                                'model'=>$compra,
                                'tarjetaCredito'=>$tarjetaCredito,
                                'establecimiento'=>$establecimiento,
                                'idCompra'=>$idCompra,
                        ));
                    }
		}else{		
                    $establecimiento = $this->cargarEstablecimiento();
                    $tarjetaCredito = $this->cargarTarjetaCredito();
                    $formaPago = $this->cargarFormaPago();
                    $codigosRetencionFuente = $this->cargarCodigosRetencionFuente();
                    $porcentajeIvaRetencion = $this->cargarPorcentajeIvaRetencion();
                    $proveedor = $this->cargarProveedor();
                    $tipoIdentificacion = $this->cargarTipoIdentificacion();
                    $tipoComprobante = $this->actionCargarTipoComprobante();
                    $porcentajeIva = $this->cargarPorcentajeIva();
                    $porcentajeIce = $this->cargarPorcentajeIce();
                    $tipoPago = $this->cargarTipoPago();
                    $ubicacionForm104 = $this->cargarUbicacionForm104();
                    $dataProvider=new CActiveDataProvider('Compra');
                    $this->render('crear',array(
                            'proveedor'=>$proveedor,
                            'dataProvider'=>$dataProvider,
                            'tipoIdentificacion'=>$tipoIdentificacion,
                            'tipoComprobante'=>$tipoComprobante,
                            'porcentajeIva'=>$porcentajeIva,
                            'porcentajeIce'=>$porcentajeIce,
                            'tipoPago'=>$tipoPago,
                            'ubicacionForm104'=>$ubicacionForm104,
                            'porcentajeIvaRetencion'=>$porcentajeIvaRetencion,
                            'codigosRetencionFuente'=>$codigosRetencionFuente,
                            'formaPago'=>$formaPago,
                            'model'=>$compra,
                            'tarjetaCredito'=>$tarjetaCredito,
                            'establecimiento'=>$establecimiento,

                            'compra'=>$compra,
                            'detalleCompra'=>$detalleCompra,
                            'compraCstm'=>$compraCstm,
                            'detallePagos'=>$detallePagos,
                            'retencionesCompra'=>$retencionesCompra,
                            'maestroAsiento'=>$maestroAsiento,
                            'detallePagoProveedor'=>$detallePagoProveedor,
                            'detalleAsiento'=>$detalleAsiento,
                    ));
                
	}
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
                $ejercicioContable = $this->cargarEjercicioContable();
                $establecimiento = $this->cargarEstablecimiento();
		$dataProvider=new CActiveDataProvider('Compra');
		$this->render('index',array(
                    'ejercicioContable'=>$ejercicioContable,
                    'establecimiento'=>$establecimiento,

		));
	}
        /**
	 * Carga los Ejercicios Contables (año)
	 */
	public function cargarEjercicioContable() {
		$ejercicioContable = EjercicioContable::model()->findAll(array('order'=>'idanio'));
		$ejercicioContableItems = CHtml::listData($ejercicioContable, 'id', 'idanio');
                return $ejercicioContableItems;
	}
        /**
	 * Carga los periodos contables (mes)
	 */
	public function actionCargarPeriodoContable() {
            if(isset ($_POST['anio'])){
                $anio = $_POST['anio'];
                if($anio != ''){
                    $data= PeriodoContable::model()->findAllBySql("SELECT * FROM periodocontrable WHERE idejercicio = ".$anio, array(':secuencial'=> $_POST['anio']));
                    $data=CHtml::listData($data,'id','nombre');
                    echo CHtml::tag('option',array('value'=>''),CHtml::encode('Seleccionar'),true);
                    foreach($data as $value=>$name){
                        echo CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
                    }
                }else
                    echo CHtml::tag('option',array('value'=>''),CHtml::encode('Seleccionar'),true);
            }
	}

        /**
	 * Carga los establecimientos
	 */
	public function cargarEstablecimiento() {
            $establecimiento = Establecimiento::model()->findAll(array('order'=>'nombre'));
            $establecimientoItems = CHtml::listData($establecimiento, 'id', 'nombre');
            return $establecimientoItems;
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
                $tipoIdentificacion = SecuencialTransaccion::model()->findAll(
                        array(
                        'condition' => '"modulousarse" = 1',
                        'params' => array(
                                ':idItem' => $idProd[$i][$j],
                        'order'=>'codigo'
                        )));
                $tipoIdentificacionItems = CHtml::listData($tipoIdentificacion, 'id', 'nombre');
                return $tipoIdentificacionItems;
	}



        /**
	 * Carga los tipos de comprobantes.
	 */
	public function actionCargarTipoComprobante() {
            if(isset ($_POST['tipo_identificacion'])){
                $comprobante = $_POST['tipo_identificacion'];
                if($comprobante != ''){
                    $secuencialTransaccion = SecuencialTransaccion::model()->findAll(
                            array(
                            'condition' => '"id" = :id',
                            'params' => array(
                                    ':id' => $_POST['tipo_identificacion']
                            )));
                    foreach($secuencialTransaccion as $secuencialTransaccions){
                        $tipoComprobanteRelacionado=$secuencialTransaccions['tipocomprobanterelacionado'];
                    }
                    $tipoComprobanteRelacionadoArray = explode(',',$tipoComprobanteRelacionado);
                    echo CHtml::tag('option',array('value'=>''),CHtml::encode('Seleccionar'),true);
                    for($i=0;$i<count($tipoComprobanteRelacionadoArray);$i++){
                        $datos = trim($tipoComprobanteRelacionadoArray[$i]);
                        $data=TipoComprobante::model()->findAllBySql("SELECT * FROM tipocomprobante WHERE codigo = '".$datos."' AND codigo <> '5' AND codigo <> '4'", array(':secuencial'=> $_POST['tipo_identificacion']));
                        $data=CHtml::listData($data,'id','descripcion');
                        foreach($data as $value=>$name){
                            echo CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
                        }
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
	public function actionCargarIdentiCredito() {
            if(isset ($_POST['tipo_comprobante'])){
                $comprobante = $_POST['tipo_comprobante'];
                if($comprobante != ''){
                    $tipoComprobante = TipoComprobante::model()->findAll(
                            array(
                            'condition' => '"id" = :id',
                            'params' => array(
                                    ':id' => $_POST['tipo_comprobante']
                            )));
                    foreach($tipoComprobante as $tipoComprobantes){
                        $sustentoTributarioRelacionado=$tipoComprobantes['sustentotributariorelacionado'];
                    }
                    $sustentoTributarioRelacionadoArray = explode(',',$sustentoTributarioRelacionado);
                    echo CHtml::tag('option',array('value'=>''),CHtml::encode('Seleccionar'),true);
                    for($i=0;$i<count($sustentoTributarioRelacionadoArray);$i++){
                        $datos = trim($sustentoTributarioRelacionadoArray[$i]);
                        $data=SustentoCredito::model()->findAllBySql("SELECT * FROM sustentocredito WHERE codigo = '".$datos."'", array(':secuencial'=> $_POST['tipo_identificacion']));
                        $data=CHtml::listData($data,'id','nombre');
                        foreach($data as $value=>$name){
                            echo CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
                        }
                    }
                }else
                    echo CHtml::tag('option',array('value'=>''),CHtml::encode('Seleccionar'),true);
            }
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

        /**
	 * Carga las tarjetas de crédito
	 */
        public function cargarTarjetaCredito(){
            $tarjetaCredito = TarjetaCredito::model()->findAll(array('order'=>'nombre'));
            $tarjetaCreditoItems = CHtml::listData($tarjetaCredito, 'id', 'nombre');
            return $tarjetaCreditoItems;

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

       /*
        * Carga todos los asientos
        * pasado por ajax
        *
        */
       public function actionbuscarAjaxAsiento(){
            $idProducto=$this->getParam('idProductos');
            $totalProducto=$this->getParam('total');
            $montoIva=$this->getParam('montoIva');
            $porcentajeIva=$this->getParam('porcentajeIva');
            $montoIce=$this->getParam('montoIce');
            $porcentajeIce=$this->getParam('porcentajeIce');
            $saldo=$this->getParam('saldo');
            $idProveedor=$this->getParam('idProveedor');
            $retIva30=$this->getParam('retIva30');
            $retIva70=$this->getParam('retIva70');
            $retIva100=$this->getParam('retIva100');
            $retIva30P=$this->getParam('retIva30P');
            $retIva70P=$this->getParam('retIva70P');
            $retIva100P=$this->getParam('retIva100P');
            $retFuente1=$this->getParam('retFuente1');
            $retFuente2=$this->getParam('retFuente2');
            $retFuente3=$this->getParam('retFuente3');
            $retFuente4=$this->getParam('retFuente4');
            $retFuente5=$this->getParam('retFuente5');
            $retFuente6=$this->getParam('retFuente6');
            $retFuente1P=$this->getParam('retFuente1P');
            $retFuente2P=$this->getParam('retFuente2P');
            $retFuente3P=$this->getParam('retFuente3P');
            $retFuente4P=$this->getParam('retFuente4P');
            $retFuente5P=$this->getParam('retFuente5P');
            $retFuente6P=$this->getParam('retFuente6P');
            $cuentaContableProducto = '';

            $idProducto = explode("|",$idProducto);

            for($i=1;$i<count($idProducto);$i++){
                $itemProducto = Item::model()->findAll(
                        array(
                        'condition' => '"id" = :idItem',
                        'params' => array(
                                ':idItem' => $idProducto[$i]
                        )));
                foreach($itemProducto as $itemProductos){
                    $idCuentaContableProducto = $itemProductos['cuentacontablecompra'];
                    $planCuentasNec = PlanCuentasNec::model()->findAll(
                            array(
                            'condition' => '"idcuentanec" = :idItem',
                            'params' => array(
                                    ':idItem' => $idCuentaContableProducto
                            )));
                    foreach($planCuentasNec as $planCuentasNecs){
                        $cuentaContableProducto = $cuentaContableProducto."|".$planCuentasNecs['nombrecuenta'];
                    }
                }
            }
            
            $porcentajeIvaCuenta = PorcentajeIva::model()->findAll(
                    array(
                    'condition' => '"id" = :id',
                    'params' => array(
                            ':id' => $porcentajeIva
                    )));
            foreach($porcentajeIvaCuenta as $porcentajeIvaCuentas){
                $itemCuentaContableMontoIva = $porcentajeIvaCuentas['cuentacontablecredito'];
                $planCuentasNec = PlanCuentasNec::model()->findAll(
                        array(
                        'condition' => '"idcuentanec" = :idItem',
                        'params' => array(
                                ':idItem' => $itemCuentaContableMontoIva
                        )));
                foreach($planCuentasNec as $planCuentasNecs){
                    $cuentaContableMontoIva = $planCuentasNecs['nombrecuenta'];
                }
            }
            
            $porcentajeIceCuenta = PorcentajeIce::model()->findAll(
                    array(
                    'condition' => '"id" = :id',
                    'params' => array(
                            ':id' => $porcentajeIce
                    )));
            foreach($porcentajeIceCuenta as $porcentajeIceCuentas){
                $idCuentaContableMontoIce = $porcentajeIceCuentas['cuentacontable'];
                $planCuentasNec = PlanCuentasNec::model()->findAll(
                        array(
                        'condition' => '"idcuentanec" = :idItem',
                        'params' => array(
                                ':idItem' => $idCuentaContableMontoIce
                        )));
                foreach($planCuentasNec as $planCuentasNecs){
                    $cuentaContableMontoIce = $planCuentasNecs['nombrecuenta'];
                }
            }

            $cuentaCuentaPorPagar = Proveedor::model()->findAll(
                    array(
                    'condition' => '"id" = :id',
                    'params' => array(
                            ':id' => $idProveedor
                    )));
            foreach($cuentaCuentaPorPagar as $cuentaCuentaPorPagars){
                $idCuentaContableCuentaPagar = $cuentaCuentaPorPagars['cuentacontableporpagar'];
                $planCuentasNec = PlanCuentasNec::model()->findAll(
                        array(
                        'condition' => '"idcuentanec" = :idItem',
                        'params' => array(
                                ':idItem' => $idCuentaContableCuentaPagar
                        )));
                foreach($planCuentasNec as $planCuentasNecs){
                    $cuentaContableCuentaPagar = $planCuentasNecs['nombrecuenta'];
                }
            }

            if($retIva30>0){
                $cuentaRetencionIva = PorcentajeRetencionIva::model()->findAll(
                        array(
                        'condition' => '"id" = :id',
                        'params' => array(
                                ':id' => $retIva30P
                        )));
                foreach($cuentaRetencionIva as $cuentaRetencionIvas){
                    $idCuentaContableRetencionIva30 = $cuentaRetencionIvas['cuentacontablecompra'];
                    $planCuentasNec = PlanCuentasNec::model()->findAll(
                            array(
                            'condition' => '"idcuentanec" = :idItem',
                            'params' => array(
                                    ':idItem' => $idCuentaContableRetencionIva30
                            )));
                    foreach($planCuentasNec as $planCuentasNecs){
                        $cuentaContableRetencionIva30 = $planCuentasNecs['nombrecuenta'];
                    }
                }
            }
            if($retIva70>0){
                $cuentaRetencionIva = PorcentajeRetencionIva::model()->findAll(
                        array(
                        'condition' => '"id" = :id',
                        'params' => array(
                                ':id' => $retIva70P
                        )));
                foreach($cuentaRetencionIva as $cuentaRetencionIvas){
                    $idCuentaContableRetencionIva70 = $cuentaRetencionIvas['cuentacontablecompra'];
                    $planCuentasNec = PlanCuentasNec::model()->findAll(
                            array(
                            'condition' => '"idcuentanec" = :idItem',
                            'params' => array(
                                    ':idItem' => $idCuentaContableRetencionIva70
                            )));
                    foreach($planCuentasNec as $planCuentasNecs){
                        $cuentaContableRetencionIva70 = $planCuentasNecs['nombrecuenta'];
                    }
                }
            }
            if($retIva100>0){
                $cuentaRetencionIva = PorcentajeRetencionIva::model()->findAll(
                        array(
                        'condition' => '"id" = :id',
                        'params' => array(
                                ':id' => $retIva100P
                        )));
                foreach($cuentaRetencionIva as $cuentaRetencionIvas){
                    $idCuentaContableRetencionIva100 = $cuentaRetencionIvas['cuentacontablecompra'];
                    $planCuentasNec = PlanCuentasNec::model()->findAll(
                            array(
                            'condition' => '"idcuentanec" = :idItem',
                            'params' => array(
                                    ':idItem' => $idCuentaContableRetencionIva100
                            )));
                    foreach($planCuentasNec as $planCuentasNecs){
                        $cuentaContableRetencionIva100 = $planCuentasNecs['nombrecuenta'];
                    }
                }
            }

            if($retFuente1>0){
                $cuentaRetencionFuente = CodigoRetencionFuente::model()->findAll(
                        array(
                        'condition' => '"idcodretfuente" = :id',
                        'params' => array(
                                ':id' => $retFuente1P
                        )));
                foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                    $idCuentaContableRetencionFuente1 = $cuentaRetencionFuentes['cuentacontablecompras'];
                    $planCuentasNec = PlanCuentasNec::model()->findAll(
                            array(
                            'condition' => '"idcuentanec" = :idItem',
                            'params' => array(
                                    ':idItem' => $idCuentaContableRetencionFuente1
                            )));
                    foreach($planCuentasNec as $planCuentasNecs){
                        $cuentaContableRetencionFuente1 = $planCuentasNecs['nombrecuenta'];
                    }
                }
            }
            if($retFuente2>0){
                $cuentaRetencionFuente = CodigoRetencionFuente::model()->findAll(
                        array(
                        'condition' => '"idcodretfuente" = :id',
                        'params' => array(
                                ':id' => $retFuente2P
                        )));
                foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                    $idCuentaContableRetencionFuente2 = $cuentaRetencionFuentes['cuentacontablecompras'];
                    $planCuentasNec = PlanCuentasNec::model()->findAll(
                            array(
                            'condition' => '"idcuentanec" = :idItem',
                            'params' => array(
                                    ':idItem' => $idCuentaContableRetencionFuente2
                            )));
                    foreach($planCuentasNec as $planCuentasNecs){
                        $cuentaContableRetencionFuente2 = $planCuentasNecs['nombrecuenta'];
                    }
                }
            }
            if($retFuente3>0){
                $cuentaRetencionFuente = CodigoRetencionFuente::model()->findAll(
                        array(
                        'condition' => '"idcodretfuente" = :id',
                        'params' => array(
                                ':id' => $retFuente3P
                        )));
                foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                    $idCuentaContableRetencionFuente3 = $cuentaRetencionFuentes['cuentacontablecompras'];
                    $planCuentasNec = PlanCuentasNec::model()->findAll(
                            array(
                            'condition' => '"idcuentanec" = :idItem',
                            'params' => array(
                                    ':idItem' => $idCuentaContableRetencionFuente3
                            )));
                    foreach($planCuentasNec as $planCuentasNecs){
                        $cuentaContableRetencionFuente3 = $planCuentasNecs['nombrecuenta'];
                    }
                }
            }
            if($retFuente4>0){
                $cuentaRetencionFuente = CodigoRetencionFuente::model()->findAll(
                        array(
                        'condition' => '"idcodretfuente" = :id',
                        'params' => array(
                                ':id' => $retFuente4P
                        )));
                foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                    $idCuentaContableRetencionFuente4 = $cuentaRetencionFuentes['cuentacontablecompras'];
                    $planCuentasNec = PlanCuentasNec::model()->findAll(
                            array(
                            'condition' => '"idcuentanec" = :idItem',
                            'params' => array(
                                    ':idItem' => $idCuentaContableRetencionFuente4
                            )));
                    foreach($planCuentasNec as $planCuentasNecs){
                        $cuentaContableRetencionFuente4 = $planCuentasNecs['nombrecuenta'];
                    }
                }
            }
            if($retFuente5>0){
                $cuentaRetencionFuente = CodigoRetencionFuente::model()->findAll(
                        array(
                        'condition' => '"idcodretfuente" = :id',
                        'params' => array(
                                ':id' => $retFuente5P
                        )));
                foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                    $idCuentaContableRetencionFuente5 = $cuentaRetencionFuentes['cuentacontablecompras'];
                    $planCuentasNec = PlanCuentasNec::model()->findAll(
                            array(
                            'condition' => '"idcuentanec" = :idItem',
                            'params' => array(
                                    ':idItem' => $idCuentaContableRetencionFuente5
                            )));
                    foreach($planCuentasNec as $planCuentasNecs){
                        $cuentaContableRetencionFuente5 = $planCuentasNecs['nombrecuenta'];
                    }
                }
            }
            if($retFuente6>0){
                $cuentaRetencionFuente = CodigoRetencionFuente::model()->findAll(
                        array(
                        'condition' => '"idcodretfuente" = :id',
                        'params' => array(
                                ':id' => $retFuente6P
                        )));
                foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                    $idCuentaContableRetencionFuente6 = $cuentaRetencionFuentes['cuentacontablecompras'];
                    $planCuentasNec = PlanCuentasNec::model()->findAll(
                            array(
                            'condition' => '"idcuentanec" = :idItem',
                            'params' => array(
                                    ':idItem' => $idCuentaContableRetencionFuente6
                            )));
                    foreach($planCuentasNec as $planCuentasNecs){
                        $cuentaContableRetencionFuente6 = $planCuentasNecs['nombrecuenta'];
                    }
                }
            }       
            
            $this->renderPartial('compra.views.compra.popup.lista',compact('cuentaContableProducto','totalProducto','cuentaContableMontoIva','montoIva','cuentaContableMontoIce','montoIce','cuentaContableCuentaPagar','saldo','cuentaContableRetencionIva30','retIva30','cuentaContableRetencionIva70','retIva70','cuentaContableRetencionIva100','retIva100','cuentaContableRetencionFuente1','retFuente1','cuentaContableRetencionFuente2','retFuente2','cuentaContableRetencionFuente3','retFuente3','cuentaContableRetencionFuente4','retFuente4','cuentaContableRetencionFuente5','retFuente5','cuentaContableRetencionFuente6','retFuente6'));


       }
}
