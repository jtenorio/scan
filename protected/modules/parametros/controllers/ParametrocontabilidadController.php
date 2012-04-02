<?php
/**
 * Clase que maneja todos los parametros de contabilidad para el sistema
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */

class ParametrocontabilidadController extends Controller
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
	//		'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
//	/	return array(
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
        $model=new Parametrocontabilidad('search');
        $model->unsetAttributes();
            if(isset($_POST['Parametrocontabilidad']))
                $model->attributes=$_POST['Parametrocontabilidad'];

        $this->render('index',array('model'=>$model));
    }
    public function actionCrear(){
    if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));


        $model=new Parametrocontabilidad;
        $this->performAjaxValidation($model);
         if(isset($_POST['Parametrocontabilidad'])){
            $model->attributes=$_POST['Parametrocontabilidad'];
            $model->setScenario('insert');
            if($model->save()){
                    Auditoria::info(MessageHandler::transformar('model_create','Default','Auditoria',array('{model}'=>"ParametroContabilidad")),
                                    "ParametroContabilidad",
                                    $model->idparametrocontabilidad,
                                    MessageHandler::transformar('data_create','Default','Auditoria',array('{model}'=>'ParametroContabilidad','{data}'=>$model->idparametrocontabilidad)));
                    $this->addFlash ("mensaje",MessageHandler::transformar('model_create','Parametros','ParametroContabilidad'));
                    $this->redirect(array('update','id'=>$model->idparametrocontabilidad));
                }
            

         }
        $this->render('crear',array('model'=>$model,'documentos'=>self::loadDocumentos()));

    }

    public function actionUpdate(){
        if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));

        $model = $this->loadModel();

         if(!empty($_REQUEST['button_delete']))
           $this->redirect(array('delete','id'=>$model->idparametrocontabilidad));

        $model = $this->loadModel();
        $model->setScenario('update');

        $this->performAjaxValidation($model);
         if(isset($_POST['Parametrocontabilidad'])){
            $model->attributes=$_POST['Parametrocontabilidad'];
                if($model->save()){
                   
                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"ParametroContabilidad")),
                                    "ParametroContabilidad",
                                    $model->idparametrocontabilidad,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"ParametroContabilidad")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','ParametroContabilidad'));
                    $this->redirect(array('update','id'=>$model->idparametrocontabilidad));
                }
          }

        $this->render('update',array('model'=>$model,'documentos'=>self::loadDocumentos()));

    }
    public function actionDelete(){
        $model = $this->loadModel();
        $relation=Parametrocontabilidad::model()->find('idparametrocontabilidad=:postID', array(':postID'=>$model->idparametrocontabilidad));
        if(empty($relation)){
            //Auditoria::info('Se elimino un banco', 'Banco',$model->idbanco,' Banco eliminado '.$model->nombre);
            Auditoria::info(MessageHandler::transformar('model_delete','Default','Auditoria',array('{model}'=>"ParametroContabilidad")),
                                    "ParametroContabilidad",
                                    $model->idparametrocontabilidad,
                                    MessageHandler::transformar('data_delete','Default','Auditoria',array('{model}'=>"ParametroContabilidad")));

            $model->setScenario('delete');
            $model->delete();
            $this->addFlash ("mensaje",MessageHandler::transformar('model_delete','Parametros','ParametroContabilidad'));
            $this->redirect(array('index'));
        }else{
            //Auditoria::warning('Se intento borrar un banco relacionado', 'Banco',$model->idbanco,' No se pudeo borra el banco '.$model->nombre);
            Auditoria::warning(MessageHandler::transformar('error_model_delete','Default','Auditoria',array('{model}'=>"ParametroContabilidad")),
                                    "ParametroContabilidad",
                                    $model->idparametrocontabilidad,
                                    MessageHandler::transformar('error_data_delete','Default','Auditoria',array('{model}'=>"ParametroContabilidad")));

            $this->addFlash ("mensaje",MessageHandler::transformar('model_error','Parametros','ParametroContabilidad'));
            $this->redirect(array('update','id'=>$model->idparametrocontabilidad));
        }
    }
    protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='parametros-contabilidad-form'){
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
   }

        /**
	 * @return ParametroContabilidad
	 */
	protected function loadModel() {
		$id = $this->getParam('id');
		if (!$id)
			throw new CHttpException(500, MessageHandler::transformar('entidad_error','Parametros','ParametroContabilidad'));
		return Parametrocontabilidad::model()->findByPk($id);
	}

        /*
         * @return <CHtml::listData>
         */
         public function loadDocumentos(){
             $documentos = Tipodocumentocontable::model()->findAll(array('order' => 'descripcion'));
		$documentos_items = CHtml::listData($documentos, 'iddocumento', 'descripcion');
             return $documentos_items;
         }
    
}
