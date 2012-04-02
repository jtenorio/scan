<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */

class SecuencialtransaccionController extends Controller{



    public function actionIndex(){
        $this->layout  = '//layouts/listado';
       $model=new Secuencialtransaccion('search');
       $model->unsetAttributes();
       if(isset($_GET['Secuencialtransaccion']))
                $model->attributes=$_GET['Secuencialtransaccion'];

       $this->render('index',array('model'=>$model));

    }


    public function actionCrear(){
    if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));


        $model=new Secuencialtransaccion;
        $this->performAjaxValidation($model);
         if(isset($_POST['Secuencialtransaccion'])){
            $model->attributes=$_POST['Secuencialtransaccion'];
            $model->setScenario($this->getParam('scenario'));
            if($this->getParam('scenario')=='insert'){
                if($model->save()){
                    Auditoria::info(MessageHandler::transformar('model_create','Default','Auditoria',array('{model}'=>"SecuencialTransaccion")),
                                    "SecuencialTransaccion",
                                    $model->id,
                                    MessageHandler::transformar('data_create','Default','Auditoria',array('{model}'=>'SecuencialTransaccion','{data}'=>$model->nombre)));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_create','Parametros','SecuencialTransaccion'));
                    $this->redirect(array('update','id'=>$model->id));
                }
            }else{
                if($model->update()){
                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"SecuencialTransaccion")),
                                    "SecuencialTransaccion",
                                    $model->id,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"SecuencialTransaccion")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','SecuencialTransaccion'));
                    $this->redirect(array('update','id'=>$model->idbanco));
                }
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
         if(isset($_POST['Secuencialtransaccion'])){
            $model->attributes=$_POST['Secuencialtransaccion'];
                if($model->save()){
                    //Auditoria::info('Se actualizo el banco', 'Banco',$model->idbanco,' Banco actualiz '.$model->nombre);
                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"SecuencialTransaccion")),
                                    "SecuencialTransaccion",
                                    $model->id,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"SecuencialTransaccion")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','SecuencialTransaccion'));
                    $this->redirect(array('update','id'=>$model->id));
                }
          }

        $this->render('update',array('model'=>$model));

    }
    

     protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='secuencial-transaccion-form'){
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
   }


   /**
	 * @return SecuencialTransaccion
	 */
	protected function loadModel() {
		$id = $this->getParam('id');
		if (!$id)
			throw new CHttpException(500, MessageHandler::transformar('entidad_error','Parametros','SecuencialTransaccion'));
		return Secuencialtransaccion::model()->findByPk($id);
	}

}
