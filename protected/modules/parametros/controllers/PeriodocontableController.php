<?php

class PeriodocontableController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
        public $meses=array(
            '1'=>'Enero',
            '2'=>'Febrero',
            '3'=>'Marzo',
            '4'=>'Abril',
            '5'=>'Mayo',
            '6'=>'Junio',
            '7'=>'Julio',
            '8'=>'Agosto',
            '9'=>'Septiembre',
            '10'=>'Octubre',
            '11'=>'Noviembre',
            '12'=>'Diciembre',
        );
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
        $model=new Periodocontable('search');
        $model->unsetAttributes();
            if(isset($_POST['Periodocontable']))
                $model->attributes=$_POST['Periodocontable'];

        $this->render('index',array('model'=>$model));
    }
    public function actionCrear(){
    if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));


        $model=new Periodocontable;
        $this->performAjaxValidation($model);
         if(isset($_POST['Periodocontable'])){
            $model->attributes=$_POST['Periodocontable'];
            $model->setScenario('insert');
            if($model->save()){
                    Auditoria::info(MessageHandler::transformar('model_create','Default','Auditoria',array('{model}'=>"PeriodoContrable")),
                                    "PeriodoContable",
                                    $model->id,
                                    MessageHandler::transformar('data_create','Default','Auditoria',array('{model}'=>'PeriodoContable','{data}'=>$model->id)));
                    $this->addFlash ("mensaje",MessageHandler::transformar('model_create','Parametros','PeriodoContable'));
                    $this->redirect(array('update','id'=>$model->id));
                }


         }
        $this->render('crear',array('model'=>$model,'meses'=>$this->meses));

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
         if(isset($_POST['Periodocontable'])){
            $model->attributes=$_POST['Periodocontable'];
                if($model->save()){

                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"PeriodoContable")),
                                    "PeriodoContrable",
                                    $model->id,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"PeriodoContable")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','PeriodoContable'));
                    $this->redirect(array('update','id'=>$model->id));
                }
          }

        $this->render('update',array('model'=>$model,'meses'=>$this->meses));

    }
    public function actionDelete(){
        $model = $this->loadModel();
        $relation=Periodocontable::model()->find('id=:postID', array(':postID'=>$model->id));
        if(empty($relation)){
            //Auditoria::info('Se elimino un banco', 'Banco',$model->idbanco,' Banco eliminado '.$model->nombre);
            Auditoria::info(MessageHandler::transformar('model_delete','Default','Auditoria',array('{model}'=>"PeriodoContable")),
                                    "PeriodoContable",
                                    $model->id,
                                    MessageHandler::transformar('data_delete','Default','Auditoria',array('{model}'=>"PeriodoContable")));

            $model->setScenario('delete');
            $model->delete();
            $this->addFlash ("mensaje",MessageHandler::transformar('model_delete','Parametros','PeriodoContable'));
            $this->redirect(array('index'));
        }else{
            //Auditoria::warning('Se intento borrar un banco relacionado', 'Banco',$model->idbanco,' No se pudeo borra el banco '.$model->nombre);
            Auditoria::warning(MessageHandler::transformar('error_model_delete','Default','Auditoria',array('{model}'=>"PeriodoContable")),
                                    "PeriodoContrable",
                                    $model->id,
                                    MessageHandler::transformar('error_data_delete','Default','Auditoria',array('{model}'=>"PeriodoContable")));

            $this->addFlash ("mensaje",MessageHandler::transformar('model_error','Parametros','PeriodoContable'));
            $this->redirect(array('update','id'=>$model->id));
        }
    }
    protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='periodo-contrable-form'){
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
   }

        /**
	 * @return PeriodoContrable
	 */
	protected function loadModel() {
		$id = $this->getParam('id');
		if (!$id)
			throw new CHttpException(500, MessageHandler::transformar('entidad_error','Parametros','PeriodoContrable'));
		return Periodocontable::model()->findByPk($id);
	}

}
