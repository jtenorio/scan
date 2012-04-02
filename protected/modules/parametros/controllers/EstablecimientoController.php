<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */

class EstablecimientoController extends Controller
{
    public function actionIndex(){
        $this->layout  = '//layouts/listado';
        $model=new Establecimiento('search');
        $model->unsetAttributes();
            if(isset($_POST['Establecimiento']))
                $model->attributes=$_POST['Establecimiento'];

        $this->render('index',array('model'=>$model));
    }
    public function actionCrear(){

        if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));


        $model=new Establecimiento;
        $this->performAjaxValidation($model);
         if(isset($_POST['Establecimiento'])){
            $model->attributes=$_POST['Establecimiento'];
            $model->setScenario('insert');
            
                if($model->save()){
                    Auditoria::info(MessageHandler::transformar('model_create','Default','Auditoria',array('{model}'=>"Establecimiento")),
                                    "Establecimiento",
                                    $model->id,
                                    MessageHandler::transformar('data_create','Default','Auditoria',array('{model}'=>'Establecimiento','{data}'=>$model->establecimiento)));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_create','Parametros','Establecimiento'));
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
           $this->redirect(array('delete','id'=>$model->idbanco));

        $model = $this->loadModel();
        $model->setScenario('update');

        $this->performAjaxValidation($model);
         if(isset($_POST['Establecimiento'])){
            $model->attributes=$_POST['Establecimiento'];
                if($model->save()){
                    //Auditoria::info('Se actualizo el banco', 'Banco',$model->idbanco,' Banco actualiz '.$model->nombre);
                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"Establecimiento")),
                                    "Establecimiento",
                                    $model->id,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"Establecimiento")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','Establecimiento'));
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
            Auditoria::info(MessageHandler::transformar('model_delete','Default','Auditoria',array('{model}'=>"Establecimiento")),
                                    "Establecimiento",
                                    $model->id,
                                    MessageHandler::transformar('data_delete','Default','Auditoria',array('{model}'=>"Establecimiento")));

            $model->setScenario('delete');
            $model->delete();
            $this->addFlash ("mensaje",MessageHandler::transformar('model_delete','Parametros','Establecimiento'));
            $this->redirect(array('index'));
        }else{
            //Auditoria::warning('Se intento borrar un banco relacionado', 'Banco',$model->idbanco,' No se pudeo borra el banco '.$model->nombre);
            Auditoria::warning(MessageHandler::transformar('error_model_delete','Default','Auditoria',array('{model}'=>"Establecimiento")),
                                    "Establecimiento",
                                    $model->id,
                                    MessageHandler::transformar('error_data_delete','Default','Auditoria',array('{model}'=>"Establecimiento")));

            $this->addFlash ("mensaje",MessageHandler::transformar('model_error','Parametros','Establecimiento'));
            $this->redirect(array('update','id'=>$model->id));
        }
    }
    protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='establecimiento-form'){
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
   }

        /**
	 * @return Establecimiento
	 */
	protected function loadModel() {
		$id = $this->getParam('id');
		if (!$id)
			throw new CHttpException(500, MessageHandler::transformar('entidad_error','Parametros','Establecimiento'));
		return Establecimiento::model()->findByPk($id);
	}

   

        
}
