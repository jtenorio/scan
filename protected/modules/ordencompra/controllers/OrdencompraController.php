<?php

class OrdencompraController extends Controller
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
		return array();
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
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
        public function actionViewaprobar($id)
	{
		$this->render('viewaprobar',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Ordencompra;

//                $resultado=array('error'=>'','url'=>'');
		if(isset($_POST['Ordencompra'])){
                    $tx = Yii::app()->getDb()->beginTransaction();
                    try{
                        $model->attributes=$_POST['Ordencompra'];

                        $model->idempresa = $this->empresa_id;
                        $model->fechaingreso = date("Y-m-d");
                        $model->estado = 'No Aprobado';
                        $model->idusuario = $this->usuario_id;
                        $model->anulado = 0;
                        if ($model->validate()){
                            if($model->save()){
                                $ordenCompraId = $model->id;
                                $codProd[] = $_POST['codigoProducto'];
                                $nomProd[] = $_POST['nombreProducto'];
                                $cantProd[] = $_POST['cantidadProducto'];
                                $valProd[] = $_POST['valorProducto'];
                                $totProd[] = $_POST['totalProducto'];
                                $idProd[] = $_POST['idProducto'];
                                $contador = count($codProd);
                                for($i=0;$i<$contador;$i++){
                                    $contador1 = count($cantProd[$i]);
                                    for($j=0;$j<$contador1;$j++){
                                        $detalleOrdenCompra = new Detalleordencompra;
                                        $detalleOrdenCompra->idordencompra = $ordenCompraId;
                                        $detalleOrdenCompra->iditem = $idProd[$i][$j];
                                        $detalleOrdenCompra->idempresa = $this->empresa_id;
                                        $detalleOrdenCompra->cantidadsolicitada = $cantProd[$i][$j];
                                        $detalleOrdenCompra->valorunitario = $valProd[$i][$j];
                                        $detalleOrdenCompra->valortotal = $totProd[$i][$j];
                                        if ($detalleOrdenCompra->validate()){
                                            if($detalleOrdenCompra->save()){
                                                $detalleOrdenCompraId = $detalleOrdenCompra->id;
                                            }
                                            else{
                                                $resultado['error'][]="error al almacenar detallecompra";
                                            }
                                        }else{
                                            $resultado['error'][]=$detalleOrdenCompra->getErrors();
                                        }
                                    }
                                }
    //                            $this->redirect(array('view','id'=>$model->id));
                            }
                            else
                                $resultado['error'][]="error al almacenar orden compra";
                        }else{
                            $resultado['error'][]=$model->getErrors();
                        }
                    }catch(Exception $ex){
                        $resultado['error'][]=$ex->getMessage();
                    }
                    $tamanoResultado = count($resultado['error']);
                    if($tamanoResultado == 0){
                        $tx->commit();
                        $this->redirect(array('view','id'=>$model->id));
                    }else{
                        $tx->rollback();                        
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
		$this->performAjaxValidation($model);
                $resultado=array('error'=>'','url'=>'');
		if(isset($_POST['Ordencompra'])){
                    $tx = Yii::app()->getDb()->beginTransaction();
                    try{
			$model->attributes=$_POST['Ordencompra'];
                        if ($model->validate()){
                            if($model->save()){
                                $ordenCompraId = $model->id;

                                $detalleOrdenCompra = Detalleordencompra::model()->findAll(
                                        array(
                                        'condition' => '"idordencompra" = :idordencompra',
                                        'params' => array(
                                                ':idordencompra' => $ordenCompraId
                                        )));
                                foreach($detalleOrdenCompra as $detalleOrdenCompras){
                                    //ELIMINO EL DETALLE ORDEN COMPRA
                                    $detalle = Detalleordencompra::model()->findByPk($detalleOrdenCompras['id']);
                                    $detalle->delete();
                                }
                                $codProd[] = $_POST['codigoProducto'];
                                $nomProd[] = $_POST['nombreProducto'];
                                $cantProd[] = $_POST['cantidadProducto'];
                                $valProd[] = $_POST['valorProducto'];
                                $totProd[] = $_POST['totalProducto'];
                                $idProd[] = $_POST['idProducto'];
                                $contador = count($codProd);
                                for($i=0;$i<$contador;$i++){
                                    $contador1 = count($cantProd[$i]);
                                    for($j=0;$j<$contador1;$j++){
                                        $detalleOrdenCompra = new Detalleordencompra;
                                        $detalleOrdenCompra->idordencompra = $ordenCompraId;
                                        $detalleOrdenCompra->iditem = $idProd[$i][$j];
                                        $detalleOrdenCompra->idempresa = $this->empresa_id;
                                        $detalleOrdenCompra->cantidadsolicitada = $cantProd[$i][$j];
                                        $detalleOrdenCompra->valorunitario = $valProd[$i][$j];
                                        $detalleOrdenCompra->valortotal = $totProd[$i][$j];
                                        if ($detalleOrdenCompra->validate()){
                                            if($detalleOrdenCompra->save()){
                                                $detalleOrdenCompraId = $detalleOrdenCompra->id;
                                            }
                                            else{
                                                $resultado['error'][]="error al almacenar detallecompra";
                                            }
                                        }else{
                                            $resultado['error'][]=$detalleOrdenCompra->getErrors();
                                        }
                                    }
                                }
//				$this->redirect(array('view','id'=>$model->id));
                            }else
                                $resultado['error'][]="error al modificar orden compra";
                        }else{
                            $resultado['error'][]=$model->getErrors();
                        }
                    }catch(Exception $ex){
                        $resultado['error'][]=$ex->getMessage();
                    }
                    $tamanoResultado = count($resultado['error']);
                    if($tamanoResultado == 1){
                        $tx->commit();
                        $this->redirect(array('view','id'=>$model->id));
                    }else{
                        $tx->rollback();
                        $this->render('update',array(
                                'model'=>$model,
                        ));
                    }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

        public function actionUpdateaprobar($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
                $resultado=array('error'=>'','url'=>'');
		if(isset($_POST['Ordencompra'])){
                    $tx = Yii::app()->getDb()->beginTransaction();
                    try{
			$model->attributes=$_POST['Ordencompra'];
                        $model->idusuarioaprueba = $this->usuario_id;
                        $model->fechaaprueba = date("Y-m-d");
                        if ($model->validate()){
                            if($model->save()){
                                $ordenCompraId = $model->id;

                                $detalleOrdenCompra = Detalleordencompra::model()->findAll(
                                        array(
                                        'condition' => '"idordencompra" = :idordencompra',
                                        'params' => array(
                                                ':idordencompra' => $ordenCompraId
                                        )));
                                foreach($detalleOrdenCompra as $detalleOrdenCompras){
                                    //ELIMINO EL DETALLE ORDEN COMPRA
                                    $detalle = Detalleordencompra::model()->findByPk($detalleOrdenCompras['id']);
                                    $detalle->delete();
                                }
                                $codProd[] = $_POST['codigoProducto'];
                                $nomProd[] = $_POST['nombreProducto'];
                                $cantProd[] = $_POST['cantidadProducto'];
                                $valProd[] = $_POST['valorProducto'];
                                $totProd[] = $_POST['totalProducto'];
                                $idProd[] = $_POST['idProducto'];
                                $contador = count($codProd);
                                for($i=0;$i<$contador;$i++){
                                    $contador1 = count($cantProd[$i]);
                                    for($j=0;$j<$contador1;$j++){
                                        $detalleOrdenCompra = new Detalleordencompra;
                                        $detalleOrdenCompra->idordencompra = $ordenCompraId;
                                        $detalleOrdenCompra->iditem = $idProd[$i][$j];
                                        $detalleOrdenCompra->idempresa = $this->empresa_id;
                                        $detalleOrdenCompra->cantidadsolicitada = $cantProd[$i][$j];
                                        $detalleOrdenCompra->valorunitario = $valProd[$i][$j];
                                        $detalleOrdenCompra->valortotal = $totProd[$i][$j];
                                        if ($detalleOrdenCompra->validate()){
                                            if($detalleOrdenCompra->save()){
                                                $detalleOrdenCompraId = $detalleOrdenCompra->id;
                                            }
                                            else{
                                                $resultado['error'][]="error al almacenar detallecompra";
                                            }
                                        }else{
                                            $resultado['error'][]=$detalleOrdenCompra->getErrors();
                                        }
                                    }
                                }
//				$this->redirect(array('view','id'=>$model->id));
                            }else
                                $resultado['error'][]="error al modificar orden compra";
                        }else{
                            $resultado['error'][]=$model->getErrors();
                        }
                    }catch(Exception $ex){
                        $resultado['error'][]=$ex->getMessage();
                    }
                    $tamanoResultado = count($resultado['error']);
                    if($tamanoResultado == 1){
                        $tx->commit();
                        $this->redirect(array('viewaprobar','id'=>$model->id));
                    }else{
                        $tx->rollback();
                        $this->render('updateaprobar',array(
                                'model'=>$model,
                        ));
                    }
		}
                $estado = $this->generarEstado();
		$this->render('updateaprobar',array(
			'model'=>$model,
                        'estado'=>$estado,
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
		$dataProvider=new CActiveDataProvider('Ordencompra');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
                $this->layout  = '//layouts/listado';
		$model=new Ordencompra('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ordencompra']))
			$model->attributes=$_GET['Ordencompra'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

        public function actionAdminaprobar()
	{
		$model=new Ordencompra('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ordencompra']))
			$model->attributes=$_GET['Ordencompra'];

		$this->render('adminaprobar',array(
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
		$model=Ordencompra::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='ordencompra-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
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

            $filtroTipoDocumento = 0;

            $model = new Proveedor;

            $criterio=$model->buscaProveedorCompra($param,20,$filtroTipoDocumento);

            $lista=$model->findAll($criterio,20,$filtroTipoDocumento);
            $this->renderPartial('parametros.views.proveedor.popup.lista',compact('lista','modelo','obj_fk','obj_name','id'));
       }

       public function actionbuscarAjaxProducto(){
           $tipoProducto=$this->getParam('tipos');
            $this->renderPartial('ordencompra.views.ordencompra.popup.buscarproducto',compact('tipoProducto'));
       }

       public function actionresultadoBuscarAjaxProducto(){
           $nombreProducto=$this->getParam('nombre');
           $tipoProducto=$this->getParam('tipoProducto');

           if($tipoProducto==0){
               $producto = Item::model()->findAll(
                        array(
                        'condition' => '"nombre" LIKE :nombre',
                        'params' => array(
                                ':nombre' => "%$nombreProducto%"
                        )));
           }                     

           $this->renderPartial('ordencompra.views.ordencompra.popup.resultadobusquedaproducto',compact('producto'));
       }

       public function actionbuscarAjaxProductoEditar(){
           $id=$this->getParam('id');
           $codigos=$this->getParam('codigos');
           $productos=$this->getParam('productos');
           $cantidads=$this->getParam('cantidads');
           $valors=$this->getParam('valors');
           $totals=$this->getParam('totals');
           $idProductos=$this->getParam('idProductos');

            $this->renderPartial('ordencompra.views.ordencompra.popup.editarproducto',compact('id','codigos','productos','cantidads','valors','totals','idProductos'));
       }

       protected function generarEstado()
	{
		$estado = array("No Aprobado"=>"No Aprobado","Aprobado"=>"Aprobado","Rechazado"=>"Rechazado");

                return $estado;
	}
}
