<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */

class TipoComprobanteController extends Controller{



    public function actionIndex(){
        $this->layout  = '//layouts/listado';
        $model=new Tipocomprobante('search');
        $model->unsetAttributes();
            if(isset($_POST['TipoComprobante']))
                $model->attributes=$_POST['TipoComprobante'];

        $this->render('index',array('model'=>$model));
    }
    public function actionCrear(){
    if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));


        $model=new Tipocomprobante;
        $this->performAjaxValidation($model);
         if(isset($_POST['Tipocomprobante'])){
            $model->attributes=$_POST['Tipocomprobante'];
            $model->setScenario($this->getParam('scenario'));
            if($this->getParam('scenario')=='insert'){
                if($model->save()){
                    Auditoria::info(MessageHandler::transformar('model_create','Default','Auditoria',array('{model}'=>"TipoComprobante")),
                                    "TipoComprobante",
                                    $model->id,
                                    MessageHandler::transformar('data_create','Default','Auditoria',array('{model}'=>'TipoComprobante','{data}'=>$model->codigo)));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_create','Parametros','TipoComprobante'));
                    $this->redirect(array('update','id'=>$model->id));
                }
            }else{
                if($model->update()){
                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"TipoComprobante")),
                                    "TipoComprobante",
                                    $model->id,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"TipoComprobante")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','TipoComprobante'));
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
         if(isset($_POST['Tipocomprobante'])){
            $model->attributes=$_POST['Tipocomprobante'];
                if($model->save()){
                    
                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"TipoComprobante")),
                                    "TipoComprobante",
                                    $model->id,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"TipoComprobante")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','TipoComprobante'));
                    $this->redirect(array('update','id'=>$model->id));
                }
          }

        $this->render('update',array('model'=>$model));

    }
    public function actionDelete(){
        $model = $this->loadModel();
        $relation=Cuentabancaria::model()->find('idbanco=:postID', array(':postID'=>$model->id));
        if(empty($relation)){
            //Auditoria::info('Se elimino un banco', 'Banco',$model->idbanco,' Banco eliminado '.$model->nombre);
            Auditoria::info(MessageHandler::transformar('model_delete','Default','Auditoria',array('{model}'=>"TipoComprobante")),
                                    "TipoComprobante",
                                    $model->id,
                                    MessageHandler::transformar('data_delete','Default','Auditoria',array('{model}'=>"TipoComprobante")));

            $model->setScenario('delete');
            $model->delete();
            $this->addFlash ("mensaje",MessageHandler::transformar('model_delete','Parametros','TipoComprobante'));
            $this->redirect(array('index'));
        }else{
            //Auditoria::warning('Se intento borrar un banco relacionado', 'Banco',$model->idbanco,' No se pudeo borra el banco '.$model->nombre);
            Auditoria::warning(MessageHandler::transformar('error_model_delete','Default','Auditoria',array('{model}'=>"TipoComprobante")),
                                    "TipoComprobante",
                                    $model->id,
                                    MessageHandler::transformar('error_data_delete','Default','Auditoria',array('{model}'=>"TipoComprobante")));

            $this->addFlash ("mensaje",MessageHandler::transformar('model_error','Parametros','TipoComprobante'));
            $this->redirect(array('update','id'=>$model->id));
        }
    }
    protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='tipo-comprobante-form'){
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
   }

        /**
	 * @return TipoComprobante
	 */
   protected function loadModel() {
		$id = $this->getParam('id');
		if (!$id)
			throw new CHttpException(500, MessageHandler::transformar('entidad_error','Parametros','TipoComprobante'));
		return Tipocomprobante::model()->findByPk($id);
   }
}
