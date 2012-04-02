<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */

class TipoagenteretencionController extends Controller{


    public function actionIndex(){
        $this->layout  = '//layouts/listado';
        $model=new Tipoagenteretencion('search');
        
        $model->unsetAttributes(); 
            if(isset($_POST['Tipoagenteretencion']))
                $model->attributes=$_POST['Tipoagenteretencion'];
        $this->render('index',array('model'=>$model));
    }
    public function actionCrear(){
    if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));

        
        $model=new Tipoagenteretencion;
        $this->performAjaxValidation($model);
         if(isset($_POST['Tipoagenteretencion'])){
            $model->attributes=$_POST['Tipoagenteretencion'];
            $model->setScenario($this->getParam('scenario'));
            if($this->getParam('scenario')=='insert'){
                if($model->save()){
                    Auditoria::info(MessageHandler::transformar('model_create','Default','Auditoria',array('{model}'=>"TipoAgenteRetencion")),
                                    "TipoAgenteRetencion",
                                    $model->id,
                                    MessageHandler::transformar('data_create','Default','Auditoria',array('{model}'=>'TipoAgenteRetencion','{data}'=>$model->nombre)));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_create','Parametros','TipoAgenteRetencion'));
                    $this->redirect(array('update','id'=>$model->id));
                }
            }else{
                if($model->update()){
                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"TipoAgenteRetencion")),
                                    "TipoAgenteRetencion",
                                    $model->id,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"TipoAgenteRetencion")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','TipoAgenteRetencion'));
                    $this->redirect(array('update','id'=>$model->id));
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
         if(isset($_POST['Tipoagenteretencion'])){
            $model->attributes=$_POST['Tipoagenteretencion'];
                if($model->save()){
                    //Auditoria::info('Se actualizo el banco', 'Banco',$model->idbanco,' Banco actualiz '.$model->nombre);
                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"TipoAgenteRetencion")),
                                    "TipoAgenteRetencion",
                                    $model->id,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"TipoAgenteRetencion")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','TipoAgenteRetencion'));
                    $this->redirect(array('update','id'=>$model->id));
                }
          }
   
        $this->render('update',array('model'=>$model));

    }
    public function actionDelete(){
        $model = $this->loadModel();
        $relation=CuentaBancaria::model()->find('idbanco=:postID', array(':postID'=>$model->id));
        if(empty($relation)){
            //Auditoria::info('Se elimino un banco', 'Banco',$model->idbanco,' Banco eliminado '.$model->nombre);
            Auditoria::info(MessageHandler::transformar('model_delete','Default','Auditoria',array('{model}'=>"TipoAgenteRetencion")),
                                    "TipoAgenteRetencion",
                                    $model->id,
                                    MessageHandler::transformar('data_delete','Default','Auditoria',array('{model}'=>"TipoAgenteRetencion")));

            $model->setScenario('delete');
            $model->delete();
            $this->addFlash ("mensaje",MessageHandler::transformar('model_delete','Parametros','TipoAgenteRetencion'));
            $this->redirect(array('index'));
        }else{
            //Auditoria::warning('Se intento borrar un banco relacionado', 'Banco',$model->idbanco,' No se pudeo borra el banco '.$model->nombre);
            Auditoria::warning(MessageHandler::transformar('error_model_delete','Default','Auditoria',array('{model}'=>"TipoAgenteRetencion")),
                                    "TipoAgenteRetencion",
                                    $model->id,
                                    MessageHandler::transformar('error_data_delete','Default','Auditoria',array('{model}'=>"TipoAgenteRetencion")));

            $this->addFlash ("mensaje",MessageHandler::transformar('model_error','Parametros','TipoAgenteRetencion'));
            $this->redirect(array('update','id'=>$model->id));
        }
    }
    protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='tipo-agente-retencion-form'){
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
   }

   /**
	 * @return TipoAgenteRetencion
	 */
	protected function loadModel() {
		$id = $this->getParam('id');
		if (!$id)
			throw new CHttpException(500, MessageHandler::transformar('entidad_error','Parametros','TipoAgenteRetencion'));
		return Tipoagenteretencion::model()->findByPk($id);
	}
}


