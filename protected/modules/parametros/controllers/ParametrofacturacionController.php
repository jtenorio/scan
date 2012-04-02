<?php

class ParametrofacturacionController extends Controller
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
//		return array(
//			'accessControl', // perform access control for CRUD operations
//		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
//		return array(
//			array('allow',  // allow all users to perform 'index' and 'view' actions
//				'actions'=>array('index','view'),
//				'users'=>array('*'),
//			),
//			array('allow', // allow authenticated user to perform 'create' and 'update' actions
//				'actions'=>array('create','update'),
//				'users'=>array('@'),
//			),
//			array('allow', // allow admin user to perform 'admin' and 'delete' actions
//				'actions'=>array('admin','delete'),
//				'users'=>array('admin'),
//			),
//			array('deny',  // deny all users
//				'users'=>array('*'),
//			),
//		);
	}

	public function actionIndex(){
            $this->layout  = '//layouts/listado';
        $model=new Parametrofacturacion('search');
        $model->unsetAttributes();
            if(isset($_POST['Parametrofacturacion']))
                $model->attributes=$_POST['Parametrofacturacion'];

        $this->render('index',array('model'=>$model));
    }
    public function actionCrear(){
    if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));


        $model=new Parametrofacturacion;
        $this->performAjaxValidation($model);
         if(isset($_POST['Parametrofacturacion'])){
            $model->attributes=$_POST['Parametrofacturacion'];
            $model->setScenario('insert');
            if($model->save()){
                    Auditoria::info(MessageHandler::transformar('model_create','Default','Auditoria',array('{model}'=>"ParametroFacturacion")),
                                    "ParametroFacturacion",
                                    $model->id,
                                    MessageHandler::transformar('data_create','Default','Auditoria',array('{model}'=>'ParametroFacturacion','{data}'=>$model->id)));
                    $this->addFlash ("mensaje",MessageHandler::transformar('model_create','Parametros','ParametroFacturacion'));
                    $this->redirect(array('update','id'=>$model->id));
                }


         }
        $this->render('crear',array('model'=>$model));

    }

    public function actionUpdate(){
        if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));

        $model = $this->loadModel();

         if(!empty($_REQUEST['button_delete']))
           $this->redirect(array('delete','id'=>$model->id));

        $model = $this->loadModel();
        $model->setScenario('update');

        $this->performAjaxValidation($model);
         if(isset($_POST['Parametrofacturacion'])){
            $model->attributes=$_POST['Parametrofacturacion'];
                if($model->save()){

                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"ParametroFacturacion")),
                                    "ParametroFacturacion",
                                    $model->id,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"ParametroFacturacion")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','ParametroFacturacion'));
                    $this->redirect(array('update','id'=>$model->id));
                }
          }

        $this->render('update',array('model'=>$model));

    }
    public function actionDelete(){
        $model = $this->loadModel();
        $relation=ParametroFacturacion::model()->find('id=:postID', array(':postID'=>$model->id));
        if(empty($relation)){
            //Auditoria::info('Se elimino un banco', 'Banco',$model->idbanco,' Banco eliminado '.$model->nombre);
            Auditoria::info(MessageHandler::transformar('model_delete','Default','Auditoria',array('{model}'=>"ParametroFacturacion")),
                                    "ParametroFacturacion",
                                    $model->id,
                                    MessageHandler::transformar('data_delete','Default','Auditoria',array('{model}'=>"ParametroFacturacion")));

            $model->setScenario('delete');
            $model->delete();
            $this->addFlash ("mensaje",MessageHandler::transformar('model_delete','Parametros','ParametroFacturacion'));
            $this->redirect(array('index'));
        }else{
            //Auditoria::warning('Se intento borrar un banco relacionado', 'Banco',$model->idbanco,' No se pudeo borra el banco '.$model->nombre);
            Auditoria::warning(MessageHandler::transformar('error_model_delete','Default','Auditoria',array('{model}'=>"ParametroFacturacion")),
                                    "ParametroFacturacion",
                                    $model->id,
                                    MessageHandler::transformar('error_data_delete','Default','Auditoria',array('{model}'=>"ParametroFacturacion")));

            $this->addFlash ("mensaje",MessageHandler::transformar('model_error','Parametros','ParametroFacturacion'));
            $this->redirect(array('update','id'=>$model->id));
        }
    }
    protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='parametros-facturacion-form'){
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
   }

        /**
	 * @return ParametroFacturacion
	 */
	protected function loadModel() {
		$id = $this->getParam('id');
		if (!$id)
			throw new CHttpException(500, MessageHandler::transformar('entidad_error','Parametros','ParametroFacturacion'));
		return Parametrofacturacion::model()->findByPk($id);
	}

}
