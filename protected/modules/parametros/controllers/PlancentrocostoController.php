<?php
/**
 * @author josesambrano
 * @company B.O.S
 * @package modules.parametros.controller
 */

class PlancentroCostoController extends Controller
{

    public function actionIndex(){
        $this->layout  = '//layouts/listado';
        $model=new Plancentrocosto('search');
        $model->unsetAttributes();
            if(isset($_POST['Plancentrocosto']))
                $model->attributes=$_POST['PlancentroCosto'];

        $this->render('index',array('model'=>$model));
    }
    public function actionCrear(){
    if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));


        $model=new Plancentrocosto;
        $this->performAjaxValidation($model);
         if(isset($_POST['Plancentrocosto'])){
            $model->attributes=$_POST['Plancentrocosto'];
            $model->setScenario('insert');
            
                if($model->save()){
                    Auditoria::info(MessageHandler::transformar('model_create','Default','Auditoria',array('{model}'=>"PlanCentroCosto")),
                                    "PlanCentroCosto",
                                    $model->idcuentagasto,
                                    MessageHandler::transformar('data_create','Default','Auditoria',array('{model}'=>'PlanCentroCosto','{data}'=>$model->nombrecuenta)));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_create','Parametros','PlanCentroCosto'));
                    $this->redirect(array('update','id'=>$model->idcuentagasto));
                }
            
            

         }
        $this->render('crear',array('model'=>$model));

    }

    public function actionUpdate(){
        if(!empty($_REQUEST['button_exit']))
           $this->redirect(array('index'));

        $model = $this->loadModel();

         if(!empty($_REQUEST['button_delete']))
           $this->redirect(array('delete','id'=>$model->idcuentagasto));

        $model = $this->loadModel();
        $model->setScenario('update');

        $this->performAjaxValidation($model);
         if(isset($_POST['Plancentrocosto'])){
            $model->attributes=$_POST['Plancentrocosto'];
                if($model->save()){
                    
                    Auditoria::info(MessageHandler::transformar('model_modify','Default','Auditoria',array('{model}'=>"PlanCentroCosto")),
                                    "PlanCentroCosto",
                                    $model->idcuentagasto,
                                    MessageHandler::transformar('data_modify','Default','Auditoria',array('{model}'=>"PlanCentroCosto")));

                    $this->addFlash ("mensaje",MessageHandler::transformar('model_modify','Parametros','PlanCentroCosto'));
                    $this->redirect(array('update','id'=>$model->idcuentagasto));
                }
          }

        $this->render('update',array('model'=>$model));

    }
    public function actionDelete(){
        $model = $this->loadModel();
        $relation=Cuentabancaria::model()->find('idbanco=:postID', array(':postID'=>$model->idcuentagasto));
        if(empty($relation)){
            //Auditoria::info('Se elimino un banco', 'Banco',$model->idbanco,' Banco eliminado '.$model->nombre);
            Auditoria::info(MessageHandler::transformar('model_delete','Default','Auditoria',array('{model}'=>"PlanCentroCosto")),
                                    "PlanCentroCosto",
                                    $model->idcuentagasto,
                                    MessageHandler::transformar('data_delete','Default','Auditoria',array('{model}'=>"PlanCentroCosto")));

            $model->setScenario('delete');
            $model->delete();
            $this->addFlash ("mensaje",MessageHandler::transformar('model_delete','Parametros','PlanCentroCosto'));
            $this->redirect(array('index'));
        }else{
            //Auditoria::warning('Se intento borrar un banco relacionado', 'Banco',$model->idbanco,' No se pudeo borra el banco '.$model->nombre);
            Auditoria::warning(MessageHandler::transformar('error_model_delete','Default','Auditoria',array('{model}'=>"PlanCentroCosto")),
                                    "PlanCentroCosto",
                                    $model->idcuentagasto,
                                    MessageHandler::transformar('error_data_delete','Default','Auditoria',array('{model}'=>"PlanCentroCosto")));

            $this->addFlash ("mensaje",MessageHandler::transformar('model_error','Parametros','PlanCentroCosto'));
            $this->redirect(array('update','id'=>$model->idcuentagasto));
        }
    }
    protected function performAjaxValidation($model){
            if(isset($_POST['ajax']) && $_POST['ajax']==='plan-centro-costo-form'){
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
   }

   /**
	 * @return PlanCentroCosto
	 */
	protected function loadModel() {
		$id = $this->getParam('id');
		if (!$id)
			throw new CHttpException(500, MessageHandler::transformar('entidad_error','Parametros','PlanCentroCosto'));
		return Plancentrocosto::model()->findByPk($id);
	}

    
        
}
