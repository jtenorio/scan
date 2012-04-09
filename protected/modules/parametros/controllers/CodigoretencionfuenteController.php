<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */

class CodigoRetencionFuenteController extends Controller{



    public function actionIndex(){
        $this->layout  = '//layouts/listado';
        $model=new Codigoretencionfuente('search');
        $model->unsetAttributes();
            if(isset($_POST['CodigoRetencionFuente']))
                $model->attributes=$_POST['CodigoRetencionFuente'];

        $this->render('index',array('model'=>$model));
    }
    public function actionCrear(){
    if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));


        $model=new Codigoretencionfuente;
        $this->performAjaxValidation($model);
         if(isset($_POST['Codigoretencionfuente'])){
            $model->attributes=$_POST['Codigoretencionfuente'];
            $model->setScenario('insert');
            
                if($model->save()){
                    Auditoria::info(MessageHandler::transformar('model_create','Default','Auditoria',array('{model}'=>"CodigoRetencionFuente")),
                                    "CodigoRetencionFuente",
                                    $model->idcodretfuente,
                                    MessageHandler::transformar('data_create','Default','Auditoria',array('{model}'=>'CodigoRetencionFuente','{data}'=>$model->descripcion)));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_create','Parametros','CodigoRetencionFuente'));
                    $this->redirect(array('update','id'=>$model->idcodretfuente));
                }
            

         }
        $this->render('crear',array('model'=>$model));

    }

    public function actionUpdate(){
        if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));

        $model = $this->loadModel();

         if(!empty($_REQUEST['button_delete']))
           $this->redirect(array('delete','id'=>$model->idcodretfuente));

        $model = $this->loadModel();
        $model->setScenario('update');

        $this->performAjaxValidation($model);
         if(isset($_POST['Codigoretencionfuente'])){
            $model->attributes=$_POST['Codigoretencionfuente'];
                if($model->save()){
                    //Auditoria::info('Se actualizo el banco', 'Banco',$model->idbanco,' Banco actualiz '.$model->nombre);
                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"CodigoRetencionFuente")),
                                    "CodigoRetencionFuente",
                                    $model->idcodretfuente,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"CodigoRetencionFuente")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','CodigoRetencionFuente'));
                    $this->redirect(array('update','id'=>$model->idcodretfuente));
                }
          }

        $this->render('update',array('model'=>$model));

    }
    public function actionDelete(){
        $model = $this->loadModel();
        $relation=Cuentabancaria::model()->find('idbanco=:postID', array(':postID'=>$model->idcodretfuente));
        if(empty($relation)){
            
            Auditoria::info(MessageHandler::transformar('model_delete','Default','Auditoria',array('{model}'=>"CodigoRetencionFuente")),
                                    "CodigoRetencionFuente",
                                    $model->idcodretfuente,
                                    MessageHandler::transformar('data_delete','Default','Auditoria',array('{model}'=>"CodigoRetencionFuente")));

            $model->setScenario('delete');
            $model->delete();
            $this->addFlash ("mensaje",MessageHandler::transformar('model_delete','Parametros','CodigoRetencionFuente'));
            $this->redirect(array('index'));
        }else{
            //Auditoria::warning('Se intento borrar un banco relacionado', 'Banco',$model->idbanco,' No se pudeo borra el banco '.$model->nombre);
            Auditoria::warning(MessageHandler::transformar('error_model_delete','Default','Auditoria',array('{model}'=>"CodigoRetencionFuente")),
                                    "CodigoRetencionFuente",
                                    $model->idcodretfuente,
                                    MessageHandler::transformar('error_data_delete','Default','Auditoria',array('{model}'=>"CodigoRetencionFuente")));

            $this->addFlash ("mensaje",MessageHandler::transformar('model_error','Parametros','CodigoRetencionFuente'));
            $this->redirect(array('update','id'=>$model->idcodretfuente));
        }
    }
    protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='codigoretencionfuente-form'){
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
   }

   /**
	 * @return CodigoRetencionFuente
	 */
	protected function loadModel() {
		$id = $this->getParam('id');
		if (!$id)
			throw new CHttpException(500, MessageHandler::transformar('entidad_error','Parametros','CodigoRetencionFuente'));
		return Codigoretencionfuente::model()->findByPk($id);
	}
}
