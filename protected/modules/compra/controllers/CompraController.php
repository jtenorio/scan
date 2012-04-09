<?php

class CompraController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

        private $formProveedor;
        private $formPorcentajeIva;
        private $formPorcentajeIce;
        private $formCodigoRetencionFuente;
        private $formPorcentajeIvaRetencion;
        private $formFormaPago;

	public function filters()
	{
		return array();
	}

	public function accessRules(){
	}

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

        public function actionBuscar(){
            $model=new Compra('search');
            $model->unsetAttributes();
                if(isset($_POST['Compra']))
                    $model->attributes=$_POST['Compra'];
            $this->render('buscar',array('model'=>$model));
        }

        public function actionBuscaranularetencion(){
            $model=new Compra('search');
            $model->unsetAttributes();
                if(isset($_POST['Compra']))
                    $model->attributes=$_POST['Compra'];
            $this->render('buscaranularetencion',array('model'=>$model));
        }

        public function actionBuscarcomprasanteriores(){
            $model=new Compra('search');
            $model->unsetAttributes();
                if(isset($_POST['Compra']))
                    $model->attributes=$_POST['Compra'];
            $this->render('buscarcomprasanteriores',array('model'=>$model));
        }

        public function actionBuscardevolucioncompra(){
            $model=new Compra('search');
            $model->unsetAttributes();
            if(isset($_POST['Compra']))
                $model->attributes=$_POST['Compra'];

//            $model=$model->model()->findAllBySql("SELECT * FROM compraingreso c,compraingreso_cstm cstm WHERE c.idcompra=cstm.idcompra AND  tipotransaccioncompra=3");

            $this->render('buscardevolucioncompra',array('model'=>$model));
        }

        public function actionAnularetencion(){
            $resultado=array('error'=>'','url'=>'');
            if(!isset($_POST['bandera'])){
                $idCompra = $_REQUEST['id'];
                $idMaestroAsiento = $_REQUEST['idMaestro'];
                $idCompraCstm = $_REQUEST['idCstm'];

                $compra = Compra::model()->findByPk($idCompra);
                $maestroAsiento = Maestroasiento::model()->findByPk($idMaestroAsiento);
                $compraCstm = Compraingresocstm::model()->findByPk($idCompraCstm);

                $validarPagado = 0;
                $validarAsientoMayorizado = 0;
                $validarNotaCredito = 0;
                $validarSecuencialVacio = 0;
                if($compraCstm->pagadocompra > 0){
                    $validarPagado = 1;
                }
                if($maestroAsiento->mayorizado == true){
                    $validarAsientoMayorizado = 1;
                }
                if($compraCstm->valornotacredito > 0){
                    $validarNotaCredito = 1;
                }
                if($compra->secuencialretencion1 == ''){
                    $validarSecuencialVacio = 1;
                }
                $bodega = $this->cargarBodega();
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

                $this->render('anularetencion',array(
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
                        'bodega'=>$bodega,
                        'idCompra'=>$idCompra,
                        'idMaestroAsiento'=>$idMaestroAsiento,
                        'idCompraCstm'=>$idCompraCstm,

                        'compra'=>$compra,
                        'maestroAsiento'=>$maestroAsiento,
                        'compraCstm'=>$compraCstm,

                        'validarPagado'=>$validarPagado,
                        'validarAsientoMayorizado'=>$validarAsientoMayorizado,
                        'validarNotaCredito'=>$validarNotaCredito,
                        'validarSecuencialVacio'=>$validarSecuencialVacio,
                ));

            }
            if(isset($_POST['bandera'])){
                    $tx = Yii::app()->getDb()->beginTransaction();
                    try{
                        $compra=new Compra;
                        $compra = $this->loadModel($_POST['idCompra']);
                        $compra->setScenario('update');
                        $compra->attributes=$_POST['Compra'];

                        $maestroAsiento=new Maestroasiento;
                        $maestroAsiento = $this->loadModelMaestroAsiento($_POST['idMaestroAsiento']);
                        $maestroAsiento->setScenario('update');
                        $maestroAsiento->attributes=$_POST['Maestroasiento'];

                        $compraCstm=new Compraingresocstm;
                        $compraCstm = $this->loadModelCompraCstm($_POST['idCompraCstm']);
                        $compraCstm->setScenario('update');
                        $compraCstm->attributes=$_POST['Compraingresocstm'];

                        $anulados = new Documentosanulados;
                        $mesAnulado = $compra->idmesperiodo;
                        $anioAnulado = $maestroAsiento->periodocontable;
                        $anulados->mes = $mesAnulado;
                        $anulados->anio = $anioAnulado;
                        $tipoComprobante = Tipocomprobante::model()->findAll(
                                array(
                                'condition' => '"codigo" = :codigo',
                                'params' => array(
                                        ':codigo' => '7'
                                )));
                        foreach($tipoComprobante as $tipoComprobantes){
                            $anulados->idcomprobante = $tipoComprobantes['id'];
                        }
                        $anulados->establecimiento = $_POST['establecimiento'];
                        $anulados->puntoemision = $_POST['puntoEmision'];
                        $anulados->desde = $_POST['desdeHasta'];
                        $anulados->hasta = $_POST['desdeHasta'];
                        $anulados->autorizacion = $_POST['autorizacion'];
                        $anulados->fecha = date("Y-m-d");
                        $anulados->cantidad = 1;
                        $anulados->idempresa = $this->empresa_id;
                        if ($anulados->validate()){
                            if($anulados->save()){

                            }else{
                                $resultado['error'][]="error al almacenar compraitem";
                            }
                        }else{
                            $resultado['error'][]=$anulados->getErrors();
                        }
                        


                        //ALMACENO LA COMPRA
                        if ($compra->validate()){
                            if($compra->update()){
                                $idCompra = $compra->idcompra;
                                //DE LA TABLA PROVEEDOR ACTUALIZAR EL CAMPO AUTORIZACIONFACTURA Y FECHA CADUCIDAD
                                $proveedorActualizacion = Proveedor::model()->findByPk($compra->idproveedor);
                                $proveedorActualizacion->autorizacionfactura = $compra->autorizacompra;
                                $proveedorActualizacion->fechacaducidad = $compra->fechacaduca;
                                $proveedorActualizacion->update();
                            }else{
                                $resultado['error'][]="error al almacenar compraitem";
                            }
                        }else{
                            $resultado['error'][]=$compra->getErrors();
                        }

                        //ALMACENO COMPRA CSTM
                        $detalleConceptoCompra = $maestroAsiento->detalle;
                        $compraCstm->conceptocompra=$detalleConceptoCompra;
                        $compraCstm->fechacancelacion=$compraCstm->fechavencimiento;//FECHA VENCE
                                       
                        $compraCstm->totalretencionfuente = $_POST['valor_retenido_1'] + $_POST['valor_retenido_2'] + $_POST['valor_retenido_3'] + $_POST['valor_retenido_4'] + $_POST['valor_retenido_5'] + $_POST['valor_retenido_6'];
                        $compraCstm->totalretencioniva = $compra->retencioniva30 + $compra->retenidoiva70 + $compra->retenidoiva100;
                        if ($compraCstm->validate()){
                            if($compraCstm->update()){
                                $idCompraCstm = $compraCstm->id;
                            }
                            else{
                                //$tx->rollback();
                                $resultado['error'][]="error al almacenar compraicstm";
                            }
                        }else{
                            $resultado['error'][]=$compraCstm->getErrors();
                            //$tx->rollback();
                        }

                        //ALMACENO EL MAESTRO ASIENTO
                        $datoProveedor = explode("|",$_POST['proveedor']);
                        $cedulaRuc = trim($datoProveedor[0]);
                        $nombreBeneficiario = trim($datoProveedor[1]);
                        $maestroAsiento->beneficiario = $nombreBeneficiario;
                        $maestroAsiento->cedularuc = $cedulaRuc;
                        $maestroAsiento->fechamodificacion = date("Y-m-d");
                        $maestroAsiento->valormovimiento = $compraCstm->pagadocompra + $compraCstm->saldocompra;//VALOR DE SUMA PAGADO + SALDO
                        if ($maestroAsiento->validate()){
                            if($maestroAsiento->update()){
                                $idMaestroAsiento = $maestroAsiento->idasiento;
                            }
                            else{
                                //$tx->rollback();
                                $resultado['error'][]="error al almacenar maestroAsiento";
                            }
                        }else{
                            $resultado['error'][]=$maestroAsiento->getErrors();
                            $aux = 0;
                            //$tx->rollback();
                        }



                        //ALMACENO EL DETALLE DE LA COMPRA
                        $detalleCompra = Detallecompra::model()->findAll(
                                array(
                                'condition' => '"idcompra" = :idcompra',
                                'params' => array(
                                        ':idcompra' => $idCompra
                                )));
                        foreach($detalleCompra as $detalleCompras){
                            //RESTO DEL STOCK ANTERIOR ANTES DE ELIMINAR EL DETALLE COMPRA
                            $itemCodigo = Itembodega::model()->findByPk($detalleCompras['iditembodega']);
                            $itemActualizacion = Item::model()->findByPk($itemCodigo->iditem);
                            $itemActualizacion->stock = $itemActualizacion->stock - $detalleCompras['cantidad'];
                            $itemActualizacion->update();

                            $itemBodegaActualizacion = Itembodega::model()->findByPk($detalleCompras['iditembodega']);
                            $itemBodegaActualizacion->stock = $itemBodegaActualizacion->stock - $detalleCompras['cantidad'];
                            $itemBodegaActualizacion->update();

                            //ELIMINO EL DETALLE COMPRA
                            $detalleCompraId = Detallecompra::model()->findByPk($detalleCompras['id']);
                            $detalleCompraId->delete();
                        }
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
                                $detalleCompra = new Detallecompra;
                                $cantidad = $cantProd[$i][$j];
                                $detalleCompra->cantidad = $cantidad;
                                $detalleCompra->idcentrocosto = $idCc[$i][$j];
                                $detalleCompra->idcompra = $idCompra; //identificador de la compra
                                $detalleCompra->idempresa = $this->empresa_id;
                                $bodegaId = $compra->idbodega;
                                $idItemBodega = Itembodega::model()->findAll(
                                        array(
                                        'condition' => '"iditem" = :iditem AND "idbodega"=:idbodega',
                                        'params' => array(
                                                ':iditem' => $idProd[$i][$j],
                                                ':idbodega' => $bodegaId
                                        )));
                                foreach($idItemBodega as $idItemBodegas){
                                    $itemBodegaId=$idItemBodegas['id'];
                                }
                                $detalleCompra->iditembodega = $itemBodegaId;
                                $detalleCompra->idtransaccioncompra=1;
                                $detalleCompra->valortotal=$totProd[$i][$j];
                                $detalleCompra->valorunitario=$valProd[$i][$j];
                                if ($detalleCompra->validate()){
                                    if($detalleCompra->save()){
                                        //ACTUALIZAR EL STOCK DE ITEM E ITEMBODEGA
                                        $itemActualizacion = Item::model()->findByPk($idProd[$i][$j]);
                                        $itemActualizacion->stock = $itemActualizacion->stock + $cantidad;
                                        $itemActualizacion->update();

                                        $itemBodegaActualizacion = Itembodega::model()->findByPk($itemBodegaId);
                                        $itemBodegaActualizacion->stock = $itemBodegaActualizacion->stock + $cantidad;
                                        $itemBodegaActualizacion->update();
                                    }
                                    else{
                                        //$tx->rollback();
                                        $resultado['error'][]="error al almacenar detallecompra";
                                    }
                                }else{
                                    $resultado['error'][]=$detalleCompra->getErrors();
                                    //$tx->rollback();
                                }
                            }
                        }



                        //ALMACENO EL DETALLE DE LOS PAGOS
                        $detallePago = Detallepagos::model()->findAll(
                                array(
                                'condition' => '"idcompra" = :idcompra',
                                'params' => array(
                                        ':idcompra' => $idCompra
                                )));
                        foreach($detallePago as $detallePagos){
                            //ELIMINO LOS PAGOS ANTERIORES
                            $detallePagoId = Detallepagos::model()->findByPk($detallePagos['id']);
                            $detallePagoId->delete();
                        }
                        $valor = $_POST['valorPago'];
                        $fecha = $_POST['fechaPago'];
                        $contador = count($valor);
                        for($i=0;$i<$contador;$i++){
                            if($valor[$i] > 0){
                                $detallePagos = new Detallepagos;
                                $detallePagos->estado=0;
                                $detallePagos->fecha=$fecha[$i];
                                $detallePagos->idasiento=0;//PONER EN 0
                                $detallePagos->idcompra=$idCompra; //IDENTIFICACION DE LA COMPRA
                                $detallePagos->saldo=$valor[$i];//PONER EN 0
                                $detallePagos->valor=$valor[$i];
                                if ($detallePagos->validate()){
                                    if($detallePagos->save()){
                                    }
                                    else{
                                        //$tx->rollback();
                                        $resultado['error'][]="error al almacenar detallePagos";
                                    }
                                }else{
                                    $resultado['error'][]=$detallePagos->getErrors();
                                    //$tx->rollback();
                                }
                            }
                        }

                        //ALMACENO LA RETENCION EN LA FUENTE DE LA COMPRA
                        $retencionesCompra = Retencionescompra::model()->findAll(
                                array(
                                'condition' => '"idcompra" = :idcompra',
                                'params' => array(
                                        ':idcompra' => $idCompra
                                )));
                        foreach($retencionesCompra as $retencionesCompras){
                            //ELIMINO LAS RETENCIONES ANTERIORES
                            $retencionesCompraId = Retencionescompra::model()->findByPk($retencionesCompras['id']);
                            $retencionesCompraId->delete();
                        }
                        if($_POST['base_imponible_1'] != 0){
                            $retencionesCompra = new Retencionescompra;
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
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar Retencionescompra";
                                }
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                //$tx->rollback();
                            }
                        }
                        if($_POST['base_imponible_2'] != 0){
                            $retencionesCompra = new Retencionescompra;
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
                                else{
                                    $resultado['error'][]="error al almacenar Retencionescompra";
                                }
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                            }
                        }
                        if($_POST['base_imponible_3'] != 0){
                            $retencionesCompra = new Retencionescompra;
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
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar Retencionescompra";
                                }
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                //$tx->rollback();
                            }
                        }
                        if($_POST['base_imponible_4'] != 0){
                            $retencionesCompra = new Retencionescompra;
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
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar Retencionescompra";
                                }
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                //$tx->rollback();
                            }
                        }
                        if($_POST['base_imponible_5'] != 0){
                            $retencionesCompra = new Retencionescompra;
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
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar Retencionescompra";
                                }
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                //$tx->rollback();
                            }
                        }
                        if($_POST['base_imponible_6'] != 0){
                            $retencionesCompra = new Retencionescompra;
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
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar Retencionescompra";
                                }
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                //$tx->rollback();
                            }
                        }



                        //ALMACENO EL DETALLE PAGO PROVEEDOR
                        $detallePagoProveedor = Detallepagoproveedor::model()->findAll(
                                array(
                                'condition' => '"asientoreferencia" = :asientoreferencia',
                                'params' => array(
                                        ':asientoreferencia' => $idMaestroAsiento
                                )));
                        foreach($detallePagoProveedor as $detallePagoProveedors){
                            //ELIMINO LOS PAGOS PROVEEDOR ANTERIORES
                            $detallePagoProveedorId = Detallepagoproveedor::model()->findByPk($detallePagoProveedors['id']);
                            $detallePagoProveedorId->delete();
                        }
                        $detallePagoProveedor = new Detallepagoproveedor;
                        $detallePagoProveedor->asientoreferencia = $idMaestroAsiento;
                        $cadena = $compra->secuencialcompra;
                        $tamanoCadena = strlen($cadena);
                        if($tamanoCadena<9){
                            $diferencia = 9 - $tamanoCadena;
                            for($i=0;$i<$diferencia;$i++){
                                $cadena = '0'.$cadena;
                            }
                        }
                        $detallePagoProveedor->documentopago = $compra->estabcompra.'-'.$compra->puntocompra.'-'.$cadena.'1';//No de serie pero el secuencial de 9 digitos
                        $detallePagoProveedor->estado = 1;
                        $detallePagoProveedor->fechahoragrabado = date('Y-m-d');
                        $detallePagoProveedor->fechamovimiento = $compra->fecharegistro;
                        $detallePagoProveedor->idperiodo = 1;
                        $detallePagoProveedor->idproveedor = $compra->idproveedor;
                        $detallePagoProveedor->saldocompra = $compraCstm->saldocompra;
                        $detallePagoProveedor->tipopagocrdb = 'CN';//COMPRA NUEVA
                        $detallePagoProveedor->valormomimiento = $compraCstm->saldocompra;
                        if ($detallePagoProveedor->validate()){
                            if($detallePagoProveedor->save()){}
                            else{
                                //$tx->rollback();
                                $resultado['error'][]="error al almacenar detallePagoProveedor";
                            }
                        }else{
                            $resultado['error'][]=$detallePagoProveedor->getErrors();
                            //$tx->rollback();
                        }


                        //ALMACENO EL DETALLE ASIENTO
                        $detalleAsiento = Detalleasientos::model()->findAll(
                                array(
                                'condition' => '"idasiento" = :idasiento',
                                'params' => array(
                                        ':idasiento' => $idMaestroAsiento
                                )));
                        foreach($detalleAsiento as $detalleAsientos){
                            //ELIMINO LOS PAGOS PROVEEDOR ANTERIORES
                            $detalleAsientoId = Detalleasientos::model()->findByPk($detalleAsientos['id']);
                            $detalleAsientoId->delete();
                        }
                        //ASIENTO DE LOS PRODUCTOS
                        $contador = count($codProd);
                        for($i=0;$i<$contador;$i++){
                            $contador1 = count($cantProd[$i]);
                            for($j=0;$j<$contador1;$j++){
                                $detalleAsiento = new Detalleasientos;
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
                                $detalleAsiento->idempresa=$this->empresa_id;
                                $detalleAsiento->subdetalle='';//PREGUNTAR
                                $detalleAsiento->valordebe=$totProd[$i][$j];
                                $detalleAsiento->valorhaber=0;
                                if ($detalleAsiento->validate()){
                                    if($detalleAsiento->save()){}
                                    else{
                                        //$tx->rollback();
                                        $resultado['error'][]="error al almacenar detalleAsiento";
                                    }
                                }else{
                                    $resultado['error'][]=$detalleAsiento->getErrors();
                                    //$tx->rollback();
                                }
                            }
                        }

                        //ASIENTO DE MONTO IVA
                        if($compra->montoiva > 0){
                            $detalleAsiento = new Detalleasientos;
                            $porcentajeIvaCuenta = Porcentajeiva::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $compra->idporcentajeiva
                                    )));
                            foreach($porcentajeIvaCuenta as $porcentajeIvaCuentas){
                                $detalleAsiento->cuentacontable=$porcentajeIvaCuentas['cuentacontablecredito'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=$compra->montoiva;
                            $detalleAsiento->valorhaber=0;
                            if ($detalleAsiento->validate()){
                                    if($detalleAsiento->save()){}
                                    else{
                                        //$tx->rollback();
                                        $resultado['error'][]="error al almacenar detalleAsiento";
                                    }
                                }else{
                                    $resultado['error'][]=$detalleAsiento->getErrors();
                                    //$tx->rollback();
                                }
                        }

                        //ASIENTO DE MONTO ICE
                        if($compra->montoice > 0){
                            $detalleAsiento = new Detalleasientos;
                            $porcentajeIceCuenta = Porcentajeice::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $compra->idporcentajeice
                                    )));
                            foreach($porcentajeIceCuenta as $porcentajeIceCuentas){
                                $detalleAsiento->cuentacontable=$porcentajeIceCuentas['cuentacontable'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=$compra->montoice;
                            $detalleAsiento->valorhaber=0;
                            if ($detalleAsiento->validate()){
                                    if($detalleAsiento->save()){}
                                    else{
                                        $resultado['error'][]="error al almacenar detalleAsiento";
                                    }
                                }else{
                                    $resultado['error'][]=$detalleAsiento->getErrors();
                                }
                        }

                        //ASIENTO DE CUENTA POR PAGAR
                        $detalleAsiento = new Detalleasientos;
                        $cuentaCuentaPorPagar = Proveedor::model()->findAll(
                                array(
                                'condition' => '"id" = :id',
                                'params' => array(
                                        ':id' => $compra->idproveedor
                                )));
                        foreach($cuentaCuentaPorPagar as $cuentaCuentaPorPagars){
                            $detalleAsiento->cuentacontable=$cuentaCuentaPorPagars['cuentacontableporpagar'];
                        }
                        $detalleAsiento->idasiento=$idMaestroAsiento;
                        $detalleAsiento->idempresa=$this->empresa_id;
                        $detalleAsiento->subdetalle='';//PREGUNTAR
                        $detalleAsiento->valordebe=0;
                        $detalleAsiento->valorhaber=$compraCstm->saldocompra;
                        if ($detalleAsiento->validate()){
                            if($detalleAsiento->save()){}
                            else{
                                //$tx->rollback();
                                $resultado['error'][]="error al almacenar detalleAsiento";
                            }
                        }else{
                            $resultado['error'][]=$detalleAsiento->getErrors();
                            //$tx->rollback();
                        }

                        //ASIENTO DE VALOR RETENCION IVA 30%
                        if($compra->retencioniva30 > 0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionIva = Porcentajeretencioniva::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $compra->porcentajeretencioniva30
                                    )));
                            foreach($cuentaRetencionIva as $cuentaRetencionIvas){
                                $detalleAsiento->cuentacontable=$cuentaRetencionIvas['cuentacontablecompra'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$compra->retencioniva30;
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }

                        //ASIENTO DE VALOR RETENCION IVA 70%
                        if($compra->retenidoiva70 > 0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionIva = Porcentajeretencioniva::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $compra->porcentajeretencioniva70
                                    )));
                            foreach($cuentaRetencionIva as $cuentaRetencionIvas){
                                $detalleAsiento->cuentacontable=$cuentaRetencionIvas['cuentacontablecompra'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$compra->retenidoiva70;
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }

                        //ASIENTO DE VALOR RETENCION IVA 100%
                        if($compra->retenidoiva100 > 0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionIva = Porcentajeretencioniva::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $compra->porcentajeretencioniva100
                                    )));
                            foreach($cuentaRetencionIva as $cuentaRetencionIvas){
                                $detalleAsiento->cuentacontable=$cuentaRetencionIvas['cuentacontablecompra'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$compra->retenidoiva100;
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }

                        //ASIENTO DE VALOR RETENCION FUENTE 1
                        if($_POST['valor_retenido_1']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_1']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_1'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }
                        //ASIENTO DE VALOR RETENCION FUENTE 2
                        if($_POST['valor_retenido_2']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_2']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_2'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }
                        //ASIENTO DE VALOR RETENCION FUENTE 3
                        if($_POST['valor_retenido_3']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_3']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_3'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }
                        //ASIENTO DE VALOR RETENCION FUENTE 4
                        if($_POST['valor_retenido_4']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_4']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_4'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }
                        //ASIENTO DE VALOR RETENCION FUENTE 5
                        if($_POST['valor_retenido_5']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_5']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_5'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }
                        //ASIENTO DE VALOR RETENCION FUENTE 6
                        if($_POST['valor_retenido_6']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_6']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_6'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }

                    }catch(Exception $ex){
                        $resultado['error'][]=$ex->getMessage();
                    }
                    $tamanoResultado = count($resultado['error']);
                    if($tamanoResultado == 1){
                        $tx->commit();
                        $this->redirect(array('buscaranularetencion'));
//                        $this->redirect(array('ver','id'=>$idCompra,'idCstm'=>$idCompraCstm,'idMaestro'=>$idMaestroAsiento));
                    }else{
                        $tx->rollback();

                        $idCompra = $_POST['idCompra'];
                        $idMaestroAsiento = $_POST['idMaestroCompra'];
                        $idCompraCstm = $_POST['idCompraCstm'];

                        $validarPagado = 0;
                        $validarAsientoMayorizado = 0;
                        $validarNotaCredito = 0;
                        $validarSecuencialVacio = 0;
                        if($compraCstm->pagadocompra > 0){
                            $validarPagado = 1;
                        }
                        if($maestroAsiento->mayorizado == true){
                            $validarAsientoMayorizado = 1;
                        }
                        if($compraCstm->valornotacredito > 0){
                            $validarNotaCredito = 1;
                        }
                        if($compra->secuencialretencion1 == ''){
                            $validarSecuencialVacio = 1;
                        }

                        $compra = Compra::model()->findByPk($idCompra);
                        $maestroAsiento = Maestroasiento::model()->findByPk($idMaestroAsiento);
                        $compraCstm = Compraingresocstm::model()->findByPk($idCompraCstm);
                        $bodega = $this->cargarBodega();
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

                        $this->render('anularetencion',array(
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
                                'bodega'=>$bodega,
                                'idCompra'=>$idCompra,
                                'idMaestroAsiento'=>$idMaestroAsiento,
                                'idCompraCstm'=>$idCompraCstm,

                                'compra'=>$compra,
                                'maestroAsiento'=>$maestroAsiento,
                                'compraCstm'=>$compraCstm,

                                'validarPagado'=>$validarPagado,
                                'validarAsientoMayorizado'=>$validarAsientoMayorizado,
                                'validarNotaCredito'=>$validarNotaCredito,
                                'validarSecuencialVacio'=>$validarSecuencialVacio,
                        ));

                        //$this->render('crear',array('errores'=>$resultado['error']));

                    }
		}
        }

        public function actionVer()
	{                        
            if(isset($_POST['idCompra'])){
                $idCompra = $_POST['idCompra'];
                $idMaestroAsiento = $_POST['idMaestroAsiento'];
                $idCompraCstm = $_POST['idCompraCstm'];
            }else{
                $idCompra = $_REQUEST['id'];
                $idMaestroAsiento = $_REQUEST['idMaestro'];
                $idCompraCstm = $_REQUEST['idCstm'];
            }
            $compra = Compra::model()->findByPk($idCompra);
            $maestroAsiento = Maestroasiento::model()->findByPk($idMaestroAsiento);
            $compraCstm = Compraingresocstm::model()->findByPk($idCompraCstm);
            $bodega = $this->cargarBodega();
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
            if(isset($_POST['bandera'])){
                $this->redirect(array('update','id'=>$idCompra,'idCstm'=>$idCompraCstm,'idMaestro'=>$idMaestroAsiento));
                
            }else{
                $this->render('ver',array(
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
                        'bodega'=>$bodega,
                        'idCompra'=>$idCompra,
                        'idMaestroAsiento'=>$idMaestroAsiento,
                        'idCompraCstm'=>$idCompraCstm,

                        'compra'=>$compra,
                        'maestroAsiento'=>$maestroAsiento,
                        'compraCstm'=>$compraCstm,
                ));
            }
	}

        public function actionVercomprasanteriores()
	{
            if(isset($_POST['idCompra'])){
                $idCompra = $_POST['idCompra'];
                $idMaestroAsiento = $_POST['idMaestroAsiento'];
                $idCompraCstm = $_POST['idCompraCstm'];
            }else{
                $idCompra = $_REQUEST['id'];
                $idMaestroAsiento = $_REQUEST['idMaestro'];
                $idCompraCstm = $_REQUEST['idCstm'];
            }
            $compra = Compra::model()->findByPk($idCompra);
            $maestroAsiento = Maestroasiento::model()->findByPk($idMaestroAsiento);
            $compraCstm = Compraingresocstm::model()->findByPk($idCompraCstm);
            $bodega = $this->cargarBodega();
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
            if(isset($_POST['bandera'])){
                $this->redirect(array('updatecomprasanteriores','id'=>$idCompra,'idCstm'=>$idCompraCstm,'idMaestro'=>$idMaestroAsiento));

            }else{
                $this->render('vercomprasanteriores',array(
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
                        'bodega'=>$bodega,
                        'idCompra'=>$idCompra,
                        'idMaestroAsiento'=>$idMaestroAsiento,
                        'idCompraCstm'=>$idCompraCstm,

                        'compra'=>$compra,
                        'maestroAsiento'=>$maestroAsiento,
                        'compraCstm'=>$compraCstm,
                ));
            }
	}

        public function actionCrear()
	{
		$compra=new Compra;                
                $compraCstm = new Compraingresocstm;
                $maestroAsiento = new Maestroasiento;
                $detallePagoProveedor = new Detallepagoproveedor;                

                $resultado=array('error'=>'','url'=>'');

		if(isset($_POST['bandera'])){
                    $tx = Yii::app()->getDb()->beginTransaction();
                    try{
                        
                        $compra->autorizacompra=$_POST['numero_autorizacion'];
                        $compra->basecero=$_POST['base_imponible'];
                        $compra->basegravada=$_POST['base_imponible_gravada'];
                        $compra->baseice=$_POST['base_imponible_ice'];
                        $compra->basenograva=$_POST['base_imponible_no_iva'];
                        $compra->estabcompra=$_POST['numero_serie1'];             
                        $sumaRetencion = $_POST['iva_bienes_valor_retencion'] + $_POST['iva_servicios_valor_retencion'] + $_POST['iva_100_valor_retencion'] + $_POST['valor_retenido_1'] + $_POST['valor_retenido_2'] + $_POST['valor_retenido_3'] + $_POST['valor_retenido_4'] + $_POST['valor_retenido_5'] + $_POST['valor_retenido_6'];
                        if($sumaRetencion==0){
                            $compra->establecimientoretencion1='';
                            $compra->puntoemisionretencion1='';
                            $compra->secuencialretencion1='';
                            $compra->autorizacionretencion1='';
                        }else{
                            $establecimiento = $_POST['establecimiento'];
                            $compra->establecimientoretencion1 = Establecimiento::model()->buscaEstablecimiento($establecimiento);
                            $compra->puntoemisionretencion1=Establecimiento::model()->buscaPuntoEmision($establecimiento);
                            $retAutomatica = Establecimiento::model()->buscaRetencionAutomatica($establecimiento);
                            if($retAutomatica==1){
                                $numRetencion = Establecimiento::model()->buscaNumeroRetencion($establecimiento);
                                $compra->secuencialretencion1=$numRetencion;
                            }else
                                $compra->secuencialretencion1=$_POST['noSecuencialComprobante'];
                            $compra->autorizacionretencion1=Establecimiento::model()->buscaAutorizacionRetencion($establecimiento);
                        }
                        $compra->estado="1";
                        $compra->fechacaduca=$_POST['fecha_vencimiento'];
                        $compra->fechaemision=$_POST['fecha_emision'];
                        $compra->fecharegistro=$_POST['fecha_registro'];
                        $compra->fecharetencion1=$_POST['fecha_emision_comprobante'];
                        $compra->formapago=$_POST['formaPago'];
                        $compra->idbodega=$_POST['bodega'];//identificador de la bodega
                        $parametroContabilidad = Parametrocontabilidad::model()->findAll(
                                array(
                                'condition' => '"idempresa" = :idempresa',
                                'params' => array(
                                        ':idempresa' => $this->empresa_id
                                )));
                        foreach($parametroContabilidad as $parametrosContabilidad){
                            $compra->idejercicio=$parametrosContabilidad['anioejercicio'];//tabla ejercicio contable (año)
                        }                        
                        $compra->idempresa=$this->empresa_id;//identificador de la empresa que esta logeado
                        $compra->idmesperiodo=$_POST['mes'];//tabla periodocontable (mes)
                        $compra->idporcentajeice=$_POST['porcentajeIce'];
                        $compra->idporcentajeiva=$_POST['porcentajeIva'];
                        $compra->idproveedor=$_POST['proveedorId'];
                        $compra->idsecuencialtransaccion=$_POST['tipo_identificacion'];
                        $compra->idsustentotributario=$_POST['identificacion_credito'];
                        if($_POST['tarjeta']=='')
                            $idTarjeta = 0;
                        else
                            $idTarjeta = $_POST['tarjeta'];
                        $compra->idtarjetacredito=$idTarjeta;
                        $compra->idtipocomprobante=$_POST['tipo_comprobante'];
                        $compra->montobaseiva100=$_POST['iva_100_monto_iva'];
                        $compra->montobaseiva30=$_POST['iva_bienes_monto_iva'];
                        $compra->montobaseiva70=$_POST['iva_servicios_monto_iva'];
                        $compra->montoice=$_POST['monto_ice'];
                        $compra->montoiva=$_POST['monto_iva'];
                        $parametroFacturacion = Parametrofacturacion::model()->findAll(
                                array(
                                'condition' => '"idempresa" = :idempresa',
                                'params' => array(
                                        ':idempresa' => $this->empresa_id
                                )));
                        foreach($parametroFacturacion as $parametroFacturacions){                            
                            $compra->numerocompratransaccion=$parametroFacturacions['numerocompra'];//tabla parametro facturacion
                        }                        
                        $compra->porcentajeretencioniva30=$_POST['iva_bienes_porcentaje_retencion'];
                        $compra->porcentajeretencioniva100=$_POST['iva_100_porcentaje_retencion'];
                        $compra->porcentajeretencioniva70=$_POST['iva_servicios_porcentaje_retencion'];
                        $compra->puntocompra=$_POST['numero_serie2'];
                        $compra->retencioniva30=$_POST['iva_bienes_valor_retencion'];
                        $compra->retenidoiva100=$_POST['iva_100_valor_retencion'];
                        $compra->retenidoiva70=$_POST['iva_servicios_valor_retencion'];
                        $compra->secuencialcompra=$_POST['secuencial'];
                        $compra->ubicacionformulario=$_POST['ubicacion_formulario_104'];
                        $compra->compraempresa=1;
                        $compra->idordencompra = $_POST['ordenCompraId'];
                        
                        if ($compra->validate()){
                            if($compra->save()){
                                $idCompra = $compra->idcompra;
                                //DE LA TABLA PARAMETRO FACTURACION EL CAMPO NUMEROCOMPRA AUMENTAR EN 1
                                $paramFacturacion1 = Parametrofacturacion::model()->findAll(
                                        array(
                                        'condition' => '"idempresa" = :idempresa',
                                        'params' => array(
                                                ':idempresa' => $this->empresa_id
                                        )));
                                foreach($paramFacturacion1 as $paramFacturacion1s){
                                    $idParam = $paramFacturacion1s['id'];
                                }

                                $paramFacturacion = Parametrofacturacion::model()->findByPk($idParam);
                                $paramFacturacion->numerocompra = $paramFacturacion->numerocompra + 1;
                                $paramFacturacion->update();

                                //DE LA TABLA PROVEEDOR ACTUALIZAR EL CAMPO AUTORIZACIONFACTURA Y FECHA CADUCIDAD
                                $proveedorActualizacion = Proveedor::model()->findByPk($_POST['proveedorId']);
                                $proveedorActualizacion->autorizacionfactura = $_POST['numero_autorizacion'];
                                $proveedorActualizacion->fechacaducidad = $_POST['fecha_vencimiento'];
                                $proveedorActualizacion->update();

                                //DE LA TABLA ESTABLECIMIENTO ACTUALIZAR EL NUMERORETENCION SI RETENCIONAUTOMATICA ES TRUE
                                $retAutomatica = Establecimiento::model()->buscaRetencionAutomatica($_POST['establecimiento']);
                                if($retAutomatica==1){
                                    $establecimientoActualizacion = Establecimiento::model()->findByPk($_POST['establecimiento']);
                                    $establecimientoActualizacion->numeroretencion = Establecimiento::model()->buscaNumeroRetencion($_POST['establecimiento']) + 1;
                                    $establecimientoActualizacion->update();
                                }
                            }else{
                                //$tx->rollback();
                                $resultado['error'][]="error al almacenar compraitem";
                            }
                        }else{
                            $resultado['error'][]=$compra->getErrors();
                            //$tx->rollback();
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
                        
                        $parambase_imponibleetroContabilidad = Parametrocontabilidad::model()->findAll(
                                array(
                                'condition' => '"idempresa" = :idempresa',
                                'params' => array(
                                        ':idempresa' => $this->empresa_id
                                )));
                        foreach($parametroContabilidad as $parametrosContabilidad){
                            $idParametroContabilidad = $parametrosContabilidad['idparametrocontabilidad'];
                            $numeroAsiento = $parametrosContabilidad['numeroasiento'];
                            $idParametros = $parametrosContabilidad['iddocumentocompragasto'];
                            $maestroAsiento->iddocumento = $parametrosContabilidad['iddocumentocompragasto'];
                            
                        }

                        $maestroAsiento->idcuentabancaria = 0;//NO HAY COMO PONERLE 0 DEBIDO A LA RELACION CON LA TABLA CUENTAS BANCARIAS

                        $tipoDocumentoContable = Tipodocumentocontable::model()->findAll(
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
                        
                        $maestroAsiento->idempresa = $this->empresa_id;
                        $maestroAsiento->impreso = 0;
                        $maestroAsiento->mayorizado = 0;

                        $maestroAsiento->numeroasiento = $numeroAsiento; //DE LA TABLA PARAMETRO CONTABILIDAD

                        $tipoComprobanteContable = Tipocomprobantecontable::model()->findAll(
                                array(
                                'condition' => '"idcomprobantecontable" = :idcomprobante',
                                'params' => array(
                                        ':idcomprobante' => $documentoComprobante
                                )));
                        foreach($tipoComprobanteContable as $tipoComprobanteContables){
                            $maestroAsiento->numerocomprobante = $tipoComprobanteContables['numeracion']; //DE LA TABLA TIPO DOCUMENTO CONTABLE
                        }

                        $maestroAsiento->numerodocumento = $numeroDocumento; //DE LA TABLA TIPO DOCUMENTO CONTABLE
                        $maestroAsiento->periodocontable = $_POST['anio'];//AÑO
                        $maestroAsiento->referenciaadicional = 'CO'.$parametroFacturacions['numerocompra'];//BLANCO
                        $maestroAsiento->valormovimiento = $_POST['pagado'] + $_POST['saldo'];//VALOR DE SUMA PAGADO + SALDO
                        $maestroAsiento->tipodecheque=6;
                        if ($maestroAsiento->validate()){
                            if($maestroAsiento->save()){
                                //EN LA TABLA PARAMETROCONTABILIDAD EL CAMPO NUMEROASIENTO AUMENTAR EN 1
                                $numAsiento = Parametrocontabilidad::model()->findByPk($idParametroContabilidad);
                                $numAsiento->numeroasiento = $numAsiento->numeroasiento + 1;
                                $numAsiento->update();

                                //EN LA TABLA TIPOCOMPROBANTECONTABLE EL CAMPO NUMERACION AUMENTAR EN 1
                                $numeracion = new Tipocomprobantecontable;
                                $numeracion = Tipocomprobantecontable::model()->findByPk($documentoComprobante);
                                $numeracion->numeracion = $numeracion->numeracion + 1;
                                $numeracion->update();

                                //EN LA TABLA TIPODOCUMENTOCONTABLE EL CAMPO NUMERODOCUMENTO AUMENTAR EN 1
                                $numDocumento = new Tipodocumentocontable;
                                $numDocumento = Tipodocumentocontable::model()->findByPk($idParametros);
                                $numDocumento->numerodocumento = $numDocumento->numerodocumento + 1;
                                $numDocumento->update();

                                $idMaestroAsiento = $maestroAsiento->idasiento;
                            }
                            else{
                                $resultado['error'][]="error al almacenar maestroAsiento";
                            }
                        }else{
                            $resultado['error'][]=$maestroAsiento->getErrors();
                        }

                        //ALMACENO COMPRA CSTM
                        $compraCstm->asientocompra = $idMaestroAsiento;//ID DEL MAESTRO ASIENTO
                        $compraCstm->asientoretencion = $idMaestroAsiento;//ID DEL MAESTRO ASIENTO
                        $compraCstm->fechacancelacion=$_POST['fechaVence'];//FECHA VENCE
                        $compraCstm->fechavencimiento=$_POST['fechaVence'];
                        $compraCstm->idcompra = $idCompra; //identificador de la compra
                        $compraCstm->idcompranotacredito = 0;//PONER EN 0
                        $compraCstm->idempresa = $this->empresa_id; //IDENTIFICADOR DE LA EMPRESA
                        $compraCstm->pagadocompra = $_POST['pagado'];//VALOR DE CAMPO Pagado
                        $compraCstm->pagosrealizados = $_POST['numeroPagos'];
                        $compraCstm->referenciaadicional = '';//BLANCO
                        $compraCstm->saldocompra = $_POST['saldo'];
                        $compraCstm->saldonotacredito = 0;//EN 0

//                        $proveedor = Proveedor::model()->findByPk($_POST['proveedorId']);
//                        $tipoProveedor = TipoProveedor::model()->findByPk($proveedor->idtipoproveedor);
                        $compraCstm->tipoproveedor = $_POST['tipo_pago'];//CAMPO Tipo de Pago
                        $compraCstm->tipotransaccioncompra = 1;
                        $compraCstm->totalretencionfuente = $_POST['valor_retenido_1'] + $_POST['valor_retenido_2'] + $_POST['valor_retenido_3'] + $_POST['valor_retenido_4'] + $_POST['valor_retenido_5'] + $_POST['valor_retenido_6'];
                        $compraCstm->totalretencioniva = $_POST['iva_bienes_valor_retencion'] + $_POST['iva_servicios_valor_retencion'] + $_POST['iva_100_valor_retencion'];
                        $compraCstm->valornotacredito = 0;
                        $compraCstm->conceptocompra = $_POST['concepto'];
                        if ($compraCstm->validate()){
                            if($compraCstm->save()){
                                $idCompraCstm = $compraCstm->id;
                            }
                            else{
                                //$tx->rollback();
                                $resultado['error'][]="error al almacenar compraicstm";
                            }
                        }else{
                            $resultado['error'][]=$compraCstm->getErrors();
                            //$tx->rollback();
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
                                $detalleCompra = new Detallecompra;
                                $cantidad = $cantProd[$i][$j];
                                $detalleCompra->cantidad = $cantidad;
                                $detalleCompra->idcentrocosto = $idCc[$i][$j];
                                $detalleCompra->idcompra = $idCompra; //identificador de la compra
                                $detalleCompra->idempresa = $this->empresa_id;
                                $idItemBodega = Itembodega::model()->findAll(
                                        array(
                                        'condition' => '"iditem" = :iditem AND "idbodega"=:idbodega',
                                        'params' => array(
                                                ':iditem' => $idProd[$i][$j],
                                                ':idbodega' => $_POST['bodega']
                                        )));
                                foreach($idItemBodega as $idItemBodegas){
                                    $itemBodegaId=$idItemBodegas['id'];
                                }
                                $detalleCompra->iditembodega = $itemBodegaId;
                                $detalleCompra->idtransaccioncompra=1;
                                $detalleCompra->valortotal=$totProd[$i][$j];
                                $detalleCompra->valorunitario=$valProd[$i][$j];
                                if ($detalleCompra->validate()){
                                    if($detalleCompra->save()){
                                        //ACTUALIZAR EL STOCK DE ITEM E ITEMBODEGA
                                        $itemActualizacion = Item::model()->findByPk($idProd[$i][$j]);
                                        $itemActualizacion->stock = $itemActualizacion->stock + $cantidad;
                                        $itemActualizacion->update();
                                        
                                        $itemBodegaActualizacion = Itembodega::model()->findByPk($itemBodegaId);
                                        $itemBodegaActualizacion->stock = $itemBodegaActualizacion->stock + $cantidad;
                                        $itemBodegaActualizacion->update();
                                    }
                                    else{
                                        //$tx->rollback();
                                        $resultado['error'][]="error al almacenar detallecompra";
                                    }
                                }else{
                                    $resultado['error'][]=$detalleCompra->getErrors();
                                    //$tx->rollback();
                                }
                            }
                        }

                        //ALMACENO EL DETALLE DE LOS PAGOS
                        if($_POST['numeroPagos']>0){
                            $saldo = $_POST['saldoPago'];
                            $valor = $_POST['valorPago'];
                            $fecha = $_POST['fechaPago'];
                            $contador = count($saldo);
                            for($i=0;$i<$contador;$i++){                                
                                if($valor[$i] > 0){
                                    $detallePagos = new Detallepagos;
                                    $detallePagos->estado=0;
                                    $detallePagos->fecha=$fecha[$i];
                                    $detallePagos->idasiento=0;//PONER EN 0
                                    $detallePagos->idcompra=$idCompra; //IDENTIFICACION DE LA COMPRA
                                    $detallePagos->saldo=$valor[$i];//PONER EN 0
                                    $detallePagos->valor=$valor[$i];
                                    if ($detallePagos->validate()){
                                        if($detallePagos->save()){
                                        }
                                        else{
                                            //$tx->rollback();
                                            $resultado['error'][]="error al almacenar detallePagos";
                                        }
                                    }else{
                                        $resultado['error'][]=$detallePagos->getErrors();
                                        //$tx->rollback();
                                    }
                                }
                            }
                        }                        
                        //ALMACENO LA RETENCION EN LA FUENTE DE LA COMPRA
                        if($_POST['base_imponible_1'] != 0){
                            $retencionesCompra = new Retencionescompra;
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
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar Retencionescompra";
                                }
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                //$tx->rollback();
                            }
                        }
                        if($_POST['base_imponible_2'] != 0){
                            $retencionesCompra = new Retencionescompra;
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
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar Retencionescompra";
                                }
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                //$tx->rollback();
                            }
                        }
                        if($_POST['base_imponible_3'] != 0){
                            $retencionesCompra = new Retencionescompra;
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
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar Retencionescompra";
                                }
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                //$tx->rollback();
                            }
                        }
                        if($_POST['base_imponible_4'] != 0){
                            $retencionesCompra = new Retencionescompra;
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
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar Retencionescompra";
                                }
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                //$tx->rollback();
                            }
                        }
                        if($_POST['base_imponible_5'] != 0){
                            $retencionesCompra = new Retencionescompra;
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
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar Retencionescompra";
                                }
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                //$tx->rollback();
                            }
                        }
                        if($_POST['base_imponible_6'] != 0){
                            $retencionesCompra = new Retencionescompra;
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
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar Retencionescompra";
                                }
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                //$tx->rollback();
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
                        $detallePagoProveedor->documentopago = $_POST['numero_serie1'].'-'.$_POST['numero_serie2'].'-'.$cadena.'1';//No de serie pero el secuencial de 9 digitos
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
                            else{
                                //$tx->rollback();
                                $resultado['error'][]="error al almacenar detallePagoProveedor";
                            }
                        }else{
                            $resultado['error'][]=$detallePagoProveedor->getErrors();
                            //$tx->rollback();
                        }


                        //ALMACENO EL DETALLE ASIENTO
                        //ASIENTO DE LOS PRODUCTOS
                        $contador = count($codProd);
                        for($i=0;$i<$contador;$i++){
                            $contador1 = count($cantProd[$i]);
                            for($j=0;$j<$contador1;$j++){
                                $detalleAsiento = new Detalleasientos;
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
                                $detalleAsiento->idempresa=$this->empresa_id;
                                $detalleAsiento->subdetalle='';//PREGUNTAR
                                $detalleAsiento->valordebe=$totProd[$i][$j];
                                $detalleAsiento->valorhaber=0;
                                if ($detalleAsiento->validate()){
                                    if($detalleAsiento->save()){}
                                    else{
                                        //$tx->rollback();
                                        $resultado['error'][]="error al almacenar detalleAsiento";
                                    }
                                }else{
                                    $resultado['error'][]=$detalleAsiento->getErrors();
                                    //$tx->rollback();
                                }
                            }
                        }

                        //ASIENTO DE MONTO IVA
                        if($_POST['monto_iva']>0){
                            $detalleAsiento = new Detalleasientos;
                            $porcentajeIvaCuenta = Porcentajeiva::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $_POST['porcentajeIva']
                                    )));
                            foreach($porcentajeIvaCuenta as $porcentajeIvaCuentas){
                                $detalleAsiento->cuentacontable=$porcentajeIvaCuentas['cuentacontablecredito'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=$_POST['monto_iva'];
                            $detalleAsiento->valorhaber=0;
                            if ($detalleAsiento->validate()){
                                    if($detalleAsiento->save()){}
                                    else{
                                        //$tx->rollback();
                                        $resultado['error'][]="error al almacenar detalleAsiento";
                                    }
                                }else{
                                    $resultado['error'][]=$detalleAsiento->getErrors();
                                    //$tx->rollback();
                                }
                        }

                        //ASIENTO DE MONTO ICE
                        if($_POST['monto_ice']>0){
                            $detalleAsiento = new Detalleasientos;
                            $porcentajeIceCuenta = Porcentajeice::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $_POST['porcentajeIce']
                                    )));
                            foreach($porcentajeIceCuenta as $porcentajeIceCuentas){
                                $detalleAsiento->cuentacontable=$porcentajeIceCuentas['cuentacontable'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=$_POST['monto_ice'];
                            $detalleAsiento->valorhaber=0;
                            if ($detalleAsiento->validate()){
                                    if($detalleAsiento->save()){}
                                    else{
                                        $resultado['error'][]="error al almacenar detalleAsiento";
                                    }
                                }else{
                                    $resultado['error'][]=$detalleAsiento->getErrors();
                                }
                        }

                        //ASIENTO DE CUENTA POR PAGAR
                        $detalleAsiento = new Detalleasientos;
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
                        $detalleAsiento->idempresa=$this->empresa_id;
                        $detalleAsiento->subdetalle='';//PREGUNTAR
                        $detalleAsiento->valordebe=0;
                        $detalleAsiento->valorhaber=$_POST['saldo'];
                        if ($detalleAsiento->validate()){
                            if($detalleAsiento->save()){}
                            else{
                                //$tx->rollback();
                                $resultado['error'][]="error al almacenar detalleAsiento";
                            }
                        }else{
                            $resultado['error'][]=$detalleAsiento->getErrors();
                            //$tx->rollback();
                        }

                        //ASIENTO DE VALOR RETENCION IVA 30%
                        if($_POST['iva_bienes_valor_retencion']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionIva = Porcentajeretencioniva::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $_POST['iva_bienes_porcentaje_retencion']
                                    )));
                            foreach($cuentaRetencionIva as $cuentaRetencionIvas){
                                $detalleAsiento->cuentacontable=$cuentaRetencionIvas['cuentacontablecompra'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['iva_bienes_valor_retencion'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }

                        //ASIENTO DE VALOR RETENCION IVA 70%
                        if($_POST['iva_servicios_valor_retencion']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionIva = Porcentajeretencioniva::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $_POST['iva_servicios_porcentaje_retencion']
                                    )));
                            foreach($cuentaRetencionIva as $cuentaRetencionIvas){
                                $detalleAsiento->cuentacontable=$cuentaRetencionIvas['cuentacontablecompra'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['iva_servicios_valor_retencion'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }

                        //ASIENTO DE VALOR RETENCION IVA 100%
                        if($_POST['iva_100_valor_retencion']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionIva = Porcentajeretencioniva::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $_POST['iva_100_porcentaje_retencion']
                                    )));
                            foreach($cuentaRetencionIva as $cuentaRetencionIvas){
                                $detalleAsiento->cuentacontable=$cuentaRetencionIvas['cuentacontablecompra'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['iva_100_valor_retencion'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }

                        //ASIENTO DE VALOR RETENCION FUENTE 1
                        if($_POST['valor_retenido_1']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_1']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_1'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }
                        //ASIENTO DE VALOR RETENCION FUENTE 2
                        if($_POST['valor_retenido_2']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_2']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_2'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }
                        //ASIENTO DE VALOR RETENCION FUENTE 3
                        if($_POST['valor_retenido_3']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_3']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_3'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }
                        //ASIENTO DE VALOR RETENCION FUENTE 4
                        if($_POST['valor_retenido_4']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_4']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_4'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }
                        //ASIENTO DE VALOR RETENCION FUENTE 5
                        if($_POST['valor_retenido_5']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_5']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_5'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }
                        //ASIENTO DE VALOR RETENCION FUENTE 6
                        if($_POST['valor_retenido_6']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_6']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_6'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }

                    }catch(Exception $ex){
                        $resultado['error'][]=$ex->getMessage();
                    }
                    $tamanoResultado = count($resultado['error']);
                    if($tamanoResultado == 1){
                        $tx->commit();
                        $bodega = $this->cargarBodega();
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
                        $this->render('ver',array(
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
                                'bodega'=>$bodega,
                                'idCompra'=>$idCompra,
                                'idMaestroAsiento'=>$idMaestroAsiento,
                                'idCompraCstm'=>$idCompraCstm,

                                'compra'=>$compra,
                                'maestroAsiento'=>$maestroAsiento,
                                'compraCstm'=>$compraCstm,
                                'detalleCompra'=>$detalleCompra,
                                'detallePagos'=>$detallePagos,
                                'retencionesCompra'=>$retencionesCompra,
                                'detallePagoProveedor'=>$detallePagoProveedor,
                                'detalleAsiento'=>$detalleAsiento,
                        ));
                    }else{
                        $tx->rollback();
                        $bodega = $this->cargarBodega();
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
                        $this->render('crear',array(
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
                                'bodega'=>$bodega,
                                'errores'=>$resultado['error'],
                        ));
                        //$this->render('crear',array('errores'=>$resultado['error']));

                    }
		}else{
                    $bodega = $this->cargarBodega();
                    $tarjetaCredito = $this->cargarTarjetaCredito();
                    $formaPago = $this->cargarFormaPago();
                    $codigosRetencionFuente = $this->cargarCodigosRetencionFuente();
                    $porcentajeIvaRetencion = $this->cargarPorcentajeIvaRetencion();
                    $proveedor = $this->cargarProveedor();
                    $tipoIdentificacion = $this->cargarTipoIdentificacion();
                    $tipoComprobante = $this->actionCargartipocomprobante();
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
                            'bodega'=>$bodega,
                    ));
                
	}
        }

	public function actionCreardevolucioncompra(){
                $compra=new Compra;
                $compraCstm = new Compraingresocstm;
                $maestroAsiento = new Maestroasiento;
                $detallePagoProveedor = new Detallepagoproveedor;
                $resultado=array('error'=>'','url'=>'');

		if(isset($_POST['bandera'])){
                    $tx = Yii::app()->getDb()->beginTransaction();
                    try{
                        $compra->attributes=$_POST['Compra'];
                        $compra->setScenario('insert');

                        $compraCstm->attributes=$_POST['Compraingresocstm'];
                        $compraCstm->setScenario('insert');

                        $compra->estado="1";
                        $parametroContabilidad = Parametrocontabilidad::model()->findAll(
                                array(
                                'condition' => '"idempresa" = :idempresa',
                                'params' => array(
                                        ':idempresa' => $this->empresa_id
                                )));
                        foreach($parametroContabilidad as $parametrosContabilidad){
                            $compra->idejercicio=$parametrosContabilidad['anioejercicio'];//tabla ejercicio contable (año)
                        }
                        $compra->idempresa=$this->empresa_id;//identificador de la empresa que esta logeado
                        $parametroFacturacion = Parametrofacturacion::model()->findAll(
                                array(
                                'condition' => '"idempresa" = :idempresa',
                                'params' => array(
                                        ':idempresa' => $this->empresa_id
                                )));
                        foreach($parametroFacturacion as $parametroFacturacions){
                            $compra->numerocompratransaccion=$parametroFacturacions['numerocompradevolucion'];//tabla parametro facturacion
                        }                        
                        $compra->compraempresa=1;
                        $compra->idmesperiodo = $_POST['mes'];

                        if ($compra->validate()){
                            if($compra->save()){
                                $idCompra = $compra->idcompra;
                                //DE LA TABLA PARAMETRO FACTURACION EL CAMPO NUMEROCOMPRA AUMENTAR EN 1
                                $paramFacturacion1 = Parametrofacturacion::model()->findAll(
                                        array(
                                        'condition' => '"idempresa" = :idempresa',
                                        'params' => array(
                                                ':idempresa' => $this->empresa_id
                                        )));
                                foreach($paramFacturacion1 as $paramFacturacion1s){
                                    $idParam = $paramFacturacion1s['id'];
                                }
                                
                                $paramFacturacion = Parametrofacturacion::model()->findByPk($idParam);
                                $paramFacturacion->numerocompradevolucion = $paramFacturacion->numerocompradevolucion + 1;
                                $paramFacturacion->update();

                                //DE LA TABLA PROVEEDOR ACTUALIZAR EL CAMPO AUTORIZACIONFACTURA Y FECHA CADUCIDAD
                                $proveedorActualizacion = Proveedor::model()->findByPk($compra->idproveedor);
                                $proveedorActualizacion->autorizacionfactura = $compra->autorizacompra;
                                $proveedorActualizacion->fechacaducidad = $compra->fechacaduca;
                                $proveedorActualizacion->update();

                                //DE LA TABLA COMPRAINGRESO_CSTM ACTUALIZAR LOS SALDOS
                                $cstm = Compraingresocstm::model()->findAll(
                                        array(
                                        'condition' => '"idcompra" = :idcompra',
                                        'params' => array(
                                                ':idcompra' => $_POST['idCompra']
                                        )));
                                foreach($cstm as $cstms){
                                    $idCstm = $cstms['id'];
                                }
                                $compraCstm1 = Compraingresocstm::model()->findByPk($idCstm);
                                $compraCstm1->idcompranotacredito = $idCompra;
                                $compraCstm1->valornotacredito = $compraCstm->pagadocompra;
                                $compraCstm1->saldocompra = $compraCstm1->saldocompra - $compraCstm->pagadocompra;
                                $compraCstm1->update();
                            }else{
                                $resultado['error'][]="error al almacenar compraitem";
                            }
                        }else{
                            $resultado['error'][]=$compra->getErrors();
                        }

                        //ALMACENO EL MAESTRO ASIENTO
                        $maestroAsiento->asientocuadrado=1;
                        $datoProveedor = explode("|",$_POST['proveedor']);
                        $cedulaRuc = trim($datoProveedor[0]);
                        $nombreBeneficiario = trim($datoProveedor[1]);
                        $maestroAsiento->beneficiario = $nombreBeneficiario;
                        $maestroAsiento->cedularuc = $cedulaRuc;
                        $maestroAsiento->detalle = $compraCstm->conceptocompra;
                        $maestroAsiento->estado = 0;
                        $maestroAsiento->fechacreacion = $compra->fecharegistro;
                        $maestroAsiento->fechamodificacion = $compra->fecharegistro;

                        $parambase_imponibleetroContabilidad = Parametrocontabilidad::model()->findAll(
                                array(
                                'condition' => '"idempresa" = :idempresa',
                                'params' => array(
                                        ':idempresa' => $this->empresa_id
                                )));
                        foreach($parametroContabilidad as $parametrosContabilidad){
                            $idParametroContabilidad = $parametrosContabilidad['idparametrocontabilidad'];
                            $numeroAsiento = $parametrosContabilidad['numeroasiento'];
                            $idParametros = $parametrosContabilidad['iddocumentocompragasto'];
                            $maestroAsiento->iddocumento = $parametrosContabilidad['iddocumentocompragasto'];

                        }

                        $maestroAsiento->idcuentabancaria = 0;//NO HAY COMO PONERLE 0 DEBIDO A LA RELACION CON LA TABLA CUENTAS BANCARIAS

                        $tipoDocumentoContable = Tipodocumentocontable::model()->findAll(
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

                        $maestroAsiento->idempresa = $this->empresa_id;
                        $maestroAsiento->impreso = 0;
                        $maestroAsiento->mayorizado = 0;

                        $maestroAsiento->numeroasiento = $numeroAsiento; //DE LA TABLA PARAMETRO CONTABILIDAD

                        $tipoComprobanteContable = Tipocomprobantecontable::model()->findAll(
                                array(
                                'condition' => '"idcomprobantecontable" = :idcomprobante',
                                'params' => array(
                                        ':idcomprobante' => $documentoComprobante
                                )));
                        foreach($tipoComprobanteContable as $tipoComprobanteContables){
                            $maestroAsiento->numerocomprobante = $tipoComprobanteContables['numeracion']; //DE LA TABLA TIPO DOCUMENTO CONTABLE
                        }

                        $maestroAsiento->numerodocumento = $numeroDocumento; //DE LA TABLA TIPO DOCUMENTO CONTABLE
                        $maestroAsiento->periodocontable = $_POST['anio'];//AÑO
                        $maestroAsiento->referenciaadicional = 'CO'.$parametroFacturacions['numerocompra'];//BLANCO
                        $maestroAsiento->valormovimiento = $compraCstm->pagadocompra + $compraCstm->saldocompra;//VALOR DE SUMA PAGADO + SALDO
                        $maestroAsiento->tipodecheque=6;
                        if ($maestroAsiento->validate()){
                            if($maestroAsiento->save()){
                                //EN LA TABLA PARAMETROCONTABILIDAD EL CAMPO NUMEROASIENTO AUMENTAR EN 1
                                $numAsiento = Parametrocontabilidad::model()->findByPk($idParametroContabilidad);
                                $numAsiento->numeroasiento = $numAsiento->numeroasiento + 1;
                                $numAsiento->update();

                                //EN LA TABLA TIPOCOMPROBANTECONTABLE EL CAMPO NUMERACION AUMENTAR EN 1
                                $numeracion = new Tipocomprobantecontable;
                                $numeracion = Tipocomprobantecontable::model()->findByPk($documentoComprobante);
                                $numeracion->numeracion = $numeracion->numeracion + 1;
                                $numeracion->update();

                                //EN LA TABLA TIPODOCUMENTOCONTABLE EL CAMPO NUMERODOCUMENTO AUMENTAR EN 1
                                $numDocumento = new Tipodocumentocontable;
                                $numDocumento = Tipodocumentocontable::model()->findByPk($idParametros);
                                $numDocumento->numerodocumento = $numDocumento->numerodocumento + 1;
                                $numDocumento->update();

                                $idMaestroAsiento = $maestroAsiento->idasiento;
                            }
                            else{
                                $resultado['error'][]="error al almacenar maestroAsiento";
                            }
                        }else{
                            $resultado['error'][]=$maestroAsiento->getErrors();
                        }

                        //ALMACENO COMPRA CSTM
                        $compraCstm->asientocompra = $idMaestroAsiento;//ID DEL MAESTRO ASIENTO
                        $compraCstm->asientoretencion = $idMaestroAsiento;//ID DEL MAESTRO ASIENTO
                        $compraCstm->fechacancelacion=$compraCstm->fechavencimiento;//FECHA VENCE
                        $compraCstm->idcompra = $idCompra; //identificador de la compra
                        $compraCstm->idcompranotacredito = 0;//PONER EN 0
                        $compraCstm->idempresa = $this->empresa_id; //IDENTIFICADOR DE LA EMPRESA
                        $compraCstm->saldonotacredito = 0;//EN 0
                        $compraCstm->tipotransaccioncompra = 3;
                        $compraCstm->valornotacredito = 0;
                        $compraCstm->totalretencioniva = 0;
                        $compraCstm->totalretencionfuente = 0;
                        if ($compraCstm->validate()){
                            if($compraCstm->save()){
                                $idCompraCstm = $compraCstm->id;
                            }
                            else{
                                $resultado['error'][]="error al almacenar compraicstm";
                            }
                        }else{
                            $resultado['error'][]=$compraCstm->getErrors();
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
                                $detalleCompra = new Detallecompra;
                                $cantidad = $cantProd[$i][$j];
                                $detalleCompra->cantidad = $cantidad;
                                $detalleCompra->idcentrocosto = $idCc[$i][$j];
                                $detalleCompra->idcompra = $idCompra; //identificador de la compra
                                $detalleCompra->idempresa = $this->empresa_id;
                                $idItemBodega = Itembodega::model()->findAll(
                                        array(
                                        'condition' => '"iditem" = :iditem AND "idbodega"=:idbodega',
                                        'params' => array(
                                                ':iditem' => $idProd[$i][$j],
                                                ':idbodega' => $compra->idbodega
                                        )));
                                foreach($idItemBodega as $idItemBodegas){
                                    $itemBodegaId=$idItemBodegas['id'];
                                }
                                $detalleCompra->iditembodega = $itemBodegaId;
                                $detalleCompra->idtransaccioncompra=1;
                                $detalleCompra->valortotal=$totProd[$i][$j];
                                $detalleCompra->valorunitario=$valProd[$i][$j];
                                if ($detalleCompra->validate()){
                                    if($detalleCompra->save()){
                                        //ACTUALIZAR EL STOCK DE ITEM E ITEMBODEGA
                                        $itemActualizacion = Item::model()->findByPk($idProd[$i][$j]);
                                        $itemActualizacion->stock = $itemActualizacion->stock - $cantidad;
                                        $itemActualizacion->update();

                                        $itemBodegaActualizacion = Itembodega::model()->findByPk($itemBodegaId);
                                        $itemBodegaActualizacion->stock = $itemBodegaActualizacion->stock - $cantidad;
                                        $itemBodegaActualizacion->update();
                                    }
                                    else{
                                        $resultado['error'][]="error al almacenar detallecompra";
                                    }
                                }else{
                                    $resultado['error'][]=$detalleCompra->getErrors();
                                }
                            }
                        }
                        
                        //ALMACENO EL DETALLE PAGO PROVEEDOR
                        $detallePagoProveedor->asientoreferencia = $idMaestroAsiento;
                        $cadena = $compra->secuencialcompra;
                        $tamanoCadena = strlen($cadena);
                        if($tamanoCadena<9){
                            $diferencia = 9 - $tamanoCadena;
                            for($i=0;$i<$diferencia;$i++){
                                $cadena = '0'.$cadena;
                            }
                        }
                        $detallePagoProveedor->documentopago = $compra->estabcompra.'-'.$compra->puntocompra.'-'.$cadena.'1';//No de serie pero el secuencial de 9 digitos
                        $detallePagoProveedor->estado = 1;
                        $detallePagoProveedor->fechahoragrabado = date('Y-m-d');
                        $detallePagoProveedor->fechamovimiento = $compra->fecharegistro;
                        $detallePagoProveedor->idperiodo = 1;
                        $detallePagoProveedor->idproveedor = $compra->idproveedor;
                        $detallePagoProveedor->saldocompra = $compraCstm->saldocompra;
                        $detallePagoProveedor->tipopagocrdb = 'CN';//COMPRA NUEVA
                        $detallePagoProveedor->valormomimiento = $compraCstm->saldocompra;
                        if ($detallePagoProveedor->validate()){
                            if($detallePagoProveedor->save()){}
                            else{
                                $resultado['error'][]="error al almacenar detallePagoProveedor";
                            }
                        }else{
                            $resultado['error'][]=$detallePagoProveedor->getErrors();
                        }


                        //ALMACENO EL DETALLE ASIENTO
                        //ASIENTO DE LOS PRODUCTOS
                        $contador = count($codProd);
                        for($i=0;$i<$contador;$i++){
                            $contador1 = count($cantProd[$i]);
                            for($j=0;$j<$contador1;$j++){
                                $detalleAsiento = new Detalleasientos;
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
                                $detalleAsiento->idempresa=$this->empresa_id;
                                $detalleAsiento->subdetalle='';//PREGUNTAR
                                $detalleAsiento->valordebe=0;
                                $detalleAsiento->valorhaber=$totProd[$i][$j];
                                if ($detalleAsiento->validate()){
                                    if($detalleAsiento->save()){}
                                    else{
                                        //$tx->rollback();
                                        $resultado['error'][]="error al almacenar detalleAsiento";
                                    }
                                }else{
                                    $resultado['error'][]=$detalleAsiento->getErrors();
                                    //$tx->rollback();
                                }
                            }
                        }

                        //ASIENTO DE MONTO IVA
                        if($compra->montoiva > 0){
                            $detalleAsiento = new Detalleasientos;
                            $porcentajeIvaCuenta = Porcentajeiva::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $compra->idporcentajeiva
                                    )));
                            foreach($porcentajeIvaCuenta as $porcentajeIvaCuentas){
                                $detalleAsiento->cuentacontable=$porcentajeIvaCuentas['cuentacontablecredito'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$compra->montoiva;
                            if ($detalleAsiento->validate()){
                                    if($detalleAsiento->save()){}
                                    else{
                                        //$tx->rollback();
                                        $resultado['error'][]="error al almacenar detalleAsiento";
                                    }
                                }else{
                                    $resultado['error'][]=$detalleAsiento->getErrors();
                                    //$tx->rollback();
                                }
                        }

                        //ASIENTO DE MONTO ICE
                        if($compra->baseice > 0){
                            $detalleAsiento = new Detalleasientos;
                            $porcentajeIceCuenta = Porcentajeice::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $compra->idporcentajeice
                                    )));
                            foreach($porcentajeIceCuenta as $porcentajeIceCuentas){
                                $detalleAsiento->cuentacontable=$porcentajeIceCuentas['cuentacontable'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$compra->montoice;
                            if ($detalleAsiento->validate()){
                                    if($detalleAsiento->save()){}
                                    else{
                                        $resultado['error'][]="error al almacenar detalleAsiento";
                                    }
                                }else{
                                    $resultado['error'][]=$detalleAsiento->getErrors();
                                }
                        }

                        //ASIENTO DE CUENTA POR PAGAR
                        $detalleAsiento = new Detalleasientos;
                        $cuentaCuentaPorPagar = Proveedor::model()->findAll(
                                array(
                                'condition' => '"id" = :id',
                                'params' => array(
                                        ':id' => $compra->idproveedor
                                )));
                        foreach($cuentaCuentaPorPagar as $cuentaCuentaPorPagars){
                            $detalleAsiento->cuentacontable=$cuentaCuentaPorPagars['cuentacontableporpagar'];
                        }
                        $detalleAsiento->idasiento=$idMaestroAsiento;
                        $detalleAsiento->idempresa=$this->empresa_id;
                        $detalleAsiento->subdetalle='';//PREGUNTAR
                        $detalleAsiento->valordebe=$compraCstm->pagadocompra;
                        $detalleAsiento->valorhaber=0;
                        if ($detalleAsiento->validate()){
                            if($detalleAsiento->save()){}
                            else{
                                //$tx->rollback();
                                $resultado['error'][]="error al almacenar detalleAsiento";
                            }
                        }else{
                            $resultado['error'][]=$detalleAsiento->getErrors();
                            //$tx->rollback();
                        }

                        

                    }catch(Exception $ex){
                        $resultado['error'][]=$ex->getMessage();
                    }
                    $tamanoResultado = count($resultado['error']);
                    if($tamanoResultado == 1){
                        $tx->commit();
                        $ejercicioContable = $this->cargarEjercicioContable();
                        $establecimiento = $this->cargarEstablecimiento();
                        $dataProvider=new CActiveDataProvider('Compra');
                        $this->render('indexdevolucioncompra',array(
                            'ejercicioContable'=>$ejercicioContable,
                            'establecimiento'=>$establecimiento,

                        ));
                    }else{
                        $tx->rollback();                     
                    }
		}else{
                    $mes = Periodocontable::model()->buscaMesNumero($_POST['mes']);
                    $anio = Ejerciciocontable::model()->buscaNombre($_POST['anio']);
                    if(strlen($mes) == 1)
                        $mes = '0'.$mes;

                    $mesUtilizado = mktime( 0, 0, 0, $mes, 1, $anio );
                    $ultimoDiaMes = $anio . '-' . $mes . '-' . date("t",$mesUtilizado);

                    if($mes==12){
                        $siguienteMes = '01';
                        $anio = $anio + 1;
                    }else{
                        $siguienteMes = $mes + 1;
                        if(strlen($siguienteMes) == 1)
                            $siguienteMes = '0'.$siguienteMes;
                    }
                    $mesUtilizadoSiguiente = mktime( 0, 0, 0, $siguienteMes, 1, $anio );
                    $ultimoDiaMesSiguiente = $anio . '-' . $siguienteMes . '-' . date("t",$mesUtilizadoSiguiente);
                    $compra->fechaemision = $ultimoDiaMes;
                    $compra->fecharegistro = $ultimoDiaMes;
                    $compra->estabcompra = '001';
                    $compra->puntocompra = '001';
                    $compraCstm->fechavencimiento = $ultimoDiaMesSiguiente;
                    $compraCstm->saldocompra = '0';

                    $bodega = $this->cargarBodega();
                    $tarjetaCredito = $this->cargarTarjetaCredito();
                    $formaPago = $this->cargarFormaPago();
                    $codigosRetencionFuente = $this->cargarCodigosRetencionFuente();
                    $porcentajeIvaRetencion = $this->cargarPorcentajeIvaRetencion();
                    $proveedor = $this->cargarProveedor();
                    $tipoIdentificacion = $this->cargarTipoIdentificacion();
                    $tipoComprobante = $this->actionCargartipocomprobante();
                    $porcentajeIva = $this->cargarPorcentajeIva();
                    $porcentajeIce = $this->cargarPorcentajeIce();
                    $tipoPago = $this->cargarTipoPago();
                    $ubicacionForm104 = $this->cargarUbicacionForm104();
                    $dataProvider=new CActiveDataProvider('Compra');
                    $this->render('creardevolucioncompra',array(
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
                            'bodega'=>$bodega,

                            'compra'=>$compra,
                            'compraCstm'=>$compraCstm,
                    ));

                }
            
        }

        public function actionUpdatedevolucioncompra(){
            $resultado=array('error'=>'','url'=>'');

            if(isset($_POST['idCompra'])){
                $idCompra = $_POST['idCompra'];
                $idCompraCstm = $_POST['idCompraCstm'];
                $idMaestroAsiento = $_POST['idMaestroAsiento'];
            }else{
                $idCompra = $_REQUEST['id'];
                $idCompraCstm = $_REQUEST['idCstm'];
                $idMaestroAsiento = $_REQUEST['idMaestro'];
            }

            if(isset($_POST['bandera'])){
                $tx = Yii::app()->getDb()->beginTransaction();
                try{
                    
                    $compraCstm1 = Compraingresocstm::model()->findByPk($idCompraCstm);
                    $saldoAnterior = $compraCstm1->pagadocompra;

                    $compra=new Compra;
                    $compra = $this->loadModel($idCompra);
                    $compra->setScenario('update');
                    $compra->attributes=$_POST['Compra'];

                    $compraCstm=new Compraingresocstm;
                    $compraCstm = $this->loadModelCompraCstm($idCompraCstm);
                    $compraCstm->setScenario('update');
                    $compraCstm->attributes=$_POST['Compraingresocstm'];

                    $maestroAsiento=Maestroasiento::model()->findByPk($idMaestroAsiento);
                                        
                    if ($compra->validate()){
                        if($compra->update()){
                            $idCompra = $compra->idcompra;

                            //DE LA TABLA PROVEEDOR ACTUALIZAR EL CAMPO AUTORIZACIONFACTURA Y FECHA CADUCIDAD
                            $proveedorActualizacion = Proveedor::model()->findByPk($compra->idproveedor);
                            $proveedorActualizacion->autorizacionfactura = $compra->autorizacompra;
                            $proveedorActualizacion->fechacaducidad = $compra->fechacaduca;
                            $proveedorActualizacion->update();

                            //DE LA TABLA COMPRAINGRESO_CSTM ACTUALIZAR LOS SALDOS
                            $cstm1 = Compraingresocstm::model()->findAll(
                                    array(
                                    'condition' => '"idcompranotacredito" = :idcompranotacredito',
                                    'params' => array(
                                            ':idcompranotacredito' => $idCompra
                                    )));
                            foreach($cstm1 as $cstm1s){
                                $idCompraDevolucion=$cstm1s['idcompra'];
                            }
                            $cstm = Compraingresocstm::model()->findAll(
                                    array(
                                    'condition' => '"idcompra" = :idcompra',
                                    'params' => array(
                                            ':idcompra' => $idCompraDevolucion
                                    )));
                            foreach($cstm as $cstms){
                                $idCstm = $cstms['id'];
                            }
                            $compraCstm1 = Compraingresocstm::model()->findByPk($idCstm);
                            $compraCstm1->idcompranotacredito = $idCompra;
                            $compraCstm1->valornotacredito = $compraCstm->pagadocompra;
                            $compraCstm1->saldocompra = $compraCstm1->saldocompra - $compraCstm->pagadocompra + $saldoAnterior;
                            $compraCstm1->update();
                        }else{
                            $resultado['error'][]="error al almacenar compraitem";
                        }
                    }else{
                        $resultado['error'][]=$compra->getErrors();
                    }

                    //ALMACENO EL MAESTRO ASIENTO
                    $maestroAsiento->detalle = $compraCstm->conceptocompra;
                    $maestroAsiento->fechacreacion = $compra->fecharegistro;
                    $maestroAsiento->fechamodificacion = $compra->fecharegistro;

                    $maestroAsiento->valormovimiento = $compraCstm->pagadocompra + $compraCstm->saldocompra;//VALOR DE SUMA PAGADO + SALDO
                    if ($maestroAsiento->validate()){
                        if($maestroAsiento->save()){
                            $idMaestroAsiento = $maestroAsiento->idasiento;
                        }
                        else{
                            $resultado['error'][]="error al almacenar maestroAsiento";
                        }
                    }else{
                        $resultado['error'][]=$maestroAsiento->getErrors();
                    }

                    //ALMACENO COMPRA CSTM
                    $compraCstm->fechacancelacion=$compraCstm->fechavencimiento;//FECHA VENCE
                    if ($compraCstm->validate()){
                        if($compraCstm->save()){
                            $idCompraCstm = $compraCstm->id;
                        }
                        else{
                            $resultado['error'][]="error al almacenar compraicstm";
                        }
                    }else{
                        $resultado['error'][]=$compraCstm->getErrors();
                    }

                    //ALMACENO EL DETALLE DE LA COMPRA
                    $detalleCompra = Detallecompra::model()->findAll(
                            array(
                            'condition' => '"idcompra" = :idcompra',
                            'params' => array(
                                    ':idcompra' => $idCompra
                            )));
                    foreach($detalleCompra as $detalleCompras){
                        //RESTO DEL STOCK ANTERIOR ANTES DE ELIMINAR EL DETALLE COMPRA
                        $itemCodigo = Itembodega::model()->findByPk($detalleCompras['iditembodega']);
                        $itemActualizacion = Item::model()->findByPk($itemCodigo->iditem);
                        $itemActualizacion->stock = $itemActualizacion->stock + $detalleCompras['cantidad'];
                        $itemActualizacion->update();

                        $itemBodegaActualizacion = Itembodega::model()->findByPk($detalleCompras['iditembodega']);
                        $itemBodegaActualizacion->stock = $itemBodegaActualizacion->stock + $detalleCompras['cantidad'];
                        $itemBodegaActualizacion->update();

                        //ELIMINO EL DETALLE COMPRA
                        $detalleCompraId = Detallecompra::model()->findByPk($detalleCompras['id']);
                        $detalleCompraId->delete();
                    }

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
                            $detalleCompra = new Detallecompra;
                            $cantidad = $cantProd[$i][$j];
                            $detalleCompra->cantidad = $cantidad;
                            $detalleCompra->idcentrocosto = $idCc[$i][$j];
                            $detalleCompra->idcompra = $idCompra; //identificador de la compra
                            $detalleCompra->idempresa = $this->empresa_id;
                            $idItemBodega = Itembodega::model()->findAll(
                                    array(
                                    'condition' => '"iditem" = :iditem AND "idbodega"=:idbodega',
                                    'params' => array(
                                            ':iditem' => $idProd[$i][$j],
                                            ':idbodega' => $compra->idbodega
                                    )));
                            foreach($idItemBodega as $idItemBodegas){
                                $itemBodegaId=$idItemBodegas['id'];
                            }
                            $detalleCompra->iditembodega = $itemBodegaId;
                            $detalleCompra->idtransaccioncompra=1;
                            $detalleCompra->valortotal=$totProd[$i][$j];
                            $detalleCompra->valorunitario=$valProd[$i][$j];
                            if ($detalleCompra->validate()){
                                if($detalleCompra->save()){
                                    //ACTUALIZAR EL STOCK DE ITEM E ITEMBODEGA
                                    $itemActualizacion = Item::model()->findByPk($idProd[$i][$j]);
                                    $itemActualizacion->stock = $itemActualizacion->stock - $cantidad;
                                    $itemActualizacion->update();

                                    $itemBodegaActualizacion = Itembodega::model()->findByPk($itemBodegaId);
                                    $itemBodegaActualizacion->stock = $itemBodegaActualizacion->stock - $cantidad;
                                    $itemBodegaActualizacion->update();
                                }
                                else{
                                    $resultado['error'][]="error al almacenar detallecompra";
                                }
                            }else{
                                $resultado['error'][]=$detalleCompra->getErrors();
                            }
                        }
                    }

                        //ALMACENO EL DETALLE PAGO PROVEEDOR
                    $dp = Detallepagoproveedor::model()->findAll(
                            array(
                            'condition' => '"asientoreferencia" = :asientoreferencia',
                            'params' => array(
                                    ':asientoreferencia' => $idMaestroAsiento
                            )));
                    foreach($dp as $dps){
                        $detallePagoProveedorId = $dps['id'];
                    }
                    $detallePagoProveedor=Detallepagoproveedor::model()->findByPk($detallePagoProveedorId);
                    $detallePagoProveedor->setScenario('update');
                    
                    $detallePagoProveedor->asientoreferencia = $idMaestroAsiento;
                    $cadena = $compra->secuencialcompra;
                    $tamanoCadena = strlen($cadena);
                    if($tamanoCadena<9){
                        $diferencia = 9 - $tamanoCadena;
                        for($i=0;$i<$diferencia;$i++){
                            $cadena = '0'.$cadena;
                        }
                    }
                    $detallePagoProveedor->documentopago = $compra->estabcompra.'-'.$compra->puntocompra.'-'.$cadena.'1';//No de serie pero el secuencial de 9 digitos
                    $detallePagoProveedor->fechamovimiento = $compra->fecharegistro;
                    $detallePagoProveedor->saldocompra = $compraCstm->saldocompra;
                    $detallePagoProveedor->valormomimiento = $compraCstm->saldocompra;
                    if ($detallePagoProveedor->validate()){
                        if($detallePagoProveedor->update()){}
                        else{
                            $resultado['error'][]="error al almacenar detallePagoProveedor";
                        }
                    }else{
                        $resultado['error'][]=$detallePagoProveedor->getErrors();
                    }


                    //ALMACENO EL DETALLE ASIENTO
                    $detalleAsiento = Detalleasientos::model()->findAll(
                            array(
                            'condition' => '"idasiento" = :idasiento',
                            'params' => array(
                                    ':idasiento' => $idMaestroAsiento
                            )));
                    foreach($detalleAsiento as $detalleAsientos){
                        //ELIMINO LOS PAGOS PROVEEDOR ANTERIORES
                        $detalleAsientoId = Detalleasientos::model()->findByPk($detalleAsientos['id']);
                        $detalleAsientoId->delete();
                    }
                    //ASIENTO DE LOS PRODUCTOS
                    $contador = count($codProd);
                    for($i=0;$i<$contador;$i++){
                        $contador1 = count($cantProd[$i]);
                        for($j=0;$j<$contador1;$j++){
                            $detalleAsiento = new Detalleasientos;
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
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$totProd[$i][$j];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }
                    }

                    //ASIENTO DE MONTO IVA
                    if($compra->montoiva > 0){
                        $detalleAsiento = new Detalleasientos;
                        $porcentajeIvaCuenta = Porcentajeiva::model()->findAll(
                                array(
                                'condition' => '"id" = :id',
                                'params' => array(
                                        ':id' => $compra->idporcentajeiva
                                )));
                        foreach($porcentajeIvaCuenta as $porcentajeIvaCuentas){
                            $detalleAsiento->cuentacontable=$porcentajeIvaCuentas['cuentacontablecredito'];
                        }
                        $detalleAsiento->idasiento=$idMaestroAsiento;
                        $detalleAsiento->idempresa=$this->empresa_id;
                        $detalleAsiento->subdetalle='';//PREGUNTAR
                        $detalleAsiento->valordebe=0;
                        $detalleAsiento->valorhaber=$compra->montoiva;
                        if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                    }

                    //ASIENTO DE MONTO ICE
                    if($compra->baseice > 0){
                        $detalleAsiento = new Detalleasientos;
                        $porcentajeIceCuenta = Porcentajeice::model()->findAll(
                                array(
                                'condition' => '"id" = :id',
                                'params' => array(
                                        ':id' => $compra->idporcentajeice
                                )));
                        foreach($porcentajeIceCuenta as $porcentajeIceCuentas){
                            $detalleAsiento->cuentacontable=$porcentajeIceCuentas['cuentacontable'];
                        }
                        $detalleAsiento->idasiento=$idMaestroAsiento;
                        $detalleAsiento->idempresa=$this->empresa_id;
                        $detalleAsiento->subdetalle='';//PREGUNTAR
                        $detalleAsiento->valordebe=0;
                        $detalleAsiento->valorhaber=$compra->montoice;
                        if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                            }
                    }

                    //ASIENTO DE CUENTA POR PAGAR
                    $detalleAsiento = new Detalleasientos;
                    $cuentaCuentaPorPagar = Proveedor::model()->findAll(
                            array(
                            'condition' => '"id" = :id',
                            'params' => array(
                                    ':id' => $compra->idproveedor
                            )));
                    foreach($cuentaCuentaPorPagar as $cuentaCuentaPorPagars){
                        $detalleAsiento->cuentacontable=$cuentaCuentaPorPagars['cuentacontableporpagar'];
                    }
                    $detalleAsiento->idasiento=$idMaestroAsiento;
                    $detalleAsiento->idempresa=$this->empresa_id;
                    $detalleAsiento->subdetalle='';//PREGUNTAR
                    $detalleAsiento->valordebe=$compraCstm->pagadocompra;
                    $detalleAsiento->valorhaber=0;
                    if ($detalleAsiento->validate()){
                        if($detalleAsiento->save()){}
                        else{
                            //$tx->rollback();
                            $resultado['error'][]="error al almacenar detalleAsiento";
                        }
                    }else{
                        $resultado['error'][]=$detalleAsiento->getErrors();
                        //$tx->rollback();
                    }
                }catch(Exception $ex){
                    $resultado['error'][]=$ex->getMessage();
                }
                $tamanoResultado = count($resultado['error']);
                if($tamanoResultado == 1){
                    $tx->commit();
                    $this->redirect(array('buscardevolucioncompra'));
                }else{
                    $tx->rollback();
                }
            }else{
                $compra=Compra::model()->findByPk($idCompra);
                $compraCstm=Compraingresocstm::model()->findByPk($idCompraCstm);
                $maestroAsiento=Maestroasiento::model()->findByPk($idMaestroAsiento);

                $bodega = $this->cargarBodega();
                $tarjetaCredito = $this->cargarTarjetaCredito();
                $formaPago = $this->cargarFormaPago();
                $codigosRetencionFuente = $this->cargarCodigosRetencionFuente();
                $porcentajeIvaRetencion = $this->cargarPorcentajeIvaRetencion();
                $proveedor = $this->cargarProveedor();
                $tipoIdentificacion = $this->cargarTipoIdentificacion();
                $tipoComprobante = $this->actionCargartipocomprobante();
                $porcentajeIva = $this->cargarPorcentajeIva();
                $porcentajeIce = $this->cargarPorcentajeIce();
                $tipoPago = $this->cargarTipoPago();
                $ubicacionForm104 = $this->cargarUbicacionForm104();
                $dataProvider=new CActiveDataProvider('Compra');
                $this->render('updatedevolucioncompra',array(
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
                        'bodega'=>$bodega,

                        'compra'=>$compra,
                        'compraCstm'=>$compraCstm,
                        'maestroAsiento'=>$maestroAsiento,
                ));

            }

        }

        public function actionVerdevolucioncompra(){
            if(isset($_POST['idCompra'])){
                $idCompra = $_POST['idCompra'];
                $idMaestroAsiento = $_POST['idMaestroAsiento'];
                $idCompraCstm = $_POST['idCompraCstm'];
            }else{
                $idCompra = $_REQUEST['id'];
                $idMaestroAsiento = $_REQUEST['idMaestro'];
                $idCompraCstm = $_REQUEST['idCstm'];
            }
            $compra = Compra::model()->findByPk($idCompra);
            $maestroAsiento = Maestroasiento::model()->findByPk($idMaestroAsiento);
            $compraCstm = Compraingresocstm::model()->findByPk($idCompraCstm);
            $bodega = $this->cargarBodega();
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
            if(isset($_POST['bandera'])){
                $this->redirect(array('updatedevolucioncompra','id'=>$idCompra,'idCstm'=>$idCompraCstm,'idMaestro'=>$idMaestroAsiento));

            }else{
                $this->render('verdevolucioncompra',array(
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
                        'bodega'=>$bodega,
                        'idCompra'=>$idCompra,
                        'idMaestroAsiento'=>$idMaestroAsiento,
                        'idCompraCstm'=>$idCompraCstm,

                        'compra'=>$compra,
                        'maestroAsiento'=>$maestroAsiento,
                        'compraCstm'=>$compraCstm,
                ));
            }
        }

        public function actionCrearcomprasanteriores()
	{
            $resultado=array('error'=>'','url'=>'');
            if(!isset($_POST['bandera'])){
                $compra = new Compra;
                $compraCstm = new Compraingresocstm;

                $mes = Periodocontable::model()->buscaMesNumero($_POST['mes']);
                $anio = Ejerciciocontable::model()->buscaNombre($_POST['anio']);
                if(strlen($mes) == 1)
                    $mes = '0'.$mes;

                $mesUtilizado = mktime( 0, 0, 0, $mes, 1, $anio );
                $ultimoDiaMes = $anio . '-' . $mes . '-' . date("t",$mesUtilizado);

                if($mes==12){
                    $siguienteMes = '01';
                    $anio = $anio + 1;
                }else{
                    $siguienteMes = $mes + 1;
                    if(strlen($siguienteMes) == 1)
                        $siguienteMes = '0'.$siguienteMes;
                }
                $mesUtilizadoSiguiente = mktime( 0, 0, 0, $siguienteMes, 1, $anio );
                $ultimoDiaMesSiguiente = $anio . '-' . $siguienteMes . '-' . date("t",$mesUtilizadoSiguiente);

                $compra->fechaemision = $ultimoDiaMes;
                $compra->fecharegistro = $ultimoDiaMes;

                $compra->estabcompra = '001';
                $compra->puntocompra = '001';

                $compraCstm->pagadocompra = '0.00';
                $compraCstm->fechavencimiento = $ultimoDiaMesSiguiente;
                $compraCstm->pagosrealizados = '1';
                

                $bodega = $this->cargarBodega();
                $tarjetaCredito = $this->cargarTarjetaCredito();
                $formaPago = $this->cargarFormaPago();
                $codigosRetencionFuente = $this->cargarCodigosRetencionFuente();
                $porcentajeIvaRetencion = $this->cargarPorcentajeIvaRetencion();
                $proveedor = $this->cargarProveedor();
                $tipoIdentificacion = $this->cargarTipoIdentificacion();
                $tipoComprobante = $this->actionCargartipocomprobante();
                $porcentajeIva = $this->cargarPorcentajeIva();
                $porcentajeIce = $this->cargarPorcentajeIce();
                $tipoPago = $this->cargarTipoPago();
                $ubicacionForm104 = $this->cargarUbicacionForm104();
                $dataProvider=new CActiveDataProvider('Compra');
                $this->render('crearcomprasanteriores',array(
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
                        'bodega'=>$bodega,

                        'compra'=>$compra,
                        'compraCstm'=>$compraCstm,
                ));

            }
            if(isset($_POST['bandera'])){
                $resultado=array('error'=>'','url'=>'');
                $tx = Yii::app()->getDb()->beginTransaction();
                try{
                    $compra = new Compra;
                    $compra->attributes=$_POST['Compra'];
                    $compra->setScenario('insert');
                    $parametroContabilidad = Parametrocontabilidad::model()->findAll(
                            array(
                            'condition' => '"idempresa" = :idempresa',
                            'params' => array(
                                    ':idempresa' => $this->empresa_id
                            )));
                    foreach($parametroContabilidad as $parametrosContabilidad){
                        $compra->idejercicio=$parametrosContabilidad['anioejercicio'];//tabla ejercicio contable (año)
                    }
                    $compra->idmesperiodo=$_POST['mes'];
                    $compra->basenograva=0;
                    $compra->basegravada=0;
                    $compra->idporcentajeiva=1;
                    $parametroFacturacion = Parametrofacturacion::model()->findAll(
                            array(
                            'condition' => '"idempresa" = :idempresa',
                            'params' => array(
                                    ':idempresa' => $this->empresa_id
                            )));
                    foreach($parametroFacturacion as $parametroFacturacions){
                        $compra->numerocompratransaccion=$parametroFacturacions['numerocompra'];//tabla parametro facturacion
                    }
                    $compra->idempresa=$this->empresa_id;//identificador de la empresa que esta logeado
                    $compra->compraempresa=1;
                    $compra->estado="1";
                    if ($compra->validate()){
                        if($compra->save()){
                            $idCompra = $compra->idcompra;
                            //DE LA TABLA PARAMETRO FACTURACION EL CAMPO NUMEROCOMPRA AUMENTAR EN 1
                            $paramFacturacion1 = Parametrofacturacion::model()->findAll(
                                    array(
                                    'condition' => '"idempresa" = :idempresa',
                                    'params' => array(
                                            ':idempresa' => $this->empresa_id
                                    )));
                            foreach($paramFacturacion1 as $paramFacturacion1s){
                                $idParam = $paramFacturacion1s['id'];
                            }

                            $paramFacturacion = Parametrofacturacion::model()->findByPk($idParam);
                            $paramFacturacion->numerocompra = $paramFacturacion->numerocompra + 1;
                            $paramFacturacion->update();
                        }else{
                            $resultado['error'][]="error al almacenar compraitem";
                        }
                    }else{
                        $resultado['error'][]=$compra->getErrors();
                    }

                    $compraCstm = new Compraingresocstm;
                    $compraCstm->attributes=$_POST['Compraingresocstm'];
                    $compraCstm->setScenario('insert');
                    $compraCstm->asientocompra = 39; //IDENTIFICADOR DEL MAESTRO ASIENTO
                    $compraCstm->asientoretencion = 39; //IDENTIFICADOR DEL MAESTRO ASIENTO
                    $compraCstm->totalretencionfuente = 0;
                    $compraCstm->totalretencioniva = 0;
                    $compraCstm->idcompra = $idCompra;
                    $compraCstm->idempresa=$this->empresa_id;//identificador de la empresa que esta logeado
                    $compraCstm->tipotransaccioncompra = 2;
                    if ($compraCstm->validate()){
                        if($compraCstm->save()){
                            $idCompraCstm = $compraCstm->id;
                            
                        }else{
                            $resultado['error'][]="error al almacenar compraitem";
                        }
                    }else{
                        $resultado['error'][]=$compraCstm->getErrors();
                    }

                    $valor = $_POST['valorPago'];
                    $fecha = $_POST['fechaPago'];
                    $contador = count($valor);
                    for($i=0;$i<$contador;$i++){
                        if($valor[$i] > 0){
                            $detallePagos = new Detallepagos;
                            $detallePagos->estado=0;
                            $detallePagos->fecha=$fecha[$i];
                            $detallePagos->idasiento=0;//PONER EN 0
                            $detallePagos->idcompra=$idCompra; //IDENTIFICACION DE LA COMPRA
                            $detallePagos->saldo=$valor[$i];//PONER EN 0
                            $detallePagos->valor=$valor[$i];
                            if ($detallePagos->validate()){
                                if($detallePagos->save()){
                                }
                                else{
                                    $resultado['error'][]="error al almacenar detallePagos";
                                }
                            }else{
                                $resultado['error'][]=$detallePagos->getErrors();
                            }
                        }
                    }

                }catch(Exception $ex){
                    $resultado['error'][]=$ex->getMessage();
                }
                $tamanoResultado = count($resultado['error']);
                if($tamanoResultado == 1){
                    $tx->commit();                        
                    $this->redirect(array('indexcomprasanteriores'));
                }else{
                    $tx->rollback();

                    $compra = new Compra;
                    $compraCstm = new Compraingresocstm;
                    $mes = Periodocontable::model()->buscaMesNumero($_POST['mes']);
                    $anio = Ejerciciocontable::model()->buscaNombre($_POST['anio']);
                    if(strlen($mes) == 1)
                        $mes = '0'.$mes;

                    $mesUtilizado = mktime( 0, 0, 0, $mes, 1, $anio );
                    $ultimoDiaMes = $anio . '-' . $mes . '-' . date("t",$mesUtilizado);

                    if($mes==12){
                        $siguienteMes = '01';
                        $anio = $anio + 1;
                    }else{
                        $siguienteMes = $mes + 1;
                        if(strlen($siguienteMes) == 1)
                            $siguienteMes = '0'.$siguienteMes;
                    }
                    $mesUtilizadoSiguiente = mktime( 0, 0, 0, $siguienteMes, 1, $anio );
                    $ultimoDiaMesSiguiente = $anio . '-' . $siguienteMes . '-' . date("t",$mesUtilizadoSiguiente);

                    $compra->fechaemision = $ultimoDiaMes;
                    $compra->fecharegistro = $ultimoDiaMes;

                    $compra->estabcompra = '001';
                    $compra->puntocompra = '001';

                    $compraCstm->pagadocompra = '0.00';
                    $compraCstm->fechavencimiento = $ultimoDiaMesSiguiente;
                    $compraCstm->pagosrealizados = '1';

                    $bodega = $this->cargarBodega();
                    $tarjetaCredito = $this->cargarTarjetaCredito();
                    $formaPago = $this->cargarFormaPago();
                    $codigosRetencionFuente = $this->cargarCodigosRetencionFuente();
                    $porcentajeIvaRetencion = $this->cargarPorcentajeIvaRetencion();
                    $proveedor = $this->cargarProveedor();
                    $tipoIdentificacion = $this->cargarTipoIdentificacion();
                    $tipoComprobante = $this->actionCargartipocomprobante();
                    $porcentajeIva = $this->cargarPorcentajeIva();
                    $porcentajeIce = $this->cargarPorcentajeIce();
                    $tipoPago = $this->cargarTipoPago();
                    $ubicacionForm104 = $this->cargarUbicacionForm104();
                    $dataProvider=new CActiveDataProvider('Compra');
                    $this->render('crearcomprasanteriores',array(
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
                            'bodega'=>$bodega,
                            'compra'=>$compra,
                            'compraCstm'=>$compraCstm,
                    ));
                }                
            }
	}

        public function actionUpdatecomprasanteriores()
	{
            $resultado=array('error'=>'','url'=>'');

            if(isset($_POST['idCompra'])){
                $idCompra = $_POST['idCompra'];
                $idCompraCstm = $_POST['idCompraCstm'];
            }else{
                $idCompra = $_REQUEST['id'];
                $idCompraCstm = $_REQUEST['idCstm'];
            }

            if(!isset($_POST['bandera'])){
                $compra = Compra::model()->findByPk($idCompra);
                $compraCstm = Compraingresocstm::model()->findByPk($idCompraCstm);

                $bodega = $this->cargarBodega();
                $tarjetaCredito = $this->cargarTarjetaCredito();
                $formaPago = $this->cargarFormaPago();
                $codigosRetencionFuente = $this->cargarCodigosRetencionFuente();
                $porcentajeIvaRetencion = $this->cargarPorcentajeIvaRetencion();
                $proveedor = $this->cargarProveedor();
                $tipoIdentificacion = $this->cargarTipoIdentificacion();
                $tipoComprobante = $this->actionCargartipocomprobante();
                $porcentajeIva = $this->cargarPorcentajeIva();
                $porcentajeIce = $this->cargarPorcentajeIce();
                $tipoPago = $this->cargarTipoPago();
                $ubicacionForm104 = $this->cargarUbicacionForm104();
                $dataProvider=new CActiveDataProvider('Compra');
                $this->render('updatecomprasanteriores',array(
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
                        'bodega'=>$bodega,

                        'compra'=>$compra,
                        'compraCstm'=>$compraCstm,
                ));

            }
            if(isset($_POST['bandera'])){
                $resultado=array('error'=>'','url'=>'');
                $tx = Yii::app()->getDb()->beginTransaction();
                try{
                    $compra=new Compra;
                    $compra = $this->loadModel($idCompra);
                    $compra->setScenario('update');
                    $compra->attributes=$_POST['Compra'];

                    $compraCstm=new Compraingresocstm;
                    $compraCstm = $this->loadModelCompraCstm($idCompraCstm);
                    $compraCstm->setScenario('update');
                    $compraCstm->attributes=$_POST['Compraingresocstm'];

                    
                    if ($compra->validate()){
                        if($compra->update()){
                            $idCompra = $compra->idcompra;                            
                        }else{
                            $resultado['error'][]="error al almacenar compraitem";
                        }
                    }else{
                        $resultado['error'][]=$compra->getErrors();
                    }

                    
                    if ($compraCstm->validate()){
                        if($compraCstm->update()){
                            $idCompraCstm = $compraCstm->id;

                        }else{
                            $resultado['error'][]="error al almacenar compraitem";
                        }
                    }else{
                        $resultado['error'][]=$compraCstm->getErrors();
                    }

                    //ALMACENO EL DETALLE DE LOS PAGOS
                    $detallePago = Detallepagos::model()->findAll(
                            array(
                            'condition' => '"idcompra" = :idcompra',
                            'params' => array(
                                    ':idcompra' => $idCompra
                            )));
                    foreach($detallePago as $detallePagos){
                        //ELIMINO LOS PAGOS ANTERIORES
                        $detallePagoId = Detallepagos::model()->findByPk($detallePagos['id']);
                        $detallePagoId->delete();
                    }
                    $valor = $_POST['valorPago'];
                    $fecha = $_POST['fechaPago'];
                    $contador = count($valor);
                    for($i=0;$i<$contador;$i++){
                        if($valor[$i] > 0){
                            $detallePagos = new Detallepagos;
                            $detallePagos->estado=0;
                            $detallePagos->fecha=$fecha[$i];
                            $detallePagos->idasiento=0;//PONER EN 0
                            $detallePagos->idcompra=$idCompra; //IDENTIFICACION DE LA COMPRA
                            $detallePagos->saldo=$valor[$i];//PONER EN 0
                            $detallePagos->valor=$valor[$i];
                            if ($detallePagos->validate()){
                                if($detallePagos->save()){
                                }
                                else{
                                    $resultado['error'][]="error al almacenar detallePagos";
                                }
                            }else{
                                $resultado['error'][]=$detallePagos->getErrors();
                            }
                        }
                    }

                }catch(Exception $ex){
                    $resultado['error'][]=$ex->getMessage();
                }
                $tamanoResultado = count($resultado['error']);
                if($tamanoResultado == 1){
                    $tx->commit();
                    $this->redirect(array('buscarcomprasanteriores'));
                }else{
                    $tx->rollback();
                }
            }
	}
	public function actionUpdate()
	{
            $resultado=array('error'=>'','url'=>'');
            if(!isset($_POST['bandera'])){
                $idCompra = $_REQUEST['id'];
                $idMaestroAsiento = $_REQUEST['idMaestro'];
                $idCompraCstm = $_REQUEST['idCstm'];

                $compra = Compra::model()->findByPk($idCompra);
                $maestroAsiento = Maestroasiento::model()->findByPk($idMaestroAsiento);
                $compraCstm = Compraingresocstm::model()->findByPk($idCompraCstm);

                $validarPagado = 0;
                $validarAsientoMayorizado = 0;
                $validarNotaCredito = 0;
                if($compraCstm->pagadocompra > 0){
                    $validarPagado = 1;
                }
                if($maestroAsiento->mayorizado == true){
                    $validarAsientoMayorizado = 1;
                }
                if($compraCstm->valornotacredito > 0){
                    $validarNotaCredito = 1;
                }

                $bodega = $this->cargarBodega();
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
                        'bodega'=>$bodega,
                        'idCompra'=>$idCompra,
                        'idMaestroAsiento'=>$idMaestroAsiento,
                        'idCompraCstm'=>$idCompraCstm,

                        'compra'=>$compra,
                        'maestroAsiento'=>$maestroAsiento,
                        'compraCstm'=>$compraCstm,

                        'validarPagado'=>$validarPagado,
                        'validarAsientoMayorizado'=>$validarAsientoMayorizado,
                        'validarNotaCredito'=>$validarNotaCredito,
                ));

            }
            if(isset($_POST['bandera'])){
                    $tx = Yii::app()->getDb()->beginTransaction();
                    try{                        
                        $compra=new Compra;
                        $compra = $this->loadModel($_POST['idCompra']);
                        $compra->setScenario('update');
                        $compra->attributes=$_POST['Compra'];

                        $maestroAsiento=new Maestroasiento;
                        $maestroAsiento = $this->loadModelMaestroAsiento($_POST['idMaestroAsiento']);
                        $maestroAsiento->setScenario('update');
                        $maestroAsiento->attributes=$_POST['Maestroasiento'];

                        $compraCstm=new Compraingresocstm;
                        $compraCstm = $this->loadModelCompraCstm($_POST['idCompraCstm']);
                        $compraCstm->setScenario('update');
                        $compraCstm->attributes=$_POST['Compraingresocstm'];

                        $sumaRetencion = $_POST['Compra_retencioniva30'] + $_POST['Compra_retenidoiva70'] + $_POST['Compra_retenidoiva100'] + $_POST['valor_retenido_1'] + $_POST['valor_retenido_2'] + $_POST['valor_retenido_3'] + $_POST['valor_retenido_4'] + $_POST['valor_retenido_5'] + $_POST['valor_retenido_6'];
                        if($sumaRetencion==0){
                            $compra->establecimientoretencion1='';
                            $compra->puntoemisionretencion1='';
                            $compra->secuencialretencion1='';
                            $compra->autorizacionretencion1='';
                        }else{
                            if($_POST['Compra_secuencialretencion1'] == 'null'){
//                                $establecimiento = $_POST['establecimiento'];
                                $establecimiento = 1;
                                $compra->establecimientoretencion1 = Establecimiento::model()->buscaEstablecimiento($establecimiento);
                                $compra->puntoemisionretencion1=Establecimiento::model()->buscaPuntoEmision($establecimiento);
                                $retAutomatica = Establecimiento::model()->buscaRetencionAutomatica($establecimiento);
                                if($retAutomatica==1){
                                    $numRetencion = Establecimiento::model()->buscaNumeroRetencion($establecimiento);
                                    $compra->secuencialretencion1=$numRetencion;
                                }
                                $compra->autorizacionretencion1=Establecimiento::model()->buscaAutorizacionRetencion($establecimiento);
                                //DE LA TABLA ESTABLECIMIENTO ACTUALIZAR EL NUMERORETENCION SI RETENCIONAUTOMATICA ES TRUE
                                $retAutomatica = Establecimiento::model()->buscaRetencionAutomatica($_POST['establecimiento']);
                                if($retAutomatica==1){
                                    $establecimientoActualizacion = Establecimiento::model()->findByPk($_POST['establecimiento']);
                                    $establecimientoActualizacion->numeroretencion = Establecimiento::model()->buscaNumeroRetencion($_POST['establecimiento']) + 1;
                                    $establecimientoActualizacion->update();
                                }
                            }
                        }                        
                        //ALMACENO LA COMPRA
                        if ($compra->validate()){
                            if($compra->update()){
                                $idCompra = $compra->idcompra;
                                //DE LA TABLA PROVEEDOR ACTUALIZAR EL CAMPO AUTORIZACIONFACTURA Y FECHA CADUCIDAD
                                $proveedorActualizacion = Proveedor::model()->findByPk($compra->idproveedor);
                                $proveedorActualizacion->autorizacionfactura = $compra->autorizacompra;
                                $proveedorActualizacion->fechacaducidad = $compra->fechacaduca;
                                $proveedorActualizacion->update();                                
                            }else{
                                $resultado['error'][]="error al almacenar compraitem";
                            }
                        }else{
                            $resultado['error'][]=$compra->getErrors();
                        }

                        //ALMACENO COMPRA CSTM
                        $detalleConceptoCompra = $maestroAsiento->detalle;
                        $compraCstm->conceptocompra=$detalleConceptoCompra;
                        $compraCstm->fechacancelacion=$compraCstm->fechavencimiento;//FECHA VENCE                        
                        $compraCstm->totalretencionfuente = $_POST['valor_retenido_1'] + $_POST['valor_retenido_2'] + $_POST['valor_retenido_3'] + $_POST['valor_retenido_4'] + $_POST['valor_retenido_5'] + $_POST['valor_retenido_6'];
                        $compraCstm->totalretencioniva = $compra->retencioniva30 + $compra->retenidoiva70 + $compra->retenidoiva100;
                        if ($compraCstm->validate()){
                            if($compraCstm->update()){
                                $idCompraCstm = $compraCstm->id;
                            }
                            else{
                                //$tx->rollback();
                                $resultado['error'][]="error al almacenar compraicstm";
                            }
                        }else{
                            $resultado['error'][]=$compraCstm->getErrors();
                            //$tx->rollback();
                        }

                        //ALMACENO EL MAESTRO ASIENTO        
                        $datoProveedor = explode("|",$_POST['proveedor']);
                        $cedulaRuc = trim($datoProveedor[0]);
                        $nombreBeneficiario = trim($datoProveedor[1]);
                        $maestroAsiento->beneficiario = $nombreBeneficiario;
                        $maestroAsiento->cedularuc = $cedulaRuc;                        
                        $maestroAsiento->fechamodificacion = date("Y-m-d");
                        $maestroAsiento->valormovimiento = $compraCstm->pagadocompra + $compraCstm->saldocompra;//VALOR DE SUMA PAGADO + SALDO
                        if ($maestroAsiento->validate()){
                            if($maestroAsiento->update()){
                                $idMaestroAsiento = $maestroAsiento->idasiento;
                            }
                            else{
                                //$tx->rollback();
                                $resultado['error'][]="error al almacenar maestroAsiento";
                            }
                        }else{
                            $resultado['error'][]=$maestroAsiento->getErrors();
                            $aux = 0;
                            //$tx->rollback();
                        }

                        

                        //ALMACENO EL DETALLE DE LA COMPRA
                        $detalleCompra = Detallecompra::model()->findAll(
                                array(
                                'condition' => '"idcompra" = :idcompra',
                                'params' => array(
                                        ':idcompra' => $idCompra
                                )));
                        foreach($detalleCompra as $detalleCompras){
                            //RESTO DEL STOCK ANTERIOR ANTES DE ELIMINAR EL DETALLE COMPRA
                            $itemCodigo = Itembodega::model()->findByPk($detalleCompras['iditembodega']);
                            $itemActualizacion = Item::model()->findByPk($itemCodigo->iditem);
                            $itemActualizacion->stock = $itemActualizacion->stock - $detalleCompras['cantidad'];
                            $itemActualizacion->update();

                            $itemBodegaActualizacion = Itembodega::model()->findByPk($detalleCompras['iditembodega']);
                            $itemBodegaActualizacion->stock = $itemBodegaActualizacion->stock - $detalleCompras['cantidad'];
                            $itemBodegaActualizacion->update();

                            //ELIMINO EL DETALLE COMPRA
                            $detalleCompraId = Detallecompra::model()->findByPk($detalleCompras['id']);
                            $detalleCompraId->delete();
                        }
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
                                $detalleCompra = new Detallecompra;
                                $cantidad = $cantProd[$i][$j];
                                $detalleCompra->cantidad = $cantidad;
                                $detalleCompra->idcentrocosto = $idCc[$i][$j];
                                $detalleCompra->idcompra = $idCompra; //identificador de la compra
                                $detalleCompra->idempresa = $this->empresa_id;
                                $bodegaId = $compra->idbodega;
                                $idItemBodega = Itembodega::model()->findAll(
                                        array(
                                        'condition' => '"iditem" = :iditem AND "idbodega"=:idbodega',
                                        'params' => array(
                                                ':iditem' => $idProd[$i][$j],
                                                ':idbodega' => $bodegaId
                                        )));
                                foreach($idItemBodega as $idItemBodegas){
                                    $itemBodegaId=$idItemBodegas['id'];
                                }
                                $detalleCompra->iditembodega = $itemBodegaId;
                                $detalleCompra->idtransaccioncompra=1;
                                $detalleCompra->valortotal=$totProd[$i][$j];
                                $detalleCompra->valorunitario=$valProd[$i][$j];
                                if ($detalleCompra->validate()){
                                    if($detalleCompra->save()){
                                        //ACTUALIZAR EL STOCK DE ITEM E ITEMBODEGA
                                        $itemActualizacion = Item::model()->findByPk($idProd[$i][$j]);
                                        $itemActualizacion->stock = $itemActualizacion->stock + $cantidad;
                                        $itemActualizacion->update();

                                        $itemBodegaActualizacion = Itembodega::model()->findByPk($itemBodegaId);
                                        $itemBodegaActualizacion->stock = $itemBodegaActualizacion->stock + $cantidad;
                                        $itemBodegaActualizacion->update();
                                    }
                                    else{
                                        //$tx->rollback();
                                        $resultado['error'][]="error al almacenar detallecompra";
                                    }
                                }else{
                                    $resultado['error'][]=$detalleCompra->getErrors();
                                    //$tx->rollback();
                                }
                            }
                        }



                        //ALMACENO EL DETALLE DE LOS PAGOS
                        $detallePago = Detallepagos::model()->findAll(
                                array(
                                'condition' => '"idcompra" = :idcompra',
                                'params' => array(
                                        ':idcompra' => $idCompra
                                )));
                        foreach($detallePago as $detallePagos){
                            //ELIMINO LOS PAGOS ANTERIORES
                            $detallePagoId = Detallepagos::model()->findByPk($detallePagos['id']);
                            $detallePagoId->delete();
                        }
                        $valor = $_POST['valorPago'];
                        $fecha = $_POST['fechaPago'];
                        $contador = count($valor);
                        for($i=0;$i<$contador;$i++){
                            if($valor[$i] > 0){
                                $detallePagos = new Detallepagos;
                                $detallePagos->estado=0;
                                $detallePagos->fecha=$fecha[$i];
                                $detallePagos->idasiento=0;//PONER EN 0
                                $detallePagos->idcompra=$idCompra; //IDENTIFICACION DE LA COMPRA
                                $detallePagos->saldo=$valor[$i];//PONER EN 0
                                $detallePagos->valor=$valor[$i];
                                if ($detallePagos->validate()){
                                    if($detallePagos->save()){
                                    }
                                    else{
                                        //$tx->rollback();
                                        $resultado['error'][]="error al almacenar detallePagos";
                                    }
                                }else{
                                    $resultado['error'][]=$detallePagos->getErrors();
                                    //$tx->rollback();
                                }
                            }
                        }
                        
                        //ALMACENO LA RETENCION EN LA FUENTE DE LA COMPRA
                        $retencionesCompra = Retencionescompra::model()->findAll(
                                array(
                                'condition' => '"idcompra" = :idcompra',
                                'params' => array(
                                        ':idcompra' => $idCompra
                                )));
                        foreach($retencionesCompra as $retencionesCompras){
                            //ELIMINO LAS RETENCIONES ANTERIORES
                            $retencionesCompraId = Retencionescompra::model()->findByPk($retencionesCompras['id']);
                            $retencionesCompraId->delete();
                        }
                        if($_POST['base_imponible_1'] != 0){
                            $retencionesCompra = new Retencionescompra;
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
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar Retencionescompra";
                                }
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                //$tx->rollback();
                            }
                        }
                        if($_POST['base_imponible_2'] != 0){
                            $retencionesCompra = new Retencionescompra;
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
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar Retencionescompra";
                                }
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                //$tx->rollback();
                            }
                        }
                        if($_POST['base_imponible_3'] != 0){
                            $retencionesCompra = new Retencionescompra;
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
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar Retencionescompra";
                                }
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                //$tx->rollback();
                            }
                        }
                        if($_POST['base_imponible_4'] != 0){
                            $retencionesCompra = new Retencionescompra;
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
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar Retencionescompra";
                                }
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                //$tx->rollback();
                            }
                        }
                        if($_POST['base_imponible_5'] != 0){
                            $retencionesCompra = new Retencionescompra;
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
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar Retencionescompra";
                                }
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                //$tx->rollback();
                            }
                        }
                        if($_POST['base_imponible_6'] != 0){
                            $retencionesCompra = new Retencionescompra;
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
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar Retencionescompra";
                                }
                            }else{
                                $resultado['error'][]=$retencionesCompra->getErrors();
                                //$tx->rollback();
                            }
                        }



                        //ALMACENO EL DETALLE PAGO PROVEEDOR
                        $detallePagoProveedor = Detallepagoproveedor::model()->findAll(
                                array(
                                'condition' => '"asientoreferencia" = :asientoreferencia',
                                'params' => array(
                                        ':asientoreferencia' => $idMaestroAsiento
                                )));
                        foreach($detallePagoProveedor as $detallePagoProveedors){
                            //ELIMINO LOS PAGOS PROVEEDOR ANTERIORES
                            $detallePagoProveedorId = Detallepagoproveedor::model()->findByPk($detallePagoProveedors['id']);
                            $detallePagoProveedorId->delete();
                        }
                        $detallePagoProveedor = new Detallepagoproveedor;
                        $detallePagoProveedor->asientoreferencia = $idMaestroAsiento;
                        $cadena = $compra->secuencialcompra;
                        $tamanoCadena = strlen($cadena);
                        if($tamanoCadena<9){
                            $diferencia = 9 - $tamanoCadena;
                            for($i=0;$i<$diferencia;$i++){
                                $cadena = '0'.$cadena;
                            }
                        }
                        $detallePagoProveedor->documentopago = $compra->estabcompra.'-'.$compra->puntocompra.'-'.$cadena.'1';//No de serie pero el secuencial de 9 digitos
                        $detallePagoProveedor->estado = 1;
                        $detallePagoProveedor->fechahoragrabado = date('Y-m-d');
                        $detallePagoProveedor->fechamovimiento = $compra->fecharegistro;
                        $detallePagoProveedor->idperiodo = 1;
                        $detallePagoProveedor->idproveedor = $compra->idproveedor;
                        $detallePagoProveedor->saldocompra = $compraCstm->saldocompra;
                        $detallePagoProveedor->tipopagocrdb = 'CN';//COMPRA NUEVA
                        $detallePagoProveedor->valormomimiento = $compraCstm->saldocompra;
                        if ($detallePagoProveedor->validate()){
                            if($detallePagoProveedor->save()){}
                            else{
                                //$tx->rollback();
                                $resultado['error'][]="error al almacenar detallePagoProveedor";
                            }
                        }else{
                            $resultado['error'][]=$detallePagoProveedor->getErrors();
                            //$tx->rollback();
                        }


                        //ALMACENO EL DETALLE ASIENTO
                        $detalleAsiento = Detalleasientos::model()->findAll(
                                array(
                                'condition' => '"idasiento" = :idasiento',
                                'params' => array(
                                        ':idasiento' => $idMaestroAsiento
                                )));
                        foreach($detalleAsiento as $detalleAsientos){
                            //ELIMINO LOS PAGOS PROVEEDOR ANTERIORES
                            $detalleAsientoId = Detalleasientos::model()->findByPk($detalleAsientos['id']);
                            $detalleAsientoId->delete();
                        }
                        //ASIENTO DE LOS PRODUCTOS
                        $contador = count($codProd);
                        for($i=0;$i<$contador;$i++){
                            $contador1 = count($cantProd[$i]);
                            for($j=0;$j<$contador1;$j++){
                                $detalleAsiento = new Detalleasientos;
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
                                $detalleAsiento->idempresa=$this->empresa_id;
                                $detalleAsiento->subdetalle='';//PREGUNTAR
                                $detalleAsiento->valordebe=$totProd[$i][$j];
                                $detalleAsiento->valorhaber=0;
                                if ($detalleAsiento->validate()){
                                    if($detalleAsiento->save()){}
                                    else{
                                        //$tx->rollback();
                                        $resultado['error'][]="error al almacenar detalleAsiento";
                                    }
                                }else{
                                    $resultado['error'][]=$detalleAsiento->getErrors();
                                    //$tx->rollback();
                                }
                            }
                        }

                        //ASIENTO DE MONTO IVA
                        if($compra->montoiva > 0){
                            $detalleAsiento = new Detalleasientos;
                            $porcentajeIvaCuenta = Porcentajeiva::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $compra->idporcentajeiva
                                    )));
                            foreach($porcentajeIvaCuenta as $porcentajeIvaCuentas){
                                $detalleAsiento->cuentacontable=$porcentajeIvaCuentas['cuentacontablecredito'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=$compra->montoiva;
                            $detalleAsiento->valorhaber=0;
                            if ($detalleAsiento->validate()){
                                    if($detalleAsiento->save()){}
                                    else{
                                        //$tx->rollback();
                                        $resultado['error'][]="error al almacenar detalleAsiento";
                                    }
                                }else{
                                    $resultado['error'][]=$detalleAsiento->getErrors();
                                    //$tx->rollback();
                                }
                        }

                        //ASIENTO DE MONTO ICE
                        if($compra->montoice > 0){
                            $detalleAsiento = new Detalleasientos;
                            $porcentajeIceCuenta = Porcentajeice::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $compra->idporcentajeice
                                    )));
                            foreach($porcentajeIceCuenta as $porcentajeIceCuentas){
                                $detalleAsiento->cuentacontable=$porcentajeIceCuentas['cuentacontable'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=$compra->montoice;
                            $detalleAsiento->valorhaber=0;
                            if ($detalleAsiento->validate()){
                                    if($detalleAsiento->save()){}
                                    else{
                                        $resultado['error'][]="error al almacenar detalleAsiento";
                                    }
                                }else{
                                    $resultado['error'][]=$detalleAsiento->getErrors();
                                }
                        }

                        //ASIENTO DE CUENTA POR PAGAR
                        $detalleAsiento = new Detalleasientos;
                        $cuentaCuentaPorPagar = Proveedor::model()->findAll(
                                array(
                                'condition' => '"id" = :id',
                                'params' => array(
                                        ':id' => $compra->idproveedor
                                )));
                        foreach($cuentaCuentaPorPagar as $cuentaCuentaPorPagars){
                            $detalleAsiento->cuentacontable=$cuentaCuentaPorPagars['cuentacontableporpagar'];
                        }
                        $detalleAsiento->idasiento=$idMaestroAsiento;
                        $detalleAsiento->idempresa=$this->empresa_id;
                        $detalleAsiento->subdetalle='';//PREGUNTAR
                        $detalleAsiento->valordebe=0;
                        $detalleAsiento->valorhaber=$compraCstm->saldocompra;
                        if ($detalleAsiento->validate()){
                            if($detalleAsiento->save()){}
                            else{
                                //$tx->rollback();
                                $resultado['error'][]="error al almacenar detalleAsiento";
                            }
                        }else{
                            $resultado['error'][]=$detalleAsiento->getErrors();
                            //$tx->rollback();
                        }

                        //ASIENTO DE VALOR RETENCION IVA 30%
                        if($compra->retencioniva30 > 0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionIva = Porcentajeretencioniva::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $compra->porcentajeretencioniva30
                                    )));
                            foreach($cuentaRetencionIva as $cuentaRetencionIvas){
                                $detalleAsiento->cuentacontable=$cuentaRetencionIvas['cuentacontablecompra'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$compra->retencioniva30;
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }

                        //ASIENTO DE VALOR RETENCION IVA 70%
                        if($compra->retenidoiva70 > 0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionIva = Porcentajeretencioniva::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $compra->porcentajeretencioniva70
                                    )));
                            foreach($cuentaRetencionIva as $cuentaRetencionIvas){
                                $detalleAsiento->cuentacontable=$cuentaRetencionIvas['cuentacontablecompra'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$compra->retenidoiva70;
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }

                        //ASIENTO DE VALOR RETENCION IVA 100%
                        if($compra->retenidoiva100 > 0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionIva = Porcentajeretencioniva::model()->findAll(
                                    array(
                                    'condition' => '"id" = :id',
                                    'params' => array(
                                            ':id' => $compra->porcentajeretencioniva100
                                    )));
                            foreach($cuentaRetencionIva as $cuentaRetencionIvas){
                                $detalleAsiento->cuentacontable=$cuentaRetencionIvas['cuentacontablecompra'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$compra->retenidoiva100;
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }

                        //ASIENTO DE VALOR RETENCION FUENTE 1
                        if($_POST['valor_retenido_1']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_1']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_1'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }
                        //ASIENTO DE VALOR RETENCION FUENTE 2
                        if($_POST['valor_retenido_2']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_2']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_2'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }
                        //ASIENTO DE VALOR RETENCION FUENTE 3
                        if($_POST['valor_retenido_3']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_3']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_3'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }
                        //ASIENTO DE VALOR RETENCION FUENTE 4
                        if($_POST['valor_retenido_4']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_4']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_4'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }
                        //ASIENTO DE VALOR RETENCION FUENTE 5
                        if($_POST['valor_retenido_5']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_5']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_5'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }
                        //ASIENTO DE VALOR RETENCION FUENTE 6
                        if($_POST['valor_retenido_6']>0){
                            $detalleAsiento = new Detalleasientos;
                            $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                                    array(
                                    'condition' => '"idcodretfuente" = :id',
                                    'params' => array(
                                            ':id' => $_POST['cod_ret_fuente_6']
                                    )));
                            foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                                $detalleAsiento->cuentacontable=$cuentaRetencionFuentes['cuentacontablecompras'];
                            }
                            $detalleAsiento->idasiento=$idMaestroAsiento;
                            $detalleAsiento->idempresa=$this->empresa_id;
                            $detalleAsiento->subdetalle='';//PREGUNTAR
                            $detalleAsiento->valordebe=0;
                            $detalleAsiento->valorhaber=$_POST['valor_retenido_6'];
                            if ($detalleAsiento->validate()){
                                if($detalleAsiento->save()){}
                                else{
                                    //$tx->rollback();
                                    $resultado['error'][]="error al almacenar detalleAsiento";
                                }
                            }else{
                                $resultado['error'][]=$detalleAsiento->getErrors();
                                //$tx->rollback();
                            }
                        }

                    }catch(Exception $ex){
                        $resultado['error'][]=$ex->getMessage();
                    }
                    $tamanoResultado = count($resultado['error']);
                    if($tamanoResultado == 1){
                        $tx->commit();                        
                        $this->redirect(array('buscar'));
//                        $this->redirect(array('ver','id'=>$idCompra,'idCstm'=>$idCompraCstm,'idMaestro'=>$idMaestroAsiento));
                    }else{
                        $tx->rollback();

                        $idCompra = $_POST['idCompra'];
                        $idMaestroAsiento = $_POST['idMaestroCompra'];
                        $idCompraCstm = $_POST['idCompraCstm'];

                        $compra = Compra::model()->findByPk($idCompra);
                        $maestroAsiento = Maestroasiento::model()->findByPk($idMaestroAsiento);
                        $compraCstm = Compraingresocstm::model()->findByPk($idCompraCstm);

                        $validarPagado = 0;
                        $validarAsientoMayorizado = 0;
                        $validarNotaCredito = 0;
                        if($compraCstm->pagadocompra > 0){
                            $validarPagado = 1;
                        }
                        if($maestroAsiento->mayorizado == true){
                            $validarAsientoMayorizado = 1;
                        }
                        if($compraCstm->valornotacredito > 0){
                            $validarNotaCredito = 1;
                        }

                        $bodega = $this->cargarBodega();
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
                                'bodega'=>$bodega,
                                'idCompra'=>$idCompra,
                                'idMaestroAsiento'=>$idMaestroAsiento,
                                'idCompraCstm'=>$idCompraCstm,
                            

                                'compra'=>$compra,
                                'maestroAsiento'=>$maestroAsiento,
                                'compraCstm'=>$compraCstm,

                                'validarPagado'=>$validarPagado,
                                'validarAsientoMayorizado'=>$validarAsientoMayorizado,
                                'validarNotaCredito'=>$validarNotaCredito,
                        ));

                        //$this->render('crear',array('errores'=>$resultado['error']));

                    }
		}
	}

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

        public function actionIndexdevolucioncompra()
	{
                $ejercicioContable = $this->cargarEjercicioContable();
                $establecimiento = $this->cargarEstablecimiento();
		$dataProvider=new CActiveDataProvider('Compra');
		$this->render('indexdevolucioncompra',array(
                    'ejercicioContable'=>$ejercicioContable,
                    'establecimiento'=>$establecimiento,

		));
	}

        public function actionIndexcomprasanteriores()
	{
                $ejercicioContable = $this->cargarEjercicioContable();
                $establecimiento = $this->cargarEstablecimiento();
		$dataProvider=new CActiveDataProvider('Compra');
		$this->render('indexcomprasanteriores',array(
                    'ejercicioContable'=>$ejercicioContable,
                    'establecimiento'=>$establecimiento,

		));
	}
        /**
	 * Carga los Ejercicios Contables (año)
	 */
	public function cargarEjercicioContable() {
		$ejercicioContable = Ejerciciocontable::model()->findAll(array('order'=>'idanio'));
		$ejercicioContableItems = CHtml::listData($ejercicioContable, 'id', 'idanio');
                return $ejercicioContableItems;
	}
        /**
	 * Carga los periodos contables (mes)
	 */
	public function actionCargarperiodocontable() {
            if(isset ($_POST['anio'])){
                $anio = $_POST['anio'];
                if($anio != ''){
                    $data= Periodocontable::model()->findAllBySql("SELECT * FROM periodocontrable WHERE idejercicio = ".$anio, array(':secuencial'=> $_POST['anio']));
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
	 * Carga las bodegas
	 */
	public function cargarBodega() {
            $bodega = Bodega::model()->findAll(array('order'=>'nombre'));
            $bodegaItems = CHtml::listData($bodega, 'id', 'nombre');
            return $bodegaItems;
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
            $this->layout  = '//layouts/listado';
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
	protected function cargarTipoidentificacion() {
                $tipoIdentificacion = Secuencialtransaccion::model()->findAll(
                        array(
                        'condition' => '"modulousarse" = 1',
                        'params' => array(
                        'order'=>'codigo'
                        )));
                $tipoIdentificacionItems = CHtml::listData($tipoIdentificacion, 'id', 'nombre');
                return $tipoIdentificacionItems;
	}



        /**
	 * Carga los tipos de comprobantes.
	 */
	public function actionCargartipocomprobante() {
            if(isset ($_POST['tipo_identificacion'])){
                $comprobante = $_POST['tipo_identificacion'];
                if($comprobante != ''){
                    $secuencialTransaccion = Secuencialtransaccion::model()->findAll(
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
                        $data=Tipocomprobante::model()->findAllBySql("SELECT * FROM tipocomprobante WHERE codigo = '".$datos."' AND codigo <> '5' AND codigo <> '4'", array(':secuencial'=> $_POST['tipo_identificacion']));
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
	 * Carga los tipos de comprobantes.
	 */
	public function actionCargartipocomprobantedevolucioncompra() {
            if(isset ($_POST['tipo_identificacion'])){
                $comprobante = $_POST['tipo_identificacion'];
                if($comprobante != ''){
                    $secuencialTransaccion = Secuencialtransaccion::model()->findAll(
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
//                    for($i=0;$i<count($tipoComprobanteRelacionadoArray);$i++){
                        $datos = trim($tipoComprobanteRelacionadoArray[$i]);
                        $data=Tipocomprobante::model()->findAllBySql("SELECT * FROM tipocomprobante WHERE codigo = '5' OR codigo = '4'", array(':secuencial'=> $_POST['tipo_identificacion']));
                        $data=CHtml::listData($data,'id','descripcion');
                        foreach($data as $value=>$name){
                            echo CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
                        }
//                    }
                }else
                    echo CHtml::tag('option',array('value'=>''),CHtml::encode('Seleccionar'),true);
            }
	}

        /**
	 * Carga los porcentajes de IVA.
	 */
	protected function cargarPorcentajeIva() {
		$porcentajeIva = Porcentajeiva::model()->findAll(array('order'=>'descripcion'));
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
		$porcentajeIce = Porcentajeice::model()->findAll(array('order'=>'porcentaje'));
		$porcentajeIceItems = CHtml::listData($porcentajeIce, 'id', 'porcentaje', 'descripcion');
		$this->formPorcentajeIce = $porcentajeIceItems;
                return $this->formPorcentajeIce;
	}

        /**
	 * Carga los códigos de retención a la fuente.
	 */
	protected function cargarCodigosRetencionFuente() {
		$codigoRetencionFuente = Codigoretencionfuente::model()->findAll(array('order'=>'porcentaje'));
		$codigoRetencionFuenteItems = CHtml::listData($codigoRetencionFuente, 'idcodretfuente', 'codigo', 'descripcion');
		$this->formCodigoRetencionFuente = $codigoRetencionFuenteItems;
                return $this->formCodigoRetencionFuente;
	}

        /**
	 * Carga los tipos de comprobantes.
	 */
	public function actionCargarimpuestorenta() {
            if(isset ($_POST['cod_ret_fuente_1'])){
                $codigoRetencion = $_POST['cod_ret_fuente_1'];
                if($codigoRetencion != ''){
                    $data=Codigoretencionfuente::model()->findAllBySql("SELECT * FROM codigoretencionfuente WHERE idcodretfuente=".$codigoRetencion, array(':secuencial'=> $_POST['cod_ret_fuente_1']));
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
	public function actionCargaridenticredito() {
            if(isset ($_POST['tipo_comprobante'])){
                $comprobante = $_POST['tipo_comprobante'];
                if($comprobante != ''){
                    $tipoComprobante = Tipocomprobante::model()->findAll(
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
                        $data=Sustentocredito::model()->findAllBySql("SELECT * FROM sustentocredito WHERE codigo = '".$datos."'", array(':secuencial'=> $_POST['tipo_identificacion']));
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
            $data=Porcentajeiva::model()->findAll('id=:id',
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
	protected function cargarPorcentajeivaretencion() {
		$porcentajeIvaRetencion = Porcentajeretencioniva::model()->findAll(array('order'=>'porcentaje'));
		$porcentajeIvaRetencionItems = CHtml::listData($porcentajeIvaRetencion, 'id', 'porcentaje', 'descripcion');
		$this->formPorcentajeIvaRetencion = $porcentajeIvaRetencionItems;
                return $this->formPorcentajeIvaRetencion;
	}

        /**
	 * Carga las formas de pago.
	 */
	protected function cargarFormaPago() {
		$formaPago = Formapago::model()->findAll(array('order'=>'id'));
		$formaPagoItems = CHtml::listData($formaPago, 'id', 'nombre');
		$this->formFormaPago = $formaPagoItems;
                return $this->formFormaPago;
	}

        /**
	 * Carga las tarjetas de crédito
	 */
        public function cargarTarjetaCredito(){
            $tarjetaCredito = Tarjetacredito::model()->findAll(array('order'=>'id'));
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
            $tipoIdentificacion=$this->getParam('tipo_identificacion');

            $secuencialTransaccion = Secuencialtransaccion::model()->findByPk($tipoIdentificacion);
            
            if($secuencialTransaccion->codigo=='01' && $secuencialTransaccion->modulousarse==1)
                $filtroTipoDocumento = 1;
            if($secuencialTransaccion->codigo=='02' && $secuencialTransaccion->modulousarse==1)
                $filtroTipoDocumento = 2;
            if($secuencialTransaccion->codigo=='03' && $secuencialTransaccion->modulousarse==1)
                $filtroTipoDocumento = 3;

            $model = new Proveedor;

            $criterio=$model->buscaProveedorCompra($param,20,$filtroTipoDocumento);
            
            $lista=$model->findAll($criterio,20,$filtroTipoDocumento);
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
                    $planCuentasNec = Plancuentasnec::model()->findAll(
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
            
            $porcentajeIvaCuenta = Porcentajeiva::model()->findAll(
                    array(
                    'condition' => '"id" = :id',
                    'params' => array(
                            ':id' => $porcentajeIva
                    )));
            foreach($porcentajeIvaCuenta as $porcentajeIvaCuentas){
                $itemCuentaContableMontoIva = $porcentajeIvaCuentas['cuentacontablecredito'];
                $planCuentasNec = Plancuentasnec::model()->findAll(
                        array(
                        'condition' => '"idcuentanec" = :idItem',
                        'params' => array(
                                ':idItem' => $itemCuentaContableMontoIva
                        )));
                foreach($planCuentasNec as $planCuentasNecs){
                    $cuentaContableMontoIva = $planCuentasNecs['nombrecuenta'];
                }
            }
            
            $porcentajeIceCuenta = Porcentajeice::model()->findAll(
                    array(
                    'condition' => '"id" = :id',
                    'params' => array(
                            ':id' => $porcentajeIce
                    )));
            foreach($porcentajeIceCuenta as $porcentajeIceCuentas){
                $idCuentaContableMontoIce = $porcentajeIceCuentas['cuentacontable'];
                $planCuentasNec = Plancuentasnec::model()->findAll(
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
                $planCuentasNec = Plancuentasnec::model()->findAll(
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
                $cuentaRetencionIva = Porcentajeretencioniva::model()->findAll(
                        array(
                        'condition' => '"id" = :id',
                        'params' => array(
                                ':id' => $retIva30P
                        )));
                foreach($cuentaRetencionIva as $cuentaRetencionIvas){
                    $idCuentaContableRetencionIva30 = $cuentaRetencionIvas['cuentacontablecompra'];
                    $planCuentasNec = Plancuentasnec::model()->findAll(
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
                $cuentaRetencionIva = Porcentajeretencioniva::model()->findAll(
                        array(
                        'condition' => '"id" = :id',
                        'params' => array(
                                ':id' => $retIva70P
                        )));
                foreach($cuentaRetencionIva as $cuentaRetencionIvas){
                    $idCuentaContableRetencionIva70 = $cuentaRetencionIvas['cuentacontablecompra'];
                    $planCuentasNec = Plancuentasnec::model()->findAll(
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
                $cuentaRetencionIva = Porcentajeretencioniva::model()->findAll(
                        array(
                        'condition' => '"id" = :id',
                        'params' => array(
                                ':id' => $retIva100P
                        )));
                foreach($cuentaRetencionIva as $cuentaRetencionIvas){
                    $idCuentaContableRetencionIva100 = $cuentaRetencionIvas['cuentacontablecompra'];
                    $planCuentasNec = Plancuentasnec::model()->findAll(
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
                $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                        array(
                        'condition' => '"idcodretfuente" = :id',
                        'params' => array(
                                ':id' => $retFuente1P
                        )));
                foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                    $idCuentaContableRetencionFuente1 = $cuentaRetencionFuentes['cuentacontablecompras'];
                    $planCuentasNec = Plancuentasnec::model()->findAll(
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
                $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                        array(
                        'condition' => '"idcodretfuente" = :id',
                        'params' => array(
                                ':id' => $retFuente2P
                        )));
                foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                    $idCuentaContableRetencionFuente2 = $cuentaRetencionFuentes['cuentacontablecompras'];
                    $planCuentasNec = Plancuentasnec::model()->findAll(
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
                $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                        array(
                        'condition' => '"idcodretfuente" = :id',
                        'params' => array(
                                ':id' => $retFuente3P
                        )));
                foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                    $idCuentaContableRetencionFuente3 = $cuentaRetencionFuentes['cuentacontablecompras'];
                    $planCuentasNec = Plancuentasnec::model()->findAll(
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
                $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                        array(
                        'condition' => '"idcodretfuente" = :id',
                        'params' => array(
                                ':id' => $retFuente4P
                        )));
                foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                    $idCuentaContableRetencionFuente4 = $cuentaRetencionFuentes['cuentacontablecompras'];
                    $planCuentasNec = Plancuentasnec::model()->findAll(
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
                $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                        array(
                        'condition' => '"idcodretfuente" = :id',
                        'params' => array(
                                ':id' => $retFuente5P
                        )));
                foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                    $idCuentaContableRetencionFuente5 = $cuentaRetencionFuentes['cuentacontablecompras'];
                    $planCuentasNec = Plancuentasnec::model()->findAll(
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
                $cuentaRetencionFuente = Codigoretencionfuente::model()->findAll(
                        array(
                        'condition' => '"idcodretfuente" = :id',
                        'params' => array(
                                ':id' => $retFuente6P
                        )));
                foreach($cuentaRetencionFuente as $cuentaRetencionFuentes){
                    $idCuentaContableRetencionFuente6 = $cuentaRetencionFuentes['cuentacontablecompras'];
                    $planCuentasNec = Plancuentasnec::model()->findAll(
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

       /*
        * Carga todos los asientos de la devolucion
        * pasado por ajax
        *
        */
       public function actionbuscarAjaxAsientoDevolucion(){
            $idProducto=$this->getParam('idProductos');
            $totalProducto=$this->getParam('total');
            $montoIva=$this->getParam('montoIva');
            $porcentajeIva=$this->getParam('porcentajeIva');
            $montoIce=$this->getParam('montoIce');
            $porcentajeIce=$this->getParam('porcentajeIce');
            $saldo=$this->getParam('saldo');
            $idProveedor=$this->getParam('idProveedor');
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
                    $planCuentasNec = Plancuentasnec::model()->findAll(
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

            $porcentajeIvaCuenta = Porcentajeiva::model()->findAll(
                    array(
                    'condition' => '"id" = :id',
                    'params' => array(
                            ':id' => $porcentajeIva
                    )));
            foreach($porcentajeIvaCuenta as $porcentajeIvaCuentas){
                $itemCuentaContableMontoIva = $porcentajeIvaCuentas['cuentacontablecredito'];
                $planCuentasNec = Plancuentasnec::model()->findAll(
                        array(
                        'condition' => '"idcuentanec" = :idItem',
                        'params' => array(
                                ':idItem' => $itemCuentaContableMontoIva
                        )));
                foreach($planCuentasNec as $planCuentasNecs){
                    $cuentaContableMontoIva = $planCuentasNecs['nombrecuenta'];
                }
            }

            $porcentajeIceCuenta = Porcentajeice::model()->findAll(
                    array(
                    'condition' => '"id" = :id',
                    'params' => array(
                            ':id' => $porcentajeIce
                    )));
            foreach($porcentajeIceCuenta as $porcentajeIceCuentas){
                $idCuentaContableMontoIce = $porcentajeIceCuentas['cuentacontable'];
                $planCuentasNec = Plancuentasnec::model()->findAll(
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
                $planCuentasNec = Plancuentasnec::model()->findAll(
                        array(
                        'condition' => '"idcuentanec" = :idItem',
                        'params' => array(
                                ':idItem' => $idCuentaContableCuentaPagar
                        )));
                foreach($planCuentasNec as $planCuentasNecs){
                    $cuentaContableCuentaPagar = $planCuentasNecs['nombrecuenta'];
                }
            }                 

            $this->renderPartial('compra.views.compra.popup.listaasientodevolucion',compact('cuentaContableProducto','totalProducto','cuentaContableMontoIva','montoIva','cuentaContableMontoIce','montoIce','cuentaContableCuentaPagar','saldo'));


       }

        protected function loadModelMaestroAsiento($id) {
            if (!$id)
                    throw new CHttpException(500, MessageHandler::transformar('entidad_error','Maestroasiento'));
            return Maestroasiento::model()->findByPk($id);
        }
        protected function loadModelCompraCstm($id) {
            if (!$id)
                    throw new CHttpException(500, MessageHandler::transformar('entidad_error','Compraingresocstm'));
            return Compraingresocstm::model()->findByPk($id);
        }

        /*
        * Carga todos los asientos
        * pasado por ajax
        *
        */
       public function actionbuscarAjaxProducto(){
           $tipoProducto=$this->getParam('tipos');
            $this->renderPartial('compra.views.compra.popup.buscarproducto',compact('tipoProducto'));
       }

       public function actionresultadoBuscarAjaxProducto(){
           $nombreProducto=$this->getParam('nombre');
           $tipoProducto=$this->getParam('tipoProducto');

           if($tipoProducto=="0"){
               $producto = Item::model()->findAll(
                        array(
                        'condition' => '"nombre" LIKE :nombre',
                        'params' => array(
                                ':nombre' => "%$nombreProducto%"
                        )));
           }
           if($tipoProducto=="1"){
               $producto = Item::model()->findAll(
                        array(
                        'condition' => '"nombre" LIKE :nombre AND "tipoproducto" = 2',
                        'params' => array(
                                ':nombre' => "%$nombreProducto%"
                        )));
           }

           $ccosto = Plancentrocosto::model()->findAll();

           $this->renderPartial('compra.views.compra.popup.resultadobusquedaproducto',compact('producto','ccosto'));
       }

       public function actionbuscarAjaxProductoEditar(){
           $id=$this->getParam('id');
           $codigos=$this->getParam('codigos');
           $productos=$this->getParam('productos');
           $cantidads=$this->getParam('cantidads');
           $valors=$this->getParam('valors');
           $totals=$this->getParam('totals');
           $ccostos=$this->getParam('ccostos');
           $idProductos=$this->getParam('idProductos');
           $idCcostos=$this->getParam('idCcostos');
           $tarifaIvas=$this->getParam('tarifaIvas');

           $ccosto = Plancentrocosto::model()->findAll();

            $this->renderPartial('compra.views.compra.popup.editarproductocompras',compact('id','codigos','productos','cantidads','valors','totals','ccostos','idProductos','idCcostos','tarifaIvas','ccosto'));
       }
       
       public function actionbuscarAjaxCompra(){
           $proveedor=$this->getParam('proveedor');
           $this->renderPartial('compra.views.compra.popup.buscarcompra',compact('proveedor'));
       }

       public function actionresultadoBuscarAjaxCompra(){
           $numeroCompra=$this->getParam('numeroCompra');
           $proveedor=$this->getParam('proveedor');
           $this->renderPartial('compra.views.compra.popup.resultadobusquedacompra',compact('numeroCompra','proveedor'));
       }

       public function actionbuscarAjaxProductosVer(){
           $text=$this->getParam('idcompra');
           $this->renderPartial('compra.views.compra.popup.grilla_view',compact('text'));
       }

       public function actionbuscarAjaxOrdenCompra(){
           $this->renderPartial('compra.views.compra.popup.buscarordencompra');
       }

       public function actionresultadoBuscarAjaxOrdenCompra(){
           $numeroOrden=$this->getParam('ordencompra');

           if($numeroOrden==''){
               $ordenCompra = Ordencompra::model()->findAll(
                       array(
                        'condition' => 'estado=:estado AND anulado = false',
                        'params' => array(
                                ':estado' => "Aprobado"
                        )));
           }else{
               $ordenCompra = Ordencompra::model()->findAll(
                        array(
                        'condition' => '"numeroorden" = :numeroorden AND estado = :estado AND anulado = false',
                        'params' => array(
                                ':numeroorden' => $numeroOrden,
                                ':estado' => "Aprobado"
                        )));
           }
           $this->renderPartial('compra.views.compra.popup.resultadobusquedaordencompra',compact('ordenCompra'));
       }

}
