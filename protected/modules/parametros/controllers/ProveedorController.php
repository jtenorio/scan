<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */

class ProveedorController extends Controller{



    public function actionIndex(){
        $this->layout  = '//layouts/listado';
        $model=new Proveedor('search');
        $model->unsetAttributes();
            if(isset($_POST['Proveedor']))
                $model->attributes=$_POST['Proveedor'];

        $this->render('index',array('model'=>$model));
    }

    public function actionCrear(){
    if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));


        $model=new Proveedor;
        $this->performAjaxValidation($model);
         if(isset($_POST['Proveedor'])){
            $model->attributes=$_POST['Proveedor'];
            $model->setScenario($this->getParam('scenario'));
            if($this->getParam('scenario')=='insert'){
                if($model->save()){
                    Auditoria::info(MessageHandler::transformar('model_create','Default','Auditoria',array('{model}'=>"Proveedor")),
                                    "Proveedor",
                                    $model->id,
                                    MessageHandler::transformar('data_create','Default','Auditoria',array('{model}'=>'Banco','{data}'=>$model->razonsocial)));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_create','Parametros','Proveedor'));
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
         if(isset($_POST['Proveedor'])){
            $model->attributes=$_POST['Proveedor'];
                if($model->save()){
                    //Auditoria::info('Se actualizo el banco', 'Banco',$model->idbanco,' Banco actualiz '.$model->nombre);
                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"Proveedor")),
                                    "Proveedor",
                                    $model->id,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"Proveedor")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','Proveedor'));
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
            Auditoria::info(MessageHandler::transformar('model_delete','Default','Auditoria',array('{model}'=>"Proveedor")),
                                    "Proveedor",
                                    $model->id,
                                    MessageHandler::transformar('data_delete','Default','Auditoria',array('{model}'=>"Proveedor")));

            $model->setScenario('delete');
            $model->delete();
            $this->addFlash ("mensaje",MessageHandler::transformar('model_delete','Parametros','Proveedor'));
            $this->redirect(array('index'));
        }else{
            //Auditoria::warning('Se intento borrar un banco relacionado', 'Banco',$model->idbanco,' No se pudeo borra el banco '.$model->nombre);
            Auditoria::warning(MessageHandler::transformar('error_model_delete','Default','Auditoria',array('{model}'=>"Proveedor")),
                                    "Proveedor",
                                    $model->id,
                                    MessageHandler::transformar('error_data_delete','Default','Auditoria',array('{model}'=>"Proveedor")));

            $this->addFlash ("mensaje",MessageHandler::transformar('model_error','Parametros','Proveedor'));
            $this->redirect(array('update','id'=>$model->id));
        }
    }
    protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='proveedor-form'){
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
   }

   /**
	 * @return Banco
	 */
	protected function loadModel() {
		$id = $this->getParam('id');
		if (!$id)
			throw new CHttpException(500, MessageHandler::transformar('entidad_error','Parametros','Proveedor'));
		return Proveedor::model()->findByPk($id);
	}
}
