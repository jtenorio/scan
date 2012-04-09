<?php

class DetalleasientosController extends Controller
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
		$model=new Detalleasientos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

                $idCabecera = $_REQUEST['id'];
                 //obtener el modelo de la cabecera
                $cabecera = new Maestroasiento;
                $cabecera->idasiento = $idCabecera;
                $rowCabecera = $cabecera->search()->getData();

                //si el asiento esta mayorizado no debe permitir editar
                if($rowCabecera[0]->mayorizado || $rowCabecera[0]->estado)
                {
                    $this->redirect(array('maestroasiento/view','id'=>$idCabecera));
                }
                
                        if(isset($_POST['Detalleasientos']))
                        {           

                                $model->attributes=$_POST['Detalleasientos'];

                                //TEST
                                $model->idempresa = 1;
                                $model->idasiento = $idCabecera;
                                $model->subdetalle= $rowCabecera[0]->detalle;

                                if($_POST['Detalleasientos']['valordebe']!= '' || $_POST['Detalleasientos']['valorhaber']!='')
                                {
                                    $model->valordebe = $_POST['Detalleasientos']['valordebe']==''?0:$_POST['Detalleasientos']['valordebe'];
                                    $model->valorhaber = $_POST['Detalleasientos']['valorhaber']==''?0:$_POST['Detalleasientos']['valorhaber'];
                                }
                                
                                if($model->save()){

                                }            
                        }


                //Obetner todas las cuentas
                $planCuentas = new Plancuentasnec;
                //$planCuentas->tipocuenta= TRUE;
                $listaCuentas = $planCuentas->findAll();

                $cuentas = array();
                
                
                foreach($listaCuentas as $cu)
                {
                    $cuentas[$cu->idcuentanec] = trim($cu->cuentacontable)." (".trim($cu->nombrecuenta).")";
                }
               
                $this->render('create',array(
                                'model'=>$model,
                                'id'=>$idCabecera,
                                'detalle'=>$rowCabecera[0]->detalle,
                                'cuentasnec'=>$cuentas,
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

		if(isset($_POST['Detalleasientos']))
		{
			$model->attributes=$_POST['Detalleasientos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
	public function actionDelete()
	{
            $id = $_REQUEST['id'];
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			$this->redirect(array('detalleasientos/create','id'=>$id));
		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = new Detalleasientos;
        
        $criteria=new CDbCriteria;

		$criteria->compare('idasiento',$_REQUEST['idCabecera']);
        
        $dataProvider=new CActiveDataProvider('Detalleasientos', array(
			'criteria'=>$criteria,
		));
        
        $data = $model->getAsientoDetalle($_REQUEST['idCabecera']);
        
        
        
		$this->renderPartial('index',array(
			'dataProvider'=>$data,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Detalleasientos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Detalleasientos']))
			$model->attributes=$_GET['Detalleasientos'];

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
		$model=Detalleasientos::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='detalleasientos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
