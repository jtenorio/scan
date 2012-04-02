<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */

class PlancuentasniffController extends Controller{



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
		//	'accessControl', // perform access control for CRUD operations
	//	);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
//			array('allow',  // allow all users to perform 'index' and 'view' actions
//				'actions'=>array('index','view'),
//				'users'=>array('*'),
//			),
//			array('allow', // allow authenticated user to perform 'create' and 'update' actions
//				'actions'=>array('crear','update'),
//				'users'=>array('*'),
//			),
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('admin','delete'),
//				'users'=>array('*'),
//			),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCrear()
	{
	       if(!empty($_REQUEST['button_exit']))
                       $this->redirect(array('index'));


                $model=new Plancuentasniff;
                $this->performAjaxValidation($model);
                 if(isset($_POST['Plancuentasniff'])){
                    $model->attributes=$_POST['Plancuentasniff'];
                    $model->setScenario('insert');
         
                        if($model->save()){
                            Auditoria::info(MessageHandler::transformar('model_create','Default','Auditoria',array('{model}'=>"PlanCuentasNiff")),
                                            "PlanCuentasNiff",
                                            $model->idcuentaniff,
                                            MessageHandler::transformar('data_create','Default','Auditoria',array('{model}'=>'Banco','{data}'=>$model->nombrecuenta)));

                            $this->addFlash ("mensaje",MessageHandler::transformar('model_create','Parametros','PlanCuentasNiff'));
                            $this->redirect(array('update','id'=>$model->idcuentaniff));
                        }
                    }

         
                $this->render('crear',array('model'=>$model));

	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{

                 if(!empty($_REQUEST['button_exit']))
                       $this->redirect(array('index'));

                $model = $this->loadModel($id);

                 if(!empty($_REQUEST['button_delete']))
                   $this->redirect(array('delete','id'=>$model->idcuentaniff));

                
                $model->setScenario('update');

                $this->performAjaxValidation($model);
                 if(isset($_POST['Plancuentasniff'])){
                     $form=$_POST['Plancuentasniff'];
                    $model->attributes=$_POST['Plancuentasniff'];
                    $val=$model->save();
                        if($model->save()){
                            Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"PlanCuentasNiff")),
                                            "PlanCuentasNiff",
                                            $model->idcuentaniff,
                                            MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"PlanCuentasNiff")));

                            $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','PlanCuentasNiff'));
                            $this->redirect(array('update','id'=>$model->idcuentaniff));
                        }
                  }

                $this->render('update',array('model'=>$model));

	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
	 $model = $this->loadModel($id);
        $relation=Cuentabancaria::model()->find('idbanco=:postID', array(':postID'=>$model->idcuentaniff));
        if(empty($relation)){
            //Auditoria::info('Se elimino un banco', 'Banco',$model->idbanco,' Banco eliminado '.$model->nombre);
            Auditoria::info(MessageHandler::transformar('model_delete','Default','Auditoria',array('{model}'=>"PlanCuentasNiff")),
                                    "PlanCuentasNiff",
                                    $model->idcuentaniff,
                                    MessageHandler::transformar('data_delete','Default','Auditoria',array('{model}'=>"PlanCuentasNiff")));

            $model->setScenario('delete');
            $model->delete();
            $this->addFlash ("mensaje",MessageHandler::transformar('model_delete','Parametros','PlanCuentasNiff'));
            $this->redirect(array('index'));
        }else{
            //Auditoria::warning('Se intento borrar un banco relacionado', 'Banco',$model->idbanco,' No se pudeo borra el banco '.$model->nombre);
            Auditoria::warning(MessageHandler::transformar('error_model_delete','Default','Auditoria',array('{model}'=>"PlanCuentasNiff")),
                                    "PlanCuentasNiff",
                                    $model->idcuentaniff,
                                    MessageHandler::transformar('error_data_delete','Default','Auditoria',array('{model}'=>"PlanCuentasNiff")));

            $this->addFlash ("mensaje",MessageHandler::transformar('model_error','Parametros','PlanCuentasNiff'));
            $this->redirect(array('update','id'=>$model->idcuentaniff));
        }
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
                $this->layout  = '//layouts/listado';
                 $model=new Plancuentasniff('search');
                 $model->unsetAttributes();
                 if(isset($_POST['Plancuentasciff']))
                    $model->attributes=$_POST['Plancuentasniff'];
            $this->render('index',array('model'=>$model));
	}

	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Plancuentasniff::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,MessageHandler::transformar('entidad_error','Parametros','PlanCuentasNiff'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='plan-cuentas-niff-form')
		{
                  //  $data= CActiveForm::validate($model);
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
       /*
    * Carga todos las cuentas contables niff dependiendo del filtro de busqueda
    * pasado por ajax
    *
    */
   public function actionbuscarAjaxCuentaNiff(){
        $param=$this->getParam('nombre');
        $modelo=$this->getParam('modelo');
        $obj_fk=$this->getParam('obj_fk');
        $obj_name=$this->getParam('obj_name');
        $id=$this->getParam('id');

        $model=new Plancuentasniff;
        $criterio=$model->buscacuentaniff($param);
        $lista=$model->findAll($criterio);
        $this->renderPartial('popup/lista',compact('lista','modelo','obj_fk','obj_name','id'));


   }
  
}
